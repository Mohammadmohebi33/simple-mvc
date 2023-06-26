<?php

namespace app\controller;

use app\core\Application;

class Controller
{
    public string $layout = 'main';

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function render($view , $params = [])
    {
        Application::$app->router->renderView($view , $params);
    }
}
