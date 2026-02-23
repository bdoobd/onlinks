<?php

namespace App\Forms;

use App\Core\DBModel;

class CreateBlockForm extends DBModel
{
    public int $catId;
    public string $name = '';
    public int $itemnum;

    public static function tableName(): string
    {
        return 'blocks';
    }
    public function labels(): array
    {
        return [
            'catId' => 'Категория',
            'name' => 'Название категории',
            'itemnum' => 'Порядковый номер',
        ];
    }

    public function attributes(): array
    {
        return ['catId', 'name', 'itemnum'];
    }

    public function rules(): array
    {
        return [
            'catId' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50], [self::RULE_UNIQUE, 'class' => self::class]],
            'itemnum' => [self::RULE_REQUIRED, self::RULE_INT],
        ];
    }
    /**
     * Получить последний порядковый номер блока в категории и прибавить к нему единицу
     * 
     * @param int $catid ID категории
     * 
     * @return int
     */
    public function getNextItemNumber(int $catid): int
    {
        $sql = 'SELECT MAX(itemnum) FROM blocks WHERE catid = :catid';
        $stmt = self::prepare($sql);

        $stmt->bindValue(':catid', $catid);
        $stmt->execute();

        $lastId = $stmt->fetchColumn();

        return (int) $lastId + 1;
    }
}
