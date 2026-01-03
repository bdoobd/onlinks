<?php

namespace App\Core;

use Stringable;

class Model
{
    protected array $errors = [];
    const RULE_REQUIRED = 'required';
    const RULE_URL = 'url';
    const RULE_MATCH = 'match';

    const RULE_NOEMPTY = 'noempty';
    public function attributes(): array
    {
        return [];
    }
    public function labels(): array
    {
        return [];
    }

    protected function rules(): array
    {
        return [];
    }

    public function getLabel(string $attribute): string
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorByRule($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrorByRule($attribute, self::RULE_MATCH, ['match' => $this->getLabel($rule['match'])]);
                }
            }
        }

        return empty($this->errors);
    }

    protected function addErrorByRule(string $attribute, string $rule, array $params = []): void
    {
        $params['field'] ??= $attribute;
        $messageString = $this->errorMessage($rule);

        foreach ($params as $key => $value) {
            $messageString = str_replace("{{$key}}", $value, $messageString);
        }

        $this->errors[$attribute][] = $messageString;
    }

    protected function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'Данное поле является обязательным',
            self::RULE_URL => 'Значение поля должно содержать URL ссылку',
            self::RULE_MATCH => 'Значение должно совпадать со зачением поля "{match}"',
            self::RULE_NOEMPTY => 'Данное поле не должно быть пустым',
        ];
    }

    public function errorMessage(string $rule): string
    {
        return $this->errorMessages()[$rule];
    }

    public function getErrorFirst(string $attribute): string
    {
        // return $this->errors[$attribute] ?? '';
        $error = $this->errors[$attribute] ?? [];

        return $error[0] ?? '';
    }
}
