<?php
require_once 'private.php';
$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   