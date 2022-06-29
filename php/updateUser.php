<?php
    // set data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    /////////////////////////////////////////
    $street = $_POST["street"];
    $postal_code = $_POST["postal-code"];
    $livingplace = $_POST["livingplace"];


    if(empty($firstname) || empty($lastname) || empty($street) || empty($postal_code) || empty($livingplace)){
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
    require_once "../php/user.php";
    $user = new User();
    if($user->updateUser($firstname, $lastname, $street, $postal_code, $livingplace)){
        $output['result'] = "Uw Gegevens zijn veranderd.";
        echo json_encode($output);
        exit();
    }else{
        $output['result'] = "Fout opgetreden probeer het later opnieuw.";
        echo json_encode($output);
        exit();
    }
?>