<?php

namespace Smark\Smark;

use chillerlan\QRCode\QRCode;
use Picqer\Barcode\BarcodeGeneratorHTML;
use VStelmakh\UrlHighlight\UrlHighlight;

class HTML
{
    public static function renderHTML($code) {
        // Output HTML content using heredoc syntax
        echo <<<HTML
            $code
        HTML;
    }

    public static function withURL($string)
    {
        $urlHighlight = new UrlHighlight();
        return $urlHighlight->highlightUrls($string);
    }

    public static function generateQRCode($data)
    {

        $out  = (new QRCode())->render($data); // -> data:image/webp;base64,...

        return '<img alt="QRCode" src="'.$out.'" />';
    }

    // BARCODE

    public static function generateBarCode($data)
    {
        $generator = new BarcodeGeneratorHTML();
        return $generator->getBarcode($data, $generator::TYPE_CODE_128);
    }

    public static function filamentMonths()
    {
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

    public static function filamentYears($startYear) {
        $currentYear = date("Y"); // Get the current year
        $numberOfYears = $currentYear - $startYear + 1; // Calculate the number of years

        $options = '';

        for ($i = 0; $i < $numberOfYears; $i++) {
            $year = $startYear + $i;
            // Check if the current year matches the year being generated
            $selected = ($year == $currentYear) ? ' selected' : '';
            $options .= "<option value=\"$year\"$selected>$year</option>\n";
        }

        echo <<<HTML
            <select id="options" name="options" required class="fi-select-input rounded-md block w-full border border-gray-400 bg-transparent py-1.5 pe-8 text-base text-gray-950 transition duration-75 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6 [&_optgroup]:bg-white [&_optgroup]:dark:bg-gray-900 [&_option]:bg-white [&_option]:dark:bg-gray-900 ps-3">
                <option value="" disabled selected>Select an option</option>
                $options
            </select>
        HTML;
    }
}
