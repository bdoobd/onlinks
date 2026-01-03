<?php

namespace App\Models;

use App\Core\DBModel;

class Categories extends DBModel
{
    public int $id;
    public string $name;
    public string $action;

    public static function tableName(): string
    {
        return 'cats';
    }
}
