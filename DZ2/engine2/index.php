<?php

function renderTemplate($page, $menu = '', $content = '')
{
    ob_start();
    include 'templates/' . $page . ".php";
    return ob_get_clean();
}

$menu = renderTemplate('menu');

$content = renderTemplate('about');


echo renderTemplate('layouts/layout', $menu, $content);