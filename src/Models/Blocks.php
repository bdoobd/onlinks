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
    /**
     * Получить список блоков по идентификатору категории
     * 
     * @param int $catId Идентификатор категории
     * 
     * @return array Список блоков
     */
    public static function blockList(int $catId): array
    {
        $sql = 'SELECT id, name FROM ' . self::tableName() . ' WHERE catid = :catid';

        return self::runPrepQuery($sql, ['catid' => $catId]);
    }
    /**
     * Получить идетнификатор категории по идентификатору блока
     * 
     * @param int $blockId Идентификатор блока
     * 
     * @return int Идентификатор категории
     */
    public static function getCatId(int $blockId): int
    {
        $sql = 'SELECT catid FROM ' . self::tableName() . ' WHERE id = :id';
        $result = self::runPrepQuery($sql, ['id' => $blockId]);

        return $result[0]->catid ?? 0;
    }
}
