<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $is_logged = isset($_SESSION["is_logged"]) && $_SESSION["is_logged"];
        if (!$is_logged)
        {
            header("Location: /login");
            exit;
        }
    }
}
