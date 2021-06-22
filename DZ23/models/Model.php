<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;



abstract class Model implements IModel
{
    

    abstract protected function getTableName();

    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->props [$name]['isUpdate'] = true;
        return $this;
    }

    public function __get($name)
    {
        return $this->$name;
    }
    



    public function getOne($id) {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";

        //return DB::getInstance()->queryOne($sql, ['id' => $id]);
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }
    public function getAll() {
        $sql = "SELECT * FROM {$this->getTableName()}";

        return DB::getInstance()->queryAll($sql);
    }

    public function existPredok($className, $id) {
        $obj = (new $className)->getOne($id);
        return ($obj) ? $obj->name : 'NULL';
    }
    
    public function insert() {

        $badInsert = false;
        $sql = "INSERT INTO {$this->getTableName()} VALUES (NULL";
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == 'id') continue;
            if ($key == 'props') continue;
            $badInsert = $this->fillParams($key, $params, $value);
            if ($badInsert) break;

            $sql .= ", :{$key}";
        };
        $sql .= ")";

        if ($badInsert){
            //echo 'Некорректный запрос INSERT'.'<br>';
        }else{
            DB::getInstance()->execute($sql, $params);
            $this->id = DB::getInstance()->lastInsertId();
        };

       return $this;
    }

    public function update() {
        $badUpdate = false;
        $params = [];
        $sql = "UPDATE {$this->getTableName()} SET ";
        foreach ($this as $key => $value){
            if ($key == 'id') continue; 
            if ($key == 'props') continue; 
            if ($this->props[$key]['isUpdate']){
                $badUpdate = $this->fillParams($key, $params, $value);
                if ($badUpdate) break;

                $sql .= "{$key} = :{$key}, ";
                $this->props[$key]['isUpdate'] = false;
            }
        };
        $sql = str_replace(', *', '', $sql . '*')." WHERE id=:id";
        $params['id'] = $this->id;
        if (count($params) > 1 && ! $badUpdate){
            DB::getInstance()->execute($sql, $params);
        }else{
           // echo "Некорректный запрос UPDATE  ". '<br>' ; 
            
        };

    }

    protected function fillParams($key, &$params, $value):bool {
        $badQuery = false;
        $className = "app\\models\\" . ucfirst(str_replace('_id','',$key, $count));
        if ( $count <> 0){
            if($this->existPredok($className, $value) <> 'NULL'){
                $params[$key] = $value;
            }else{
                if ($this->props[$key]['mbNull']){
                    $params[$key] = NULL;
                }else{
                    $badQuery = true; 
                }
            }
                }else{
                    $params[$key] = $value;
                };
        return $badQuery;
    }
    
    public function delete() {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";

        return DB::getInstance()->execute($sql, ['id' => $this->id]);
    }
    
    public function  display(){
        $className = get_called_class();
        $th = new $className;//чтобы display не портила объект класса, из которго мы его вызываем
        foreach( $th->getAll() as $row) {  
            
            $str = '';
            foreach ($row as $key => $value){
                if ($key == 'id') {
                    $str = "{$value}";
                    continue;
                };
                if ($key == 'props') {
                    continue;
                };
                $className = "app\\models\\" . ucfirst(str_replace('_id','',$key, $count));
                if ( $count <> 0 ){
                    $str .= ", {$th->existPredok($className, $value)}";
                    
                }else{
                    $str .= ", {$value}";
                }

                
            }
            echo  $str . '<br>';
        };
        echo  '<br>';
    }
    
    public function save() {
        if (is_null($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }
    
    public static function newBase(){
        $sql = "DROP DATABASE IF EXISTS newshop;
CREATE DATABASE newshop;
USE newshop;

DROP TABLE IF EXISTS catalogs;
CREATE TABLE catalogs(
	id SERIAL PRIMARY KEY,
    name VARCHAR(100)
    
    );
    
INSERT INTO catalogs VALUES(NULL, 'Food'),(NULL, 'Office'),(NULL, 'Dress');

DROP TABLE IF EXISTS products;
CREATE TABLE products(
	id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255),
    price INT,
    catalog_id BIGINT UNSIGNED,
    
    FOREIGN KEY (catalog_id) REFERENCES catalogs(id) ON UPDATE CASCADE ON DELETE SET NULL);
    
INSERT INTO products VALUES(NULL, 'Tea', 'Ceylon',20, 1),(NULL, 'Pizza', 'Margarita',50, 1),(NULL, 'Pen', 'Blue pen',10, 2),(NULL, 'Pen', 'Black roller pen',15, 2);
INSERT INTO products VALUES(NULL, 'TeaGreen', 'China',20, NULL);

DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    pass VARCHAR(100)
    
    );
    
DROP TABLE IF EXISTS basket;
CREATE TABLE basket(
	id SERIAL PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    product_id BIGINT UNSIGNED,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON UPDATE CASCADE ON DELETE CASCADE
    );
    
"; 
        return DB::getInstance()->execute($sql, []);
    }

    

}