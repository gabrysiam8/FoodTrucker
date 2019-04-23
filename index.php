<?php
if($_GET['task']=='foodtruck') 
{
    include 'controller/foodtruck.php';
    $ob = new FoodtruckController();
    $ob->$_GET['action']();
} 
else if($_GET['task']=='foodpark') 
{
    include 'controller/foodpark.php';
    $ob = new FoodparkController();
    $ob->$_GET['action']();
}
else if($_GET['task']=='menu') 
{
    include 'controller/menu.php';
    $ob = new MenuController();
    $ob->$_GET['action']();
}
else if($_GET['task']=='event') 
{
    include 'controller/event.php';
    $ob = new EventController();
    $ob->$_GET['action']();
}
else if($_GET['task']=='opinion') 
{
    include 'controller/opinion.php';
    $ob = new OpinionController();
    $ob->$_GET['action']();
}
else if($_GET['task']=='company') 
{
    include 'controller/company.php';
    $ob = new CompanyController();
    $ob->$_GET['action']();
}
else if($_GET['task']=='promo') 
{
    include 'controller/promo.php';
    $ob = new PromoController();
    $ob->$_GET['action']();
}
else 
{
    include 'controller/login.php';
    $ob = new LoginController();
    $ob->index();
}