<?php

namespace FoodTruckUpfluence;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class ToolRegistrar
{

    public static function register(ContainerInterface $container)
    {
        $container[Logger::class] = function ($container) {
            $logger = new Logger("FoodTruckUpfluence");
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
            return $logger;
        };

        $container['errorHandler'] = function ($container) {
            return function ($request, $response, $error) use ($container) {
                return $response->withStatus(500)
                    ->withHeader('Content-Type', 'text/html')
                    ->write($error->getMessage());
            };
        };
    }
}