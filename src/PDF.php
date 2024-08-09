<?php

// Extend TCPDF class to create custom header and footer
class PDF extends TCPDF {
    // Method to set up the page header
    public function Header() {
        // Set the font for the header text: Helvetica, bold, 12 pt size
        $this->SetFont('helvetica', 'B', 12);
        // Add a cell with the title text centered
        // Parameters:
        // 0: Width (0 means full width)
        // 10: Height
        // 'Example PDF Export with TCPDF': Text to display
        // 0: Border (0 means no border)
        // false: Line break after the cell (false means no line break)
        // 'C': Text alignment (Center)
        // 0: Fill (0 means no fill)
        // '': Link (empty means no link)
        // 0: Stretch (0 means no stretching)
        // false: Ignore padding (false means padding is applied)
        // 'M': Vertical alignment (Middle)
        // 'M': Horizontal alignment (Middle)
        $this->Cell(0, 10, 'Example PDF Export with TCPDF', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // Add a line break of 10 mm
        $this->Ln(10);
    }

    // Method to set up the page footer
    public function Footer() {
        // Position the cursor at 15 mm from the bottom of the page
        $this->SetY(-15);
        // Set the font for the footer text: Helvetica, italic, 8 pt size
        $this->SetFont('helvetica', 'I', 8);
        // Add a cell with the page number centered
        // Parameters:
        // 0: Width (0 means full width)
        // 10: Height
        // 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(): Text to display (current page number / total pages)
        // 0: Border (0 means no border)
        // false: Line break after the cell (false means no line break)
        // 'C': Text alignment (Center)
        // 0: Fill (0 means no fill)
        // '': Link (empty means no link)
        // 0: Stretch (0 means no stretching)
        // false: Ignore padding (false means padding is applied)
        // 'T': Vertical alignment (Top)
        // 'M': Horizontal alignment (Middle)
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}