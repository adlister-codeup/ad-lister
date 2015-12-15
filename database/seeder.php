<?php
require 'migration.php';
$delete = 'TRUNCATE users';
$dbc->exec($delete);

// krieger pass is what, archer pass is lol

$tableInfo = [
	['username' => 'krieger', 'hash' => '749ab2c0d06c42ae3b841b79e79875f02b3a042e43c92378cd28bd444c04d284', 'first_name' => 'Johnny', 'last_name' => 'Bravo', 'email' => 'Johnny@test.com', 'birth_date' => '1919-02-26', 'gender' => 'M', 'shared' => true],
	['username' => 'archer', 'hash' => '07123e1f482356c415f684407a3b8723e10b2cbbc0b8fcd6282c49d37c9c1abc', 'first_name' => 'Tony', 'last_name' => 'Pecker', 'email' => 'Bob@test.com', 'birth_date' => '1929-04-12', 'gender' => 'M', 'shared' => true]
	
];

foreach ($tableInfo as $info) {
    $query = "INSERT INTO users (username, hash, first_name, last_name, email, birth_date, gender, shared) 
    VALUES (
        '{$info['username']}',
        '{$info['hash']}',
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
