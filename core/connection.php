<?php
session_start();
include "database_operations.php";
$db = new Database_operations(); // create the "request object"

if (isset($_POST["connect"])) {
	$db->connect($_POST["username"], $_POST["password"]);
	header("Location: ../index.php?url=admin");
}	
else if (isset($_POST["disconnect"])) {
	unset($_SESSION["id"]);
	unset($_SESSION["username"]);
	header("Location: ../index.php?url=home");
}
?>