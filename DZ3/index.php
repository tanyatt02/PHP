<?php
// С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.
$i = 0;
$n = 100;
while ($i <=100){
    if ($i % 3 == 0 && ($i + 3) <= 100) {
        echo "{$i}, ";
    }
    elseif ($i % 3 == 0 && ($i + 3) > 100){
        echo "{$i} ";
    }
    $i++;
};

echo " <br>";// если здесь убрать точку(любой символ кроме пробела годится), программа вывод 1-ого задания перенесет в конец - КАК ТАК???

/*     2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так: 
0 – это ноль.
1 – нечётное число.
2 – чётное число.
3 – нечётное число.
…
10 – чётное число.*/

$i = 0;
do {
    if ($i % 2 == 1) echo "{$i} - нечётное число.<br>";
    elseif ($i == 0) echo "{$i} - это ноль.<br>";
    else echo "{$i} - чётное число.<br>";
    $i++;
} while ($i <= 10);
echo "<br>";
/*     3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области.
Вывести в цикле значения массива, чтобы результат был таким:
Московская область:
Москва, Зеленоград, Клин.
Ленинградская область:
Санкт-Петербург, Всеволожск, Павловск, Кронштадт.
Рязанская область*/

$cities = [
    "Московская область" => [
        "Москва", "Зеленоград", "Клин", "Ковров"
    ],
    "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"
    ],
    "Курская область" => ["Курск"]
];

foreach ($cities as $key => $value) {
    echo "{$key}:<br>";
    $str = implode(",",$value);
    echo "{$str}.<br>";
}
echo "<br>";
/* 8 Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».*/


function kFirst($cityName)
{return (mb_substr($cityName,0,1) == "К");
   }

foreach ($cities as $key => $value) {
    echo "{$key}:<br>";
    $str = implode(",",array_filter($value, 'kFirst'));
    echo "{$str}.<br>";
}

/*    4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
9. Написать функцию транслитерации строк, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах). */



$str = "Татьяна сварила Щи для Михаила";

$arrStr = preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);


function translit ($ch){
    $alfabet = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
		];
    if ($ch == " ") return "_";
    
    if (!( array_key_exists($ch, $alfabet)) && ! (array_key_exists(mb_strtolower($ch), $alfabet))) return null;
    // не знаю, нужна ли эта проверка? А вдруг управляющие символы подсунут
    if (mb_strtoupper($ch) == $ch) 
        return mb_convert_case(mb_strtoupper($alfabet[mb_strtolower($ch)]), MB_CASE_TITLE, 'UTF-8'); 
     else    
        return $alfabet[$ch];
}

    $str = implode("",array_map('translit', $arrStr));
    echo "{$str}<br>";


/*     7. *Вывести с помощью цикла for числа от 0 до 9, НЕ используя тело цикла. */

for ($i = 0; $i <= 9;print $i++." ");

