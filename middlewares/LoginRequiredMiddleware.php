<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $is_logged = isset($_SESSION["user"]) && $_SESSION["user"]["is_authenticated"] === true;
    if (!$is_logged)
    {
        header("Location: /login");
        exit;
    }
}

}
