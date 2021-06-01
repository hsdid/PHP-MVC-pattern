<?php
namespace app\core;

/**
 * Class Database
 * @package app\core
 */
class Database
{
    /**
     * @var \PDO
     */
    public \PDO $pdo;

    /**
     * Database constructor.
     * @param array $dbConfig
     */
    public function __construct(array $dbConfig)
    {
        $dsn       = $dbConfig['dsn']      ?? '';
        $user      = $dbConfig['user']     ?? '';
        $password  = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
    }
}
