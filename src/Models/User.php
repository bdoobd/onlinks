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

    public static function tableName(): string
    {
        return 'usrs';
    }

    public function labels(): array
    {
        return [
            'name' => 'Имя пользователя',
            'pwd' => 'Пароль',
            'confirm_pwd' => 'Подтверждение пароля',
        ];
    }

    public function attributes(): array
    {
        return ['name', 'pwd'];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class], [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 20]],
            'pwd' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 40]],
            'confirm_pwd' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'pwd']],
        ];
    }
    public static function showAll(): array
    {
        $sql = 'SELECT id, name, created FROM ' . self::tableName();

        $users = User::runPrepQuery($sql);

        return $users;
    }

    public function save(): bool
    {
        $this->pwd = password_hash($this->pwd, PASSWORD_DEFAULT);

        return parent::save();
    }
}
