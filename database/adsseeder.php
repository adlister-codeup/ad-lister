<?php
	require_once 'private.php';
	$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, USER, PASS);
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$delete = 'TRUNCATE users';
	$dbc->exec($delete);

	$data = [
		["title" => "Cyborg legs", "description" => "Mostly new set of cyborg legs", "email" => "legs@email.email", "phone" => 2345765234, "price" => 29.99, "location" => "kriegers lab", "images" => ""],
		["title" => "wooden table", "description" => "I cleaned it last week", "email" => "nobody@email.email", "phone" => 1231231265, "price" => 33.87, "location" => "my house", "images" => ""],
		["title" => "macbook", "description" => "my macbook with all of my personal information still on it", "email" => "dumb@email.email", "phone" =>9874562345 , "price" => 54.33, "location" => "street corner", "images" => ""],
		["title" => "Kenny Loggins Danger Zone cd", "description" => "brand new copy of Lenny loggins Danger Zone on a cd", "email" => "music@email.email", "phone" => 2349876354, "price" => 10.99, "location" => "DANGER ZONE", "images" => ""]
	];
	foreach ($data as $key => $value)
	{
		$query = "INSERT INTO ads (title, description, email, phone, price, location, images) 
   		VALUES (
   			'{$value['title']}',
   			'{$value['description']}',
   			'{$value['email']}',
   			'{$value['phone']}',
   			'{$value['price']}',
   			'{$value['location']}',
   			'{$value['images']}'
    	)";
		$dbc->exec($query);
	}
	echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
?>