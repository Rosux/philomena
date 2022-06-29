<?php
    require_once "php/user.php";
    $user = new User();
    $user->protectPage();
    // access data = $user->firstname
?>
<div class="form-wrapper philomena-import">
    <div class="form-image">
        <img src="images/philomena-logo-diap.png" alt="Philomena Logo"> 
    </div>
    <div class="form">
        <form action="php/logout.php" method="POST">
            <div class="form-text">
                <p>Loguit</p>
            </div>
            <div class="form-row">
                <input type="submit" value="Uitloggen">
            </div>
        </form>
    </div>
</div>