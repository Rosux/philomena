<?php
    // set data
    $appointmentid = $_POST["appointmentid"];
    // check if fields are empty
    if(empty($appointmentid)){
        $output['result'] = "Fout opgetreden, Ververs de pagina en probeer het opnieuw.";
        echo json_encode($output);
        exit();
    }
    require_once "../php/user.php";
    $user = new User();
    if($user->worker != 1){
        $output['result'] = "U mag dit niet doen.";
        echo json_encode($output);
        exit();
    }
    // register user
    if($user->updateAppointmentStatus($appointmentid)){
        $output['result'] = "Afspraak status is gewijzigd.";
        $output['redirect'] = "afspraken.php";
    }else{
        $output['result'] = "Fout opgetreden probeer het later opnieuw.";
    }
    echo json_encode($output);
    exit();
?>