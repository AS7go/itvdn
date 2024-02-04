<?php

Flight::route('/', array('MainController', 'index'));

Flight::route('/posts', array('BlogController', 'list'));
Flight::route('/post/create', array('BlogController', 'create'));
Flight::route('/post/update/@id', function($id) {BlogController::update($id); });
Flight::route('/post/show/@id', function($id) {BlogController::show($id); });
Flight::route('/post/delete/@id', function($id) {BlogController::delete($id); });
