<?php
require_once '../utils/Auth.php';
Auth::logOut();
header("Location: /auth.login.php");
die();
?>