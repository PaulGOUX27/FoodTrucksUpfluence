<?php

namespace FoodTruckUpfluence\Service;

use GuzzleHttp\Client;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\StreamInterface;

class FoodTruckService
{
    /**
     * FoodTruckService constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
    }

    /**
     * @param array $body
     * @return StreamInterface
     */
    public function getNearestFoodTruck(array $body)
    {
        $latitude = $body['latitude'];
        $longitude = $body['longitude'];
        $limit = $body['limit'];

        $client = new Client(['verify' => 'C:\Users\Paul\.ssh\cacert.pem']);

        return $client->get("https://data.sfgov.org/resource/rqzj-sfat.json?\$order=distance_in_meters(location,'POINT ($latitude $longitude)')&\$limit=$limit")->getBody();
    }

}