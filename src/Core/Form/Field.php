<?php

namespace App\Core\Form;

use App\Core\Model;

class Field extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public function __construct(Model $model, string $attribute, array $options)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute, $options);
    }

    public function renderControl(): string
    {
        return sprintf(
            '<input type="%s" name="%s" id="%s" value="%s" autocomplete="off" %s>',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute} ?? '',
            $this->stringifyOptions(),
        );
    }

    public function passwordField(): self
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function numberField(): self
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function hideValue(string $prop): self
    {
        $this->model->{$prop} = '';
        return $this;
    }
}
