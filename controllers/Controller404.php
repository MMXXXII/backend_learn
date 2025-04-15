<?php

require_once "BaseOSTwigController.php"; // импортим TwigBaseController
class Controller404 extends BaseOSTwigController {
    public $template = "404.twig";
    public $title = "Страница не найдена";

    public function get(array $context)
    {
        http_response_code(404);
        parent::get($context);
    }
}