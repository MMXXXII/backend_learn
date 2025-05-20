<?php

class HistoryMiddleware
{
    public function handle(array $context): array
    {

        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }

        $currentUrl = $_SERVER['REQUEST_URI'];

        // Добавить URL в историю
        if (end($_SESSION['history']) !== $currentUrl) {
            $_SESSION['history'][] = $currentUrl;
        }

        // Ограничить последние 10
        $_SESSION['history'] = array_slice($_SESSION['history'], -10);

        // Добавить расшифрованную историю в контекст
        $context['history'] = array_map('urldecode', $_SESSION['history']);

        return $context;
    }
}
