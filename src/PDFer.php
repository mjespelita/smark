<?php

namespace Smark\Smark;

/**
 * export($data)
 */

use PDF;

class PDFer
{
    // Method to export data as a PDF
    public static function export($data)
    {
        // Include the PDF class
        require 'PDF.php';

        // Create a new PDF document instance
        // Parameters:
        // "L": Page orientation (Landscape)
        // PDF_UNIT: Unit of measure (default)
        // PDF_PAGE_FORMAT: Page format (default)
        // true: Unicode support
        // 'UTF-8': Character encoding
        // false: Disable automatic page breaking
        $pdf = new PDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Sample data array (overwrites the input data)
        $data = $data;

        // Set document information
        $pdf->SetCreator(PDF_CREATOR); // Set the creator of the document
        $pdf->SetAuthor('Your Name'); // Set the author of the document
        $pdf->SetTitle('Example PDF Export'); // Set the title of the document
        $pdf->SetSubject('Using TCPDF for PDF generation'); // Set the subject of the document
        $pdf->SetKeywords('TCPDF, PDF, example, PHP, export'); // Set keywords for the document

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Example PDF Export', ''); // Set header data (left, center, right content)

        // Set header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 10)); // Set font for the header (Helvetica, normal, 10 pt)
        $pdf->setFooterFont(Array('helvetica', '', 8)); // Set font for the footer (Helvetica, normal, 8 pt)

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); // Set left, top, and right margins
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER); // Set header margin
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER); // Set footer margin

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); // Enable auto page breaks and set bottom margin

        // Add a page to the PDF
        $pdf->AddPage();

        // Custom HTML header
        $html_header = '
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: left; width: 33.33%;">Company Name</td>
                    <td style="text-align: center; width: 33.33%;"><h2>Report Title</h2></td>
                    <td style="text-align: right; width: 33.33%;">Date: ' . date('Y-m-d') . '</td>
                </tr>
            </table>
            <hr>
        ';

        // Output the custom HTML header
        $pdf->writeHTML($html_header, true, false, true, false, '');

        // HTML content for the table with data
        $html_table = '
            <h1>User Data</h1>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Email</th>
                </tr>
        ';

        // Loop through the data and add rows to the HTML table
        foreach ($data as $row) {
            $html_table .= '<tr>';
            $html_table .= '<td>' . $row['ID'] . '</td>'; // Add ID
            $html_table .= '<td>' . $row['Name'] . '</td>'; // Add Name
            $html_table .= '<td>' . $row['Email'] . '</td>'; // Add Email
            $html_table .= '<td>' . $row['Email'] . '</td>'; // Add Email again (duplicate)
            $html_table .= '</tr>';
        }

        $html_table .= '</table>';

        // Output the HTML content - Table with data
        $pdf->writeHTML($html_table, true, false, true, false, '');

        // Close and output the PDF document
        // Parameters:
        // 'example.pdf': Name of the output file
        // 'I': Output destination (I = inline in browser)
        $pdf->Output('example.pdf', 'I');
    }
}
