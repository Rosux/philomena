<?php
    // set data
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordrepeat"];
    $oldpassword = $_POST["oldpassword"];
    if(empty($password) || empty($passwordRepeat) || empty($oldpassword)){
        $output['error'] = "Vul alle velden in.";
        echo json_encode($output);
        exit();
    }
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
    if($user->changePasswords($oldpassword, $password) == true){
        $output['result'] = "Uw wachtwoord is veranderd.";
        echo json_encode($output);
        exit();
    }else{
        $output['result'] = "Fout opgetreden probeer het later opnieuw.";
        echo json_encode($output);
        exit();
    }
?>