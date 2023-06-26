<?php

namespace app\controller;

use app\core\Request;

class SiteController extends Controller
{

    public function login()
    {
        $this->setLayout('auth');
        $this->render('login');
    }

    public function register(Request $request)
    {
        if ($request->getMethod() === 'post') {
            echo '<pre>';
            var_dump($request->getBody());
            echo '</pre>';
            exit;
        }
        $this->setLayout('auth');
        $this->render('register');
    }

}
