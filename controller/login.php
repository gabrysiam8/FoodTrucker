<?php

include 'controller/controller.php';
 
class LoginController extends Controller
{
    public function index() 
    {
        $view=$this->loadView('login');
        $view->index();
    }
}