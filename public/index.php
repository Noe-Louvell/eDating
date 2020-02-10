<?php

session_start();
require '../vendor/autoload.php';

function chargerClasse($classe){
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__."{$ds}.."; //Remonte d'un cran par rapport à index.php
    $classeName = str_replace('\\', $ds,$classe);

    $file = "{$dir}{$ds}{$classeName}.php";
    if(is_readable($file)){
        require_once $file;
    }
}

spl_autoload_register('chargerClasse');

$router = new \src\Router\Router($_GET['url']);
$router->get('/Utilisateur/List', 'Utilisateur#AllUtilisateur');
$router->get('/Utilisateur/Show/:ID_Utilisateur','Utilisateur#OneUtilisateur#:ID_Utilisateur');
$router->get('/Utilisateur/Delete/:ID_Utilisateur','Utilisateur#Delete#:ID_Utilisateur');


echo $router->run();
