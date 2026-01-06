<?php

namespace App\Core;

use Stringable;

class Model
{
    protected array $errors = [];
    const RULE_REQUIRED = 'required';
    const RULE_URL = 'url';
    const RULE_MATCH = 'match';
    const RULE_UNIQUE = 'unique';
    const RULE_MIN = 'min';
    const RULE_MAX = 'max';
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

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorByRule($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorByRule($attribute, self::RULE_MAX, ['max' => $rule['max']]);
                }

                if ($ruleName === self::RULE_UNIQUE) {
                    $class = $rule['class'];
                    $table = $class::tableName();
                    $unique = $rule['attribute'] ?? $attribute;
                    $db = App::$app->db;
                    $sql = "SELECT * FROM $table WHERE $unique = :$unique";
                    $stmt = $db->prepare($sql);
                    $stmt->bindValue("$unique", $value);
                    $stmt->execute();

                    $found = $stmt->fetchObject();
                    if ($found) {
                        $this->addErrorByRule($attribute, self::RULE_UNIQUE);
                    }
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

    protected function addError(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = $message;
    }

    protected function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'Данное поле является обязательным',
            self::RULE_URL => 'Значение поля должно содержать URL ссылку',
            self::RULE_MATCH => 'Значение должно совпадать со зачением поля "{match}"',
            self::RULE_UNIQUE => 'Значение поля {field} уже существует',
            self::RULE_MIN => 'Минимальное количество знаков для данного поля {min}',
            self::RULE_MAX => 'Максимальное количество знаков для данного поля {max}',
        ];
    }

    public function errorMessage(string $rule): string
    {
        return $this->errorMessages()[$rule];
    }

    public function getErrorFirst(string $attribute): string
    {
        $error = $this->errors[$attribute] ?? [];

        return $error[0] ?? '';
    }
}
