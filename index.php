<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
error_reporting(E_ALL ^ E_DEPRECATED);

include dirname(__FILE__) . '/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;

/**
 * Connect to database
 */

Flight::register('db', PDO::class, ['mysql:host=db;dbname=itvdn', 'root', 'secret']);

$db = Flight::db();

/**
 * Initiate Twig, and register to Flight
 */
$loader = new FilesystemLoader(dirname(__FILE__) . '/views');  // Используйте правильный класс FilesystemLoader
$twigConfig = array(
    // 'cache'  =>  './cache/twig/',
    // 'cache'  =>  false,
    'debug' =>  true,
);
Flight::register('view', 'Twig\Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new Twig\Extension\DebugExtension());  // Используйте правильный класс DebugExtension
});

/**
 * Add /controllers to the include-path
 */
Flight::path(dirname(__FILE__) . '/controllers');
Flight::path(dirname(__FILE__) . '/models');

/**
 * Include routes
 */
include dirname(__FILE__) . '/routes.php';

Flight::start();
