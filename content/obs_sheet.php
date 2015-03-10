<?php 
session_start();

if(isset($_SESSION["bird"])) {
	print_r($_SESSION["bird"]);
}
else {
	header("Location: index.php?url=form");
}

?>