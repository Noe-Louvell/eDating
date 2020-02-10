<?php


$hostname = "mysql-louvel.alwaysdata.net";
$username = "louvel";
$password = "Vuxec654";
$dbname = "louvel_edating";


try {
    $bdd = new PDO('mysql:host=' . $hostname . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
