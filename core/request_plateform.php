<?php
    session_start(); // Start the session
    $url = "home"; // GET parameter for the URL
    
    include "database_operations.php";
    $db = new Database_operations("kentish_plover"); // create the "request object"
    if (isset($_POST["colors"]) && isset($_POST["numbers"])) {
        $bird = $db->get_birds($_POST["numbers"], $_POST["colors"]);
        print_r($bird->fetch());
        echo($bird->rowCount());
        
        if($bird->rowCount() > 0) {
            $_SESSION["bird"] = $bird->fetch();
            $url = "obs_sheet";
        }
        
        else {
            $url = "form";
        }
    }
    
    header("Location: ../index.php?url=" . $url);
?>