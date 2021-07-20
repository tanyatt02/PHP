<?php


use Phinx\Seed\AbstractSeed;

class NewShopSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $table = $this->table('products');
        $table->dropForeignKey('catalog_id')->save();
        
        $table = $this->table('basket');
        $table->dropForeignKey('product_id')->save();
        $table->dropForeignKey('user_id')->save();
        
        $table = $this->table('orders');
        $table->dropForeignKey('user_id')->save();
        
        $sql = 'TRUNCATE catalogs';
        $this->adapter->query($sql);
        
//        $sql = 'TRUNCATE orders';
//        $this->adapter->query($sql);
        
        $sql = 'TRUNCATE users';
        $this->adapter->query($sql);
        

//        $sql = 'TRUNCATE basket';
//        $this->adapter->query($sql);
        
        
        
        
        $sql = 'TRUNCATE products';
        $this->adapter->query($sql);
        
        
        

        
        $catalogs = [
            [
                'name' => 'Food'
            ],
            [
                'name' => 'Office'
            ],
            [
                'name' => 'Dress'
            ]
        ];
        $this->table('catalogs')->insert($catalogs)->save();
        
        

            
        $products = [
            [
                'name' => 'Tea',
                'description' => 'Ceylon',
                'price' => '20',
                'catalog_id' => '1'
            ],
            [
                'name' => 'Pizza',
                'description' => 'Margarita',
                'price' => '50',
                'catalog_id' => '1'
            ],
            [
                'name' => 'Pen',
                'description' => 'Black roller pen',
                'price' => '10',
                'catalog_id' => '2'
            ],
            [
                'name' => 'Dress',
                'description' => 'Ivanovo',
                'price' => '200',
                'catalog_id' => '3'
            ],
        ];
        $this->table('products')->insert($products)->save();

        $users = [
            [
                'name' => 'admin',
                'pass' => password_hash('123', PASSWORD_DEFAULT),
                'currentBasket' => '1234567890',
            ]
        ];

        $this->table('users')->insert($users)->save();


    }
}
