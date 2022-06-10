<div class="form-wrapper philomena-import">
    <div class="form-image">
        <img src="images/philomena-logo-diap.png" alt="Philomena Logo"> 
    </div>
    <div class="form">
        <form action="php/login.php" method="POST">
            <div class="form-text">
                <p>Inloggen</p>
            </div>
            <div class="form-error" error></div>
            <div class="form-row">
                <div class="form-error" error-mail></div>
                <input type="email" name="email" value="" placeholder="Email" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-pass></div>
                <input type="password" name="pass" value="" placeholder="Wachtwoord" required>
            </div>
            <div class="form-row row-checkbox-text">
                <input type="checkbox" name="keeploggedin"><p>blijf ingelogt</p>
            </div>
            <div class="form-row">
                <input type="text" id="login-redirect" name="redirect" value="" style="display: none;">
                <input type="submit" value="Inloggen">
            </div>
        </form>
        <div class="form-links">
            <a href="registreren.php" data-link>Registreren</a>
            <a href="wachtwoord-vergeten.php" data-link>Wachtwoord Vergeten</a>
            <a href="medewerker.php" data-link>Medewerker Portaal</a>
        </div>
    </div>
</div>