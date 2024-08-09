<?php

namespace Smark\Smark;

use chillerlan\QRCode\QRCode;
use Picqer\Barcode\BarcodeGeneratorHTML;
use VStelmakh\UrlHighlight\UrlHighlight;

class HTML
{
    // Renders HTML content using heredoc syntax
    public static function renderHTML($code) {
        // Output the provided HTML code
        echo <<<HTML
            $code
        HTML;
    }

    // Highlights URLs in a string
    public static function withURL($string)
    {
        $urlHighlight = new UrlHighlight(); // Create an instance of UrlHighlight
        return $urlHighlight->highlightUrls($string); // Highlight URLs in the provided string
    }

    // Generates a QR code image
    public static function generateQRCode($data)
    {
        // Render the QR code with the provided data
        $out = (new QRCode())->render($data); // Output is a data URI (base64-encoded image)

        // Return an HTML <img> tag to display the QR code
        return '<img alt="QRCode" src="'.$out.'" />';
    }

    // Generates a barcode image
    public static function generateBarCode($data)
    {
        $generator = new BarcodeGeneratorHTML(); // Create an instance of BarcodeGeneratorHTML
        // Generate the barcode in HTML format (TYPE_CODE_128)
        return $generator->getBarcode($data, $generator::TYPE_CODE_128);
    }

    // Renders a dropdown menu for selecting months
    public static function filamentMonths()
    {
        // Output the HTML for a dropdown menu with months
        echo <<<HTML
            <select id="options" name="options" required class="fi-select-input rounded-md block w-full border border-gray-400 bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&_optgroup]:bg-white [&_optgroup]:dark:bg-gray-900 [&_option]:bg-white [&_option]:dark:bg-gray-900 ps-3">
                <option value="" disabled selected>Select an option</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        HTML;
    }

    // Renders a dropdown menu for selecting years
    public static function filamentYears($startYear) {
        $currentYear = date("Y"); // Get the current year
        $numberOfYears = $currentYear - $startYear + 1; // Calculate the number of years to display

        $options = ''; // Initialize an empty string for options

        // Generate options for each year from startYear to currentYear
        for ($i = 0; $i < $numberOfYears; $i++) {
            $year = $startYear + $i;
            // Mark the current year as selected
            $selected = ($year == $currentYear) ? ' selected' : '';
            $options .= "<option value=\"$year\"$selected>$year</option>\n";
        }

        // Output the HTML for a dropdown menu with years
        echo <<<HTML
            <select id="options" name="options" required class="fi-select-input rounded-md block w-full border border-gray-400 bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&_optgroup]:bg-white [&_optgroup]:dark:bg-gray-900 [&_option]:bg-white [&_option]:dark:bg-gray-900 ps-3">
                <option value="" disabled selected>Select an option</option>
                $options
            </select>
        HTML;
    }
}
