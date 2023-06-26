<?php

namespace app\core;

use app\controller\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Router;



class Application
{

    public Router $router ;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static Application $app ;



    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request , $this->response);
        $this->controller = new Controller();
        self::$app = $this;
    }



    public function run()
    {
       $this->router->resovle();
    }
}
