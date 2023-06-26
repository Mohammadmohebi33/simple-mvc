<?php


use app\controller\ContactController;
use app\controller\SiteController;

require_once '../vendor/autoload.php';

$app = new app\core\Application();

$app->router->get('/' , 'home');
$app->router->get('/user' , function (){
    return "Users";
});
$app->router->get('/contact' , [ContactController::class , 'contact']);
$app->router->post('/contact' ,  [ContactController::class , 'handelContact']);


$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [SiteController::class, 'register']);
$app->router->get('/login', [SiteController::class, 'login']);


$app->run();

