<?php

namespace App\models {

    class TagsModel extends Model
    {
        public $id_tag;
        public $name_tag;
        public $created_at;
        public $updated_at;

        public function __construct()
        {
            $class = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
            $this->table = strtoupper(str_replace('Model', '', $class));
        }

        /**
         * Get the value of name_tag
         */
        public function getName_tag()
        {
            return $this->name_tag;
        }

        /**
         * Set the value of name_tag
         *
         * @return  self
         */
        public function setName_tag($name_tag)
        {
            $this->name_tag = $name_tag;

            return $this;
        }

        /**
         * Get the value of id_tag
         */
        public function getId_tag()
        {
            return $this->id_tag;
        }

        /**
         * Set the value of id_tag
         *
         * @return  self
         */
        public function setId_tag($id_tag)
        {
            $this->id_tag = $id_tag;

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
