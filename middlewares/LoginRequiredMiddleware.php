<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        $username = $_SERVER['PHP_AUTH_USER'] ?? '';
        $password = $_SERVER['PHP_AUTH_PW'] ?? '';

        if (empty($username) || empty($password)) {
            $this->unauthorized();
        }

        // Простой запрос без хешей
        $stmt = $controller->pdo->prepare('SELECT password FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Простое сравнение пароля (НЕбезопасное, но по запросу)
        if (!$user || $password !== $user['password']) {
            $this->unauthorized();
        }
    }

    private function unauthorized()
    {
        header('WWW-Authenticate: Basic realm="OS List"');
        http_response_code(401);
        exit;
    }
}
