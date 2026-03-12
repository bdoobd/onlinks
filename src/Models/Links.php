<?php

namespace App\Models;

use App\Core\DBModel;

class Links extends DBModel
{
    public int $id;
    public int $blockid;
    public string $name;
    public string $link;
    public int $linknum;
    public static function tableName(): string
    {
        return 'links';
    }

    public static function linkList(int $blockId): array
    {
        $sql = 'SELECT id, name FROM ' . self::tableName() . ' WHERE blockid = :blockid';
        return self::runPrepQuery($sql, ['blockid' => $blockId]);
    }
}
