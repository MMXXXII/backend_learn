<?php 
require_once "../vendor/autoload.php";
require_once "../controllers/MainController.php"; // добавим в самом верху ссылку на наш контроллер

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
    $title = "Windows 11";
    $context['base_url'] = '/windows';

    if (preg_match("#/windows/image#", $url)) {
        $template = "image.twig";

        $context['image'] = "/images/Windows-Logo.png";
    } elseif (preg_match("#/windows/info#", $url)) {
        $template = "windows_info.twig";
    } else {
        $template = "__object.twig";
    }
} elseif (preg_match("#^/linux#", $url)) {
    $title = "Linux Ubuntu";
    $context['base_url'] = '/linux';

    if (preg_match("#/linux/image#", $url)) {
        $template = "image.twig";
        $context['image'] = "/images/Ubuntu_logo.svg";
    } elseif (preg_match("#/linux/info#", $url)) {
        $template = "linux_info.twig";
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
