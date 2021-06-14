<?php
namespace app\interfaces;

interface IModel
{
    public function getOne($id);
    public function getAll();
    public function insert($params);
    public function update();
    public function delete();

}

