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
}
