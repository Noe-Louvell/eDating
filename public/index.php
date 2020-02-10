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
$router->get('/', "Article#ListAllArticle");
$router->get('/Article', "Article#ListAllArticle");
$router->get('/Article/Update/:id', "Article#Update#id");
$router->post('/Article/Update/:id', "Article#Update#id");
$router->get('/Article/Add', "Article#Add");
$router->post('/Article/Add', "Article#Add");
$router->get('/Article/Delete/:id', "Article#Delete#id");
$router->get('/Article/Fixtures', "Article#Fixtures");
$router->get('/Article/Write', "Article#Write");
$router->get('/Article/Read', "Article#Read");
$router->get('/Article/WriteOne/:id', "Article#Read#id");
$router->get('/Api/Article', "Api#ArticleGet");
$router->post('/Api/Article', "Api#ArticlePost");
$router->put('/Api/Article/:id/:json', "Api#ArticlePut#id#json");
$router->get('/Article/ListAllArticle','Article#ListAllArticle');
$router->get('/Api/Article/Last','Api#ArticleGetLast');

$router->get('/coucou/di/:param1/:param2','Article#test#param1#param2');
$router->get('/Contact', 'Contact#showForm');
$router->post('/Contact/sendMail', 'Contact#sendMail');
$router->get('/Login', 'User#loginForm');
$router->post('/Login', 'User#loginCheck');
$router->get('/Logout', 'User#logout');
$router->get('/Register','User#registerFrom');
$router->post('/Register','User#registerAdd');
$router->get('/Article/Show/:id','Article#Show#id');
$router->get('/Article/Search/:id','Article#Search#id');
$router->post('/Article/Show/', 'Article#Search');

$router->get('/Article/Validation', 'Article#ListValidator');
$router->get('/Article/Val/:id', 'Article#Val#id');

$router->get('/User/ValidationUser', 'User#ListValidatorUser');
$router->get('/User/Val/:id_uti', 'User#Val#id_uti');

$router->get('/User', "User#ListAllUser");
$router->get('/User/Show', "User#Show");
$router->get('/Api/User', "Api#UserGet");

echo $router->run();
