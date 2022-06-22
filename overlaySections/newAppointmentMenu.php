<?php
    require_once "../php/user.php";
    $user = new User();
    $user->protectPage();
    function showTreatments(string $category=null, $user){
        $treatments = $user->getAllTreatments($category);
        if($treatments){
            echo '<div class="treatment-row-title"><p>'.$category.'</p></div>';
            for($i=0; $i < count($treatments); $i++){
                echo '<div class="treatment-row"><p>'.$treatments[$i]["name"].'</p><p class="treatment-price">'.$treatments[$i]["price"].'</p></div>';
            }
        }
    }
?>
<div class="philomena-import">
    <div class="new-appointment-wrapper">
        <div class="new-appointment-title"><p>Nieuwe Afspraak Maken</p></div>
        <div class="new-appointment-row">
            <p class="new-appointment-row-current">Behandelingen</p>
            <p>Datum</p>
            <p>Tijd</p>
            <p>Afrekenen</p>
            <p>Bevestiging</p>
        </div>
        <div class="new-appointment-inner-wrapper-treatments" id="behandelingen">
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
        <div class="new-appointment-price">
            <h2>Totaal (te betalen bij vertrek): € <a>....</a></h2>
        </div>
        <hr>
        <div class="new-appointment-navigation">
            <button onclick="backward()">Terug</button>
            <button onclick="forward()">Verder</button>
        </div>
    </div>
</div>