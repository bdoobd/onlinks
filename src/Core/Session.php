<?php

namespace App\Core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key): string|bool
    {
        return $_SESSION[$key] ?? false;
    }
}
