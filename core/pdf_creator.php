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

	$bird_info = json_decode(str_replace($to_replace, $replace_by, $bird_info_json), true);
	$observers_list = json_decode(str_replace($to_replace, $replace_by, $observers_list_json), true);

	print_r($bird_info);
	echo "<br><br>";
	print_r($observers_list);

	ob_get_clean();
	class PDF extends FPDF {
		var $B;
		var $I;
		var $U;
		var $HREF;

		function PDF($orientation='P', $unit='mm', $size='A4') {
		    $this->FPDF($orientation,$unit,$size); // Call the parent constructor
		    
		    // Initialisation
		    $this->B = 0;
		    $this->I = 0;
		    $this->U = 0;
		    $this->HREF = '';
		}

		function WriteHTML($html) {
		    // HTML parser
		    $html = str_replace("\n", ' ', $html);
		    $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
		    foreach($a as $i => $e) {
		        if($i % 2 == 0) {
		            // Text
		            if($this->HREF)
		                $this->PutLink($this->HREF, $e);
		            else
		                $this->Write(5, $e);
		        }

		        else {
		            // Tag
		            if($e[0]=='/')
		                $this->CloseTag(strtoupper(substr($e,1)));
		            else {
		                // Extract attributes
		                $a2 = explode(' ', $e);
		                $tag = strtoupper(array_shift($a2));
		                $attr = array();
		                foreach($a2 as $v)
		                {
		                    if(preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
		                        $attr[strtoupper($a3[1])] = $a3[2];
		                }
		                $this->OpenTag($tag, $attr);
		            }
		        }
		    }
		}

		function OpenTag($tag, $attr)
		{
		    if($tag == 'B' || $tag == 'I' || $tag == 'U')
		        $this->SetStyle($tag, true);
		    if($tag == 'A')
		        $this->HREF = $attr['HREF'];
		    if($tag == 'BR')
		        $this->Ln(5);
		}

		function CloseTag($tag)
		{
		    if($tag =='B' || $tag == 'I' || $tag == 'U')
		        $this->SetStyle($tag, false);
		    if($tag == 'A')
		        $this->HREF = '';
		}

		function SetStyle($tag, $enable)
		{
		    // Modifie le style et sélectionne la police correspondante
		    $this->$tag += ($enable ? 1 : -1);
		    $style = '';
		    foreach(array('B', 'I', 'U') as $s)
		    {
		        if($this->$s>0)
		            $style .= $s;
		    }
		    $this->SetFont('', $style);
		}

		function PutLink($URL, $txt)
		{
		    // Place un hyperlien
		    $this->SetTextColor(0, 0, 255);
		    $this->SetStyle('U', true);
		    $this->Write(5, $txt, $URL);
		    $this->SetStyle('U', false);
		    $this->SetTextColor(0);
		}

		function Footer()
		{
		    $this->SetY(-15); // Positionnement à 1,5 cm du bas
		    $this->SetFont('Arial','I',8);
		    $this->Cell(0, 10,'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C'); 	
		}
	}

	$titre = "Historique des observations d'un Gravelot à Collier interrompu bagué couleur " .
			 "<i>Charadrius alexandrinus</i>";

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->setAutoPageBreak(true, 10);

	// ---- Title ----
	$pdf->Image("../statics/pictures/gonm_logo.jpg", 0, 10, 80);
	$pdf->SetFont('Arial', 'B', 16);
	$pdf->SetLeftMargin(80);
	$pdf->SetY(20);
	$pdf->WriteHTML(utf8_decode($titre));

	// ---- Reset ----
	$pdf->SetLeftMargin(0);

	// ---- Content ----
	
	// -- Header --
	$pdf->SetFont('Arial', 'B', 10);
	$space = 6;
	$positionY = 75;
	
	$pdf->SetXY(20, $positionY);
	$pdf->Cell(0, $space, "Bague Acier :", 0, 2);
	$pdf->Cell(0, $space, "Bague Couleur :", 0, 2);
	$pdf->Cell(0, $space, "Code :", 0, 2);
	$pdf->Cell(0, $space, "Date de baguage : ", 0, 2);

	$pdf->SetXY(120, $positionY);
	$pdf->Cell(0, $space, utf8_decode("Âge :"), 0, 2);
	$pdf->Cell(0, $space, "Sexe :", 0, 2);
	$pdf->Cell(0, $space, "Lieu de Baguage :", 0, 2);
	$pdf->Cell(0, $space, "Bageur : ", 0, 2);
	
	$pdf->SetFont('Arial', '', 10);

	$pdf->SetXY(55, $positionY);
	$pdf->Cell(0, $space, utf8_decode($bird_info["metal_ring"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["color"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["number"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["date"]), 0, 2);

	$pdf->SetXY(152, $positionY);
	$pdf->Cell(0, $space, utf8_decode($bird_info["age"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["sex"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["town"]), 0, 2);
	$pdf->Cell(0, $space, utf8_decode($bird_info["observer"]), 0, 2);



	$pdf->Output("test.pdf", "D");
}
?>
</html>