<?php  
if(isset($_SESSION["bird"])) { 
	$bird_info = $_SESSION["bird"];
	$observers_list = $db->get_observers($bird_info["id_kentish_plover"]);
	
	$to_replace = array("\"", "'");
	$replace_by = array("\\\"", "'");
	$bird_info_json = str_replace($to_replace, $replace_by, json_encode($bird_info));
	$observers_list_json = str_replace($to_replace, $replace_by, json_encode($observers_list->fetch()));
?>

	<h2>Résultat de la requête</h2>

	<form method="post" action="core/pdf_creator.php">
		<input type="hidden" name="bird_infos" value='<?php echo $bird_info_json ?>'>
		<input type="hidden" name="observers_list" value='<?php echo $observers_list_json ?>'>
		<button type="submit" class="btn btn-warning">Obtenir une version PDF</button>
	</form>

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
			  	<table class="table">
				    <tbody>
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
							<td><?php echo $bird_info["date"]; ?></td>
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Lieu d'observation</th>
						<th>Observateur</th>
					</tr>
				</thead>
				<tbody>
  					<?php 
  					$observers_list = $db->get_observers($bird_info["id_kentish_plover"]);
  					while($observers = $observers_list->fetch()) { 
  					?>
  						<tr>
							<td>
								<?php 
								$mysql_date = strtotime($observers["date"]);
								echo date('d-m-Y', $mysql_date); 
								?>
							</td>
							<td><?php echo $observers["town"]; ?></td>
							<td><?php echo $observers["last_name"] . " " . $observers["first_name"]; ?></td>
						</tr>
  					<?php } ?>
				</tbody>
			</table>
	  	</div>
	</div>
<?php							 
	unset($_SESSION["bird"]);
}
else {
	header("Location: index.php?url=form");
}
?>