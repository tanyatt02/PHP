<?php


namespace app\models;


use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();
    
    public  function getLimit($limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);

    }
    
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        //return DB::getInstance()->queryOne($sql, ['id' => $id]);
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }
    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return DB::getInstance()->queryAll($sql);
    }

    public function getOneWhere($column, $value){
        $tableName = $this->getTableName();
        $params[$column] = $value;
        $sql = "SELECT * FROM {$tableName} WHERE {$column} = :{$column}";
        return DB::getInstance()->queryOneObject($sql, $params, $this->getEntityClass());
    }
    
    public  function getCountWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }
    
    //достаточно специфический запрос, не знаю, стоит ли его обобщать
    public  function getSumWhere($value) {
        $tableName = $this->getTableName();
        $sql = "SELECT sum(price) as sum FROM {$tableName} as b JOIN products as p ON b.product_id = p.id WHERE b.user_id=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['sum'];
    }

    
    public function existPredok($className, $id) {
        $obj = (new $className)->getOne($id);
        return ($obj) ? $obj->name : 'NULL';
    }
    
    public function insert(Model $entity) {
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} VALUES (NULL";
        $params = [];
        foreach ($entity->props as $key => $value) {
            $params[$key] = $entity->$key;
            $sql .= ", :{$key}";
        };
        $sql .= ")";
        
            DB::getInstance()->execute($sql, $params);
       
            $this->id = DB::getInstance()->lastInsertId();
       
       return $this;
    }

    public function update(Model $entity) {
        $params = [];
        $tableName = $this->getTableName();
        $sql = "UPDATE {$tableName} SET ";
        foreach ($entity->props as $key => $value){
            if ($value  ['isUpdate']){
                $params[$key] = $entity->$key;

                $sql .= "{$key} = :{$key}, ";
 
            }
        };
        $sql = str_replace(', *', '', $sql . '*')." WHERE id=:id";
        $params['id'] = $entity->id;
        if (count($params) > 1){
            DB::getInstance()->execute($sql, $params);
        }else{
           // echo "Некорректный запрос UPDATE  ". '<br>' ; 
            
        };
        
        foreach ($entity->props as $key => $value){
            
            if ($value  ['isUpdate']){
                
                $value[$key] ['isUpdate'] = false;
            }
        };
    }


    
    public function delete(Model $entity) {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";

        return DB::getInstance()->execute($sql, ['id' => $entity->id]);
    }
    
    
    public function  display(){
        $className = $this->getEntityClass();
        $th = new $className;//чтобы display не портила объект класса, из которго мы его вызываем
        foreach( $this->getAll() as $row) {  
            
            $str = '';
            foreach ($row as $key => $value){
                if ($key == 'id') {
                    $str = "{$value}";
                    continue;
                };
                if ($key == 'props') {
                    continue;
                };
                $className = "app\\models\\entities\\" . ucfirst(str_replace('_id','',$key, $count));
                if ( $count <> 0 ){
                    $str .= ", {$this->existPredok($className, $value)}";
                    
                }else{
                    $str .= ", {$value}";
                }

                
            }
            echo  $str . '<br>';
        };
        echo  '<br>';
    }
    
    public function save(Model $entity) {
        if (is_null($entity->id)) {
             $this->insert($entity);
        } else {
            $this->update($entity);
        };
        
    }
    
    

}