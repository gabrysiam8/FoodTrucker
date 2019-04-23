<?php

include 'view/view.php';
 
class OpinionView extends View
{
    public function add()
    {
        $this->render('addOpinion');
    }
}