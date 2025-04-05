<?php
require_once "BaseOSTwigController.php"; // импортим TwigBaseController

class MainController extends BaseOSTwigController {
    public $template = "main.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        
        // подготавливаем запрос SELECT * FROM space_objects
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        $query = $this->pdo->query("SELECT * FROM os_list");
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['os_list'] = $query->fetchAll();

        return $context;
    }
}