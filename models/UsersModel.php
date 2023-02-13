<?php
namespace App\models
{

    class UsersModel extends Model 
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
        protected $is_logged_user;

        public function __construct()
        {
            // __NAMESPACE__ = App\models\UsersModel  || __CLASS__ = App\models
            // remove the path "App\models\ to leave UsersModel
            $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
            // remove "Model" and make the rest class name UPPERCASE and assign it to the proprety table wich is the table name in my DB
            // NAMING CLASS IS VERY IMPORTANT AND MUST MATCH THE DB TABLES NAME
            $this->table = strtoupper(str_replace('Model','', $class ));
        }

        /**
         * Get the value of id_user
         */ 
        public function getId_user()
        {
                return $this->id_user;
        }

        /**
         * Set the value of id_user
         *
         * @return  self
         */ 
        public function setId_user($id_user)
        {
                $this->id_user = $id_user;

                return $this;
        }

        /**
         * Get the value of prenom_user
         */ 
        public function getPrenom_user()
        {
                return $this->prenom_user;
        }

        /**
         * Set the value of prenom_user
         *
         * @return  self
         */ 
        public function setPrenom_user($prenom_user)
        {
                $this->prenom_user = $prenom_user;

                return $this;
        }

        /**
         * Get the value of nom_user
         */ 
        public function getNom_user()
        {
                return $this->nom_user;
        }

        /**
         * Set the value of nom_user
         *
         * @return  self
         */ 
        public function setNom_user($nom_user)
        {
                $this->nom_user = $nom_user;

                return $this;
        }

        /**
         * Get the value of pseudo_user
         */ 
        public function getPseudo_user()
        {
                return $this->pseudo_user;
        }

        /**
         * Set the value of pseudo_user
         *
         * @return  self
         */ 
        public function setPseudo_user($pseudo_user)
        {
                $this->pseudo_user = $pseudo_user;

                return $this;
        }

        /**
         * Get the value of email_user
         */ 
        public function getEmail_user()
        {
                return $this->email_user;
        }

        /**
         * Set the value of email_user
         *
         * @return  self
         */ 
        public function setEmail_user($email_user)
        {
                $this->email_user = $email_user;

                return $this;
        }

        /**
         * Get the value of role_user
         */ 
        public function getRole_user()
        {
                return $this->role_user;
        }

        /**
         * Set the value of role_user
         *
         * @return  self
         */ 
        public function setRole_user($role_user)
        {
                $this->role_user = $role_user;

                return $this;
        }

        /**
         * Get the value of pw_user
         */ 
        public function getPw_user()
        {
                return $this->pw_user;
        }

        /**
         * Set the value of pw_user
         *
         * @return  self
         */ 
        public function setPw_user($pw_user)
        {
                $this->pw_user = $pw_user;

                return $this;
        }

        /**
         * Get the value of created_at
         */ 
        public function getCreated_at()
        {
                return $this->created_at;
        }

        /**
         * Set the value of created_at
         *
         * @return  self
         */ 
        public function setCreated_at($created_at)
        {
                $this->created_at = $created_at;

                return $this;
        }

        /**
         * Get the value of updated_at
         */ 
        public function getUpdated_at()
        {
                return $this->updated_at;
        }

        /**
         * Set the value of updated_at
         *
         * @return  self
         */ 
        public function setUpdated_at($updated_at)
        {
                $this->updated_at = $updated_at;

                return $this;
        }

        /**
         * Get the value of is_logged_user
         */ 
        public function getIs_logged_user()
        {
                return $this->is_logged_user;
        }

        /**
         * Set the value of is_logged_user
         *
         * @return  self
         */ 
        public function setIs_logged_user($is_logged_user)
        {
                $this->is_logged_user = $is_logged_user;

                return $this;
        }
    }
}
?>