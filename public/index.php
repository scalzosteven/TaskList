<?php
namespace App;

require '../vendor/autoload.php';

$pdo = new SQLiteConnection();
$pdo->connect();
if ($pdo != null) {
    echo  'Connected to the SQLite database successfully!';
} else{
    echo 'Whoops, could not connect to the SQLite database!';
}




