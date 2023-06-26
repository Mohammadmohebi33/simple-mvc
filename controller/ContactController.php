<?php

namespace app\controller;

use app\core\Application;
use app\core\Request;

class ContactController extends Controller
{


    public function contact()
    {
        $params = [
            "name" => "mohammad",
        ];

        $this->render('contact' , $params);
    }



    public function handelContact(Request $request)
    {
        if ($request->isPost()){
            var_dump($request->getBody());
        }
//      $data =  Application::$app->request->getBody();
//      var_dump($data);
    }
}
