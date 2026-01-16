<?php

namespace App\Forms;

use App\Core\Model;
use App\Models\User;

class CreateUserForm extends Model
{
    public string $name = '';
    public string $pwd = '';
    public string $confirm_pwd = '';

    public function labels(): array
    {
        return [
            'name' => 'Имя пользователя',
            'pwd' => 'Пароль',
            'confirm_pwd' => 'Подтверждение пароля',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 20]],
            'pwd' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 40]],
            'confirm_pwd' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'pwd']],
        ];
    }
    /**
     * Записывает данные пользователя в базу данных
     * 
     * @return bool
     */
    public function save(): bool
    {
        $user = new User();
        $user->name = $this->name;
        $user->pwd = password_hash($this->pwd, PASSWORD_DEFAULT);

        return $user->save();
    }
}
