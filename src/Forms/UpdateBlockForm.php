<?php

namespace App\Forms;

use App\Core\DBModel;

class UpdateBlockForm extends DBModel
{
    public int $id;
    public int $catid;
    public string $name;
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
        return ['id', 'catid', 'name', 'itemnum'];
    }

    public function rules(): array
    {
        return [
            'catid' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50]],
            'itemnum' => [self::RULE_REQUIRED, self::RULE_INT],
        ];
    }
}
