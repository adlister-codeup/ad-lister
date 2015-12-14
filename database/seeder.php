<?php
require 'migration.php';


$delete = 'TRUNCATE national_parks';
$dbc->exec($delete);

$tableInfo = [
	['first_name' => 'Johnny', 'last_name' => 'Bravo', 'email' => 'Johnny@test.com', 'birth_date' => '1919-02-26', 'gender' => 'M', 'shared' => true],
	['first_name' => 'Tony', 'last_name' => 'Pecker', 'email' => 'Bob@test.com', 'birth_date' => '1929-04-12', 'gender' => 'M', 'shared' => true]
	
];

foreach ($tableInfo as $info) {
    $query = "INSERT INTO kriegerslist (first_name, last_name, email, birth_date, gender, shared) 
    VALUES (
    	'{$info['first_name']}', 
    	'{$info['last_name']}', 
    	'{$info['email']}', 
    	'{$info['birth_date']}',
    	'{$info['gender']}',
    	'{$info['shared']}'
    	)";

    $dbc->exec($query);

    echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;
};
