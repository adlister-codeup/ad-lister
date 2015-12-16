<?php
	require_once 'private.php';
	$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = 'DROP TABLE IF EXISTS ads';
	$dbc->exec($query);

	$table = "CREATE TABLE IF NOT EXISTS ads (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		owner VARCHAR(50) NOT NULL,
		title VARCHAR(200) NOT NULL,
		description TEXT NOT NULL,
		email VARCHAR(100) NOT NULL,
		phone BIGINT,
		price FLOAT NOT NULL,
		location VARCHAR(250) NOT NULL,
		images TEXT,
		categories TEXT,
		PRIMARY KEY (id)
	)";
	$dbc->exec($table);
?>