<?php

namespace App\Models;

use App\Core\Model;

class Blocks extends Model
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
