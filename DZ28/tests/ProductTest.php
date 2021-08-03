<?php


use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
   
    

        protected $product;





protected function setUp():void
{
$this->product = new Product ();
}

protected function tearDown():void
{
$this->product = NULL;
}
    
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
            $this->product->name = $name;
            $this->assertEquals($name, $this->product->name);
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
    
    public function testProductAll($name, $description, $price = null) {
          $this->product->name = $name;    
        $this->product->description = $description;
        $this->product->price = $price;
        
        $this->assertEquals([$name, $description, $price], [$this->product->name, $this->product->description, $this->product->price]);
        }
    
    public function testProductProps() {
            $this->assertIsArray($this->product->props);
        
            $this->assertArrayHasKey('name', $this->product->props);
            $this->assertArrayHasKey('isUpdate',  $this->product->props['name']);
            $this->assertFalse($this->product->props['name'] ['isUpdate']);
        
            $this->assertArrayHasKey('description', $this->product->props);
            $this->assertArrayHasKey('isUpdate',  $this->product->props['description']);
            $this->assertFalse($this->product->props['description'] ['isUpdate']);
        
            $this->assertArrayHasKey('price', $this->product->props);
            $this->assertArrayHasKey('isUpdate',  $this->product->props['price']);
            $this->assertFalse($this->product->props['price'] ['isUpdate']);
                    
        
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