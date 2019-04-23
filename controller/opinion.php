<?php

include 'controller/controller.php';
 
class OpinionController extends Controller
{
    public function add()
    {
        $view=$this->loadView('opinion');
        $view->add();
    }

    public function insert()
    {
        $model=$this->loadModel('opinion');
        $msg = $model->insert($_POST);
        echo ("<script type='text/javascript'>alert('$msg')
          window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=company&action=index';</script>");
    }
}