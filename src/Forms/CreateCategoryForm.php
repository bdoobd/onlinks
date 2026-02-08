<?php

namespace App\Forms;

use App\Core\DBModel;
use App\Core\Model;

class CreateCategoryForm extends DBModel
{
    public string $name = '';
    public string $action = '';

    public static function tableName(): string
    {
        return 'cats';
    }
    public function labels(): array
    {
        return [
            'name' => 'Название категории',
            'action' => 'Идентификатор категории',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50], [self::RULE_UNIQUE, 'class' => self::class]],
            'action' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
        ];
    }
}
