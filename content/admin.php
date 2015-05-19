<?php
if (isset($_SESSION["username"]) && isset($_SESSION["id"])) { ?>

	<h2 class="margin-title">Exporter les observations en CSV</h2>

<div class="row">
  	<div class="col-sm-6">
		<form method="post" action="index.php?url=admin">
			<input type="hidden" name="csv" value="true">
			<button type="submit" class="btn btn-success btn-block">
				<span class="glyphicon glyphicon glyphicon-file big-icon" aria-hidden="true"></span>
				<p class="big-text-button">Exporter toutes les données en CSV<p>
			</button>
		</form>
  	</div>
  	<div class="col-sm-6">
		<form method="post" action="core/connection.php">
			<input type="hidden" name="disconnect" value="true">
			<button type="submit" class="btn btn-danger btn-block">
				<span class="glyphicon glyphicon-remove-circle big-icon" aria-hidden="true"></span>
				<p class="big-text-button">Se déconnecter de l'espace d'administration<p>
			</button>
		</form>
  	</div>
</div>

	<?php
	if (isset($_POST["csv"])) {
		header("Location: core/export_csv.php");
	}
}

else {
?>
	<div class="wrapper">
    	<form class="form-signin" method="post" action="core/connection.php">
	      	<h2 class="form-signin-heading">Connexion</h2>
	      	<input type="text" class="form-control little-margin" name="username" placeholder="Nom d'utilisateur"/>
	      	<input type="password" class="form-control margin-form" name="password" placeholder="Password"/>
	      	<input type="hidden" name="connect" value="true">
	      	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    	</form>
  	</div>
<?php } ?>
