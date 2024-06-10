<?php

namespace gift\appli\app\utils;

class CsrfService
{
    public static function generate(): string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $token;
        return $token;
    }

    public static function check(string $token) : void
    {
        if (!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $token) {
            throw new CsrfException('Invalid CSRF token', 400);
        }

        unset($_SESSION['csrf']);
    }
}