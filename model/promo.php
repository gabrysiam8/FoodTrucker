<?php
 
include 'model/model.php';
 
class PromoModel extends Model
{
    public function getAll()
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.promocja p ORDER BY p.start') ;
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function getActual()
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.promocja p WHERE p.koniec>DATE(NOW()) ORDER BY p.start') ;
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function insert($data) 
    {
        $sth=$this->pdo->prepare('INSERT INTO katalog_foodtruck.promocja(rodzaj, start, koniec) VALUES (:rodzaj, :start, :koniec)');
        $sth->bindValue(':rodzaj', $data['rodzaj'], PDO::PARAM_STR);
        $sth->bindValue(':start', $data['start'], PDO::PARAM_STR);
        $sth->bindValue(':koniec', $data['koniec'], PDO::PARAM_STR);
        $sth->execute();
    }

    public function delete($id) 
    {
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.promocja where id_promocji=:id');
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
    }

    public function insertCompanyPromo($id, $data) 
    {
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_firma_promocja(:id, :nazwa_f)');
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result['dodaj_firma_promocja'];
    }
}