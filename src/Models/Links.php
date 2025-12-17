<?php

namespace App\Models;

use App\Core\Model;

class Links extends Model
{
    public int $id;
    public int $blockid;
    public string $name;
    public string $url;
    public int $linknum;
    public static function tableName(): string
    {
        return 'links';
    }
}
