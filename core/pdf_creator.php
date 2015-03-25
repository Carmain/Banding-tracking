<?php
require("../statics/fpdf/fpdf.php");

if (isset($_POST["bird_infos"]) && isset($_POST["observers_list"])) {

	// Get the informations to fill the blank
	$bird_info = utf8_decode(base64_decode($_POST["bird_infos"]));
	$observers_list =  utf8_decode(base64_decode($_POST["observers_list"]));

	$pdf = new FPDF(); // Create a new PDF file
	$pdf->AddPage(); // Create a blank page
	$pdf->SetFont("Arial", "", 12); // Set the font (Font family, style, size)
	$pdf->Cell(40, 10, "Hello World !");
	$pdf->Output("test.pdf", "D");
}
?>