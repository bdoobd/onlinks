<?php

namespace App\Core;

use App\Exceptions\NoPropertyException;
use PDO;
use PDOStatement;

abstract class DBModel extends Model
{
    abstract public static function tableName(): string;

    /**
     * Локальная ссылка на метод класса DBH. Использовать только для выборки всех данных из db. 
     * ВНИМАНИЕ! Не использует подготовленные запросы, внешние данные в строку sql не передавать
     * 
     * @param string $sql Сторка SQL
     * 
     * @return bool|PDOStatement
     */
    public static function query(string $sql): bool|PDOStatement
    {
        return App::$app->db->query($sql);
    }
    /**
     * Локальная ссылка на метод класса DBH. Использует подготовленные запросы
     * 
     * @param string $sql Строка sql
     * 
     * @return bool|PDOStatement
     */
    public static function prepare(string $sql): bool|PDOStatement
    {
        return App::$app->db->prepare($sql);
    }
    /**
     * Выборка всех данных из таблицы
     * 
     * @return array Массиы объектов
     */
    public static function findAll(): array
    {
        $tableName = static::tableName();

        $sql = "SELECT * FROM {$tableName} ORDER BY id ASC";

        return self::query($sql)->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
    /**
     * Выборка одной записи по фильтру
     * 
     * @param array $filter Ассоциативный массив, ключи - имя свойства для поиска => значения - поисковое слово
     * 
     * @throws NoPropertyException
     * @return bool|object
     */
    public static function findOne(array $filter): object | bool
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM {$tableName} WHERE " . self::createAndClause($filter);

        $stmt = self::prepare($sql);

        foreach ($filter as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->execute();

        return $stmt->fetchObject(static::class);
    }
    /**
     * Выборка нескольких записей из базы дынных по фильтру
     * 
     * @param array $filter Массив критериев фильтрации формата ['placeholder' => 'value']
     * 
     * @return array Массив объектов
     */
    public static function findMany(array $filter): array
    {
        $tableName = static::tableName();

        $sql = "SELECT * FROM {$tableName} WHERE " . self::createAndClause($filter);

        $stmt = self::prepare($sql);

        foreach ($filter as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
    /**
     * Добавляет данные из объекта в базу данных
     * 
     * @return bool
     */
    public function save(): bool
    {
        $tableName = static::tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($item) => ":$item", $attributes);

        $stmt = self::prepare("INSERT INTO {$tableName} (" . implode(',', $attributes) . ") 
            VALUES (" . implode(',', $params) . ")");

        foreach ($attributes as $attribute) {
            $stmt->bindValue(":$attribute", $this->{$attribute});
        }

        $stmt->execute();

        return true;
    }
    // FIXME: Underconstruction
    public function update(): bool
    {
        echo '<pre>';
        var_dump($this);
        echo '</pre>';

        return true;
    }
    /**
     * Удаляет запись из таблицы базы данных по фильтру
     * 
     * @param array $filter Ассоциативный массив вида ключ => значение
     * 
     * @return bool
     */
    public function delete(array $filter): bool
    {
        $sql = "DELETE FROM {$this->tableName()} WHERE {$this->createAndClause($filter)}";
        $stmt = self::prepare($sql);
        foreach ($filter as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->execute();

        return true;
    }
    /**
     * Выборка данных с помощью мануального запроста SQL
     * Если строка SQL содержит фильтр, данные фильтрации указываюстя в массив params
     * 
     * @param string $sql Строка запроста SQL
     * @param array $params Параметры для подготовленного запрста в формате
     *                      ['placeholder' => 'v<lue']
     * 
     * @return array Массив найженых значений
     */
    public static function runPrepQuery(string $sql, array $params = []): array
    {
        $stmt = self::prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Private properties
    /**
     * Формирует часть стороки запроса SQL для использования в WHERE разделе с использованием оператора AND
     * 
     * @param array $filter массив заначений для поля и ключа
     * 
     * @throws NoPropertyException
     * 
     * @return string
     */
    private static function createAndClause(array $filter): string
    {
        $attributes = array_keys($filter);
        foreach ($attributes as $attribute) {
            if (!property_exists(static::class, $attribute)) {
                throw new NoPropertyException();
            }
        }

        $clause = implode(' AND ', array_map(fn($item) => "$item = :$item", $attributes));

        return $clause;
    }
}
