<?php
require_once "../vendor/autoload.php";
require_once "../controllers/MainController.php"; 
require_once "../controllers/WindowsController.php";
require_once "../controllers/WindowsImageController.php";
require_once "../controllers/WindowsInfoController.php";
require_once "../controllers/LinuxController.php";
require_once "../controllers/LinuxImageController.php";
require_once "../controllers/LinuxInfoController.php";
require_once "../controllers/Controller404.php"; 


$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";
$context = [];

$controller = new Controller404($twig); // создаем переменную под контроллер
$menu = [
    [
        "title" => "Главная",
        "url" => "/",
    ],
    [
        "title" => "Windows",
        "url" => "/windows",
    ],
    [
        "title" => "Linux",
        "url" => "/linux",
    ]
];

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/windows/image#", $url)) {
    $controller = new WindowsImageController($twig);    
} elseif (preg_match("#^/windows/info#", $url)) {
    $controller = new WindowsInfoController($twig);
} elseif (preg_match("#^/windows#", $url)) {
    $controller = new WindowsController($twig);
} elseif (preg_match("#^/linux/image$#", $url)) {
    $controller = new LinuxImageController($twig);
} elseif (preg_match("#^/linux/info#", $url)) {
    $controller = new LinuxInfoController($twig);
} elseif (preg_match("#^/linux$#", $url)) {
    $controller = new LinuxController($twig);
}

$context['menu'] = $menu;



if ($controller) {
    $controller->get();
}
