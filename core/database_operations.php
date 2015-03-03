<?php

    class Database_operations {
        private $database;
        
        // Class constructor
        function __construct() {
            try {
                $this->database = new PDO(
                                'mysql:host=localhost;dbname=gonm;charset=utf8',
                                'root',
                                '');
            }
            catch(Exception $e) {
                die('Error : '.$e->getMessage());
            }
        }
        
        // debug function
        function get_plover($code, $color) {
            $response = $this->database->query("SELECT * FROM kentish_plover WHERE metal_ring = '" . $code .
                                               "' AND color = '" . $color . "'");
            
            while($data = $response->fetch()) {
                echo $data["age"] . " " . $data["town"];
            }
        }
    }
?>