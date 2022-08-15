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
    private const DBHOST = '172.21.0.2:3306'; 
    private const DBUSER = 'ism34'; 
    private const DBPASS = 'admin';
    private const DBNAME = 'BLOG_DB';
    
    private function __construct()
    {
        // DSN de connexion 
        $_conn = "mysql:dbname=" . self::DBNAME . ";host=". self::DBHOST;

        // On appelle le constructeur de la class PDO
        try {
            parent::__construct($_conn, self::DBUSER, self::DBPASS);

            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance():self
    {
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

}
?>