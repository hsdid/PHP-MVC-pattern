<?php 
namespace app\core;
//odstępy
// ta klasa imo nie robi nic konkretnego, jeżęli już by byla to powinna być abstrakcyjna i modele ją dziedizczyć by mieć dostęp do obiektu pdo
class Database 
{

    public \PDO $pdo;

    public function __construct(array $dbConfig)
    {
        $dsn       = $dbConfig['dsn']      ?? '';
        $user      = $dbConfig['user']     ?? '';
        $password  = $dbConfig['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // when problem with connection trow expection

    }



}