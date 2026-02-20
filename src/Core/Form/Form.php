<?php

namespace App\Core\Form;

use App\Core\Model;

class Form
{
    public static function head(string $action, string $method, array $styles = ['form'], array $options = []): Form
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }

        echo sprintf('<form class="%s" action="%s" method="%s" %s>', implode(' ', $styles), $action, $method, implode(' ', $attributes));

        return new Form();
    }

    public static function tail(): void
    {
        echo '</form>';
    }

    public function field(Model $model, string $attribute, array $options = []): Field
    {
        return new Field($model, $attribute, $options);
    }
    public function select(Model $model, string $attribute, array $options = [], int $selected = 0): Select
    {
        return new Select($model, $attribute, $options, $selected);
    }
}
