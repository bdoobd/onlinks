<?php

namespace App\Core\Form;

use App\Core\Model;

class Select extends BaseField
{
    public int $selected;
    public function __construct(Model $model, string $attribute, array $options, int $selected)
    {
        $this->selected = $selected;
        parent::__construct($model, $attribute, $options);
    }
    public function renderControl(): string
    {
        $optionsMarkup = '';
        foreach ($this->options as $value => $label) {
            $selected = $value == $this->selected ? 'selected' : '';
            // $selected = ($this->model->{$this->attribute} == $value) ? 'selected' : '';
            $optionsMarkup .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
        }
        return sprintf(
            '<select name="%s" id="%s" %s>%s</select>',
            $this->attribute,
            $this->attribute,
            $this->stringifyOptions(),
            $optionsMarkup
        );
    }
}
