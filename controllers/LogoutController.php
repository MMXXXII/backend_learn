<?php

class LogoutController extends TwigBaseController {
    public function get(array $context = []): void {
        session_start();
        $_SESSION["is_logged"] = false;
        header("Location: /login");
        exit;
    }
}
