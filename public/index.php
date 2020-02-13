<?php
namespace App;

require '../vendor/autoload.php';

$pdo = new SQLiteConnection();
$pdo->connect();
if ($pdo != null) {
    echo  $pdo->generateTable();
} else{
    echo 'Whoops, could not connect to the SQLite database!';
}




