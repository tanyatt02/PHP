<?php
/* 1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:
если $a и $b положительные, вывести их разность;
если $а и $b отрицательные, вывести их произведение;
если $а и $b разных знаков, вывести их сумму;
Ноль можно считать положительным числом.*/
$a = rand(-10, 10);
$b = rand (-10,10);

if ($a >= 0 && $b >= 0){
    echo "a = $a, b = $b - положительные, разность = ";
    echo $a - $b;
} elseif ($a < 0 && $b < 0){
    echo "a = $a, b = $b - отрицательные, произведение = ";
    echo $a * $b;
} else{
    echo "a = $a, b = $b - разных знаков, сумма = ";
    echo $a + $b;
    };
echo '<br>';

/* 2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15. При желании сделайте это задание через рекурсию.*/
$a = rand(0, 15);

switch($a){
    case 0:echo $a++.' ';
    case 1:echo $a++.' '.' ';
    case 2:echo $a++.' '.' ';
    case 3:    
        echo $a++.' ';
   
   
   
    case 4:
        echo $a++.' '; 
    case 5:
        echo $a++.' '; 
    case 6:
        echo $a++.' '; 
    case 7:
        echo $a++.' '; 
    case 8:
        echo $a++.' '; 
    case 9:
        echo $a++.' '; 
    case 10:
        echo $a++.' '; 
    case 11:
        echo $a++.' '; 
    case 12:
        echo $a++.' '; 
    case 13:
        echo $a++.' '; 
    case 14:
        echo $a++.' '; 
    case 15:
        echo $a++.' '; 
};
echo '<br>';

/* 3.  Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return. В делении проверьте деление на 0 и верните текст ошибки.*/

function add($a, $b){
    return $a + $b || $a - $b;
};

function subtract($a, $b){
    return $a - $b;
};

function multiply($a, $b){
    return $a * $b;
};

function divide($a, $b){
    if ($b <> 0)
    return $a / $b;
    else return 'Нельзя делить на 0!';
};

/* 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).*/
function calc($a, $b, $operation){
    /*switch ($operation){
        case '+': return add($a, $b);
        case '-': return subtract($a, $b);
        case '*': return multiply($a, $b);
        case '/': return divide($a, $b);
        default: return 'Недопустимые значение параметров';
    }*/
    $func = '';
    switch ($operation){
        case '+': $func = "add"; break;
        case '-': $func = "subtract"; break;
        case '*': $func = "multiply"; break;
        case '/': $func = "divide";
    };
    echo "$func <br>";
    if (function_exists($func))
        return $func($a, $b);
        else return 'Недопустимые значение параметров';
}

echo "calc(1, 1.5,'+') = " . calc(1, 1.5,'+') . '<br>';
echo "calc(1, 1.5,'-') = " . calc(1, 1.5,'-') . '<br>';
echo "calc(9, 1.5,'/') = " . calc(9, 1.5,'/') . '<br>';
echo "calc(10, 1.5,'*') = " . calc(10, 1.5,'*') . '<br>';
echo "calc(1, 0,'/') = " . calc(1, 0,'/') . '<br>';
echo "calc(1, 1.5,'()') = " . calc(1, 1.5,'()') . '<br>';

/* 6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.*/

function power ($val,int $pow){
    if ($val == 0 && $pow == 0) return 'Значение не определено';
    else if ($pow == 0) return 1;
    if ($val == 0 && $pow == 1) return 0;
    else if ($pow > 0) return ($val * power($val, $pow - 1));
    else return (1 / $val * power($val, $pow + 1));
};

echo '2 ^ 10 = ' . power (2,10) . '<br>';
echo '0 ^ 0 = ' . power (0,0) . '<br>';
echo '0 ^ 1 = ' . power (0,1) . '<br>';
echo '2 ^ -2 = ' . power (2, -2) . '<br>';

/* 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты */

