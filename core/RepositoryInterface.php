<?php
namespace app\core;

interface RepositoryInterface
{
    public function findOne($field, $data);
    public function findAll();
    public function create($object);
    public function remove($object);
}
