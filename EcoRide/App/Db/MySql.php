<?php
namespace App\Db;

class MySql
{
    private string $db_name;
    private string $db_username;
    private string $db_password;
    private string|int $db_ports;
    private string|int $db_host;
    private \PDO|null $pdo = null;
    private static $_instance = null;

    private function __construct()
    {
        // get .env and convert in to an array
        $config = parse_ini_file(ROOT_PATH . "/" . ".env");

        if (isset($config["DB_NAME"])) {
            $this->db_name = $config["DB_NAME"];
        }

        if (isset($config["DB_USER"])) {
            $this->db_username = $config["DB_USER"];
        }

        if (isset($config["DB_PWD"])) {
            $this->db_password = $config["DB_PWD"];
        }

        if (isset($config["DB_PORTS"])) {
            $this->db_ports = $config["DB_PORTS"];
        }

        if (isset($config["DB_HOST"])) {
            $this->db_host = $config["DB_HOST"];
        }
    }

    public static function getInstance(): self
    {
        // verify if $_instance is null if null initi object
        if (is_null(self::$_instance)) {
            self::$_instance = new MySql();
        }
        // if not return return $_instance that allready existes
        return self::$_instance;
    }

    public function getPDO(): \PDO
    {
        try {
            if (is_null($this->pdo)) {
                $this->pdo = new \PDO("mysql:dbname={$this->db_name};charset=utf8;host={$this->db_host};{$this->db_ports}", $this->db_username, $this->db_password);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }

            return $this->pdo;
        } catch (\PDOException $e) {
            die("Connexion echouer:" . $e->getMessage());
        }
    }
}
