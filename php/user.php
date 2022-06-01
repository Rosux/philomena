<?php
    // usage
    // include "../php/user.php";
    // $user = new User();

    class User {

        private $conn;
        public $id;
        public $name;
        public $email;

        public function __construct() {
            require_once "pdo.php";
            $this->conn = $connection;
            session_start();
        }

        // private function customerData() {
        //     $stmt = $this->connection->prepare("SELECT * FROM philomena.klant WHERE ID = ?");
        //     if(!$stmt->execute(array($_SESSION["id"]))) {
        //         $stmt = null;
        //         header("location: ../view/login.php?error=Niet%20Gelukt!");
        //         exit();
        //     }
        //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //     $this->id = $data[0]["ID"];
        //     $this->firstname = $data[0]["voornaam"];
        //     $this->lastname = $data[0]["achternaam"];
        //     $this->street = $data[0]["straat"];
        //     $this->postcode = $data[0]["postcode"];
        //     $this->place = $data[0]["woonplaats"];
        //     $this->email = $data[0]["email"];
        //     $this->phonenumber = $data[0]["telefoonnummer"];
        //     $this->image = $data[0]["profielfoto"];
        // }

        public function register($name, $email, $password, $passwordRepeat) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute($email);
            $user = $stmt->fetch();
            if ($user) {
                // email already in use
                return "Email is al in gebruik";
                exit();
            } else {
                $dbpassword = password_hash($password, PASSWORD_DEFAULT);
                $activationcode = bin2hex(random_bytes(16));
            }
        }
    }
?>