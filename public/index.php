<?php 
require_once "../vendor/autoload.php";
require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер
require_once "../controllers/WindowsController.php"; 
require_once "../controllers/WindowsImageController.php";
require_once "../controllers/WindowsInfoController.php";
require_once "../controllers/LinuxController.php";
require_once "../controllers/LinuxImageController.php";
require_once "../controllers/LinuxInfoController.php";

$loader = new \Twig\Loader\FilesystemLoader('C:\Users\perfi\Desktop\study\4\Web programming\Backend\back1_1\views');
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";
$context = []; 

$controller = null; // создаем переменную под контроллер
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
} elseif (preg_match("#^/windows#", $url)) {
    $controller = new windowsController($twig);

    if (preg_match("#/windows/image#", $url)) {
        $controller = new WindowsImageController($twig);
    } elseif (preg_match("#/windows/info#", $url)) {
        $controller = new WindowsInfoController($twig);
    } else {
        $template = "__object.twig";
    }



} elseif (preg_match("#^/linux#", $url)) {
    $controller = new LinuxController($twig);

    if (preg_match("#/linux/image#", $url)) {
        $controller = new LinuxImageController($twig);
    } elseif (preg_match("#/linux/info#", $url)) {
        $controller = new LinuxInfoController($twig);
    } else {
        $template = "__object.twig";
    }
}

// $context['title'] = $title;
$context['menu'] = $menu;

// echo $twig->render($template, $context);

if ($controller) {
    $controller->get();
}
