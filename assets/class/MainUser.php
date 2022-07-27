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

    public function getId() 
    {
      return $this->id_user;
    }

    public function setId($newId) 
    {
      $this->id_user = $newId;
    }

    public function getPrenom() 
    {
      return $this->prenom_user;
    }

    public function setPrenom($setPrenom) 
    {
      $this->prenom_user = $setPrenom;
    }

    public function getNom() 
    {
      return $this->nom_user;
    }

    public function setNom($setNom) 
    {
      $this->nom_user = $setNom;
    }

    public function getPseudo() 
    {
      return $this->pseudo_user;
    }

    public function setPseudo($setPseudo) 
    {
      $this->pseudo_user = $setPseudo;
    }

    public function getEmail() 
    {
      return $this->email_user;
    }

    public function setEmail($setEmail) 
    {
      $this->email_user = $setEmail;
    }

    public function getRole() 
    {
      return $this->role_user;
    }

    public function setRole($setRole) 
    {
      $this->role_user = $setRole;
    }

    public function getPass() 
    {
      return $this->pw_user;
    }

    public function setPass($setPass) 
    {
      $this->pw_user = $setPass;
    }

    public function getCreatedAt() 
    {
      return $this->created_at;
    }
    public function setCreatedAt($setCreated) 
    {
      $this->created_at = $setCreated;
    }

    public function getUpdatedAt() 
    {
      return $this->updated_at;
    }

    public function setUpdatedAt($setUpt) 
    {
      $this->updated_at = $setUpt;
    }
}