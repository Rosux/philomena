<?php
    require_once "../php/user.php";
    $user = new User();
    $user->protectPage();
    function showTreatments(string $category=null, $user){
        $treatments = $user->getAllTreatments($category);
        if($treatments){
            echo '<div class="treatment-row-title"><p>'.$category.'</p></div>';
            for($i=0; $i < count($treatments); $i++){
                // <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                echo '<div class="new-appointment-row2"><input type="radio" name="treatment" value="'.$treatments[$i]["id"].'" class="treatment-row"><p class="new-appointment-row-name">'.$treatments[$i]["name"].'</p><p class="treatment-price">€'.$treatments[$i]["price"].'</p></div>';
            }
        }
    }
?>
<div class="philomena-import">
    <div class="new-appointment-wrapper">
        <div class="new-appointment-title"><p>Nieuwe Afspraak Maken</p></div>
        <div class="form-error" error></div>
        <div class="new-appointment-row">
            <p id="1" class="new-appointment-row-current">Behandelingen</p>
            <p id="2">Datum</p>
            <p id="3">Tijd</p>
            <p id="4">Afrekenen</p>
            <p id="5">Bevestiging</p>
        </div>
        <form action="php/newAppointment.php" method="POST">
            <div class="overlay-form-wrapper" id="appointment-1">
                <div class="new-appointment-nails">
                    <h2>Nagels</h2>
                    <?php
                        // print treatments from db
                        showTreatments("Nieuwe set", $user);
                        showTreatments("Nabehandeling", $user);
                        showTreatments("Handen", $user);
                        showTreatments("Voeten", $user);
                    ?>
                </div>
                <div class="new-appointment-hair">
                    <h2>Haar</h2>
                    <?php
                        // print treatments from db
                        showTreatments("Dames", $user);
                        showTreatments("Heren", $user);
                        showTreatments("Kinderen t/m 11 jaar", $user);
                        showTreatments("Kinderen 12 t/m 15 jaar", $user);
                    ?>
                </div>
            </div>
            <div class="overlay-form-wrapper" id="appointment-2" style="flex-direction: column;display: none;">
                <h4>Werkdagen: ma-vr</h4>
                <input type="date" name="date">
            </div>
            <div class="overlay-form-wrapper" id="appointment-3" style="flex-direction: column;display: none;">
                <h4>Openingstijden: 10:00-18:00</h4>
                <input type="time" name="time">
            </div>
            <div class="overlay-form-wrapper" id="appointment-4" style="flex-direction: column;display: none;">
                <input type="submit" value="Afspraak Aanvragen">
            </div>
        </form>
        <div class="new-appointment-price">
            <h2>Totaal (te betalen bij vertrek): € <a>....</a></h2>
        </div>
        <div class="new-appointment-navigation">
            <button onclick="backward()">Terug</button>
            <button onclick="forward()">Verder</button>
        </div>
    </div>
</div>