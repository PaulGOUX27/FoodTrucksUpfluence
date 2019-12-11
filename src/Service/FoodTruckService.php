<?php

namespace FoodTruckUpfluence\Service;

use Exception;
use FoodTruckUpfluence\ConfigLoader;
use GuzzleHttp\Client;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamInterface;

class FoodTruckService
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * FoodTruckService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(Logger::class);
    }

    /**
     * @param array $params
     * @return StreamInterface
     * @throws Exception
     */
    public function getNearestFoodTruck(array $params)
    {
        if(!isset($params['latitude']) || !isset($params['longitude'])) {
            $msg = "Parameters 'longitude' and 'latitude' are required";
            $this->logger->error($msg);
            throw new Exception($msg);
        }

        $latitude = intval($params['latitude']);
        $longitude = intval($params['longitude']);
        if(isset($params['limit']))
            $limit = intval($params['limit']);
        else
            $limit = 5;

        if($limit < 0){
            $msg = "'limit' must be > 0";
            $this->logger->error($msg);
            throw new Exception($msg);
        }

        $client = new Client(['verify' => (ConfigLoader::getConfig()['GuzzleVerify'])]);

        return $client->get(ConfigLoader::getConfig()['dataURL'] . "?\$order=distance_in_meters(location,'POINT ($latitude $longitude)')&\$limit=$limit")->getBody();
    }
}