<?php

include 'view/view.php';
 
class LoginView extends View
{
    public function  index() 
    {
        $login=$this->loadModel('login');
        $this->render('login');
    }
}