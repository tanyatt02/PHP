<?php

function renderTemplate($page, $menu = '', $content = '', $login='',    $auth = '')
{
    ob_start();
    include 'templates/' . $page . ".php";
    return ob_get_clean();
}

$login = "admin";
$password = "123";
/*if ($login == "admin" && $password == "123"){
    $auth = renderTemplate('welcome', '', '', $login);
} else {
    $auth = renderTemplate('auth');
};*/
$auth = ($login == "admin" && $password == "123") ? renderTemplate('welcome', '', '', $login) : $auth = renderTemplate('auth');

$menu = renderTemplate('menu');

$content = renderTemplate('about');


echo renderTemplate('layouts/layout', $menu, $content, '', $auth);