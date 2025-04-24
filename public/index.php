<?php
require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/OperationSystemsCreateController.php";
require_once "../controllers/OperationSystemsDeleteController.php";
require_once "../controllers/OperationSystemsUpdateController.php";
require_once "../controllers/OperationSystemsTypeController.php";
require_once "../middlewares/LoginRequiredMiddleware.php";
require_once "../controllers/SetWelcomeController.php";
require_once "../controllers/LoginController.php";
require_once "../controllers/LogoutController.php";


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$pdo = new PDO("mysql:host=localhost;dbname=operation_systems;charset=utf8", "root", "");


$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/search", SearchController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/os_list/(?P<id>\d+)", ObjectController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/login", LoginController::class);
$router->add("/logout", LogoutController::class);

$router->add("/os_list/create", OperationSystemsCreateController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/os_list/(?P<id>\d+)/delete", OperationSystemsDeleteController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/os_list/(?P<id>\d+)/edit", OperationSystemsUpdateController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/os_list/types", OperationSystemsTypeController::class)
    ->middleware(new LoginRequiredMiddleware());
$router->add("/set-welcome/", SetWelcomeController::class);

$router->get_or_default(Controller404::class);
