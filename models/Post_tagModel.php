<?php

namespace App\models {

    class Post_TagModel extends Model
    {
        public $fk_id_post;
        public $fk_id_tag;

        public function __construct()
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
            $this->table = strtoupper(str_replace('Model', '', $class));
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
         * Get the value of fk_id_tag
         */
        public function getFk_id_tag()
        {
            return $this->fk_id_tag;
        }

        /**
         * Set the value of fk_id_tag
         *
         * @return  self
         */
        public function setFk_id_tag($fk_id_tag)
        {
            $this->fk_id_tag = $fk_id_tag;

            return $this;
        }
    }
}
