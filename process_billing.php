<?php
require('fpdf.php');

// Create instance of FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add title
$pdf->Cell(40, 10, 'Invoice');

// Fetch and add invoice details from database...

$pdf->Output('invoice.pdf', 'D'); // Force download
?>
