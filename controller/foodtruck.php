<?php

include 'controller/controller.php';
 
class FoodtruckController extends Controller
{
    public function index() 
    {
        $view=$this->loadView('foodtruck');
        $view->index();
    }

    public function getByCompany()
    {
        $view=$this->loadView('foodtruck');
        $view->getByCompany();
    }

    public function selectByCompany()
    {
        $view=$this->loadView('foodtruck');
        $view->selectByCompany($_POST);
    }

    public function getByFoodpark()
    {
        $view=$this->loadView('foodtruck');
        $view->getByFoodpark();
    }

    public function selectByFoodpark()
    {
        $view=$this->loadView('foodtruck');
        $view->selectByFoodpark($_POST);
    }

    public function getByEvent()
    {
        $view=$this->loadView('foodtruck');
        $view->getByEvent();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('foodtruck');
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
            $model=$this->loadModel('foodtruck');
            $msg = $model->insert($_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=foodtruck&action=index';</script>");
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function update()
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $model=$this->loadModel('foodtruck');
            $msg = $model->update($_GET['ftId'], $_POST);
            
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=foodtruck&action=index';</script>");
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
            $model=$this->loadModel('foodtruck');
            $model->delete($_GET['ftId']);
            $this->redirect('?task=foodtruck&action=index');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}