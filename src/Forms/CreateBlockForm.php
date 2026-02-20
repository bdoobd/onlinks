<?php

namespace App\Forms;

use App\Core\DBModel;

class CreateBlockForm extends DBModel
{
    public int $catId = 0;
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

    public function rules(): array
    {
        return [
            'catId' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50], [self::RULE_UNIQUE, 'class' => self::class]],
            'itemnum' => [self::RULE_REQUIRED, self::RULE_INT, [self::RULE_UNIQUE, 'class' => self::class]],
        ];
    }
}
