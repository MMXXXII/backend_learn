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
    $method = $_SERVER['REQUEST_METHOD'];

    // сначала — сессия!
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params(60 * 60 * 30);
        session_start();
    }

    // теперь можно безопасно работать с контекстом
    $context = $this->getContext();

    // middleware по истории
    $middleware = new HistoryMiddleware();
    $context = $middleware->handle($context);

    if ($method === 'GET') {
        $this->get($context);
    } else if ($method === 'POST') {
        $this->post($context);
    }
}




    public function get(array $context) {} // ну и сюда добавил в качестве параметра 
    public function post(array $context) {} // и сюда
}
