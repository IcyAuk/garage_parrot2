<?php

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => DOMAIN,
    'httponly' => true
]);

session_start();

function adminOnly(){
    if (!isset($_SESSION["user"])) {
        header("location: ../login.php");
    } else if ($_SESSION["user"]["role"] != "admin"){
        header("location: ../index.php");
    }
}
