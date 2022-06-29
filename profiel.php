<div class="philomena-import">
    <?php
        require_once "php/user.php";
        $user = new User();
        $user->protectPage();
        // access data = $user->firstname
    ?>
    <div class="profile">
        <h1>profiel</h1>
        <form action="php/updateUser.php" method="POST">
            <div class="firstname">
                <div class="form-error" error-first-name></div>
                <label for="firstname">Voornaam:</label>
                <input type="text" name="firstname" value="<?php echo $user->firstname ?>">
            </div>
            <div class="lastname">
                <div class="form-error" error-last-name></div>
                <label for="lastname">Achternaam:</label>
                <input type="text" name="lastname" value="<?php echo $user->lastname ?>">
            </div>
            <div class="street">
                <div class="form-error" error-street></div>
                <label for="street">Straat:</label>
                <input type="text" name="street" value="<?php echo $user->street ?>">
            </div>
            <div class="postal-code">
                <div class="form-error" error-postal-code></div>
                <label for="postal-code">Post code:</label>
                <input type="text" name="postal-code" value="<?php echo $user->postalcode ?>">
            </div>
            <div class="livingplace">
                <div class="form-error" error-livingplace></div>
                <label for="livingplace">Woonplaats:</label>
                <input type="text" name="livingplace" value="<?php echo $user->livingplace ?>">
            </div>
            <div class="input">
                <input type="submit" value="Opslaan">
            </div>
        </form>
        <form action="php/resetPassword.php" method="POST">
            <div class="password">
                <div class="form-error" error-pass></div>
                <label for="password">Nieuw Wachtwoord:</label>
                <input type="password" name="password">
            </div>
            <div class="password-repeat">
                <div class="form-error" error-pass-repeat></div>
                <label for="passwordrepeat">Herhaal Nieuw Wachtwoord:</label>
                <input type="password" name="passwordrepeat">
            </div>
            <div class="oldpassword">
                <label for="oldpassword">Oud Wachtwoord:</label>
                <input type="password" name="oldpassword">
            </div>
            <div class="input">
                <input type="submit" value="Wachtwoord Opslaan">
            </div>
        </form>
    </div>
</div>