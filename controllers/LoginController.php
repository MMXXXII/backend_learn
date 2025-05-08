<?php

class LoginController extends TwigBaseController
{
    public function get(array $context = []): void
    {
        echo $this->twig->render("login.twig", []);
    }

    public function post(array $context = []): void
    {
        // session_start() вызывается один раз, на уровне process_response()
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $this->pdo->prepare('SELECT password FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['user'] = [
                'username' => $username,
                'is_authenticated' => true
            ];

            header("Location: /");
            exit;
        }

        echo $this->twig->render("login.twig", ['error' => 'Неверные данные']);
    }
}
