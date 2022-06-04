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
        public $image;

        public function __construct() {
            require_once "pdo.php";
            $this->conn = $connection;
            session_start();
            // $this->customerData();
        }

        // private function customerData() {
        //     $stmt = $this->connection->prepare("SELECT * FROM users WHERE ID = ?");
        //     if(!$stmt->execute(array($_SESSION["id"]))) {
        //         $output['error'] = "Server Error: User not found";
        //         echo json_encode($output);
        //         exit();
        //     }
        //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     $this->id = $data[0]["id"];
        //     $this->firstname = $data[0]["name"];
        //     $this->email = $data[0]["email"];
        //     $this->image = $data[0]["profile-image"];
        // }

        public function register($firstname, $lastname, $email, $password) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if ($user) {
                // email already in use
                $output['error'] = "Email is al in gebruik";
                echo json_encode($output);
                exit();
            }
            $activationCode = bin2hex(random_bytes(16));
            // prepare and execute
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, password, create_date, update_date, activation_code, activation_expiry) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                htmlspecialchars($firstname),
                htmlspecialchars($lastname),
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                date("Y/m/d/h/m/s"),
                date("Y/m/d/h/m/s"),
                $activationCode,
                date("Y/m/d/h/m/s", strtotime("+3 days"))
            ]);
            if($stmt->rowCount() > 0){
                $this->sendActivationCode($email, $activationCode, $firstname, $lastname);
                return true;
            }
            return false;
        }

        public function sendActivationCode($email, $code, $firstname, $lastname){
            
        }

        // public function activateUser($email){
        //     $d=strtotime("+3 days");
        //     $activationExpiry = date("Y/m/d/h/m/s", $d);
        //     $stmt = $this->conn->prepare("UPDATE users SET active=1, update_date=? WHERE email=?");
        //     $stmt->execute([
        //         $activationExpiry,
        //         $email
        //     ]);
        //     if($stmt->rowCount() > 0){
        //         return true;
        //     }
        //     return false;
        // }

        public function login($email, $password){
            
        }
    }
?>