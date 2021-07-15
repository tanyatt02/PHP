<?php


namespace app\models;


use app\engine\{App, Db};

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();
    
    public function __construct()
    {
        
        $this->query = new QueryHelper();
    }
    
    
    public  function getLimit($limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return App::call()->db->queryLimit($sql, $limit);

    }
    
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";

        return App::call()->db->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
        
        
    }
    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function getOneWhere($column, $value){
        $tableName = $this->getTableName();
        $params[$column] = $value;
        $sql = "SELECT * FROM {$tableName} WHERE {$column} = :{$column}";
        return App::call()->db->queryOneObject($sql, $params, $this->getEntityClass());
    }
    
    public function getJoin($columns = [], $keys = []){
        $tableName = $this->getTableName();
        $strColumns = implode(',', $columns);

        $strJoin = $this->query->getStrJoin($tableName, $keys);
        $params = [];
        
    
        $sql = "SELECT {$strColumns} FROM {$tableName} {$strJoin}";
        return App::call()->db->queryAll($sql, $params);
    }
    
    public function getJoinWhere($columns = [], $keys = [], $where = []){
        $tableName = $this->getTableName();
        $strColumns = implode(',', $columns);

        $strJoin = $this->query->getStrJoin($tableName, $keys);
  
        $strWhere = $this->query->getStrWhere($tableName, $where);
        $params = $this->query->getParams($tableName, $where);
        
        $sql = "SELECT {$strColumns} FROM {$tableName} {$strJoin} WHERE {$strWhere}";
        return App::call()->db->queryAll($sql, $params);
    }
    
    public  function getCountWhere($keys = [], $where = [])
    
    {
        $tableName = $this->getTableName();

        $strJoin = $this->query->getStrJoin($tableName, $keys);
 
        $strWhere = $this->query->getStrWhere($tableName, $where);
        $params = $this->query->getParams($tableName, $where);
        
        $sql = "SELECT count({$tableName}.id) as count FROM {$tableName} {$strJoin} WHERE {$strWhere}";
        return App::call()->db->queryOne($sql, $params)['count'];
    }
    
        
        

    
  
    public  function getSumWhere($keys = [], $where = []) {

         $tableName = $this->getTableName();

        $strJoin = $this->query->getStrJoin($tableName, $keys);

        $strWhere = $this->query->getStrWhere($tableName, $where);
        $params = $this->query->getParams($tableName, $where);
        
        $sql = "SELECT sum(price) as sum FROM {$tableName} {$strJoin} WHERE {$strWhere}";
        return App::call()->db->queryOne($sql, $params)['sum'];
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
        
            App::call()->db->execute($sql, $params);
       
            $this->id = App::call()->db->lastInsertId();
       
       //return $this;
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
            App::call()->db->execute($sql, $params);
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

        return App::call()->db->execute($sql, ['id' => $entity->id]);
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
                    $str .= ", {$this->query->existPredok($className, $value)}";
                    
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