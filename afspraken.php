<div class="philomena-import">
    <?php
        require_once "php/user.php";
        $user = new User();
        $user->protectPage();
    ?>
    <div class="appoin">
        <div class="appoin-user">
            <p>Welkom <?php echo $user->firstname ?></p>
            <button>NIEUWE AFSPRAAK</button>
        </div>
        <div class="appoin-title">
            <p>Afspraken</P>
        </div>
        <div class="appoin-wrapper">
            <div class="appointment">
                <div class="appointment-time"><p>1999 - 01 - 01</p></div>
                <div class="appointment-type"><p>naturel: gel ofzo idk</p></div>
            </div>
            <div class="appointment">
                <div class="appointment-time"><p>1999 - 01 - 01</p></div>
                <div class="appointment-type"><p>naturel: gel ofzo idk</p></div>
            </div>
            <div class="appointment">
                <div class="appointment-time"><p>1999 - 01 - 01</p></div>
                <div class="appointment-type"><p>naturel: gel ofzo idk</p></div>
            </div>
            <div class="appointment">
                <div class="appointment-time"><p>1999 - 01 - 01</p></div>
                <div class="appointment-type"><p>naturel: gel ofzo idk</p></div>
            </div>
        </div>
    </div>



</div>