<?php
namespace App\Repository;

use App\Db\MySql;

class Repository
{
    protected \PDO $pdo;
    public function __construct()
    {
        $mysql     = MySql::getInstance();
        $this->pdo = $mysql->getPDO();
    }

}
