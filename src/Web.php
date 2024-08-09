<?php

namespace Smark\Smark;

/**
 * scrapeWithCssSelectors($url, $cssSelectors)
 * extractScriptsAndLinks($url)
 * extractEmails($url)
 * extractImages($url)
 */

use DOMDocument;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Web
{
    public static function scrapeWithCssSelectors($url, $cssSelectors) {
        // Create a new Guzzle HTTP client
        $client = new Client();
    
        // Send a GET request to the URL
        $response = $client->request('GET', $url);
    
        // Get the response body as a string
        $html = (string) $response->getBody();
    
        // Create a new Crawler instance
        $crawler = new Crawler($html);
    
        // Initialize an array to hold the extracted data
        $extractedData = [];
    
        // Loop through each CSS selector and extract data
        foreach ($cssSelectors as $name => $selector) {
            $extractedData[$name] = $crawler->filter($selector)->each(function (Crawler $node) {
                return $node->text();
            });
        }
    
        return $extractedData;
    }

    public static function extractScriptsAndLinks($url) {
        // Create a new DOMDocument instance
        $dom = new DOMDocument();
    
        // Suppress errors due to malformed HTML
        libxml_use_internal_errors(true);
    
        // Load the HTML content from the URL
        $html = file_get_contents($url);
        if ($html === false) {
            return ['error' => 'Could not retrieve URL content.'];
        }
    
        // Load the HTML into the DOMDocument
        $dom->loadHTML($html);
    
        // Clear the libxml errors
        libxml_clear_errors();
    
        // Create arrays to hold scripts and links
        $scripts = [];
        $links = [];
    
        // Extract <script> tags
        foreach ($dom->getElementsByTagName('script') as $script) {
            $scripts[] = $script->getAttribute('src');
        }
    
        // Extract <link> tags
        foreach ($dom->getElementsByTagName('link') as $link) {
            $links[] = $link->getAttribute('href');
        }
    
        // Return the results
        return [
            'scripts' => array_filter($scripts),
            'links' => array_filter($links),
        ];
    }

    public static function extractEmails($url) {
        // Retrieve the HTML content from the URL
        $html = file_get_contents($url);
        if ($html === false) {
            return ['error' => 'Could not retrieve URL content.'];
        }
    
        // Define a regular expression pattern for email addresses
        $emailPattern = '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';
    
        // Use preg_match_all to find all matches of the pattern
        preg_match_all($emailPattern, $html, $matches);
    
        // Return the unique email addresses
        return array_unique($matches[0]);
    }

    public static function extractImages($url) {
        // Create a new DOMDocument instance
        $dom = new DOMDocument();
    
        // Suppress errors due to malformed HTML
        libxml_use_internal_errors(true);
    
        // Load the HTML content from the URL
        $html = file_get_contents($url);
        if ($html === false) {
            return ['error' => 'Could not retrieve URL content.'];
        }
    
        // Load the HTML into the DOMDocument
        $dom->loadHTML($html);
    
        // Clear the libxml errors
        libxml_clear_errors();
    
        // Create an array to hold image URLs
        $images = [];
    
        // Extract <img> tags
        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');
            if ($src) {
                $images[] = htmlspecialchars($src); // Escape for safety
            }
        }
    
        // Return the results
        return array_unique($images); // Ensure unique URLs
    }
}
