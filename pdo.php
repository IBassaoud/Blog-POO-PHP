<?php

$connex = "mysql:dbname=MYSQL_DATABASE;host=172.21.0.2:3306;";
$user = "ism34";
$pw = "admin";

try {
    $dbh = new PDO($connex, $user, $pw);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
