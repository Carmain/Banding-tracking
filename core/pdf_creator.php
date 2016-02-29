<?php
require("../statics/fpdf/fpdf.php");

if (isset($_POST["bird_infos"]) && isset($_POST["observers_list"])) {

	// Get the informations to fill the blank
	$bird_info_json = $_POST["bird_infos"];
	$observers_list_json = $_POST["observers_list"];

	$to_replace = array("£dqot;", "£sqot;");
	$replace_by = array("\"", "'");

	$bird_info = json_decode(str_replace($to_replace, $replace_by, $bird_info_json), true);
	$observers = json_decode(str_replace($to_replace, $replace_by, $observers_list_json), true);

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
		    $this->SetFont("Arial", '', 8);
		    $this->Cell(0, 2,'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
		}
	}

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->AliasNbPages();
	$pdf->setAutoPageBreak(true, 10);


	// -----------------------------------------------------------------------
	// ------------------- Configuration vars for the PDF --------------------
	// -----------------------------------------------------------------------

	$font_family = "Arial";
	$text_size = 10;
	$cell_heigh = 6;
	$start_positionY_bird = 65;

	// -----------------------------------------------------------------------
	// -----------------------------------------------------------------------


	// -----------------------------------------------------------------------
	// -------------------------------- Title --------------------------------

	$pdf->Image("../statics/pictures/gonm_logo.jpg", 0, 10, 60);
	$pdf->Image("../statics/pictures/plover_2.jpg", 140, 10, 60);
	$pdf->SetFont($font_family, 'B', 15);
	$pdf->SetLeftMargin(55);
	$pdf->SetY(15);
	$pdf->MultiCell(80, 6, utf8_decode("Historique des observations " .
					"d'un Gravelot à Collier interrompu bagué couleur"), 0, 'C');
	$pdf->SetFont($font_family, 'I', 15);
	$pdf->SetX(65);
	$pdf->Cell(0, 6, "Charadrius alexandrinus", 0, 2);
	// -----------------------------------------------------------------------
	// -----------------------------------------------------------------------

	$pdf->SetLeftMargin(0); // Reset

	// -----------------------------------------------------------------------
	// ------------------------------- Content -------------------------------

	// -------------------------------------------------------
	// ------------------ bird informations ------------------

	$pdf->SetFont($font_family, 'B', $text_size);

	// ------------------------
	// -------- Titles --------

	$pdf->SetXY(20, $start_positionY_bird);
	$pdf->Cell(0, $cell_heigh, "Bague Acier :", 0, 2);
	$pdf->Cell(0, $cell_heigh, "Bague Couleur :", 0, 2);
	$pdf->Cell(0, $cell_heigh, "Code :", 0, 2);
	$pdf->Cell(0, $cell_heigh, "Date de baguage : ", 0, 2);

	$pdf->SetXY(120, $start_positionY_bird);
	$pdf->Cell(0, $cell_heigh, utf8_decode("Âge :"), 0, 2);
	$pdf->Cell(0, $cell_heigh, "Sexe :", 0, 2);
	$pdf->Cell(0, $cell_heigh, "Lieu de Baguage :", 0, 2);
	$pdf->Cell(0, $cell_heigh, "Bagueur : ", 0, 2);
	// ------------------------
	// ------------------------

	$pdf->SetFont($font_family, '', $text_size);

	// ------------------------
	// ----- Informations -----

	$color = utf8_decode(ucfirst(strtolower($bird_info["color"])));

	$pdf->SetXY(52, $start_positionY_bird);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["metal_ring"]), 0, 2);
	$pdf->Cell(0, $cell_heigh, $color, 0, 2);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["number"]), 0, 2);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["date"]), 0, 2);

	$pdf->SetXY(152, $start_positionY_bird);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["age"]), 0, 2);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["sex"]), 0, 2);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["town"]), 0, 2);
	$pdf->Cell(0, $cell_heigh, utf8_decode($bird_info["observer"]), 0, 2);

	// -------------------------------------------------------
	// -------------------------------------------------------

	// -------------------------------------------------------
	// --------------------- Users datas ---------------------

	$pdf->SetFont($font_family, 'B', $text_size);
	$pdf->SetXY(20, 100);
	$pdf->Cell(40, $cell_heigh, "Date", 1, 0, 'C');
	$pdf->Cell(60, $cell_heigh, "Ville", 1, 0, 'C');
	$pdf->Cell(70, $cell_heigh, "Observateur", 1, 2, 'C');

	$pdf->SetFont($font_family, '', $text_size);
	foreach($observers as $row) {
		$pdf->SetX(20);
		$name = str_replace(array("£dqot;", "£sqot;"), array("\"", "'"), $row["name"]);
		$pdf->Cell(40, $cell_heigh, utf8_decode($row["date"]), 1, 0, 'C');
		$pdf->Cell(60, $cell_heigh, utf8_decode($row["town"]), 1, 0, 'C');
		$pdf->Cell(70, $cell_heigh, utf8_decode($name), 1, 2, 'C');
	}

	// -----------------------------------------------------------------------
	// -----------------------------------------------------------------------

	// Send PDF
	$pdf->Output("GCI_". utf8_decode($bird_info["metal_ring"]) . "_" .
				 $color . ".pdf", "D");
}
?>
