<?php
namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct(array $dbConfig)
    {
        $dsn       = $dbConfig['dsn']      ?? '';
        $user      = $dbConfig['user']     ?? '';
        $password  = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
    }
}
