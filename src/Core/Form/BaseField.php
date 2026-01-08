<?php

namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField
{
    protected Model $model;
    protected string $attribute;
    protected string $type;
    public array $options = [];

    public function __construct(Model $model, string $attribute, array $options)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->options = $options;
    }

    public function __toString()
    {
        return sprintf(
            '<div class="input-group">
            <label for="%s">%s</label>
            %s
            <div class="invalid">%s</div>
        </div>',
            $this->attribute,
            $this->model->getLabel($this->attribute),
            $this->renderControl(),
            $this->model->getErrorFirst($this->attribute),
        );
    }

    public function stringifyOptions(): string
    {
        return (!empty($this->options)) ? implode(' ', $this->options) : '';
    }

    abstract public function renderControl(): string;
}
