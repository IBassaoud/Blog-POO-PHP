<?php

require __DIR__ . '/../../pdo.php';

try {
    $dbh = new PDO($connex, $user, $pw);
}
catch (PDOException $e) {
    echo "Connection failed dbh: " . $e->getMessage();
}

$insert_user_query = "INSERT INTO `USERS` (`pseudo_user`, `email_user`, `pw_user`, `prenom_user`, `nom_user`, `role_user`) VALUES('$this->pseudo_user', '$this->email_user', '$this->pw_user', '$this->prenom_user', '$this->nom_user','$this->role_user')";
try {
  $sth = $dbh->query($insert_user_query);
  $createdmsg = urlencode("&#9989 User created successfully!");
  // header('Location: register.php?msgCreate='.$createdmsg);
  $_GET['msgCreate'] = $createdmsg;
}
catch (PDOException $e) {
  echo "Insertion failed request: " . $e->getMessage();
}

?>