<?php

namespace App\Forms;

use App\Core\DBModel;
use App\Core\Model;

class UpdateCategoryForm extends DBModel
{
    public int $id;
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
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 50]],
            'action' => [self::RULE_REQUIRED],
        ];
    }
}
