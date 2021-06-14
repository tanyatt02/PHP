<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;

abstract class Model implements IModel
{
    protected $db;

    abstract protected function getTableName();

    public function __construct(Db $db)
    {
        $this->db = $db;
    }


    public function getOne($id) {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = {$id}";

        echo $this->db->queryOne($sql);
    }
    public function getAll() {
        $sql = "SELECT * FROM {$this->getTableName()}";

        echo $this->db->queryAll($sql);
    }

    public function insert($params) {
        $sql = 'NULL';
        foreach ($params as $param) {
            $sql .= ", '{$param}'";
        }
        $sql = "INSERT INTO {$this->getTableName()} VALUES ({$sql})";
        return $sql;

    }

    public function update() {

    }

    public function delete() {

    }
    
    public function foo(IModel $model) {
    $model->getAll();
}

}