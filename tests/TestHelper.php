<?php

use Phalcon\Loader;

ini_set("display_errors", 1);
error_reporting(-1);

// required for monolog/monolog
include "vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new Loader();

$loader->registerNamespaces([
    'C0DE8\\Phalcon\\Logger\\Adapter' => 'src/C0DE8/Phalcon/Logger/Adapter/',
]);

$loader->register();
