<?php

namespace app\controller;

use app\core\Request;
use app\model\RegisterModel;

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

            $registerModel = new RegisterModel();
            $registerModel->loadData($request->getBody());

            echo "<pre>";
            var_dump($registerModel);
            echo "</pre>";

            if ($registerModel->validate() && $registerModel->register()){
                return "success";
            }
            $this->render('register' , ['model' => $registerModel]);
        }

        $this->setLayout('auth');
        $this->render('register');
    }

}
