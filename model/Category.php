<?php 

namespace app\model;

class Category 
{
    private $id;
    private $name;
    // modele nie mają nic wspólnego z bazą danych. Chyba, że miał to być ActiveRecord.. ale na to nie wygląda
    public static $tableName = 'category';

    
    public function getId (): int
    {
        return $this->id;
    }
    public function setId (int $id) 
    {
        $this->id = $id;
    }
    public function getName (): string  
    {
        return $this->name;
    }
    public function setName (string $name) 
    {
        $this->name = $name;
    }

}