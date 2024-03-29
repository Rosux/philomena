<?php
    // usage
    // include "../php/user.php";
    // $user = new User(); // creating new user object
    // $user->name // <-- accessing user data

    class User {

        private $conn;
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $street;
        public $postalcode;
        public $livingplace;

        public function __construct() {
            require_once "pdo.php";
            $this->conn = $connection;
            session_start();
            if($this->checkLoggedIn()){
                $this->setUserData();
            }
        }

        private function setUserData() {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
            if(!$stmt->execute([$_SESSION["id"]])){
                $this->logout();
                header("Location: ./login.php");
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->id = $data[0]["id"];
            $this->firstname = $data[0]["first_name"];
            $this->lastname = $data[0]["last_name"];
            $this->email = $data[0]["email"];
            $this->street = $data[0]["street"];
            $this->postalcode = $data[0]["postal_code"];
            $this->livingplace = $data[0]["living_place"];
            $this->worker = $data[0]["worker"];
        }

        public function register($firstname, $lastname, $email, $password, $street, $postalcode, $livingplace) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user) {
                // email already in use
                $output['error'] = "Email is al in gebruik";
                echo json_encode($output);
                exit();
            }
            // prepare and execute
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, create_date, update_date, street, postal_code, living_place) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                htmlspecialchars($firstname),
                htmlspecialchars($lastname),
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                date("Y/m/d/h/m/s"),
                date("Y/m/d/h/m/s"),
                htmlspecialchars($street),
                htmlspecialchars($postalcode),
                htmlspecialchars($livingplace)
            ]);
            if($stmt->rowCount() == 0){
                return false;
            }
            return true;
        }

        // only used if i want to implement some annoying activation code and stuff :) maar geen zin in
        // public function activateUser($email, $activationCode){
        //     // check if email and code are right
        //     $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        //     $stmt->execute([
        //         $email
        //     ]);
        //     if($stmt->rowCount() == 0){
        //         $output['error'] = "Gebruiker niet gevonden.";
        //         echo json_encode($output);
        //         exit();
        //     }
        //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     if($data[0]["activation_code"] != $activationCode){
        //         $output['error'] = "De activatie code komt niet overeen.";
        //         echo json_encode($output);
        //         exit();
        //     }
        //     $stmt = $this->conn->prepare("UPDATE users SET active=1, activation_code=null, activation_expiry=null, update_date=? WHERE email=?");
        //     $stmt->execute([
        //         date("Y/m/d/h/m/s"),
        //         $email
        //     ]);
        //     if($stmt->rowCount() > 0){
        //         return true;
        //     }
        //     return false;
        // }

        public function addAppointment($date, $time, $treatment){
            if(!$this->getAvailableWorkerID($date, $time, $treatment)){
                return false;
            }
            $stmt = $this->conn->prepare("INSERT INTO appointments (date, time, user_id, med_id, behandeling_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $date,
                $time,
                $this->id,
                $this->getAvailableWorkerID($date, $time, $treatment),
                $treatment
            ]);
            if($stmt->rowCount() == 0){
                $output['error'] = "Fout opgetreden. Kan geen afspraak maken.";
                echo json_encode($output);
                exit();
            }
            return true;
        }

        private function getAvailableWorkerID($date, $time, $treatment){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE worker=1");
            $stmt->execute();
            if($stmt->rowCount() == 0){
                return false;
            }
            $workerdata = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $this->conn->prepare("SELECT * FROM appointments WHERE date=? AND time=?");
            $stmt->execute([
                $date,
                $time
            ]);
            if($stmt->rowCount() == 0){
                return $workerdata[0]["id"];
            }
            $appointmentsdata = $stmt->fetchAll(PDO::FETCH_ASSOC);

            for($i=0; $i < count($workerdata); $i++){
                if($appointmentsdata[$i]["med_id"] != $workerdata[$i]["id"]){
                    return $workerdata[$i]["id"];
                }
            }
            return false;
            //SELECT * FROM `appointments` WHERE `date`="2022-06-08" AND time="16:40:42" AND med_id=28
            //SELECT * FROM `appointments` WHERE (`date`="2022-06-08" AND time="16:40:42") AND (med_id=28 OR med_id=27) 
        }

        public function isAppointmentAvailable($date, $time){
            $stmt = $this->conn->prepare("SELECT * FROM appointments WHERE date=? AND time=?");
            $stmt->execute([
                $date,
                $time
            ]);
            if($stmt->rowCount() < 2){
                return true;
            }
            return false;
        }

        public function getFirstnameById($id){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
            $stmt->execute([
                $id
            ]);
            if($stmt->rowCount() == 0){
                return false;
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function isWeekend($date){
            return (date('N', strtotime($date)) >= 6);
        }

        public function getAllAppointments(){
            if($this->worker != 1){
                return false;
            }
            $stmt = $this->conn->prepare("SELECT * FROM appointments ORDER BY date DESC, time");
            $stmt->execute();
            if($stmt->rowCount() == 0){
                return false;
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getAppointments(){
            $stmt = $this->conn->prepare("SELECT * FROM appointments WHERE user_id=? ORDER BY date DESC, time");
            $stmt->execute([
                $this->id
            ]);
            if($stmt->rowCount() == 0){
                return false;
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getTreatment(int $id){
            $stmt = $this->conn->prepare("SELECT * FROM treatments WHERE id=?");
            $stmt->execute([
                $id
            ]);
            if($stmt->rowCount() == 0){
                return false;
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function getAllTreatments(string $category=null){
            if($category != null){
                $stmt = $this->conn->prepare("SELECT * FROM treatments WHERE category=?");
                $stmt->execute([$category]);
            }else{
                $stmt = $this->conn->prepare("SELECT * FROM treatments");
                $stmt->execute();
            }
            if($stmt->rowCount() == 0){
                return false;
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        public function deleteAppointment($appointmentId){
            $stmt = $this->conn->prepare("DELETE FROM appointments WHERE id=?");
            $stmt->execute([
                $appointmentId
            ]);
            if($stmt->rowCount() != 0){
                return true;
            }else{
                return false;
            }
        }

        public function updateAppointmentStatus($appointmentId){
            $stmt = $this->conn->prepare("SELECT * FROM appointments WHERE id=?");
            $stmt->execute([
                $appointmentId
            ]);
            if($stmt->rowCount() == 0){
                return false;
            }
            $stmt = $this->conn->prepare("UPDATE appointments SET status=!status WHERE id=?");
            $stmt->execute([
                $appointmentId
            ]);
            if($stmt->rowCount() != 0){
                return true;
            }else{
                return false;
            }
        }

        public function updateUser($firstname, $lastname, $street, $postalcode, $livingplace){
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, update_date, street, postal_code, living_place) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                htmlspecialchars($firstname),
                htmlspecialchars($lastname),
                date("Y/m/d/h/m/s"),
                htmlspecialchars($street),
                htmlspecialchars($postalcode),
                htmlspecialchars($livingplace)
            ]);
            if($stmt->rowCount() != 0){
                return true;
            }else{
                return false;
            }
        }

        public function changePasswords($oldpassword, $newpassword){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
            $stmt->execute([
                $this->id
            ]);
            if($stmt->rowCount() == 0){
                $output['error'] = "Gebruiker niet gevonden.";
                echo json_encode($output);
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!password_verify($oldpassword, $data[0]["password"])){
                return false;
            }
            $stmt = $this->conn->prepare("UPDATE users SET password=?, update_date=? WHERE id=?");
            $stmt->execute([
                password_hash($newpassword, PASSWORD_DEFAULT),
                date("Y/m/d/h/m/s"),
                $this->id
            ]);
            if($stmt->rowCount() != 0){
                return true;
            }else{
                return false;
            }
        }

        public function login($email, $password, $remember=false){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
            $stmt->execute([
                $email
            ]);
            if($stmt->rowCount() == 0){
                $output['error'] = "Gebruiker niet gevonden.";
                echo json_encode($output);
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!password_verify($password, $data[0]["password"])){   
                $output['error-pass'] = "Het Wachtwoord komt niet overeen.";
                echo json_encode($output);
                exit();
            }
            $stmt = $this->conn->prepare("UPDATE users SET login_token=?, update_date=? WHERE email=?");
            $stmt->execute([
                null,
                date("Y/m/d/h/m/s"),
                $email
            ]);
            $_SESSION["id"] = $data[0]['id'];
            $this->setUserData();
            if($remember){
                $logintoken = bin2hex(random_bytes(32));
                // anytime you require a login it checks if the token and cookie match. if so ur logged in and a new token gets generated every time
                $stmt = $this->conn->prepare("UPDATE users SET login_token=?, update_date=? WHERE email=?");
                $stmt->execute([
                    password_hash($logintoken, PASSWORD_DEFAULT),
                    date("Y/m/d/h/m/s"),
                    $email
                ]);
                if($stmt->rowCount() == 0){
                    $output['error'] = "Fout opgetreden. Kan gebruiker niet onthouden.";
                    echo json_encode($output);
                    exit();
                }
                // set cookie and make checklogin func
                setcookie("_ph_sess", $logintoken, time() + (86400 * 30), "/", "", true, true);
                return true;
            }
            return true;
        }

        public function logout(){
            if (isset($_COOKIE['_ph_sess'])) {
                unset($_COOKIE['_ph_sess']); 
                setcookie('_ph_sess', null, -1, '/');
            }
            session_unset();
            session_destroy();
        }

        public function checkLoggedIn() {
            if(isset($_SESSION["id"])) {
                return true;
            } else {
                return false;
            }
        }

        public function protectPage(){
            if(!$this->checkLoggedIn()){
                $this->logout();
                header("Location: ./login.php");
                exit();
            }
        }
    }
?>