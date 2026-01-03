<?php

namespace App\Models;

use App\Core\DBModel;

class Blocks extends DBModel
{
    public int $id;
    public int $catid;
    public string $name;
    public int $itemnum;

    public static function tableName(): string
    {
        return 'blocks';
    }
}
