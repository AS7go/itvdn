<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
error_reporting(E_ALL ^ E_DEPRECATED);

include dirname(__FILE__) . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

use Twig\Loader\FilesystemLoader;

/**
 * Configuration of Doctrine ORM
 */
/**
 * Configuration of Doctrine ORM
 */
$paths = array(dirname(__FILE__) . '/entity'); // Путь к папке с сущностями Doctrine
$isDevMode = false; // Режим разработки (false означает использование продуктивного режима)

// Конфигурация соединения
$dbParams = array(
    'driver'   => 'pdo_mysql', // Драйвер базы данных
    'host'     => 'db', // Хост базы данных
    'user'     => 'root', // Имя пользователя базы данных
    'password' => 'secret', // Пароль пользователя базы данных
    'dbname'   => 'itvdn', // Имя базы данных
);

// Создание конфигурации с использованием аннотаций в сущностях Doctrine
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

// Создание менеджера сущностей Doctrine
$entityManager = EntityManager::create($dbParams, $config);


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
Flight::path(dirname(__FILE__) . '/repositories');

/**
 * Include routes
 */
include dirname(__FILE__) . '/routes.php';

Flight::start();
