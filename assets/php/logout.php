<?php
require_once("../../pdo.php");
require_once("../class/User.php");
session_start();

if (isset($_SESSION['user'])){
  $email = $_SESSION['user']->getEmail();
  if(session_destroy()) { 
  $insert_logNo = "UPDATE `USERS` SET `is_logged_user` = b'0' WHERE `email_user` = '$email'";
  try {
    $stmt = $dbh->query($insert_logNo);
  }
  catch (PDOException $e) {
      echo "Update failed: " . $e->getMessage();
  }
  // Redirecting To Home Page
  header("Location: login.php");
}
}

if (isset($_SESSION['admin'])){
  $email = $_SESSION['admin']->getEmail();
  if(session_destroy()) { 
  $insert_logNo = "UPDATE `USERS` SET `is_logged_user` = b'0' WHERE `email_user` = '$email'";
  try {
    $stmt = $dbh->query($insert_logNo);
  }
  catch (PDOException $e) {
      echo "Update failed: " . $e->getMessage();
  }
  // Redirecting To Home Page
  header("Location: login.php");
}

}
if (isset($_SESSION['moderator'])){
  $email = $_SESSION['moderator']->getEmail();
  if(session_destroy()) { 
  $insert_logNo = "UPDATE `USERS` SET `is_logged_user` = b'0' WHERE `email_user` = '$email'";
  try {
    $stmt = $dbh->query($insert_logNo);
  }
  catch (PDOException $e) {
      echo "Update failed: " . $e->getMessage();
  }
  // Redirecting To Home Page
  header("Location: login.php");
}
}

?>