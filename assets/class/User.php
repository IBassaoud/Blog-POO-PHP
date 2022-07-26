<?php

abstract class User 
{
    protected $id_user;
    protected $prenom_user;
    protected $nom_user;
    protected $pseudo_user;
    protected $email_user;
    protected $role_user;
    private $pw_user; 
    protected $created_at;
    protected $updated_at;

    public function saveUser()
    {
        echo "hello world";
    }
}