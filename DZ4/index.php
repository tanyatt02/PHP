<?php

class DB
{
    public $dbConnection;
    public $dbRecord;
    public $dbQueryBuilder;
}

trait Singleton
{
    private static $instance = null;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    /**
     * @return static
     */
    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new self();
            echo "DBconnection is OK .";
        }else{
            echo'! only one DBconnection .';
        }
        static $count = 0;
        $count++;
        echo "Счетчик обращений: {$count}<br>";
        return static::$instance;
    }
}


abstract class DBConnection
{
    
}




class MySQL_DBConnection extends DBConnection
{
    use Singleton;
}



class PostreSQL_DBConnection extends DBConnection
{
    use Singleton;
}

class OracleSQL_DBConnection extends DBConnection
{
    use Singleton;
}


//class OracleSQL_DBConnection extends DBConnection ------------- это без использования Одиночки
//{
//    public function __construct()
//    {
//        static $count = 0;
//        $count++;
//        echo "OracleSQL connection is OK  {$count}<br>";
//        return MySQL_DBConnection::getInstance();
//    }
//}

abstract class DBRecord
{
    
}

class MySQL_DBRecord extends DBRecord
{
    public function __construct()
    {
        echo 'MySQL record table is OK<br>';
    }
}

class PostreSQL_DBRecord extends DBRecord
{
    public function __construct()
    {
        echo 'PostreSQL record table is OK<br>';
    }
}

class OracleSQL_DBRecord extends DBRecord
{
    public function __construct()
    {
        echo 'OracleSQL record table is OK<br>';
    }
}

abstract class DBQueryBuilder
{
    abstract public function __construct();
}

class MySQL_DBQueryBuilder extends DBQueryBuilder
{
    public function __construct()
    {
        echo 'MySQL SELECT * FROM users;<br>';
    }
}

class PostreSQL_DBQueryBuilder extends DBQueryBuilder
{
    public function __construct()
    {
        echo 'PostreSQL SELECT * FROM users;<br>';
    }
}

class OracleSQL_DBQueryBuilder extends DBQueryBuilder
{
    public function __construct()
    {
        echo 'OracleSQL SELECT * FROM users;<br>';
    }
}



interface CRM_Factory
{
    public function createDBConnecion();

    public function createDBRecord();

    public function createDBQueryBuilder();
}


class MySQL_Factory implements CRM_Factory
{

    public function createDBConnecion() : DBConnection
    {
        return MySQL_DBConnection::getInstance();
    }

    public function createDBRecord() : DBRecord
    {
        return new MySQL_DBRecord();
    }

    public function createDBQueryBuilder() : DBQueryBuilder
    {
        return new MySQL_DBQueryBuilder();
    }
}

class PostreSQL_Factory implements CRM_Factory
{

    public function createDBConnecion() : DBConnection
    {
        return PostreSQL_DBConnection::getInstance();
    }

    public function createDBRecord() : DBRecord
    {
        return new PostreSQL_DBRecord();
    }

    public function createDBQueryBuilder() : DBQueryBuilder
    {
        return new PostreSQL_DBQueryBuilder();
    }
}

class OracleSQL_Factory implements CRM_Factory
{

    public function createDBConnecion() : DBConnection
    {
        return OracleSQL_DBConnection::getInstance();
    }

    public function createDBRecord() : DBRecord
    {
        return new OracleSQL_DBRecord();
    }

    public function createDBQueryBuilder() : DBQueryBuilder
    {
        return new OracleSQL_DBQueryBuilder();
    }
}




class CRM
{
    public function createCRM(CRM_Factory $crmFactory):DB
    {
        $db = new DB;
        
        $db->dbConnection = $crmFactory->createDBConnecion();
        $db->dbQueryBuilder = $crmFactory->createDBQueryBuilder();
        $db->dbRecord = $crmFactory->createDBRecord();
        
        return $db;
        
    }

    
}

$mysql = (new CRM())->createCRM(new MySQL_Factory);
var_dump($mysql);
echo '<br><br>';

$postresql = (new CRM())->createCRM(new PostreSQL_Factory);
var_dump($postresql);
echo '<br><br>';

$oraclesql = (new CRM())->createCRM(new OracleSQL_Factory);
var_dump($oraclesql);
echo '<br><br>';

$mysql = (new CRM())->createCRM(new MySQL_Factory);
var_dump($mysql);
echo '<br><br>';

$postresql = (new CRM())->createCRM(new PostreSQL_Factory);
var_dump($postresql);
echo '<br><br>';

$oraclesql = (new CRM())->createCRM(new OracleSQL_Factory);
var_dump($oraclesql);
echo '<br><br>';


