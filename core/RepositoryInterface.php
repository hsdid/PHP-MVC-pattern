<?php
namespace app\core;
/**
 * Interface RepositoryInterface
 * @package app\core
 */
interface RepositoryInterface
{
    public function findOne($field, $data);
    public function findAll();
    public function create($object);
    public function remove($object);
}
