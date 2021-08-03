<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('/');
$twig = new \Twig\Environment($loader);

echo $twig->render('template.twig', ['name' => 'Fabien']);