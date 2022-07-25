<?php
require_once("../../pdo.php");
// echo "<pre>";
// var_dump($_POST);
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['password'];
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];
$role = $_POST['role'];

$insert_user_query = "INSERT INTO `USERS` (`pseudo_user`, `email_user`, `pw_user`, `prenom_user`, `nom_user`, `role_user`) VALUES('$pseudo', '$email', '$password', '$firstname', '$lastname','$role')";

try {
    $sth = $dbh->query($insert_user_query);
    $createdmsg = urlencode("User created successfully!");
    header('Location: register.php?msgCreate='.$createdmsg);
    ?>
    <?php
}
catch (PDOException $e) {
    echo "Insertion failed: " . $e->getMessage();
}
