<?php

use Phalcon\Loader;
use Phalcon\Version;

ini_set("display_errors", 1);
error_reporting(-1);

// ensure, that the phalcon extension is available
if (!extension_loaded('phalcon')) {
    die('PHPUnit ERROR: The PHP phalcon extension is not available!' . PHP_EOL);
}

$phalconMinVersion = '3.0.0';
$currentVersion    = Version::get();

if (version_compare($currentVersion, $phalconMinVersion, '<')) {
    die(
        'PHPUnit ERROR: The PHP phalcon extension is available in wrong version'.
        ' (current: '. $currentVersion . '; expected min. version: '
        . $phalconMinVersion . ')!' . PHP_EOL
    );
}

// required for monolog/monolog
include "vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new Loader();

$loader->registerNamespaces([
    'C0DE8\\Phalcon\\Logger\\Adapter' => 'src/C0DE8/Phalcon/Logger/Adapter/',
]);

$loader->register();
