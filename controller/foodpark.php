<?php

include 'controller/controller.php';
 
class FoodparkController extends Controller
{
    public function index() 
    {
        $view=$this->loadView('foodpark');
        $view->index();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('foodpark');
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
            $model=$this->loadModel('foodpark');
            $msg = $model->insert($_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=foodpark&action=index';</script>");
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
            $model=$this->loadModel('foodpark');
            $model->delete($_GET['fpId']);
            $this->redirect('?task=foodpark&action=index');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}