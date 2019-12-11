# Food trucks backend & command line interface

The objective of this mini-project is to provide a backend and a CLI to find the n food trucks closest to a gps position (longitude / latitude). 

## Backend

### Install and start
Backend is write in **PHP 7.2** using [Slim framework](http://www.slimframework.com/) to provide an API.
It's a [Composer](https://getcomposer.org/) project. To install project run  

    composer install

To start the back run.

    php -S localhost:8080 -t src src/index.php 
    
Default port is **8080**, this port is used in the CLI.

### API documentation
Every endpoint is preceded by `localhost:8080`
* `/health` : return `{"health":"OK"}` as text. Useful to test if the back is currently running and everything is ok.
* `/food-trucks` :
    * request parameter :
        * longitude (required) : search longitude
        * latitude (required) : search latitude
        * limit (optional) : number of result to return
    * response :
        * 200 : in case of success, returns the limit food trucks closest to the longitude/latitude point
        * 500 : an error occurred

### Running tests

Automated tests are located in the `tests` directory. To run them : 

    ./vendor/bin/phpunit ./tests/FoodTruckUpfluenceTests
    
These tests use the API from the outside, testing the endpoints and parameters.
The answers are compared with the expected values.

### Backend features

* [Composer](https://getcomposer.org/) project
* [Slim framework](http://www.slimframework.com/)
* [Monologue](https://github.com/Seldaek/monolog) logger
* [Guzzle](http://docs.guzzlephp.org/en/stable/) http request
* [PHPUnit](https://phpunit.de/) Unit test

### Backend explanation

I have chose PHP and a the Slim framework because a already work using this framework.
It's organised following service layer pattern, adding new endpoints will be easy.
Searching using a SOQL query directly in the query to the dataset prevents the return from receiving many unnecessary data and filtering it.

## Command line interface

CLI use python3.  
You might probably have to install `requests` : 

    pip install requests

### Usage
CLI is located in `srcCLI` directory.
Upon in this directory, to see entire help, type :

        python3 foodTruckUpfluenceCLI.py --help
        
## Go further
Here are some aspect to improve or add to the project : 
* Dockerize backend to deploy independently to the platform
* Separate backend and CLI in different Git repository
* Project reorganisation (create Tool directory with ConfigLoader and ToolRegistrar, place for cacert.pem and setting.ini)
* Document API using OpenAPI specification ([Swagger](https://swagger.io/specification/))
