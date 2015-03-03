<?php

    class Database_operations {
        private $databse;
        
        // Class constructor
        function __construct() {
            try {
                $this->databse = new PDO(
                                'mysql:host=localhost;dbname=gonm;charset=utf8',
                                'root',
                                '');
            }
            catch(Exception $e) {
                die('Error : '.$e->getMessage());
            }
        }
        
        // debug function
        function select() {
            $response = $this->database->query("SELECT * FROM kentish_plover");
        }
    }
?>