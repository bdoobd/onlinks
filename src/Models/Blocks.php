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

    public static function blockList(int $catId): array
    {
        $sql = 'SELECT id, name FROM ' . self::tableName() . ' WHERE catid = :catid';

        return self::runPrepQuery($sql, ['catid' => $catId]);
    }
}
