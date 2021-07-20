<?php


use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
   
    

        protected $fixture;


    
    public function providerProductName()
    {
        return [
            ["Чай"],
            ["Tea"],
            [""],
            [111],
            [null],
        ];
    }
    
    
    /** 
    * @dataProvider providerProductName 
    */    
    
    public function testProductName($name) {
            $product = new Product($name);
            $this->assertEquals($name, $product->name);
        }
    
     public function providerProductAll()
    {
        return [
            'russian' => ["Чай","Цейлонский",100],
            'engl, price is missed' => ["Tea","Ceylon", ],
            'empty strings' => ["","",""],
            'number values' => [111,111,111],
            'null & empty' => [null,"",1000],
        ];
    }
    
    
    /** 
    * @dataProvider providerProductAll 
    */    
    
    public function testProductAll($name, $description, $price) {
            $product = new Product($name, $description, $price);
            $this->assertEquals([$name, $description, $price], [$product->name, $product->description, $product->price]);
        }
    
    public function testProductProps() {
            $product = new Product();
            $this->assertIsArray($product->props);
        
            $this->assertArrayHasKey('name', $product->props);
            $this->assertArrayHasKey('isUpdate',  $product->props['name']);
            $this->assertFalse($product->props['name'] ['isUpdate']);
        
            $this->assertArrayHasKey('description', $product->props);
            $this->assertArrayHasKey('isUpdate',  $product->props['description']);
            $this->assertFalse($product->props['description'] ['isUpdate']);
        
            $this->assertArrayHasKey('price', $product->props);
            $this->assertArrayHasKey('isUpdate',  $product->props['price']);
            $this->assertFalse($product->props['price'] ['isUpdate']);
                    
        
        }
    
    public function testProductNameClass() {
        $nameClass = Product::class;
        $fileName = str_replace(['app\\', '\\'], [dirname(__DIR__) . '\\', '\\'], $nameClass) . ".php";
        $this->assertFileExists($fileName);
        
        $arr = explode('\\', $nameClass);
        $this->assertContains('app', $arr);
        $arr = explode('\\', $nameClass);
        $this->assertContains('models', $arr);
        $arr = explode('\\', $nameClass);
        $this->assertContains('entities', $arr);
        
    }
    
    }