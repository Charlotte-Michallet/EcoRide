<?php
namespace App\Repository\Admin;

use App\Db\MongoDb;
use MongoDB\Client;

class MongoRepository
{
    protected string $collectionName;
    protected string $dbName;
    protected Client $client;

    public function __construct()
    {
        $mongo        = MongoDb::getInstance();
        $this->client = $mongo->connexion();
        $this->dbName = $mongo->getDbName();

    }

    protected function getCollection(string $collectionName)
    {
        return $this->client
            ->selectDatabase($this->dbName)
            ->selectCollection($collectionName);
    }

}
