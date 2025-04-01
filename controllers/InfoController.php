<?php
// require_once "WindowsInfoController.php"; // импортим TwigBaseController
require_once "ObjectController.php";
    
class InfoController extends ObjectController
{
    public $template = "info.twig"; // Шаблон для информации

    public function getContext(): array
    {
        $context = parent::getContext();

        // Активная страница — информация
        $context['active_page'] = 'info';

        return $context;
    }
}
