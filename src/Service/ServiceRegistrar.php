<?php

namespace FoodTruckUpfluence\Service;

use Psr\Container\ContainerInterface;

class ServiceRegistrar
{
    public static function register(ContainerInterface $container){
        $container[FoodTruckService::class] = function($container){
            return new FoodTruckService($container);
        };
    }
}