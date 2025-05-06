<?php

class LogoutController extends TwigBaseController
{
    public function get(array $context = []): void
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /login");
        exit;
    }
}
