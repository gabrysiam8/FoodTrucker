<?php
 
include 'model/model.php';
 
class FoodparkModel extends Model
{
    public function getAll() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.foodpark_info') ;
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function insert($data) 
    {
        $sth=$this->pdo->prepare('BEGIN');
        $sth->execute();
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_adres (:miasto, :kod_pocz, :ulica, :numer)');
        $sth->bindValue(':miasto', $data['miasto'], PDO::PARAM_STR);
        $sth->bindValue(':kod_pocz', $data['kod_pocz'], PDO::PARAM_STR);
        $sth->bindValue(':ulica', $data['ulica'], PDO::PARAM_STR);
        $sth->bindValue(':numer', $data['numer'], PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch();
        if($result['dodaj_adres'] == '')
        {
            $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_foodpark (:nazwa_p, :miasto, :kod_pocz, :ulica, :numer)');
            $sth->bindValue(':nazwa_p', $data['nazwa_p'], PDO::PARAM_STR);
            $sth->bindValue(':miasto', $data['miasto'], PDO::PARAM_STR);
            $sth->bindValue(':kod_pocz', $data['kod_pocz'], PDO::PARAM_STR);
            $sth->bindValue(':ulica', $data['ulica'], PDO::PARAM_STR);
            $sth->bindValue(':numer', $data['numer'], PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetch();
            $sth=$this->pdo->prepare('COMMIT');
            $sth->execute();
            return $result['dodaj_foodpark'];
        }
        else
        {
            $sth=$this->pdo->prepare('ROLLBACK');
            $sth->execute();
            return $result['dodaj_adres'];
        }
    }

    public function delete($id) 
    {
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.foodpark where id_foodparku=:id');
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
    }
}