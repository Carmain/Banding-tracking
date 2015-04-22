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

        // Save the record form a user to the database
        function save_record($fk_plover, $last_name, $first_name, $date, $town, $department, $locality, $sex) {
            $convert_date = date('Y-m-d', strtotime($date));

            $dict_user_form = array(
                "fk_plover" => $fk_plover,
                "last_name" => mb_strtoupper($last_name, 'UTF-8'),
                "first_name" => ucfirst(strtolower($first_name)),
                "date" => $convert_date,
                "town" => mb_strtoupper($town, 'UTF-8'),
                "department" => $department
            );

            $checkRecord = $this->database->prepare("SELECT * FROM observations 
                                                     WHERE fk_plover = :fk_plover AND
                                                           last_name = :last_name AND
                                                           first_name = :first_name AND
                                                           date = :date AND
                                                           town = :town AND
                                                           department = :department
                                                     LIMIT 1");
            $checkRecord->execute($dict_user_form);

            $data = $checkRecord->fetch();

            if (!isset($data["fk_plover"])) {
                $request = $this->database->prepare("INSERT INTO observations(fk_plover, last_name, first_name, 
                                                                              date, town, department, locality, sex) 
                                                     VALUES (:fk_plover, :last_name, :first_name, :date, :town, 
                                                             :department, :locality, :sex)");
                $dict_user_form["locality"]  = $locality;
                $dict_user_form["sex"]  = $sex;
                $request->execute($dict_user_form);
            }
        }

        // Get all the observers for a specific bird
        function get_observers($fk_plover) {
            $request = $this->database->prepare("SELECT * FROM observations WHERE fk_plover = :fk_plover ORDER BY date DESC");
            $request->execute(array("fk_plover" => $fk_plover));
            return $request;
        }

        // Method for the export of all the data
        function csv_save() {
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

        // Connect the user to the administration page
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


        // ------------------------------------ EXPORT DATA ------------------------------------
        /** Was used only for a specific case. Juste here in case. **/

        // Check if a bird already exists in the database
        function exist($metal_ring, $color, $number) {
            $bird_data = array(
                "number" => $number,
                "metal_ring" => $metal_ring,
                "color" => $color
            );

            $checkRecord = $this->database->prepare("SELECT * FROM kentish_plover 
                                                     WHERE number = :number AND
                                                           metal_ring = :metal_ring AND
                                                           color = :color
                                                     LIMIT 1");
            $checkRecord->execute($bird_data);

            $data = $checkRecord->fetch();

            if ($data["id_kentish_plover"]) {
                return $data["id_kentish_plover"];
            }
            else {
                return "NO NUMBER";
            }

        }

        // Link the all data with a specific plover and record the observation.
        function transfer() {

            $line_number = 2;
            $line_error =  array();

            $old_data = $this->database->query("SELECT * FROM old_data");
            while ($data = $old_data->fetch()) {

                // Convert the date
                $to_date = strtotime(str_replace("/", "-", $data["date"]));
                $date = date("Y-m-d", $to_date);

                // Check if all the informations are here
                if ($data["metal_ring"] == "" || $data["color"] == "" || $data["number"] == "" 
                    || $data["town"] == "" || $data["department"] == "" || $date == "1970-01-01") {
                    echo "<br>----------------- SKIP -----------------------<br><br>";
                }
                else {

                    // Check if we could find a real plover to link
                    $result_link = $this->exist($data["metal_ring"], $data["color"], $data["number"]);
                    if($result_link == "NO NUMBER") {
                        array_push($line_error, $line_number);
                    }
                    else {

                        // Record the observation in the database
                        $this->save_record($result_link, $data["last_name"], $data["first_name"], $date, 
                                    $data["town"], $data["department"], $data["locality"], $data["sex"]);
                        echo "OK <br>";
                        // echo $line_number . " : The ID of the plover is " . $result_link . '<br>';
                    }
                    $line_number++;
                }
            }

            echo "<br><br><br><br><br>";

            // Display the error in the file if we have a problem. 
            foreach ($line_error as $value) {
                echo $value . "<br>";
            }
        }
    }
?>