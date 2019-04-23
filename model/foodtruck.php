<?php
 
include 'model/model.php';
 
class FoodtruckModel extends Model
{

    public function insert($data) 
    {
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_foodtruck (:nazwa_f, :nazwa_p, :godzina_otwarcia, :godzina_zamkniecia, :telefon)');
        $sth->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->bindValue(':nazwa_p', $data['nazwa_p'], PDO::PARAM_STR);
        $sth->bindValue(':godzina_otwarcia', $data['godz_otwarcia'], PDO::PARAM_STR);
        $sth->bindValue(':godzina_zamkniecia', $data['godz_zamkniecia'], PDO::PARAM_STR);
        $sth->bindValue(':telefon', $data['telefon'], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result['dodaj_foodtruck'];
    }

    public function getAll() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.foodtruck_info') ;
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function selectByCompany($data) 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.foodtruck_info WHERE LOWER(nazwa_f)=LOWER(:nazwa)') ;
        $sth->bindValue(':nazwa', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function selectByFoodpark($data) 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.foodtruck_info WHERE LOWER(nazwa_p)=LOWER(:nazwa)') ;
        $sth->bindValue(':nazwa', $data['nazwa_p'], PDO::PARAM_STR);
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function getByEvent() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.foodtruck_info fi, katalog_foodtruck.wydarzenie_foodtruck wf WHERE fi.id_foodtrucka=wf.id_foodtrucka AND wf.id_wydarzenia=:eventId') ;
        $sth->bindValue(':eventId', $_GET['eventId'], PDO::PARAM_INT);
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function update($id, $data) 
    {
        $up=$this->pdo->prepare('SELECT katalog_foodtruck.zaktualizuj_foodtruck (:nazwa_f, :nazwa_p, :godzina_otwarcia, :godzina_zamkniecia, :telefon, :id)');
        $up->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $up->bindValue(':nazwa_p', $data['nazwa_p'], PDO::PARAM_STR);
        $up->bindValue(':godzina_otwarcia', $data['godz_otwarcia'], PDO::PARAM_STR);
        $up->bindValue(':godzina_zamkniecia', $data['godz_zamkniecia'], PDO::PARAM_STR);
        $up->bindValue(':telefon', $data['telefon'], PDO::PARAM_STR);
        $up->bindValue(':id', $id, PDO::PARAM_INT);
        $up->execute();
        $result = $up->fetch();
        return $result['zaktualizuj_foodtruck'];
    }

    public function delete($id) 
    {
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.foodtruck where id_foodtrucka=:id');
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
    }
}