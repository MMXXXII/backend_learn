<?php
require_once "WindowsController.php"; // импортим TwigBaseController

class WindowsImageController extends WindowsController {
    public $template = "image.twig";

    public function getContext() : array {
        $context = parent::getContext(); // Наследуем базовый контекст
        $context['image'] = "/images/Windows-Logo.png";
        return $context;
    }
}