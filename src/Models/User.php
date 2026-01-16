<?php

namespace App\Models;

use App\Core\DBModel;

class User extends DBModel
{
    public int $id;
    public string $name;
    public string $pwd;
    public string $confirm_pwd = '';
    public string $created;
    public ?string $modified;
    /**
     * Возвращает название таблицы пользователей в базе данных
     * 
     * @return string Название таблицы
     */
    public static function tableName(): string
    {
        return 'usrs';
    }
    /**
     * Сопоставляет название поля в базе данных с именем label для поля формы 
     * 
     * @return array{confirm_pwd: string, name: string, pwd: string}
     */

    public function attributes(): array
    {
        return ['name', 'pwd'];
    }
    /**
     * Возвращает всех пользователей из базы данных без паролей
     * 
     * @return array Массив пользователей
     */
    public static function showAll(): array
    {
        $sql = 'SELECT id, name, created FROM ' . self::tableName();

        $users = User::runPrepQuery($sql);

        return $users;
    }
    /**
     * обновление только поля pwd в записи пользователя
     * 
     * @return bool
     */
    public function update_password(): bool
    {
        $sql = 'UPDATE usrs SET pwd = :pwd WHERE id = :id';
        $stmt = self::prepare($sql);
        $stmt->bindValue('pwd', $this->pwd);
        $stmt->bindValue('id', $this->id);

        return $stmt->execute();
    }
    /**
     * Возвращает имя пользователя
     * 
     * @return string
     */
    public function getUserName(): string
    {
        return ucfirst($this->name);
    }
}
