<?php

namespace App\Models;

use App\Core\App;
use App\Core\Model;

class Login extends Model
{
    public string $name;
    public string $pwd;

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'pwd' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Имя пользователя',
            'pwd' => 'Пароль',
        ];
    }

    public function login()
    {
        $user = User::findOne(['name' => $this->name]);

        if (!$user) {
            $this->addError('name', 'Не верные данные для входа');
            return false;
        }
        if (!password_verify($this->pwd, $user->pwd)) {
            $this->addError('name', 'Не верные данные для входа');
            return false;
        }

        return App::$app->login($user);
    }
}
