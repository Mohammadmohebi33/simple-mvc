<?php

namespace app\core;


use app\core\Request;

class Router
{
    public Request $request;
    public Response $response;
    public array $routes = [];

    /**
     * @param array $routes
     */
    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path , $callback)
    {
        $this->routes['get'][$path] = $callback;
    }


    public function post($path , $callback)
    {
        $this->routes['post'][$path] = $callback;
    }



    public function resovle()
    {
       $path =  $this->request->getPath();
       $method = $this->request->getMethod();

       $callback = $this->routes[$method][$path] ?? false ;

       if ($callback === false){
           $this->response->setStatusCode(404);
           return $this->renderView('_404');
       }
       if (is_string($callback)){
           return $this->renderView($callback);
       }
       if (is_array($callback)){
           $callback[0] = new $callback[0]();
       }

       echo call_user_func($callback, $this->request);
    }




    public function renderView($view , $params = [])
    {
        if (!file_exists("../view/$view.php")){
            $this->renderView('_404');
        }
         $layoutName = Application::$app->controller->layout;
         $viewContent = $this->renderOnlyView($view , $params);
         ob_start();
         include_once "../view/layout/$layoutName.php";
         $layoutContent = ob_get_clean();
         echo str_replace('{{content}}', $viewContent, $layoutContent);
    }



    public function renderOnlyView($view , $params)
    {
        foreach ($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once "../view/$view.php";
        return ob_get_clean();
    }
}
