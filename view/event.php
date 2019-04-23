<?php

include 'view/view.php';
 
class EventView extends View
{
    public function index() 
    {
        $event=$this->loadModel('event');
        $this->set('eventData', $event->getAll());
        $this->render('indexEvent');
    }

    public function getFuture() 
    {
        $event=$this->loadModel('event');
        $this->set('eventData', $event->getFuture());
        $this->render('indexEvent');
    }

    public function  add() 
    {
        $this->render('addEvent');
    }

    public function  addFoodtruck() 
    {
        $this->render('addFoodtruck');
    }
}