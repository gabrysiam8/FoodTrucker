<?php

include 'controller/controller.php';
 
class EventController extends Controller
{
    public function index()
    {
        $view=$this->loadView('event');
        $view->index();
    }

    public function getFuture()
    {
        $view=$this->loadView('event');
        $view->getFuture();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('event');
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
            $model=$this->loadModel('event');
            $msg = $model->insert($_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=event&action=index';</script>");
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
            $model=$this->loadModel('event');
            $model->delete($_GET['eventId']);
            $this->redirect('?task=event&action=index');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function addFoodtruck() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('event');
            $view->addFoodtruck();
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function insertFoodtruckEvent() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $model=$this->loadModel('event');
            $msg = $model->insertFoodtruckEvent($_GET['eventId'], $_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=event&action=index';</script>");
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}