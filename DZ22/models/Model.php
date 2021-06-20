<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;



abstract class Model implements IModel
{
    

    abstract protected function getTableName();

    


    public function getOne($id) {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";

        //return DB::getInstance()->queryOne($sql, ['id' => $id]);
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }
    public function getAll() {
        $sql = "SELECT * FROM {$this->getTableName()}";

        return DB::getInstance()->queryAll($sql);
    }

    public function insert() {

        
        $sql = "INSERT INTO {$this->getTableName()} VALUES (NULL";
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            $className = "app\\models\\" . ucfirst(str_replace('_id','',$key, $count));
            if ( $count <> 0){
                $obj = new $className;
                if(! $obj->getOne($value)){
                    $sql .= ", NULL";
                }else{$sql .= ", '{$value}'";}
            }else{
                $sql .= ", '{$value}'";
            };
            $params[$key] = $value;
        };
        $sql .= ")";
        echo "<br>SQL INSERT: ". $sql . "<br>";
        DB::getInstance()->execute($sql, $params);
        $this->id = DB::getInstance()->lastInsertId();
        

       return $this;
    }

    public function update() {

    }

    public function delete() {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";

        return DB::getInstance()->execute($sql, ['id' => $this->id]);
    }
    
    public function display(){
        foreach( $this->getAll() as $row) {  
            
            $str = '';
            foreach ($row as $key => $value){
                if ($key == 'id') {
                    $str = "{$value}";
                    continue;
                };
                $className = "app\\models\\" . ucfirst(str_replace('_id','',$key, $count));
                if ( $count <> 0 ){
                    $obj = new $className;
                    if(! $obj->getOne($value)){
                        $str .= ", NULL";
                    }else{$str .= ", {$obj->getOne($value)->name}";}
                }else{
                    $str .= ", {$value}";
                }
                
            }
            echo $str . '<br>';
        };
    }
    
    

    

}