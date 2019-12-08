<?php

namespace FoodTruckUpfluence\Controller;

use FoodTruckUpfluence\Service\FoodTruckService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FoodTruckController
{

    /**
     * @var FoodTruckService
     */
    private $foodTruckService;

    /**
     * FoodTruckController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->foodTruckService = $container->get(FoodTruckService::class);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getNearestFoodTrucks(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $response->getBody()->write($this->foodTruckService->getNearestFoodTruck($body));

        $response = $response->withoutHeader('Content-type');
        $response = $response->withAddedHeader('Content-type', 'application/json');
        return $response;
    }

}