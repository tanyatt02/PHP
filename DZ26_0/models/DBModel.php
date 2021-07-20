<?php


namespace app\models;


use app\engine\Db;

abstract class DBModel extends Model
{
    abstract protected static function getTableName();

    public static function getLimit($limit) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit);

    }
    
    static function getOne($id) {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        //return DB::getInstance()->queryOne($sql, ['id' => $id]);
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }
    static function getAll() {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return DB::getInstance()->queryAll($sql);
    }

    static function getOneWhere($column, $value){
        $tableName = static::getTableName();
        $params[$column] = $value;
        $sql = "SELECT * FROM {$tableName} WHERE {$column} = :{$column}";
        return DB::getInstance()->queryOneObject($sql, $params, get_called_class());
    }
    
    public static function getCountWhere($name, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }
    
    //достаточно специфический запрос, не знаю, стоит ли его обобщать
    public static function getSumWhere($name, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT sum(price) as sum FROM {$tableName} as b JOIN products as p ON b.product_id = p.id WHERE b.user_id=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['sum'];
    }

    
    public function existPredok($className, $id) {
        $obj = (new $className)->getOne($id);
        return ($obj) ? $obj->name : 'NULL';
    }
    
    public function insert() {
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} VALUES (NULL";
        $params = [];
        foreach ($this->props as $key => $value) {
            $params[$key] = $this->$key;
            $sql .= ", :{$key}";
        };
        $sql .= ")";
        
            DB::getInstance()->execute($sql, $params);
       
            $this->id = DB::getInstance()->lastInsertId();
       
       return $this;
    }

    public function update() {
        $params = [];
        $tableName = static::getTableName();
        $sql = "UPDATE {$tableName} SET ";
        foreach ($this->props as $key => $value){
            if ($value  ['isUpdate']){
                $params[$key] = $this->$key;

                $sql .= "{$key} = :{$key}, ";
 
            }
        };
        $sql = str_replace(', *', '', $sql . '*')." WHERE id=:id";
        $params['id'] = $this->id;
        if (count($params) > 1){
            DB::getInstance()->execute($sql, $params);
        }else{
           // echo "Некорректный запрос UPDATE  ". '<br>' ; 
            
        };
        
        foreach ($this->props as $key => $value){
            
            if ($value  ['isUpdate']){
                
                $value[$key] ['isUpdate'] = false;
            }
        };
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
        };
        
    }
    
    

}