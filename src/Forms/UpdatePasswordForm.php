<?php

namespace App\Forms;

use App\Core\Model;
use App\Models\User;

class UpdatePasswordForm extends Model
{
    public int $id;
    public string $current_password = '';
    public string $new_password = '';
    public string $confirm_new_password = '';

    public function labels(): array
    {
        return [
            'current_password' => 'Текущий пароль',
            'new_password' => 'Новый пароль',
            'confirm_new_password' => 'Подтверждение нового пароля',
        ];
    }

    public function rules(): array
    {
        return [
            'current_password' => [self::RULE_REQUIRED],
            'new_password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 40]],
            'confirm_new_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'new_password']],
        ];
    }
    /**
     * Запись нового пароля пользователя в базу данных
     * 
     * @return bool
     */
    public function save(): bool
    {
        $user = User::findOne(['id' => $this->id]);
        $user->pwd = password_hash($this->new_password, PASSWORD_DEFAULT);

        return $user->update_password();
    }
}
