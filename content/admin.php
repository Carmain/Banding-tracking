<?php if (isset($_SESSION["user"]) && isset($_SESSION["id"])) { ?>

	<h2 class="margin-title">Exporter les observations en CSV</h2>

	<form method="post" action="content/admin.php">
		<input type="hidden" name="csv" value="true">
		<button type="submit" class="btn btn-warning">Exporter toutes les données en CSV</button>
	</form>

	<?php
	if (isset($_POST["csv"])) {
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
		fpassthru($output);
	}
}

else {
?>
	<div class="wrapper">
    	<form class="form-signin">       
	      	<h2 class="form-signin-heading">Connexion</h2>
	      	<input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur"/>
	      	<input type="password" class="form-control margin-form" name="password" placeholder="Password"/>
	      	<input type="hidden" name="connect" value="true">
	      	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    	</form>
  	</div>
<?php } ?>