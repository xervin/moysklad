<?php

namespace App\Services;

/**
 * Класс-оболочка над данными аутентификации из сессии пользователя
 * Использовал сессию (а не БД, например) т.к. был ограничен во времени
 * и не знал как долго нужно хранить данные и как часто с ними оперировать
 */
class User
{
    private const LOGIN_KEY = 'MOLogin';
    private const PASS_KEY = 'MOPass';
    public static function isAuth(): bool
    {
        return session()->has(self::LOGIN_KEY) && session()->has(self::PASS_KEY);
    }

    public static function save(string $login, string $pass): void
    {
        session()->put(self::LOGIN_KEY, $login);
        session()->put(self::PASS_KEY, $pass);
    }

    public static function login()
    {
        return session()->get(self::LOGIN_KEY);
    }

    public static function pass()
    {
        return session()->get(self::PASS_KEY);
    }

    public static function logout(): void
    {
        session()->forget(self::LOGIN_KEY);
        session()->forget(self::PASS_KEY);
    }
}
