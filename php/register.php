<?php
    // set data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $passwordRepeat = $_POST["pass2"];
    /////////////////////////////////////////
    $street = $_POST["street"];
    $postal_code = $_POST["postal-code"];
    $livingplace = $_POST["livingplace"];
    /////////////////////////////////////////

    // check if fields are empty
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat) || empty($street) || empty($postal_code) || empty($livingplace)){
        $output['error'] = "Vul alle velden in.";
        echo json_encode($output);
        exit();
    }
    // check if username is longer than 4 and only containts a-Z and numbers
    if(strlen($firstname)<4 || strlen($firstname)>30 || preg_match('/[^A-Za-z]/', $firstname)){
        $output['error-first-name'] = "De voornaam voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // check if username is longer than 4 and only containts a-Z and numbers
    if(strlen($lastname)<4 || strlen($lastname)>30 || preg_match('/[^A-Za-z]/', $lastname)){
        $output['error-last-name'] = "De achternaam voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // check if email is valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $output['error-mail'] = "Voer een geldige email in.";
        echo json_encode($output);
        exit();
    }
    // check if postal-code is 6 and only containts 4 numbers and 2 letters = 0000AA
    if(strlen($postal_code) != 6 || !preg_match('/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i', $postal_code)){
        $output['error-postal-code'] = "De postcode is niet geldig.";
        echo json_encode($output);
        exit();
    }
    // check if street is not longer then 200
    if(strlen($street)>200 || preg_match('/[^A-Za-z]/', $street)){
        $output['error-street'] = "De straatnaam voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // check if livingplace is not longer then 200
    if(strlen($livingplace)>200 || preg_match('/[^A-Za-z]/', $livingplace)){
        $output['error-livingplace'] = "De woonplaats voldoet niet aan de eisen.";
        echo json_encode($output);
        exit();
    }
    // Validate password strength
    $passFilter = "/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";
    if(!preg_match($passFilter, $password) || strlen($password) < 8 || strlen($password) > 40){
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
    require_once "../php/user.php";
    $user = new User();
    // register user
    if($user->register($firstname, $lastname, $email, $password, $street, $postal_code, $livingplace)){
        $output['result'] = "U bent aangemeld.";
        $output['redirect'] = "login.php";
    }else{
        $output['result'] = "Fout opgetreden probeer het later opnieuw.";
    }
    echo json_encode($output);
    exit();
?>