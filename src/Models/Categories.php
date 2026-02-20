<?php

namespace App\Models;

use App\Core\DBModel;

class Categories extends DBModel
{
    public int $id;
    public string $name;
    public string $action;
    /**
     * Возвращает название таблицы в DB
     * 
     * @return string
     */
    public static function tableName(): string
    {
        return 'cats';
    }

    public function attributes(): array
    {
        return ['name', 'action'];
    }

    public static function catList(): array
    {
        $sql = 'SELECT id, name FROM ' . self::tableName();
        return self::runPrepQuery($sql);
    }
}
