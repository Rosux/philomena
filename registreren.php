<div class="form-wrapper philomena-import">
    <div class="form-image">
        <img src="images/philomena-logo-diap.png" alt="Philomena Logo"> 
    </div>
    <div class="form">
        <form action="" method="POST">
            <div class="form-text">
                <p>Registreren</p>
            </div>
            <div class="form-error" error></div>
            <div class="form-row">
                <div class="form-error" error-first-name></div>
                <input type="text" name="firstname" value="" placeholder="Voornaam" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-last-name></div>
                <input type="text" name="lastname" value="" placeholder="Achternaam" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-mail></div>
                <input type="email" name="email" value="" placeholder="Email" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-pass></div>
                <input type="password" name="pass" value="" placeholder="Wachtwoord" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-pass-repeat></div>
                <input type="password" name="pass2" value="" placeholder="Wachtwoord Herhalen" required>
            </div>
            <div class="form-row">
                <input type="submit" value="Registreren" run-script="register.php">
            </div>
        </form>
        <div class="form-links">
            <a href="login.php" data-link>Inloggen</a>
            <a href="wachtwoord-vergeten.php" data-link>Wachtwoord Vergeten</a>
            <a href="medewerker.php" data-link>Medewerker Portaal</a>
        </div>
    </div>
</div>