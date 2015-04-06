<?php
    session_start(); // Start the session
    $url = "home"; // GET parameter for the URL
    
    include "database_operations.php";
    $db = new Database_operations(); // create the "request object"
    if (isset($_POST["color"]) && isset($_POST["numbers"])) {
        $bird = $db->get_birds($_POST["numbers"], $_POST["color"]);
        
        if($bird->rowCount() > 0) {
            $bird_info = $bird->fetch();
            $_SESSION["bird"] = $bird_info;
            $db->record_watching($bird_info["id_kentish_plover"], $_POST["last_name"], $_POST["first_name"], 
                                   $_POST["date"], $_POST["town"], $_POST["department_short"], $_POST["location"], $_POST["sex"]);
            $url = "obs_sheet";
        }
        
        else {
            $url = "form";
            $_SESSION["alert"] = true;
        }
    }
    header("Location: ../index.php?url=" . $url);
?>