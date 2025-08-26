<?php
namespace App\Db;

require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

use MongoDB\Client;

class MongoDb
{
    private string|int $host;
    private string|int $port;
    private string $username;
    private string $password;
    private string $authSource;
    private static $_instance     = null;
    private Client|null $client = null;
    private string $dbName        = "ecoride";

    private function __construct()
    {
        $config = parse_ini_file(dirname(__DIR__, 2) . "/" . ".env");

        if (isset($config["MONGO_USER"])) {
            $this->username = $config["MONGO_USER"];
        }
        if (isset($config["MONGO_PWD"])) {
            $this->password = $config["MONGO_PWD"];
        }

        if (isset($config["MONGO_PORT_WEB"])) {
            $this->port = $config["MONGO_PORT_WEB"];
        }

        if (isset($config["MONGODB_HOST"])) {
            $this->host = $config["MONGODB_HOST"];
        }

        if (isset($config["AUTH_SOURCE"])) {
            $this->authSource = $config["AUTH_SOURCE"];
        }

        $this->dbName = $config["MONGODB_NAME"];

    }

    public static function getInstance(): self
    {
        // verify if $_instance is null if null initi object
        if (is_null(self::$_instance)) {
            self::$_instance = new MongoDb();
        }
        // if not return return $_instance that allready existes
        return self::$_instance;
    }

    public function connexion()
    {
        try {
            if (is_null($this->client)) {

                $uri          = "mongodb://{$this->username}:{$this->password}@{$this->host}:{$this->port}/?authSource={$this->authSource}";
                $this->client = new Client($uri);
            }
            return $this->client;

        } catch (\Exception $e) {
            error_log("Erreur de connexion à MongoDB: " . $e->getMessage());
            throw new \Exception("Impossible de se connecter à la base de données MongoDB. Détails: " . $e->getMessage());
        }
    }

    public function getDbName(): string
    {
        return $this->dbName;
    }
}
