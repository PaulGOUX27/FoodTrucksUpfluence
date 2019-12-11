<?php

namespace FoodTruckUpfluenceTest;

use FoodTruckUpfluence\FoodTruckApp;
use PHPUnit\Framework\TestCase;
use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Request;

require dirname(__FILE__) . '/../vendor/autoload.php';

class FoodTruckUpfluenceTests extends TestCase
{

    /**
     * @var App
     */
    private $app;

    protected function setUp(): void
    {
        $this->app = (new FoodTruckApp())->getApp();
    }

    protected function tearDown(): void
    {
        $this->app = null;
    }

    /**
     * ensure the class is correctly loaded
     */
    public function testShouldInit(){
        $this->assertTrue(true);
    }

    public function testGetFoodTruckShouldReturn200(){
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/food-trucks',
            'QUERY_STRING' => 'latitude=-122&longitude=37',
        ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run();
        $body = json_decode($response->getBody());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(5, count($body));
    }

    public function testGetFoodTruckWithoutParamShouldReturn500(){
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/food-trucks',
        ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run();

        $this->assertSame(500, $response->getStatusCode());
    }

    public function testGetFoodTruckWithoutLatitudeShouldReturn500(){
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/food-trucks',
            'QUERY_STRING' => 'longitude=37',
        ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run();

        $this->assertSame(500, $response->getStatusCode());
    }

    public function testGetFoodTruckWithoutLongitudeShouldReturn500(){
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/food-trucks',
            'QUERY_STRING' => 'latitude=-122',
        ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run();

        $this->assertSame(500, $response->getStatusCode());
    }

    public function testGetFoodTruckWithLimitShouldReturn200(){
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/food-trucks',
            'QUERY_STRING' => 'latitude=-122&longitude=37&limit=3',
        ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run();
        $body = json_decode($response->getBody());

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(3, count($body));
    }
}