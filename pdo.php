<?php

$connex = "mysql:dbname=blog_db;host=dbblog:3306;";
$user = "ism34";
$pw = "admin";
$root = "root";
$rootpw = "MYSQL_ROOT_PASSWORD";

try {
    $dbh = new PDO($connex, $user, $pw);
    $set_timezone = "SET GLOBAL time_zone = 'Europe/Paris';";
    $rootconn = new PDO($connex, $root, $rootpw);
    $rootconn->query($set_timezone);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
