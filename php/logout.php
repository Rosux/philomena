<?php
    require_once "../php/user.php";
    $user = new User();
    // logout
    $user->logout();
    $output['redirect'] = "login.php";
    echo json_encode($output);
    exit();
?>