<?php
include "config.php";

$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error) {
    die("DataBase Connection Failed Badly " . $connection->connect_error);
}
// else {
//     echo "connected";
// }
