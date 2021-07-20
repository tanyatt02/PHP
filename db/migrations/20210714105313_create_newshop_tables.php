<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNewshopTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('catalogs')
            ->addColumn('name', 'string', ['limit' => 100])
            ->create();
            
        
    
        $this->table('products')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('price', 'integer')
            ->addColumn('catalog_id','integer',['null' => true])
            
            ->addForeignKey('catalog_id', 'catalogs', 'id', array('delete'=>'SET_NULL', 'update'=>'CASCADE'))
            ->create();
        
        $this->table('users')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('pass', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('hash', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('currentBasket', 'string', ['limit' => 100])
            ->create();
  
        $this->table('basket')
            ->addColumn('user_id', 'integer',['null' => true])
            ->addColumn('product_id', 'integer')
            ->addColumn('currentBasket', 'string', ['limit' => 100])
            
            ->addForeignKey('product_id', 'products', 'id', array('delete'=>'CASCADE', 'update'=>'CASCADE'))
            ->addForeignKey('user_id', 'users', 'id', array('delete'=>'SET_NULL', 'update'=>'CASCADE'))
            ->addIndex(['currentBasket'])
            ->create();
        
        
        
        $this->table('orders')
            ->addColumn('user_id', 'integer',['null' => true])
            ->addColumn('tel',  'string', ['limit' => 10])
            ->addColumn('sum', 'integer')
            ->addColumn('currentBasket', 'string', ['limit' => 100])
            ->addColumn('statusOrder', 'enum', ['values' => ['new', 'paid', 'close']])
            ->addForeignKey('user_id', 'users', 'id', array('delete'=>'SET_NULL', 'update'=>'CASCADE'))
            ->create();
        
        

        
    }
}
