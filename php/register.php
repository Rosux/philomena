<?php
    require_once "../php/user.php";
    $user = new User();


    

    // sent data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $passwordRepeat = $_POST["pass2"];

    // check if fields are empty
    if(empty($name) || empty($email) || empty($password) || empty($passwordRepeat)){
        echo json_encode("Vul alle velden in.");
        exit();
    }
    // check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode("Voer een geldige email in.");
        exit();
    }
    // check if username is longer than 4 and only containts a-Z and numbers
    if(strlen($name)<4 || strlen($name)>30 || preg_match('/[^A-Za-z0-9]/', $name)){
        echo json_encode("De gebruikersnaam voldoet niet aan de eisen.");
        exit();
    }
    // Validate password strength
    $passFilter = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
    if (!preg_match($passFilter, $password) || strlen($password) < 8 || strlen($password) > 40) {
        echo json_encode("Het wachtwoord voldoet niet aan de eisen.");
        exit();
    }
    // check if passwords match
    if($password != $passwordRepeat){
        echo json_encode("Wachtwoorden komen niet overeen.");
        exit();
    }

    // register user
    $user->register($name, $email, $password, $passwordRepeat);
    
?>