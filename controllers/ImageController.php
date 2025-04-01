<?php
// require_once "WindowsController.php"; // импортим TwigBaseController
require_once "ObjectController.php";

class ImageController extends ObjectController
{
    public $template = "image.twig"; // Шаблон для изображения

    public function getContext(): array
    {
        $context = parent::getContext();
        
        // Активная страница — изображение
        $context['active_page'] = 'image';
        

        return $context;
    }
}
