<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
    header("location: login.php"); 
    exit;
}
