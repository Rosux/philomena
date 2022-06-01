<?php
    session_start();
?>
<div class="form-wrapper philomena-import">
    <div class="form-image">
        <img src="images/philomena-logo-diap.png" alt="Philomena Logo"> 
    </div>
    <div class="form">
        <form action="" method="POST">
            <div class="form-text">
                <p>Inloggen</p>
            </div>
            <div class="form-row">
                <input type="email" name="email" value="" placeholder="Email" required>
            </div>
            <div class="form-row">
                <input type="password" name="pass" value="" placeholder="Wachtwoord" required>
            </div>
            <div class="form-row">
                <input type="submit" value="Inloggen"  run-script="login.php">
            </div>
        </form>
        <div class="form-links">
            <a href="registreren.php" data-link>Registreren</a>
            <a href="wachtwoord-vergeten.php" data-link>Wachtwoord Vergeten</a>
            <a href="medewerker.php" data-link>Medewerker Portaal</a>
        </div>
    </div>
</div>