<?php

include 'view/view.php';
 
class CompanyView extends View
{
    public function index() 
    {
        $companies=$this->loadModel('company');
        $this->set('companyData', $companies->getAll());
        $this->render('indexCompany');
    }

    public function getByPromo() 
    {
        $companies=$this->loadModel('company');
        $this->set('companyData', $companies->getByPromo());
        $this->render('indexCompany');
    }

    public function getByDish() 
    {
        $companies=$this->loadModel('company');
        $this->set('companyData', $companies->getByDish());
        $this->render('indexCompany');
    }

    public function  add() 
    {
        $this->render('addCompany');
    }
}