<?php

namespace FoodTruckUpfluence\Controller;

use Exception;
use FoodTruckUpfluence\Service\FoodTruckService;
use Monolog\Logger;
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
     * @var Logger
     */
    private $logger;

    /**
     * FoodTruckController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->foodTruckService = $container->get(FoodTruckService::class);
        $this->logger = $container->get(Logger::class);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function getNearestFoodTrucks(Request $request, Response $response)
    {
        $this->logger->info("Getting nearest food trucks from " . $request->getUri()->getHost() . " with param " .$request->getUri()->getQuery());
        $body = $request->getQueryParams();

        $response->getBody()->write($this->foodTruckService->getNearestFoodTruck($body));

        $response = $response->withoutHeader('Content-type');
        $response = $response->withAddedHeader('Content-type', 'application/json');
        return $response;
    }

}