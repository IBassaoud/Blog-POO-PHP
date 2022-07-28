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
    protected $isLoggedYesNo;

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
      require __DIR__ . '/../template/save_user.php';
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

    public function getIsLogged() 
    {
      return $this->isLoggedYesNo;
    }

    public function setIsLogged($loggedYesNo) 
    {
      $this->isLoggedYesNo = $loggedYesNo;
    }
}