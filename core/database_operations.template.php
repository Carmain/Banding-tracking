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
            $request = $this->database->prepare("SELECT * FROM kentish_plover
                                                 WHERE number = :number AND color = :color LIMIT 1");
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

            $dict_user_form = array(
                "fk_plover" => $fk_plover,
                "last_name" => ucfirst(strtolower($last_name)),
                "first_name" => ucfirst(strtolower($first_name)),
                "date" => $convert_date,
                "town" => mb_strtoupper($town, 'UTF-8'),
                "department" => $department,
                "locality" => $locality,
                "sex" => $sex
            );

            $checkRecord = $this->database->prepare("SELECT * FROM observations 
                                                     WHERE fk_plover = :fk_plover AND
                                                           last_name = :last_name AND
                                                           first_name = :first_name AND
                                                           date = :date AND
                                                           town = :town AND
                                                           department = :department AND
                                                           locality = :locality AND
                                                           sex = :sex 
                                                     LIMIT 1");
            $checkRecord->execute($dict_user_form);

            $data = $checkRecord->fetch();

            if (!isset($data["fk_plover"])) {
                $request = $this->database->prepare("INSERT INTO observations(fk_plover, last_name, first_name, 
                                                                              date, town, department, locality, sex) 
                                                     VALUES (:fk_plover, :last_name, :first_name, :date, :town, 
                                                             :department, :locality, :sex)");
                $request->execute($dict_user_form);
            }
        }

        function get_observers($fk_plover) {
            $request = $this->database->prepare("SELECT * FROM observations WHERE fk_plover = :fk_plover ORDER BY date DESC");
            $request->execute(array("fk_plover" => $fk_plover));
            return $request;
        }

        function save_observations() {
            $observations = array();
            $users = $this->database->query("SELECT * FROM observations");
            while ($user_data = $users->fetch()) {
                $bird = $this->database->prepare("SELECT banding_year, date, metal_ring, color, number, age, sex 
                                                  FROM kentish_plover WHERE id_kentish_plover = :id LIMIT 1");
                $bird->execute(array("id" => $user_data["fk_plover"]));

                while ($bird_info = $bird->fetch()) {
                    array_push($observations, array($bird_info["banding_year"], $bird_info["date"], $bird_info["metal_ring"],
                                                    $bird_info["number"], $bird_info["color"], $bird_info["sex"], $bird_info["age"],

                                                    $user_data["date"], $user_data["last_name"] . ' ' . $user_data["first_name"],
                                                    $user_data["town"], $user_data["department"], $user_data["locality"]));
                }
            }
            return $observations;
        }

        function connect($user, $password) {
            $request = $this->database->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
            $request->execute(array(
                'username' => $user,
                'password' => hash('sha512', $password)));

            $result = $request->fetch();
            if ($result) {
                $_SESSION['id'] = $result['id_user'];
                $_SESSION['username'] = $user;
            }
        }
    }
?>