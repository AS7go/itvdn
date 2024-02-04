<?php

class MainController
{

    public function __construct() {}

    public static function index()  // Метод не должен быть static
    {
        // echo "Hello ITVDN! =========";
        // Flight::view()->render('views/template.html', []);
        // Flight::view()->render('template.html', ['name' => 'John Doe']);

        // Flight::view()->display('views/template.html', []); // display устарело, используйте render
        Flight::view()->display('template.html', []); // display устарело, используйте render
        // Flight::view()->display('post/create.php', []); // display устарело, используйте render
    }
}



// class MainController
// {

//     public function __construct()
//     {
//     }

//     public static function index()
//     {
//         echo "Hello ITVDN! =========";
//         // Flight::view()->render('views/template.html', []);
//         // Flight::view()->render('template.html', ['name' => 'John Doe']);

//         // Flight::view()->display('template.html', []);

//     }

//     // public static function test($name) {
//     //     Flight::view()->render('template.html', ["name"=>$name]);
//     // }

//     // public static function index() {
//     //     echo 'Hello world1111!';
//     // }

//     // public static function test($name) {
//     //     // Flight::view()->display('template.html', ["name"=>$name]);//устарело в Flight теперь render
//     //     Flight::view()->render('template.html', ["name"=>$name]);
//     // }

// }