function counter ( int $val, string $name, bool $neskl = false,//несклоняемое
                  bool $jr = true,//женский род 2 печи но 2 лося 
                  bool $beglGlasn = false//беглая гласная 1 день 2 дня
                 ): string {
    if ($neskl) return $val . ' '.$name;
    if (mb_substr_count ('бвгдзклмнпрстфхцч', mb_substr($name, -1)) >=1 && $beglGlasn == false) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.$name . 'ов';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.$name.'а';
    };
    if (mb_substr_count ('а', mb_substr($name, -1)) >=1) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_substr($name, 0, -1);
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'ы';
    };
    if (mb_substr_count ('я', mb_substr($name, -1)) >=1) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_substr($name, 0, -1).'ь';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'и';
    };
    if (mb_substr_count ('о', mb_substr($name, -1)) >= 1) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_substr($name, 0, -1);
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'а';
    };
    if (mb_substr_count ('е', mb_substr($name, -1)) >= 1) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.$name . 'й';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'я';
    };
    if (mb_substr_count ('жшщ', mb_substr($name, -1)) >= 1) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.$name . 'ей';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.$name.'а';
    };
    if (mb_substr_count ('ь', mb_substr($name, -1)) >= 1 && $jr && $beglGlasn == false) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_substr($name, 0, -1) . 'ей';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'и';
    };
    if (mb_substr_count ('ь', mb_substr($name, -1)) >= 1 && $jr == false && $beglGlasn == false) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_substr($name, 0, -1) . 'ей';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_substr($name, 0, -1).'я';
    };
    $l = mb_stripos( $name, 'е');
    if ($l) $l = mb_stripos( $name, 'о');
    if (mb_substr_count ('ь', mb_substr($name, -1)) >= 1 && $beglGlasn) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_strcut($name, 0, $l*2+2 ) . mb_strcut($name, 2 * $l +4, -1) . 'ей';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_strcut($name, 0, $l*2+2 ) . mb_strcut($name, 2 * $l +4, -1).'я';
    };
    $l = mb_stripos( $name, 'е');
    if ($l) $l = mb_stripos( $name, 'о');
    if (mb_substr_count ('бвгдзклмнпрстфхцч', mb_substr($name, -1)) >= 1 && $beglGlasn) {
        if ($val >= 5 && $val <= 20 || $val % 10 == 0 || $val % 10 >=5 && $val % 10 <= 9) return  $val . ' '.mb_strcut($name, 0, $l*2+2 ) . mb_strcut($name, 2 * $l +4) . 'ов';
        if ($val % 10 == 1) return  $val . ' '.$name;
        if ($val % 10 >= 2 && $val % 10 <= 4) return  $val . ' '.mb_strcut($name, 0, $l*2+2 ) . mb_strcut($name, 2 * $l +4).'а';
    };
    
};


echo counter(5,'час') . '<br>';
echo counter(11,'космонавт') . '<br>';
echo counter(101,'долматинец') . '<br>';
echo counter(22,'час') . '<br>';
echo counter(16,'минута') . '<br>';
echo counter(1,'минута') . '<br>';
echo counter(3,'минута') . '<br>';
echo counter(16,'неделя') . '<br>';
echo counter(3,'неделя') . '<br>';
echo counter(16,'яблоко') . '<br>';
echo counter(1,'облако') . '<br>';
echo counter(3,'озеро') . '<br>';
echo counter(16,'море') . '<br>';
echo counter(1,'море') . '<br>';
echo counter(3,'море') . '<br>';
echo counter(16,'еж') . '<br>';
echo counter(3,'ерш') . '<br>';
echo counter(16,'мера') . '<br>';
echo counter(3,'мера') . '<br>';
echo counter(3,'кофе', 1) . '<br>';
echo counter(3,'печь', 0, 1) . '<br>';
echo counter(3,'лось', 0, 0) . '<br>';
echo counter(5,'день', 0, 0, 1) . '<br>';
echo counter(32,'пень', 0, 0, 1) . '<br>';
echo counter(5,'лоб', 0, 0, 1) . '<br>';
echo counter(3,'рот', 0, 0, 1) . '<br><br>';

echo counter(date('H'), 'час') . ' ' . counter(date('m'), 'минута') . '<br>';
echo counter(0, 'час') . ' ' . counter(52, 'минута') . '<br>';

function find($start, $history, $target){
    if ($start == $target)
        echo "$target = $history;<br>";
    elseif ($start > $target) return null;
    else find($start + 5, "($history + 5)", $target) || find($start * 3, "$history * 3", $target);
    //return NULL;
}

find (1,'1',48);