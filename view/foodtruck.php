<?php

include 'view/view.php';
 
class FoodtruckView extends View
{
    public function index() 
    {
        $foodtrucks=$this->loadModel('foodtruck');
        $this->set('foodtruckData', $foodtrucks->getAll());
        $this->render('indexFoodtruck');
    }

    public function getByCompany() 
    {
        $companies=$this->loadModel('company');
        $this->set('companyData', $companies->getAll());
        $this->render('getByCompany');
    }

    public function selectByCompany($data) 
    {
        $foodtrucks=$this->loadModel('foodtruck');
        $this->set('foodtruckData', $foodtrucks->selectByCompany($data));
        $this->render('indexFoodtruck');
    }

    public function getByFoodpark() 
    {
        $foodparks=$this->loadModel('foodpark');
        $this->set('foodparkData', $foodparks->getAll());
        $this->render('getByFoodpark');
    }

    public function selectByFoodpark($data) 
    {
        $foodtrucks=$this->loadModel('foodtruck');
        $this->set('foodtruckData', $foodtrucks->selectByFoodpark($data));
        $this->render('indexFoodtruck');
    }

    public function getByEvent() 
    {
        $foodtrucks=$this->loadModel('foodtruck');
        $this->set('foodtruckData', $foodtrucks->getByEvent());
        $this->render('indexFoodtruck');
    }

    public function  add() 
    {
        $this->render('addFoodtruck');
    }
}