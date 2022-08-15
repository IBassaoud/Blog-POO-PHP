<?php
namespace App\models
{

    class PostsModel extends Model 
    {
        protected $id_post;
        protected $fk_id_user;
        protected $title_post;
        protected $description_post;
        protected $views_post;
        protected $image_post;
        protected $body_post;
        protected $published_post;
        protected $created_at;
        protected $updated_at;

        public function __construct()
        {
            // __NAMESPACE__ = App\models\PostsModel  || __CLASS__ = App\models
            // remove the path "App\models\ to leave PostsModel
            $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
            // remove "Model" and make the rest "Projects" UPPERCASE and assign it to table wich is the table name in my DB
            $this->table = strtoupper(str_replace('Model','', $class ));
        }

        /**
         * Get the value of id_post
         */ 
        public function getId_post()
        {
                return $this->id_post;
        }

        /**
         * Set the value of id_post
         *
         * @return  self
         */ 
        public function setId_post($id_post)
        {
                $this->id_post = $id_post;

                return $this;
        }

        /**
         * Get the value of fk_id_user
         */ 
        public function getFk_id_user()
        {
                return $this->fk_id_user;
        }

        /**
         * Set the value of fk_id_user
         *
         * @return  self
         */ 
        public function setFk_id_user($fk_id_user)
        {
                $this->fk_id_user = $fk_id_user;

                return $this;
        }

        /**
         * Get the value of title_post
         */ 
        public function getTitle_post()
        {
                return $this->title_post;
        }

        /**
         * Set the value of title_post
         *
         * @return  self
         */ 
        public function setTitle_post($title_post)
        {
                $this->title_post = $title_post;

                return $this;
        }

        /**
         * Get the value of description_post
         */ 
        public function getDescription_post()
        {
                return $this->description_post;
        }

        /**
         * Set the value of description_post
         *
         * @return  self
         */ 
        public function setDescription_post($description_post)
        {
                $this->description_post = $description_post;

                return $this;
        }

        /**
         * Get the value of views_post
         */ 
        public function getViews_post()
        {
                return $this->views_post;
        }

        /**
         * Set the value of views_post
         *
         * @return  self
         */ 
        public function setViews_post($views_post)
        {
                $this->views_post = $views_post;

                return $this;
        }

        /**
         * Get the value of image_post
         */ 
        public function getImage_post()
        {
                return $this->image_post;
        }

        /**
         * Set the value of image_post
         *
         * @return  self
         */ 
        public function setImage_post($image_post)
        {
                $this->image_post = $image_post;

                return $this;
        }

        /**
         * Get the value of body_post
         */ 
        public function getBody_post()
        {
                return $this->body_post;
        }

        /**
         * Set the value of body_post
         *
         * @return  self
         */ 
        public function setBody_post($body_post)
        {
                $this->body_post = $body_post;

                return $this;
        }

        /**
         * Get the value of published_post
         */ 
        public function getPublished_post()
        {
                return $this->published_post;
        }

        /**
         * Set the value of published_post
         *
         * @return  self
         */ 
        public function setPublished_post($published_post)
        {
                $this->published_post = $published_post;

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
    }
}
?>