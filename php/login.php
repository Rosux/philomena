<?php
    // set data
    $email = $_POST["email"];
    $password = $_POST["pass"];
    // check if fields are empty
    if(empty($email) || empty($password)){
        $output['error'] = "Vul alle velden in.";
        echo json_encode($output);
        exit();
    }
    require_once "../php/user.php";
    $user = new User();
    // register user
    if(isset($_POST["keeploggedin"])){
        if($user->login($email, $password, true)){
            $output['result'] = "U bent ingelogt";
            if(isset($_POST["redirect"])){
                $output['redirect'] = $_POST["redirect"];
            }else{
                $output['redirect'] = "profiel.php";
            }
        }else{
            $output['result'] = "Fout opgetreden probeer het later opnieuw.";
        }
    }else{
        if($user->login($email, $password)){
            $output['result'] = "U bent ingelogt";
            if(isset($_POST["redirect"])){
                $output['redirect'] = $_POST["redirect"];
            }else{
                $output['redirect'] = "profiel.php";
            }
        }else{
            $output['result'] = "Fout opgetreden probeer het later opnieuw.";
        }
    }
    echo json_encode($output);
    exit();
?>