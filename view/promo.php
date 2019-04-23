<?php

include 'view/view.php';
 
class PromoView extends View
{
    public function index() 
    {
        $promo=$this->loadModel('promo');
        $this->set('promoData', $promo->getAll());
        $this->render('indexPromo');
    }

    public function getActual() 
    {
        $promo=$this->loadModel('promo');
        $this->set('promoData', $promo->getActual());
        $this->render('indexPromo');
    }

    public function  add() 
    {
        $this->render('addPromo');
    }

    public function  addCompany() 
    {
        $this->render('addCompany');
    }
}