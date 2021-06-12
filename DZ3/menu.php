<?php
   $menu_array = [
    [
        "title" => "Главная",
        "href" => "/",
    ],
    [
        "title" => "Каталог",
        "href" => "/?page=catalog",
        "subitems" => [
            [
            "name" => "pizza",
            "href" => "/?page=catalog",
            "title" => "Пицца",
            "subitems" => [
                    [
                "name" => "pizza_thin",
                "title" => "Пицца на тонком тесте",
                "href" => "/?page=catalog"
                    ],
                    [
                "name" => "pizza_thick",
                "title" => "Пицца на толстом тесте",
                "href" => "/?page=catalog",
                    ]
                ]
            ],
        
        [
            "name" => "pizza",
            "href" => "/?page=catalog",
            "title" => "tea",
            "subitems" => [
                    [
                "name" => "tea_green",
                "title" => "Зеленый чай",
                "href" => "/?page=catalog"
                    ],
                    [
                "name" => "tea_black",
                "title" => "Черный чай",
                "href" => "/?page=catalog",
                    ]
                ]
        ]
    ]
],
    [
            "title" => "Для вас",
            "href" => "/?page=about"
    ]
    
   
];

    function getMenu($menu_array, $d1)// глубина вывода меню, чтобы использвать на разных страницах
{static $i = 1;
    $output = "<ul>";
    foreach ($menu_array as $item) { 
        
        if ($i <= $d1) {
            
            $output .= "<li><a href='{$item['href']}'>{$item['title']}</a>";
        
        if (array_key_exists("subitems", $item)) { 
            $i++;
            $output .= getMenu($item["subitems"], $d1);
            $i--;
        }
        $output .= "</li>";}
    }
    $output .= "</ul>";
    return $output;
}

echo getMenu($menu_array, 255);
echo "<br>";

echo getMenu($menu_array, 2);
echo "<br>";

echo getMenu($menu_array, 1);
echo "<br>";





