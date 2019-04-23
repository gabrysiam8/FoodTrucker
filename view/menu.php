<?php

include 'view/view.php';
 
class MenuView extends View
{
    public function  index() 
    {
        $menu=$this->loadModel('menu');
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->set('menuData', $menu->selectByCompany($_POST));
        }
        else
        {
            $this->set('menuData', $menu->getAll());
        }
        $this->render('indexMenu');
    }

    public function getByCompany() 
    {
        $companies=$this->loadModel('company');
        $this->set('companyData', $companies->getAll());
        $this->render('getMenuByCompany');
    }

    public function  add() 
    {
        $this->render('addMenu');
    }
}