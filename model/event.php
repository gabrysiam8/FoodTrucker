<?php
 
include 'model/model.php';
 
class EventModel extends Model
{
    public function getAll()
    {
        $sth = $this->pdo->prepare('SELECT w.id_wydarzenia, w.nazwa, w.data, a.miasto, a.ulica, a.numer FROM katalog_foodtruck.wydarzenie w JOIN katalog_foodtruck.adres a USING (id_adresu) ORDER BY w.data') ;
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function getFuture()
    {
        $sth = $this->pdo->prepare('SELECT w.id_wydarzenia, w.nazwa, w.data, a.miasto, a.ulica, a.numer FROM katalog_foodtruck.wydarzenie w JOIN katalog_foodtruck.adres a USING (id_adresu) WHERE w.data>DATE(NOW()) ORDER BY w.data') ;
        $sth->execute() ;
        $result = $sth->fetchAll() ;
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
            $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_wydarzenie (:nazwa_w, :data_w, :miasto, :kod_pocz, :ulica, :numer)');
            $sth->bindValue(':nazwa_w', $data['nazwa_w'], PDO::PARAM_STR);
            $sth->bindValue(':data_w', $data['data_w'], PDO::PARAM_STR);
            $sth->bindValue(':miasto', $data['miasto'], PDO::PARAM_STR);
            $sth->bindValue(':kod_pocz', $data['kod_pocz'], PDO::PARAM_STR);
            $sth->bindValue(':ulica', $data['ulica'], PDO::PARAM_STR);
            $sth->bindValue(':numer', $data['numer'], PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetch();
            $sth=$this->pdo->prepare('COMMIT');
            $sth->execute();
            return $result['dodaj_wydarzenie'];
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
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.wydarzenie where id_wydarzenia=:id');
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
    }

    public function insertFoodtruckEvent($id, $data) 
    {
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_foodtruck_wydarzenie(:id, :nazwa_f, :nazwa_p)');
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->bindValue(':nazwa_p', $data['nazwa_p'], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result['dodaj_foodtruck_wydarzenie'];
    }
}