<?php

namespace App\models {

    class CommentsModel extends Model
    {
        protected $id_comment;
        protected $fk_id_user;
        protected $fk_id_post;
        protected $body_comment;
        protected $created_at;
        protected $updated_at;

        public function __construct()
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
            $this->table = strtoupper(str_replace('Model', '', $class));
        }

        /**
         * Get the value of id_comment
         */
        public function getId_comment()
        {
            return $this->id_comment;
        }

        /**
         * Set the value of id_comment
         *
         * @return  self
         */
        public function setId_comment($id_comment)
        {
            $this->id_comment = $id_comment;

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
         * Get the value of fk_id_post
         */
        public function getFk_id_post()
        {
            return $this->fk_id_post;
        }

        /**
         * Set the value of fk_id_post
         *
         * @return  self
         */
        public function setFk_id_post($fk_id_post)
        {
            $this->fk_id_post = $fk_id_post;

            return $this;
        }

        /**
         * Get the value of body_comment
         */
        public function getBody_comment()
        {
            return $this->body_comment;
        }

        /**
         * Set the value of body_comment
         *
         * @return  self
         */
        public function setBody_comment($body_comment)
        {
            $this->body_comment = $body_comment;

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
