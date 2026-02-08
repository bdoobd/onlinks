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
}
