<?php

include 'controller/controller.php';
 
class CompanyController extends Controller
{
    public function index() 
    {
        $view=$this->loadView('company');
        $view->index();
    }

    public function getByPromo()
    {
        $view=$this->loadView('company');
        $view->getByPromo();
    }

    public function getByDish()
    {
        $view=$this->loadView('company');
        $view->getByDish();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('company');
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
            $model=$this->loadModel('company');
            $msg = $model->insert($_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=company&action=index';</script>");
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
            $model=$this->loadModel('company');
            $msg = $model->update($_GET['compId'], $_POST);
            
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
            $model=$this->loadModel('company');
            $model->delete($_GET['compId']);
            $this->redirect('?task=company&action=index');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}