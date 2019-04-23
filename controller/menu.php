<?php

include 'controller/controller.php';
 
class MenuController extends Controller
{
    public function index() 
    {
        $view=$this->loadView('menu');
        $view->index();
    }

    public function getByCompany()
    {
        $view=$this->loadView('menu');
        $view->getByCompany();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('menu');
            $view->add();
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
    
    public function insert() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $model=$this->loadModel('menu');
            $msg = $model->insert($_GET['compId'], $_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=company&action=index';</script>");
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function delete() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $model=$this->loadModel('menu');
            $model->delete($_GET['compId'], $_GET['dishId']);
            $this->redirect('?task=menu&action=getByCompany');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}