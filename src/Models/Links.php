<?php

namespace App\Models;

use App\Core\DBModel;

class Links extends DBModel
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
