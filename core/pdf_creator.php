<?php
require("../statics/fpdf/fpdf.php");

$pdf = new FPDF(); // Create a new PDF file
$pdf->AddPage(); // Create a blank page
$pdf->SetFont("Arial", "", 12); // Set the font (Font family, style, size)
$pdf->Cell(40, 10, "Hello World !");
$pdf->Output("test.pdf", "D");
?>