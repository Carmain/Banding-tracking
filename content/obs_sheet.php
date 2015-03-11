<h2>Résultat de la requête</h2>
<div class="row">

  	<div class="col-sm-4 padding-content">
  		<img src="statics/pictures/gonm_logo.jpg" class="img-responsive">
  	</div>

  	<div class="col-sm-4">
  		<h2>
  			Historique des observations d'un Gravelot à Collier
  			interrompu bagué couleur <i>Charadrius alexandrinus</i>
  		</h2>
  	</div>

  	<div class="col-sm-4 padding-content">
  		<img src="statics/pictures/plover_2.jpg" class="img-responsive">
  	</div>
</div>
<div class="row padding-content">
	<div class="col-sm-5">
		<div class="col-sm-12">
		  	<table class="table table-striped">
			    <tbody>
			      	<tr>
			        	<?php 
			        	if(isset($_SESSION["bird"])) { 
			        		$bird_info = $_SESSION["bird"];
			        	?>

							<tr>
								<td class="strong">Bague acier</td>
								<td><?php echo $bird_info["metal_ring"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Numéro de la bague</td>
								<td><?php echo $bird_info["number"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Couleur de la bague</td>
								<td><?php echo $bird_info["color"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Date du baguage</td>
								<td><?php echo $bird_info["banding_year"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Age</td>
								<td><?php echo $bird_info["age"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Sexe</td>
								<td><?php echo $bird_info["sex"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Lieu de baguage</td>
								<td><?php echo $bird_info["town"]; ?></td>
							</tr>
							<tr>
								<td class="strong">Bagueur</td>
								<td><?php echo $bird_info["observer"]; ?></td>
							</tr>
						<?php							 
							unset($_SESSION["bird"]);
						}
						else {
							header("Location: index.php?url=form");
						}
						?>
			      	</tr>
			    </tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<img src="statics/pictures/mnhn.jpg" class="img-responsive">
		</div>
		<div class="col-sm-12">
			<img src="statics/pictures/logo_warning.jpg" class="img-responsive">
		</div>
	</div>
	<div class="col-sm-7">
  		<p>
  			Lorem ipsum
  		</p>
  	</div>
</div>