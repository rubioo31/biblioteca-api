<?php

/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

header('Content-Type: application/json');

require_once __DIR__ . '/clases/Database.php';
$db = new Database();

//incluir ejecutar router
require_once __DIR__ . '/clases/Router.php';
$router = new Router($db);
$router->run();
?>
