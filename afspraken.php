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
                    echo '<div class="appointment-date"><p>'.$appointments[$i]["date"]." • ".$appointments[$i]["time"].'</p></div>';
                    echo '<div class="appointment-type"><p>'.$user->getTreatment($appointments[$i]["behandeling_id"])[0]["name"].'</p></div>';
                    if($user->worker == 0){
                        if($appointments[$i]["status"] == 0){
                            echo '<div class="appointment-status" style="color:red;"><p>Uw afspraak is nog niet aangenomen.</p></div>';
                        }else{
                            echo '<div class="appointment-status" style="color:green;"><p>Uw afspraak is aangenomen.</p></div>';
                        }
                    }
                    // fix
                    if($user->worker == 1){
                        if($appointments[$i]["status"] == 0){
                            echo '<div class="appointment-status" style="color:red;"><p>De afspraak is nog niet aangenomen.</p></div>';
                        }else{
                            echo '<div class="appointment-status" style="color:green;"><p>De afspraak is aangenomen.</p></div>';
                        }
                        echo '<div class="appointment-name"><p>Klant: '.$user->getFirstnameById($appointments[$i]["user_id"])[0]["first_name"].'</p></div>';
                        echo '<div class="appointment-worker"><p>Werknemer: '.$user->getFirstnameById($appointments[$i]["med_id"])[0]["first_name"].'</p></div>';
                        if($appointments[$i]["status"] == 0){
                            echo '<div class="appointment-accept-cancel"><form action="php/setAppointment.php" method="POST"><input type="text" name="appointmentid" value="'.$appointments[$i]["id"].'"><input type="submit" value="Afspraak Accepteren"></form></div>';
                        }else{
                            echo '<div class="appointment-accept-cancel"><form action="php/setAppointment.php" method="POST"><input type="text" name="appointmentid" value="'.$appointments[$i]["id"].'"><input type="submit" value="Afspraak Afzeggen"></form></div>';
                        }
                        echo '<div class="appointment-accept-cancel"><form action="php/deleteAppointment.php" method="POST"><input type="text" name="appointmentid" value="'.$appointments[$i]["id"].'"><input style="color: red;" type="submit" value="Verwijder Afspraak"></form></div>';
                    }
                    echo '</div>';
                }
            }
            
    

            ?>
        </div>
    </div>
</div>