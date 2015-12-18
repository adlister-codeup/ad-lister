<?php
require 'auth.php';
session_start();
Auth::logout();
endSession();
header("Location: /auth.login.php");
die();
?>