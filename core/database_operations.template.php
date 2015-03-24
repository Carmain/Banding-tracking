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
        
        // Return an bird with all the informations
        function get_birds($code, $color) {
            $request = $this->database->prepare("SELECT * FROM kentish_plover" . 
                                                " WHERE number = :number AND color = :color LIMIT 1");
            $request->execute(array(
                                "number" => $code,
                                "color" => $color)
                            );
            return $request;
        }

        // Get all the colors from the database
        function get_unique_colors_rings() {
            return $this->database->query("SELECT DISTINCT color FROM kentish_plover");
        }

        function record_watching($fk_plover, $last_name, $first_name, $date, $town, $department, $locality, $sex) {
            $convert_date = date('Y-m-d', strtotime($date));
            $request = $this->database->prepare("INSERT INTO observations(fk_plover, last_name, first_name, date, town, department, locality, sex) 
                VALUES (:fk_plover, :last_name, :first_name, :date, :town, :department, :locality, :sex)");
            $request->execute(array(
                "fk_plover" => $fk_plover,
                "last_name" => ucfirst(strtolower($last_name)),
                "first_name" => ucfirst(strtolower($first_name)),
                "date" => $convert_date,
                "town" => mb_strtoupper($town, 'UTF-8'),
                "department" => $department,
                "locality" => $locality,
                "sex" => $sex
            ));
        }

        function get_observers($fk_plover) {
            $request = $this->database->prepare("SELECT * FROM observations WHERE fk_plover = :fk_plover ORDER BY date DESC");
            $request->execute(array("fk_plover" => $fk_plover));
            return $request;
        }
    }
?>