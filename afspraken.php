<div class="philomena-import">
    <?php
        require_once "php/user.php";
        $user = new User();
        $user->protectPage();
        if($user->worker == 1){
            $appointments = $user->getAllAppointments();
        }else{
            $appointments = $user->getAppointments();
        }
        // appointment example
        // $appointments[i]["date"]
        // $appointments[i]["time"]
        // date time status user_id med_id behandeling_id
    ?>
    <div class="appoin">
        <div class="appoin-user">
            <p>Welkom <?php echo $user->firstname; ?></p>
            <button onclick="makeAppointment()">NIEUWE AFSPRAAK</button>
        </div>
        <div class="appoin-title">
            <p>Afspraken</p>
        </div>
        <div class="appoin-wrapper">
            <?php


            if(!$appointments){
                echo "<h1>Er zijn nog geen afspraken.</h1>";
            }else{
                for($i=0; $i < count($appointments); $i++){
                    echo '<div class="appointment">';
                    echo '<div class="appointment-date"><p>'.$appointments[$i]["date"]." - ".$appointments[$i]["time"].'</p></div>';
                    echo '<div class="appointment-type"><p>'.
                        $user->getTreatment($appointments[$i]["behandeling_id"])[$i]["name"]
                    .'</p></div>';
                    // fix
                    if($user->worker == 1){
                        echo '<div class="appointment-status"><p>'.$appointments[$i]["status"].'</p></div>';
                        echo '<div class="appointment-name"><p>'.$appointments[$i]["user_id"].'</p></div>';
                        echo '<div class="appointment-worker"><p>'.$appointments[$i]["med_id"].'</p></div>';
                    }
                    echo '</div>';
                }
            }
            
    

            ?>
        </div>
    </div>
</div>