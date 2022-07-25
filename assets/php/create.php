<?php
require_once("../../pdo.php");
// echo "<pre>";
// var_dump($_POST);
if (isset($_POST)){

    if(!empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty(["repeat_password"]) && !empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["role"])){
        if($_POST["password"] === $_POST["repeat_password"]){
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $role = $_POST['role'];
            $hashedpassword = password_hash($password,PASSWORD_BCRYPT); 

            $insert_user_query = "INSERT INTO `USERS` (`pseudo_user`, `email_user`, `pw_user`, `prenom_user`, `nom_user`, `role_user`) VALUES('$pseudo', '$email', '$hashedpassword', '$firstname', '$lastname','$role')";
            try {
                $sth = $dbh->query($insert_user_query);
                $createdmsg = urlencode("&#9989 User created successfully!");
                header('Location: register.php?msgCreate='.$createdmsg);
                ?>
                <?php
            }
            catch (PDOException $e) {
                echo "Insertion failed: " . $e->getMessage();
            }
        } else {
            $msg = urlencode("The two passwords are not matching!");
            header('Location: register.php?msg='.$msg);}
    } 
}


