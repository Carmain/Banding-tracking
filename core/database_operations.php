<?php

    class Database_operations {
        private $database;
        private $bird_db;
        
        // Class constructor
        function __construct($bird) {
            try {
                $this->bird_db = $bird;
                $this->database = new PDO(
                                'mysql:host=localhost;dbname=gonm;charset=utf8',
                                'root',
                                '');
            }
            catch(Exception $e) {
                die('Error : '.$e->getMessage());
            }
        }
        
        // Return an bird with all the informations
        function get_birds($code, $color) {
            $request = $this->database->prepare("SELECT * FROM " . $this->bird_db .
                                                " WHERE number = :number AND color = :color LIMIT 1");
            $request->execute(array(
                                "number" => $code,
                                "color" => $color)
                            );
            return $request;
        }

        function get_unique_colors_rings() {
            return $this->database->query("SELECT DISTINCT color FROM kentish_plover"); //. $this->bird_db . "");
        }
    }
?>