<?php

namespace App\Core;

class Session
{
    protected const POPUP_KEY = 'popup_key';

    public function __construct()
    {
        session_start();
        $popups = $_SESSION[self::POPUP_KEY] ?? [];

        foreach ($popups as $key => &$popup) {
            $popup['remove'] = true;
        }

        $_SESSION[self::POPUP_KEY] = $popups;
    }

    public function __destruct()
    {
        $this->removePopupMessages();
    }
    /**
     * Усиаервиит переменную сессии
     * 
     * @param string $key Ключ переменной сессии
     * @param string $value Значение переменной сессии
     * 
     * @return void
     */
    public function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Получить значение переменной сессии по ключу
     * 
     * @param string $key Ключ переменной сессии
     * 
     * @return string|bool
     */
    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? false;
    }
    /**
     * Удалить переменную сессии по ключу
     * 
     * @param string $key Ключ переменной сессии
     * 
     * @return void
     */
    public function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }
    /**
     * Установить переменную сессии для popup уведомления
     * 
     * @param string $key Ключ массива для переменноцй сессии
     * @param string $value Значение переменной сессии
     * 
     * @return void
     */
    public function setPopup(string $key, string $value): void
    {
        $_SESSION[self::POPUP_KEY][$key] = ['value' => $value, 'remove' => false];
    }
    /**
     * Удалить переменную сессии пользовательского уведомления после отображения (ключ remove => true)
     * 
     * @return void
     */
    public function removePopupMessages()
    {
        $popups = $_SESSION[self::POPUP_KEY] ?? [];

        foreach ($popups as $key => $popup) {
            if ($popup['remove']) {
                unset($popups[$key]);
            }
        }

        $_SESSION[self::POPUP_KEY] = $popups;
    }
    /**
     * Получить переменную с пользоватеьским уведолмение по ключу.
     * 
     * @param string $key Ключ массива для переменноцй сессии
     * 
     * @return string|bool
     */
    public function getPopup(): string | bool
    {
        $key = $this->getPopupKey();

        return $_SESSION[self::POPUP_KEY][$key]['value'] ?? false;
    }

    public function hasPopups(): bool
    {
        return empty($_SESSION[self::POPUP_KEY]) ? false : true;
    }

    public function getPopupKey(): string
    {
        return key($_SESSION[self::POPUP_KEY]) ?? '';
    }
}
