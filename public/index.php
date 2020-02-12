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
//Profile de tout les utilisateurs afficher sur une page//
$router->get('/User/List', 'User#AllUser');
//Profile de 1 utilisateur//
$router->get('/User/Show/:ID_User','User#OneUser#:ID_User');
//Suppression de 1 utilisateur//
$router->get('/User/Delete/:ID_User','User#DeleteUser#:ID_User');
//Création d'utilisateur//
$router->get('/Register','User#registerFrom');
$router->post('/Register','User#registerAdd');


//ANIMAL ROUTE//
//Création de pet//
$router->get('/Pet/Add','Pet#AddPetView');
$router->post('/Pet/Add','Pet#AddPet');



echo $router->run();
