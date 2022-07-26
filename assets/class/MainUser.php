<?php

abstract class MainUser 
{
    protected $id_user;
    protected $prenom_user;
    protected $nom_user;
    protected $pseudo_user;
    protected $email_user;
    protected $role_user;
    protected $pw_user; 
    protected $created_at;
    protected $updated_at;

    public function __construct($prenom, $nom,$pseudo,$email, $role,$pw) 
    {
        $this->prenom_user = $prenom;
        $this->nom_user = $nom;
        $this->pseudo_user = $pseudo;
        $this->email_user = $email;
        $this->role_user = $role;
        $this->pw_user = $pw;
    }

    public function saveUser()
    {
      $connex = "mysql:dbname=MYSQL_DATABASE;host=172.21.0.2:3306;";
      $user = "ism34";
      $pw = "admin";

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
    }
    
}