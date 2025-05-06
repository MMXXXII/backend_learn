<?php

abstract class BaseController
{
    public PDO $pdo; // добавил поле
    public array $params;

    public function setPDO(PDO $pdo)
    { // и сеттер для него
        $this->pdo = $pdo;
    }
    // остальное не трогаем
    public function getContext(): array
    {
        return [];
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }


    public function process_response()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params(60 * 60 * 30);
            session_start();
        }

        $currentUrl = $_SERVER['REQUEST_URI'];

        $method = $_SERVER['REQUEST_METHOD'];
        $context = $this->getContext(); // сначала получить context

        // потом добавить в него history
        if (isset($_SESSION['history'])) {
            $context['history'] = array_map('urldecode', $_SESSION['history']);
        }

        if (end($_SESSION['history']) !== $currentUrl) {
            $_SESSION['history'][] = $currentUrl;
        }

        $_SESSION['history'] = array_slice($_SESSION['history'], -10);

     
        if ($method == 'GET') {
            $this->get($context);
        } else if ($method == 'POST') {
            $this->post($context);
        }
    }



    public function get(array $context) {} // ну и сюда добавил в качестве параметра 
    public function post(array $context) {} // и сюда
}
