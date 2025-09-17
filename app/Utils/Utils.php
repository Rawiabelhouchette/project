<?php

namespace App\Utils;

use Exception;

class Utils
{
    public static function getRestaurantValueSeparator()
    {
        return '|||';
    }

    public static function getRestaurantImageSeparator()
    {
        return ',';
    }

    // function that take 22/11/2024 09:57:27 or 22/11/2024 09:57:27 and return the datetime start and end of the day
    public static function getStartAndEndOfDay($date)
    {
        try {
            $dateTime = new \DateTime($date);
            $start = $dateTime->format('Y-m-d') . ' 00:00:00';
            $end = $dateTime->format('Y-m-d') . ' 23:59:59';

            return [$start, $end];
        } catch (Exception $e) {
            // Handle the exception, for example, by logging the error or returning a default value
            // error_log('Invalid date format: ' . $e->getMessage());
            return [null, null];
        }
    }

    /**
     * Nettoie la valeur donnée en supprimant tous les caractères non numériques.
     *
     * @param mixed $value La valeur à nettoyer.
     * @return string La valeur nettoyée contenant uniquement des chiffres.
     */
    public static function cleanValue($value)
    {
        // Nettoyer la valeur pour ne garder que les chiffres
        return preg_replace('/\D/', '', $value);
    }

}
