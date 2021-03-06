<?php
require_once 'private.php';
$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = 'DROP TABLE IF EXISTS users';
$dbc->exec($query);

$table = "CREATE TABLE IF NOT EXISTS users (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		username VARCHAR(50) UNIQUE NOT NULL,
		hash CHAR(64) NOT NULL,
		first_name VARCHAR(50) NOT NULL,
		last_name VARCHAR(75) NOT NULL,
		email VARCHAR(150) UNIQUE NOT NULL,
		birth_date DATE NOT NULL,
		GENDER CHAR(6),
		PRIMARY KEY (id)
	)";
$dbc->exec($table);