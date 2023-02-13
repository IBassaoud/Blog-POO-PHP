<?php

namespace App\core;

// On importe PDO
use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe 
    private static $instance;

    // Information de connexion 
    private const DBHOST = 'dbblog';
    private const DBUSER = 'ism34';
    private const DBPASS = 'admin';
    private const DBNAME = 'blog_db';

    public function __construct()
    {
        // DSN de connexion 
        $_conn = "mysql:dbname=" . self::DBNAME . ";host=" . self::DBHOST;

        // On appelle le constructeur de la class PDO
        try {
            parent::__construct($_conn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->exec("SET GLOBAL time_zone = 'Europe/Paris';");
            $this->checkAndCreateTables();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function checkAndCreateTables()
    {
        try {
            // Fetch an array of all table names in the database
            $tables = $this->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

            // Check if all required tables (USERS, POSTS, COMMENTS, TAGS, POST_TAG) exist
            if (!in_array('USERS', $tables) || !in_array('POSTS', $tables) || !in_array('COMMENTS', $tables) || !in_array('TAGS', $tables) || !in_array('POST_TAG', $tables)) {
                // If any of the required tables does not exist, execute the SQL statements from the init.sql file
                $sql = file_get_contents(__DIR__ . "/init.sql");
                $this->exec($sql);
            }
        } catch (PDOException $e) {
            // If there was an error, display the error message and terminate the script
            die($e->getMessage());
        }
    }
}
