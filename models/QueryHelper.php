<?php


namespace app\models;




class QueryHelper
{
    
   public function existPredok($className, $id) {
        $obj = (new $className)->getOne($id);
        return ($obj) ? $obj->name : 'NULL';
    } 
    
    public function getStrJoin ($tableName, $keys = []){
        $strJoin = '';
        if (empty($keys)) {
            return '';
        }
        foreach($keys as $key){
            $tablePredok = str_replace('_id', 's', $key);
            $strJoin .=  " JOIN {$tablePredok} ON {$tableName}.{$key}={$tablePredok}.id ";
        };
        return $strJoin;
    }
    
    public function getStrWhere ($tableName, $where = []){
        if (empty($where)) {
            return '';
        }
        $strWhere='';
        $i = 0;
        foreach($where as $key => $value){
            $strWhere .=  " `{$key}`=:value{$i} AND ";
            $i++;
        };
        $strWhere = preg_replace('/ AND $/',' ', $strWhere);
        return $strWhere;
    }
    
    public function getParams ($tableName, $where = []){
        if (empty($where)) {
            return '';
        }
        $i = 0;
        $params = [];
        foreach($where as $key => $value){
            $params ["value{$i}"] = $value;
            $i++;
        };
        return $params;
    }
}