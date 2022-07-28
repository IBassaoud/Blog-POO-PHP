<?php
session_start();
// Check if the user is logged in, if not then redirect him to login page 
if(!isset($_SESSION['admin'])){
    header("location: http://localhost:8006/"); 
    exit;
}

