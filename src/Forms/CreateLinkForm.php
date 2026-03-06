<?php

namespace App\Forms;

use App\Core\DBModel;

class CreateLinkForm extends DBModel
{
    public int $blockid;
    public string $name;
    public string $link;
    public int $linknum;

    public static function tableName(): string
    {
        return 'links';
    }
    public function labels(): array
    {
        return [
            'blockid' => 'Блок',
            'name' => 'Название ссылки',
            'link' => 'Ссылка',
            'linknum' => 'Порядковый номер',
        ];
    }

    public function attributes(): array
    {
        return ['blockid', 'name', 'link', 'linknum'];
    }

    public function rules(): array
    {
        return [
            'blockid' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50], [self::RULE_UNIQUE, 'class' => self::class]],
            'link' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 255]],
            'linknum' => [self::RULE_REQUIRED, self::RULE_INT],
        ];
    }
}
