<?php

namespace App\Core\Form;

use App\Core\Model;

abstract class BaseField
{
    protected Model $model;
    protected string $attribute;
    protected string $type = 'text';
    public array $options = [];

    public function __construct(string $type, string $attribute)
    {
        $this->type = $type;
        $this->attribute = $attribute;
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

    abstract public function renderControl(): string;
}
