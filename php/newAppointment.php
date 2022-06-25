<?php
    require_once "user.php";
    $user = new User();
    // validate new appointment
    $treatments = $user->getAllTreatments();
    $usertreatments = array();
    $x = 0;
    if(!isset($_POST['treatment'])){
        $output['error'] = "Vul een Behandeling in.";
        echo json_encode($output);
        exit();
    }
    if(!dateCheck($_POST["date"]) && $user->isWeekend($_POST["date"])){
        $output['error'] = "Vul een geldige datum in.";
        echo json_encode($output);
        exit();
    }
    if(!preg_match("/((1[0-7]):([0]{2}|30))|(18:00)/", $_POST["time"])){
        $output['error'] = "Vul een geldige tijd in.";
        echo json_encode($output);
        exit();
    }

    if($user->isAppointmentAvailable($_POST["date"], $_POST["time"])){
        if($user->addAppointment($_POST["date"], $_POST["time"], $_POST["treatment"])){
            $output['result'] = "Uw afspraak is verzonden.";
            $output['redirect'] = "afspraken.php";
            echo json_encode($output);
            exit();
        }else{
            $output['error'] = "Deze datum/tijd staat vol, Kies een andere datum of tijd";
            echo json_encode($output);
            exit();
        }
    }else{
        $output['error'] = "Deze datum/tijd staat vol, Kies een andere datum of tijd";
        echo json_encode($output);
        exit();
    }

    // get all appointments
    // if appointment time+date already exist cancel event
    // else insert into sql




    function dateCheck($date) { 
        if (false === strtotime($date)) { 
            return false;
        } 
        list($year, $month, $day) = explode('-', $date); 
        return checkdate($month, $day, $year);
    }

?>