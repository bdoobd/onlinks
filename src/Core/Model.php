<?php

namespace App\Core;

use PDOStatement;

abstract class Model
{
    abstract public static function tableName(): string;

    // public function loadData(array $data): void
    // {
    //     foreach ($data as $key => $value) {
    //         if (property_exists($this, $key)) {
    //             $this->{$key} = $value;
    //         }
    //     }
    // }

    public static function query(string $sql): bool|PDOStatement
    {
        return App::$app->db->query($sql);
    }

    public static function findAll(): array
    {
        $tableName = static::tableName();

        $sql = "SELECT * FROM {$tableName} ORDER BY id ASC";

        return self::query($sql)->fetchAll(\PDO::FETCH_CLASS, static::class);
    }
}
