<?php

namespace Smark\Smark;

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
}
