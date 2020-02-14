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
//====================================================================================================//

//USER ROUTE //
//Conection User//
$router->get('/Login', 'User#loginFrom');
$router->post('/Login', 'User#loginCheck');

//Deconection User//
$router->get('/Logout', 'User#logout');

//Profile de tout les utilisateurs afficher sur une page//
$router->get('/User/List', 'User#AllUser');

//Profile de 1 utilisateur//
$router->get('/User/Show/:ID_User','User#Show#ID_User');

//Suppression de 1 utilisateur//
$router->get('/User/Delete/:ID_User','User#DeleteUser#ID_User');

//Création d'utilisateur//
$router->get('/Register','User#registerFrom');
$router->post('/Register','User#registerAdd');

//Update Utilisateur//
$router->get('/User/Update/:ID_User', "User#updateUser#:ID_User");
$router->post('/User/Update/:ID_User', "User#updateUser#:ID_User");

//====================================================================================================//
//ANIMAL ROUTE//

//Création de pet//
$router->get('/Pet/Add','Pet#AddPetView');
$router->post('/Pet/Add','Pet#AddPet');

//Delete de Pet//
$router->get('Pet/Delete/:ID_Pet','Pet#DeleteOnePet#:ID_Pet');
//List pet//
$router->get('Pet/List/:ID_User','Pet#SqlGetAllPet#:ID_User');

//====================================================================================================//



echo $router->run();
