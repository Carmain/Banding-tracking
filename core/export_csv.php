<?php
include "database_operations.php";
$db = new Database_operations(); // create the "request object"

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=lectures.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Année du baguage', 'Date du baguage', 'Bague métal', 
					   'Numéro', 'Couleur', 'Sexe', 'Âge au baguage', 'Date de lecture', 
					   'Nom du lecteur', 'Ville de lecture', 'Département de lecture', 
					   'Lieu-dit de lecture'));

$data_observations = $db->save_observations();
foreach ($data_observations as $row) {
	fputcsv($output, $row);
}

?>