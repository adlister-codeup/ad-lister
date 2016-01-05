<?php
require_once 'private.php';
	$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = 'DROP TABLE IF EXISTS images';
	$dbc->exec($query);

	$table = "CREATE TABLE IF NOT EXISTS images (
		id INT UNSIGNED NOT NULL AUTO_INCREMENT,
		adid INT UNSIGNED NOT NULL,
		imgpath VARCHAR(128) NOT NULL,
		PRIMARY KEY (id)
	)";
	$dbc->exec($table);
?>