<?php

/*1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п. или любой другой области. Опишите свойства и методы, придумайте наследника, расширяющего функционал родителя. Приведите пример использования. ВАЖНОЕ.
rpg добавлена Ведьма, при нападении на которую Воин сходит с ума и начинает ранить сам себя, и смерть персонажей*/

class Human
{
    private $name;
    protected $age;
    private $health;
    protected $mind;
    

    public static $count = 0;
    
    public function __construct($name = '', $age = 0, $health = 100, $mind = 1)
    {
        echo("Я родился! " . self::class . ' нас:' . ++self::$count . "<br>");
        $this->name = $name;
        $this->age = $age;
        $this->health = $health;
        $this->mind = $mind;
    }
    
    public function setHealth($health){
        if ($health > 0) {
            $this->health = $health;
        } else {
            $this->death();
        }
    }
    
    public function getHealth(){
        return $this->health;
    }

    public function getName(){
        return $this->name;
    }

    public function sayName()
    {
        echo "Меня зовут " . $this->name . "<br>";

    }
    
    public function death (){
        $this->health = 0.5;
        echo("Я " . $this->name . " умер " . self::class . ' нас:' . --self::$count . "<br>");
    }
    
    public function isMad (){
        return $this->mind == 0;
    }
    
    public function isAlive (){
        return $this->health > 1;
    }
    
    public function hurt ($damage){
        $this->setHealth($this->getHealth()-$damage);
    }

}

class Warrior extends Human {

    public $attack;

    public function __construct($attack = 0, $name = '', $age = 0, $health = 100 )
    {
        parent::__construct($name, $age, $health);
        $this->attack = $attack;
    }

    public function sayName()
    {
        parent::sayName();
        echo " и я Воин<br>";

    }

    public function attack(Human $target) {
        if ($this->isMad()){
            if ($this->isAlive()){
                echo "Сумасшедший Воин ранил себя  на {$this->attack} урона.<br>";
                $this->hurt($this->attack);
                
                
            }
        } else {
            if (get_class($target) == 'Witch'){
                $this->hurt($this->attack);
                
                $this->mind = 0;
                echo "Воин огреб урон  на {$this->attack} урона и сошел с ума.<br>";
            } else {
                if ($target->isAlive()){
                    echo "Воин наносит урон {$target->getName()} на {$this->attack} урона.<br>";
                    $target->hurt($this->attack);
                
                }
            }
        }
    }
}

class Witch extends Human {

    

    public function __construct($name = '', $age = 0, $health = 100)
    {
        parent::__construct($name, $age, $health);
       
    }

    public function sayName()
    {
        parent::sayName();
        echo " и я Ведьма<br>";

    }

    
}



$human1 = new Human("Грут", 233, 100);
$human1->sayName();

$warrior1 = new Warrior(20,"Конан", 22, 100);
$warrior1->sayName();
echo $warrior1->isMad() . "<br>";

$warrior1->attack($human1);
$warrior1->attack($human1);
$warrior1->attack($human1);
$warrior1->attack($human1);
$warrior1->attack($human1); 
$warrior1->attack($human1); 
$warrior1->attack($human1); 

$witch1 = new Witch("Cat", 55, 100);
$witch1->sayName();

$warrior1->attack($witch1);
$warrior1->attack($witch1);
$warrior1->attack($witch1);
$warrior1->attack($witch1);
$warrior1->attack($witch1);
$warrior1->attack($witch1);
$warrior1->attack($witch1);


/*2. Добавьте метод andWhere в класс Db, который обеспечит реализацию цепочеки:
echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->get();
что должно вывести SELECT * FROM product WHERE name = Alex AND session = 123 AND id = 5*/

class Db {
    protected $tableName;
    protected $wheres = [];


    public function table($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->tableName}";
        if (!empty($this->wheres)) {
            $sql .= " WHERE ";
            foreach ($this->wheres as $value) {
                $sql .= $value['field'] . " = '" . $value['value'] . "'";
                if ($value != end($this->wheres)) $sql .= " AND ";
            }
            $this->wheres = [];
        }


        return $sql . '<br>';
    }

    public function getOne($id) {
        return "SELECT * FROM {$this->tableName} WHERE id = '{$id}'" . '<br>';
    }

    public function where($field, $value) {
        $this->wheres[] = [
            'field' => $field,
            'value' => $value
        ];
        return $this;
    }

    public function andwhere($field, $value) {
        $this->where($field, $value);
        return $this;
    }
}

$db = new Db();
echo $db->table('goods')->getAll();
echo $db->table('goods')->getOne(1);
echo $db->table('user')->where('name', 'admin')->getAll();
echo $db->table('users')->where('login', 'admin')->where('pass', 123)->getAll();
echo $db->table('goods')->where('name', 'чай')->andwhere('price', 12)->getAll();
echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->getAll();

/*3.class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo(); 
выводится 1234, т.к. переменная $x принадлежит классу, а не объекту
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo();
выводится 1122, т.к. у каждого класса своя static переменная

5.class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo(); 
$b1->foo(); 
$a1->foo(); 
$b1->foo(); 
выводится 1122, т.к. у каждого класса своя static переменная*/


