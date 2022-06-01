<?php
    require_once "../php/user.php";
    $user = new User();

    // $output['result'] = 'test123!!!';
    // echo json_encode($output); // json encode here
    // exit;
    

    // sent data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $passwordRepeat = $_POST["pass2"];

    // check if fields are empty
    if(empty($name) || empty($email) || empty($password) || empty($passwordRepeat)){
        $output['error'] = "Vul alle velden in.";
    }
    // check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output['errorEmail'] .= "Voer een geldige email in.";
    }
    // check if username is longer than 4 and only containts a-Z and numbers
    if(strlen($name)<4 || strlen($name)>30 || preg_match('/[^A-Za-z0-9]/', $name)){
        $output['errorName'] .= "De gebruikersnaam voldoet niet aan de eisen.";
    }
    // Validate password strength
    $passFilter = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
    if (!preg_match($passFilter, $password) || strlen($password) < 8 || strlen($password) > 40) {
        $output['errorPass'] .= "Het wachtwoord voldoet niet aan de eisen.";
    }
    // check if passwords match
    if($password != $passwordRepeat){
        $output['errorPassRepeat'] .= "Wachtwoorden komen niet overeen.";
    }

    if(!isset($output)){
        // register user
        $user->register($name, $email, $password, $passwordRepeat);
        echo json_encode($output);
        exit();
    } else {
        echo json_encode($output);
        exit();
    }
    
    

    
    
?>