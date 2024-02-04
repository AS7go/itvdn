<?php

// echo phpinfo();

error_reporting(E_ALL);
ini_set('display_errors', '1');

include dirname(__FILE__) . '/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;


// $host = 'db';
// $db = 'itvdn';
// $user = 'root';
// $pass = 'secret';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
//     // получаем и выводим данные  
//     // Выполняем SQL-запрос для выборки данных из таблицы users
//     $stmt = $pdo->query('SELECT * FROM posts');
//     // Получаем ассоциативный массив с результатами
//     $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     var_dump($users);

//     // Выводим результаты
//     echo '<pre>' . print_r($users, true) . '</pre';
// } catch (PDOException $e) {
//     echo 'Ошибка соединения с БД ' . $e->getMessage();
// }

/**
 * Connect to database
 */


//  Flight::register('db', 'mysqli', ['host' => 'mysql:8', 'user' => 'root', 'password' => 'secret', 'db' => 'itvdn']);
//  $db = Flight::db();
//  $result = $db->query("
//       SELECT *
//         FROM posts
//         LIMIT 1
//  ")-> fetch_assoc();
//  print_r($result);


// Register class with constructor parameters
Flight::register('db', PDO::class, ['mysql:host=db;dbname=itvdn', 'root', 'secret']);

// Get an instance of your class
// This will create an object with the defined parameters
//
// new PDO('mysql:host=localhost;dbname=test','user','pass');
//
$db = Flight::db();





//  Flight::register('db', 'mysqli', array('localhost','my_user','my_pass','my_dbname'));
//  Flight::register('db', 'mysqli', array('mysql:3306','root','secret','itvdn'));

//  $db = Flight::db();
 
//  $x = $db->query("SELECT * FROM `posts` LIMIT 1")->fetch_assoc();
 
//  print_r($x);


// Flight::register('db', 'mysqli', array('mysql', 'itvdn', 'root', 'secret'));
// $db = Flight::db();

// Flight::register('db', function() {
//     return new mysqli('db', 'root', 'secret', 'itvdn');
// });

// $db = Flight::db();





// $host = 'db';
// $db = 'itvdn';
// $user = 'root';
// $pass = 'secret';

// // Создаем объект mysqli
// $mysqli = new mysqli($host, $user, $pass, $db);

// // Регистрируем объект mysqli в Flight
// Flight::register('db', $mysqli);

// $db = Flight::db();


// class Database {
//     private $mysqli;

//     public function __construct($host, $user, $pass, $db) {
//         $this->mysqli = new mysqli($host, $user, $pass, $db);
//     }

//     public function query($sql) {
//         return $this->mysqli->query($sql);
//     }

//     // Другие методы, которые вам могут понадобиться
// }

// // Создаем экземпляр класса Database
// $database = new Database('db', 'root', 'secret', 'itvdn');

// // Регистрируем объект Database в Flight
// Flight::register('db', $database);

// // Теперь вы можете получить доступ к базе данных через Flight
// $db = Flight::db();
// $result = $db->query('SELECT * FROM posts');





// ======
// $host = 'db';
// $db = 'itvdn';
// $user = 'root';
// $pass = 'secret';

// try {
//     $mysqli = new mysqli($host, $user, $pass, $db);

//     // проверяем соединение
//     if ($mysqli->connect_error) {
//         die('Ошибка соединения с БД: ' . $mysqli->connect_error);
//     }

//     // Выполняем SQL-запрос для выборки данных из таблицы posts
//     $result = $mysqli->query('SELECT * FROM posts');

//     // Получаем ассоциативный массив с результатами
//     $users = $result->fetch_all(MYSQLI_ASSOC);
//     var_dump($users);

//     // Выводим результаты
//     echo '<pre>' . print_r($users, true) . '</pre>';
    
//     // Закрываем соединение
//     $mysqli->close();
// } catch (Exception $e) {
//     echo 'Ошибка соединения с БД: ' . $e->getMessage();
// }











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
