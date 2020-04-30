<?php

/** @var Phalcon\Mvc\Router $router */
$router = $di->getRouter(false);
// Define your routes here

// Site Frontend page
$router->add('/', ['controller' => 'index', 'action' => 'index']);

// Auth Routes
$router->add('/login', ['controller' => 'user', 'action' => 'login'])->setName('login');
$router->add('/logout', ['controller' => 'user', 'action' => 'logout'])->setName('logout');
$router->add('/register', ['controller' => 'user', 'action' => 'register'])->setName('register');
$router->add('/forget', ['controller' => 'user', 'action' => 'forget'])->setName('forget');

// Home page need is Auth
$router->add('/home', ['controller' => 'home', 'action' => 'index'])->setName('home');


$router->notFound(['controller' => 'errors', 'action' => 'show404']);

$router->handle($_SERVER['REQUEST_URI']);
