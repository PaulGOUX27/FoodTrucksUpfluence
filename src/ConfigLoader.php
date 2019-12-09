<?php

namespace FoodTruckUpfluence;

/**
 * Class ConfigLoader
 * @package FoodTruckUpfluence
 */
class ConfigLoader
{

    /**
     * return configuration variables write in settings.ini
     * @return array
     */
    public static function getConfig(): array {
        return parse_ini_file(__DIR__ . "/../settings.ini");
    }

}