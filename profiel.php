<div class="philomena-import">
    <?php
        require_once "php/user.php";
        $user = new User();
        $user->protectPage();
        // access data = $user->firstname
    ?>
    <div class="profile">
        <h1>profiel</h1>
        <hr>
    </div>
</div>