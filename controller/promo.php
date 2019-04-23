<?php

include 'controller/controller.php';
 
class PromoController extends Controller
{
    public function index()
    {
        $view=$this->loadView('promo');
        $view->index();
    }

    public function getActual()
    {
        $view=$this->loadView('promo');
        $view->getActual();
    }

    public function add() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('promo');
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
            $model=$this->loadModel('promo');
            $model->insert($_POST);
            $this->redirect('?task=promo&action=index');
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
            $model=$this->loadModel('promo');
            $model->delete($_GET['promoId']);
            $this->redirect('?task=promo&action=index');
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function addCompany() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $view=$this->loadView('promo');
            $view->addCompany();
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }

    public function insertCompanyPromo() 
    {
        if (session_id() == "") 
        {
            session_start();
        }
        if($_SESSION['username'] == 'admin')
        {
            $model=$this->loadModel('promo');
            $msg = $model->insertCompanyPromo($_GET['promoId'], $_POST);
            echo ("<script type='text/javascript'>alert('$msg')
            window.location.href='http://pascal.fis.agh.edu.pl/~6miedlar/BD/index.php?task=promo&action=index';</script>");
        }
        else
        {
            $view=$this->loadView('login');
            $view->index();
        }
    }
}