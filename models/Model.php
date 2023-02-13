<?php

namespace App\models {

    use App\core\Db;

    class Model extends Db
    {
        // Table de la base de données 
        protected $table;

        // Instance de Db
        private $db;

        // Les méthodes ; CRUD
        // PARTIE Read  
        public function findAll()
        {
            $query = $this->query_DB("SELECT * FROM " . $this->table);
            return $query->fetchAll();
        }

        /**
         * Find records in the database based on given criteria
         * @param array $criteres - Criteria for searching in the database
         * @return array - Result of the query 
         */
        public function findBy(array $criteres)
        {
            $champs = [];
            $valeurs = [];

            // On boucle pour éclater le tableau
            foreach ($criteres as $champ => $valeur) {
                // SELECT * FROM USERS WHERE `status_job` = ? AND `age` = 0 
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
            // On transforme le tableau "champs" en une chaine de caractères séparé par des AND
            $list_champs = implode(' AND ', $champs);
            // On execute la requête
            return $this->query_DB("SELECT * FROM " . $this->table . " WHERE " . $list_champs, $valeurs)->fetchAll();
        }

        public function findOrderbyLimit(array $order, int $limit)
        {
            $orderby = key($order);
            $orderColumn = $order[$orderby];

            // Validate and sanitize the input data
            if (!in_array($orderby, ['ASC', 'DESC'])) {
                throw new \Exception("Invalid orderby value. Only 'ASC' or 'DESC' are allowed.");
            }
            $allowedColumns = ['created_at', 'updated_at', 'id','id_post','id_comment'];
            if (!in_array($orderColumn, $allowedColumns)) {
                throw new \Exception("Invalid order column value. Only 'created_at', 'updated_at', or 'id' are allowed.");
            }

            // On execute la requête
            // SELECT * FROM `POSTS` ORDER BY `created_at` DESC LIMIT 5
            if (!empty($order)) {
                if ($limit != null) {
                    return $this->query_DB("SELECT * FROM " . $this->table . " ORDER BY " . $orderColumn . " " . $orderby . " LIMIT " . $limit)->fetchAll();
                } else {
                    return $this->query_DB("SELECT * FROM " . $this->table . " ORDER BY " . $orderColumn . " " . $orderby)->fetchAll();
                }
            }
        }

        public function find(int $id, string $tab)
        {
            // Pour aller chercher spécifiquement 1 seul utilisateur par son id
            return $this->query_DB("SELECT * FROM " . $this->table . " WHERE id" . $tab . " = " . $id)->fetch();
        }

        // PARTIE Create
        //Créer un utilisateur à partir d'un formulaire ou à partir d'un modèle
        public function create(Model $model)  // à l'aide de ma méthode j'injècte le modèle $modele qui est sur mon fichier index.php le $newUser qui me permet de faire un INSERT  de manière automatisé
        {
            $champs = [];
            $inter = [];
            $valeurs = [];

            // On boucle pour éclater le tableau
            foreach ($model as $champ => $valeur) {
                $name_column = "id_" . rtrim(strtolower($this->table), "s");
                // INSERT INTO USERS (`name`,`username`,`email`,`password`,`title`,`aboutme`,`city`,`country`,`facebook`,`twitter`,`instagram`,`youtube`,`linkedin`,`github`,`slogan`,`birthday`,`website`,`phone`,`age`,`degree`,`status_job`,`certification`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) 
                // J'éxclue les champs non désirée pour ma requête création d'un utilisateur
                if ($valeur !== null && $champ != $name_column && $champ != 'db' && $champ != 'table' && $champ != 'created_at' && $champ != 'updated_at') {
                    $champs[] = "`" . $champ . "`";
                    $inter[] = "?";
                    $valeurs[] = $valeur;
                }
            }
            // On transforme le tableau "champs" en une chaine de caractères séparé par des AND
            $list_champs = implode(', ', $champs);
            $list_inter = implode(', ', $inter);
            // On execute la requête
            return $this->query_DB("INSERT INTO " . $this->table . " (" . $list_champs . ") VALUES (" . $list_inter . ")", $valeurs);
        }


        // PARTIE Update
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $k => $v) {
                // On récupère le nom du setter correspondant à la clé (key)
                $setter = "set" . ucfirst($k);

                // On vérifie si le setter existe
                if (method_exists($this, $setter)) {
                    // Si oui, on appelle le setter avec sa valeur en argument
                    $this->$setter($v);
                }
            }
            return $this;
        }
        // Mettre à jour un utilisateur
        public function update(int $id, Model $model)
        {
            $champs = [];
            $valeurs = [];
            $name_column = "`$this->table`.id_" . rtrim(strtolower($this->table), "s");
            // On boucle pour éclater le tableau
            foreach ($model as $champ => $valeur) {
                if (isset($valeur) && $champ != $name_column && $champ != 'db' && $champ != 'table' && $champ != 'created_at') {
                    $champs[] = "`$champ` = ?";
                    $valeurs[] = $valeur;
                }
            }
            $valeurs[] = $id;
            // On transforme le tableau "champs" en une chaine de caractères séparé par des AND
            $list_champs = implode(', ', $champs);
            // On execute la requête
            return $this->query_DB("UPDATE " . $this->table . " SET " . $list_champs . " WHERE " . $name_column . " = ?", $valeurs);
        }


        // PARTIE Delete
        // Mettre à jour un utilisateur
        public function delete(int $id)
        {
            // Rend en minuscule le nom de la table et supprime le "s" en fin de la chaine de caractère
            $name_column = "id_" . rtrim(strtolower($this->table), "s");
            // retourne la requête avec le bon nom de colonne qui commence avec "id_" suivi du nom de la table en miniuscule et au singulier
            return $this->query_DB('DELETE FROM ' . $this->table . " WHERE " . $name_column . " = ? ", [$id]);
        }


        public function query_DB(string $sql, array $attributs = null)
        {
            // On récupère l'instance de Db
            $this->db = Db::getInstance();

            // On vérifie si on a des attributs
            if ($attributs !== null) {
                // Requête préparée 
                $query = $this->db->prepare($sql);
                $query->execute($attributs);
                return $query;
            } else {
                // Requête simple
                return $this->db->query($sql);
            }
        }
    }
}
