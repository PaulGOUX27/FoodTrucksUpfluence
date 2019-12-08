<?php

namespace FoodTruckUpfluence;

use FoodTruckUpfluence\Controller\FoodTruckController;
use FoodTruckUpfluence\Service\ServiceRegistrar;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

class FoodTruckApp
{

    /**
     * @var App
     */
    private $app;

    /**
     * FoodTruckApp constructor.
     */
    public function __construct()
    {
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
            ],
        ];
        $container = new Container($configuration);
        $this->app = new App($container);
        ServiceRegistrar::register($container);

        $this->app->get('/health', function (Request $request, Response $response){
            $response->getBody()->write('{"health":"OK"}');
            return $response;
        });

        $this->app->get('/food-trucks', FoodTruckController::class . ':getNearestFoodTrucks');
    }

    /**
     * @return App
     */
    public function getApp(): App
    {
        return $this->app;
    }

}