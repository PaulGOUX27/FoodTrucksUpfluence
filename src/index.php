<?php

use FoodTruckUpfluence\FoodTruckApp;

require './vendor/autoload.php';

$app = (new FoodTruckApp())->getApp();
$app->run();
