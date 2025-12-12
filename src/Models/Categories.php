<?php

namespace App\Models;

use App\Core\Model;

class Categories extends Model
{
    public int $id;
    public string $name;
    public string $action;

    public static function tableName(): string
    {
        return 'cats';
    }
}
