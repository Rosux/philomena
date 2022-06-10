<div class="form-wrapper philomena-import">
    <div class="form-image">
        <img src="images/philomena-logo-diap.png" alt="Philomena Logo"> 
    </div>
    <div class="form">
        <form action="php/register.php" method="POST">
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
                <div class="form-error" error-street></div>
                <input type="text" name="street" value="" placeholder="Straat" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-postal-code></div>
                <input type="email" name="postal-code" value="" placeholder="Postcode" required>
            </div>
            <div class="form-row">
                <div class="form-error" error-livingplace></div>
                <input type="email" name="livingplace" value="" placeholder="Woonplaats" required>
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
                <input type="submit" value="Registreren">
            </div>
        </form>
        <div class="form-links">
            <a href="login.php" data-link>Inloggen</a>
            <a href="wachtwoord-vergeten.php" data-link>Wachtwoord Vergeten</a>
            <a href="medewerker.php" data-link>Medewerker Portaal</a>
        </div>
    </div>
</div>