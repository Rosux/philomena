<!-- gemaakt door Jacobus Fransen -->
<?php
// usage
// include "../model/customer.classes.php";
// $user = new Customer();

class Customer {

    private $connection;
    public $id;
    public $firstname;
    public $lastname;
    public $street;
    public $postcode;
    public $place;
    public $email;
    public $phonenumber;
    public $image;

    public function __construct() {
        include "../model/pdo.php";
        $this->connection = $conn;

        session_start();
        if($this->loggedIn()) {
            $this->customerData();
        } else {
            // $_SESSION["customer"] = false;
            // header("location: ../login.php?error=Nee");
        }
    }

    private function customerData() {
        $stmt = $this->connection->prepare("SELECT * FROM philomena.klant WHERE ID = ?");
        if(!$stmt->execute(array($_SESSION["id"]))) {
            $stmt = null;
            header("location: ../view/login.php?error=Niet%20Gelukt!");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $data[0]["ID"];
        $this->firstname = $data[0]["voornaam"];
        $this->lastname = $data[0]["achternaam"];
        $this->street = $data[0]["straat"];
        $this->postcode = $data[0]["postcode"];
        $this->place = $data[0]["woonplaats"];
        $this->email = $data[0]["email"];
        $this->phonenumber = $data[0]["telefoonnummer"];
        $this->image = $data[0]["profielfoto"];
    }

    public function login($email, $password) {
        if(empty($email) || empty($password)) {
            header("location: ../view/login.php?error=Vul%20hier%20je%20inloggegevens%20in!");
            exit();
        }
        $stmt = $this->connection->prepare("SELECT id, wachtwoord FROM philomena.klant WHERE email = ?;");
        if(!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../view/login.php?error=Contact%20the%20administrator!");
        }

        if($stmt->rowCount() < 1){
            $stmt = null;
            header("location: ../view/login.php?error=Ongeldig%20email%20/%20wachtwoord!&username=".$email."&password=".$password."");
            exit();
        }


        $verify = password_verify($password, $hashed_password);
        if($verify == false){
            header("location: ../view/login.php?error=Ongeldig%20gebruikersnaam%20/%20wachtwoord!");
            exit();
        }
        $_SESSION["id"] = $data[0]['id'];

        // $stmt = $this->connection->prepare("SELECT `username`, `password` FROM `philomena.customers` WHERE `username` = ? || `email` = ?;");
    }

    public function register($firstname, $lastname, $street, $pcode, $place, $email, $password) {
        // register user
    }

    public function updateUser($deleteImage, $firstname, $lastname, $street, $pcode, $place, $email, $pnumber, $image) {
        // update user data
    }

    protected function loggedIn() {
        if(isset($_SESSION["id"])) {
            return true;
            exit();
        } else {
            return false;
            exit();
        }
    }
}