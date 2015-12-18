<?php
require_once '../utils/Auth.php';
session_start();
Auth::logout();
header("Location: /auth.login.php");
die();
?>