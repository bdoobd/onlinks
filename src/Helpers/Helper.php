<?php

namespace App\Helpers;

class Helper
{
    /**
     * Конвертирует дату в формате datetime, например полученную из базы данных, в формат дд.мм.гггг для отображения пользователю.
     * 
     * @param string $datetime Строка в формате datetime
     * 
     * @return string
     */
    public static function convertToDotDate(string $datetime, bool $short = true): string
    {
        if ($short) {
            return date('d.m.Y', strtotime($datetime));
        }

        return date('d.m.Y H:i', strtotime($datetime));
    }

    /**
     * Отформатировать массив полученых из базы данных блоков для передачи в шаблон
     * 
     * @param array $fetched Массив полученный после запроса к базе данных
     * @param string $indexKey Имя свойства объекта, которое будет использоваться в качестве идентификатора блока
     * @param string $subArrayName Имя свойства, в котором будут храниться вложенные данные
     * @param array $firstLevelKeys Массив имен свойств объекта, которые будут включены на первом уровне
     * 
     * @return array
     */
    public static function formatDBData(array $fetched, string $indexKey, string $subArrayName, array $firstLevelKeys = []): array
    {
        $tmpArray = [];
        foreach ($fetched as $block) {
            $groupId = $block->{$indexKey};

            if (!isset($tmpArray[$groupId])) {
                $tmpArray[$groupId] = [];

                foreach (get_object_vars($block) as $key => $value) {
                    if (in_array($key, $firstLevelKeys, true)) {
                        $tmpArray[$groupId][$key] = $value;
                    }
                }

                $tmpArray[$groupId][$subArrayName] = [];
            }
            $sub = [];
            foreach (get_object_vars($block) as $key => $value) {
                if ($key !== $indexKey && !in_array($key, $firstLevelKeys, true)) {
                    $sub[$key] = $value;
                }
            }

            $tmpArray[$groupId][$subArrayName][] = $sub;
        }

        return array_values($tmpArray);
    }
    /**
     * Получить строку для выборки блоков с фильтром по категориям
     * 
     * @return string
     */
    public static function createSQLString(): string
    {
        return "SELECT b.id as blockId, b.name as block, l.id as linkId, l.name as item, l.link FROM blocks as b  
                JOIN links as l ON 
                b.id = l.blockid WHERE b.catid = :id";
    }
    public static function createBlocksSQLString(): string
    {
        return "SELECT b.id as blockId, b.name as name, b.itemnum, c.id as catId, c.name as cat FROM blocks as b
                JOIN cats as c ON 
                b.catid = c.id";
    }
    /**
     * Конвертирует строку в StudlyCaps из studly-caps. Удаляет дефис и делает первые буквы слов заглавными
     *
     * @param string $name Строка для конвертации
     * 
     * @return string
     */
    public static function toStudlyCaps(string $name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    /**
     * Конвертирует строку в camelCase из camel-case. С прописной первой буквой
     * 
     * @param string $name Сторка или массив для конвертации
     * 
     * @return string
     */
    public static function toCamelCase(string $name): string
    {
        return lcfirst(self::toStudlyCaps($name));
    }
}
