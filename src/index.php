<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\App;

require '../vendor/autoload.php';

$app = new App;
$app->get('/health', function (Request $request, Response $response){
   $response->getBody()->write('{"health":"OK"}');
   return $response;
});

$app->run();
