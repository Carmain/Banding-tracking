<?php
    session_start(); // Start the session
    $url = "home"; // GET parameter for the URL
    
    include "database_operations.php";
    $db = new Database_operations("kentish_plover"); // create the "request object"
    if (isset($_POST["color"]) && isset($_POST["numbers"])) {
        $bird = $db->get_birds($_POST["numbers"], $_POST["color"]);
        
        if($bird->rowCount() > 0) {
            $_SESSION["bird"] = $bird->fetch();
            $url = "obs_sheet";
        }
        
        else {
            $url = "form";
            $_SESSION["alert"] = true;
            //TODO : add an error in the form
        }
    }
    header("Location: ../index.php?url=" . $url);
?>