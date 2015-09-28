<?php
session_start();
session_destroy();

$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
);

header('Location: ../startPage.php');
die;