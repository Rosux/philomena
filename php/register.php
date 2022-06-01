<?php
    require_once "../php/user.php";
    $user = new User();

    // $output["result"] = 'dwadaswefrwsggrfdsedfsfsegfsredfdrs';
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
        echo json_encode($output);
        exit();
    }
    // check if username is longer than 4 and only containts a-Z and numbers
    if(strlen($name)<4 || strlen($name)>30 || preg_match('/[^A-Za-z0-9]/', $name)){
        $output['error-name'] = "De gebruikersnaam voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output['error-mail'] = "Voer een geldige email in.";
        echo json_encode($output);
        exit();
    }
    // Validate password strength
    $passFilter = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
    if (!preg_match($passFilter, $password) || strlen($password) < 8 || strlen($password) > 40) {
        $output['error-pass'] = "Het wachtwoord voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // check if passwords match
    if($password != $passwordRepeat){
        $output['error-pass-repeat'] = "Wachtwoorden komen niet overeen.";
        echo json_encode($output);
        exit();
    }
    
    // $user->register($name, $email, $password, $passwordRepeat);
    
    

    
    
?>