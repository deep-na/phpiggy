<?php

use Framework\Database;

include __DIR__ . "/src/Framework/Database.php";

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy'
], 'root', '');


// $query = "SELECT * FROM products WHERE name= :name";
// $stmt = $db->connection->prepare($query);

// //$stmt -> bindValue();

// $stmt->execute([
//     'name' => "Erikson"
// ]);

// var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));

$file = file_get_contents('./database.sql');

$db->connection->query($file);


echo "Successfully connected to a database";
