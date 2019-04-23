<?php

include 'view/view.php';
 
class FoodparkView extends View
{
    public function  index() 
    {
        $foodparks=$this->loadModel('foodpark');
        $this->set('foodparkData', $foodparks->getAll());
        $this->render('indexFoodpark');
    }

    public function  add() 
    {
        $this->render('addFoodpark');
    }
}