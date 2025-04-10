<?php
require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php"; 
require_once "../controllers/ImageController.php";
require_once "../controllers/InfoController.php";
require_once "../controllers/Controller404.php"; 
require_once "../controllers/ObjectController.php";


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$pdo = new PDO("mysql:host=localhost;dbname=operation_systems;charset=utf8", "root", "");


$router = new Router($twig, $pdo);
$router->add("/", MainController::class);


$router->add("/os_list/(?P<id>\d+)", ObjectController::class); 
 


$router->get_or_default(Controller404::class);


