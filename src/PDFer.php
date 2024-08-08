<?php

namespace Smark\Smark;

use PDF;

class PDFer
{
    public static function export($data)
    {
        require 'PDF.php';
        $pdf = new PDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Sample data array
        $data = $data;

        // Set document information
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Example PDF Export');
        $pdf->SetSubject('Using TCPDF for PDF generation');
        $pdf->SetKeywords('TCPDF, PDF, example, PHP, export');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Example PDF Export', '');

        // Set header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 10));
        $pdf->setFooterFont(Array('helvetica', '', 8));

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
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

        // Output custom HTML header
        $pdf->writeHTML($html_header, true, false, true, false, '');

        // HTML content - Table with data
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

        // Loop through data and add rows to HTML table
        foreach ($data as $row) {
            $html_table .= '<tr>';
            $html_table .= '<td>' . $row['ID'] . '</td>';
            $html_table .= '<td>' . $row['Name'] . '</td>';
            $html_table .= '<td>' . $row['Email'] . '</td>';
            $html_table .= '<td>' . $row['Email'] . '</td>';
            $html_table .= '</tr>';
        }

        $html_table .= '</table>';

        // Output HTML content - Table with data
        $pdf->writeHTML($html_table, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('example.pdf', 'I');
    }
}
