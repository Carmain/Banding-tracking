<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
    </head>

<?php
require("../statics/fpdf/fpdf.php");

if (isset($_POST["bird_infos"]) && isset($_POST["observers_list"])) {

	// Get the informations to fill the blank
	$bird_info_json = $_POST["bird_infos"];
	$observers_list_json = $_POST["observers_list"];

	$to_replace = array("\\\"", "'");
	$replace_by = array("\"", "'");

	$bird_info = json_decode(str_replace($to_replace, $replace_by, $bird_info_json));
	$observers_list = json_decode(str_replace($to_replace, $replace_by, $observers_list_json));

	print_r($bird_info);
	echo "<br><br>";
	print_r($observers_list);

	/*ob_get_clean();
	$pdf = new FPDF(); // Create a new PDF file
	$pdf->AddPage(); // Create a blank page
	$pdf->SetFont("Arial", "", 12); // Set the font (Font family, style, size)
	$pdf->Cell(40, 10, "Hello World !");
	$pdf->Output("test.pdf", "D");*/
}
?>
</html>