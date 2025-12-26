<?php

namespace App\Models;

use App\Core\Model;
use DateTime;

class User extends Model
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
    public static function showAll(): array
    {
        $sql = 'SELECT id, name, created FROM ' . self::tableName();

        $users = User::runPrepQuery($sql);

        return $users;
    }
}
