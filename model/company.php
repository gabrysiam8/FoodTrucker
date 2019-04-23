<?php
 
include 'model/model.php';
 
class CompanyModel extends Model
{
    public function getAll() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.firma_info') ;
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function getByPromo() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.firma_info fi, katalog_foodtruck.firma_promocja fp WHERE fi.id_firmy=fp.id_firmy AND fp.id_promocji=:promoId') ;
        $sth->bindValue(':promoId', $_GET['promoId'], PDO::PARAM_INT);
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function getByDish() 
    {
        $sth = $this->pdo->prepare('SELECT * FROM katalog_foodtruck.firma_info fi, katalog_foodtruck.firma_danie fd WHERE fi.id_firmy=fd.id_firmy AND fd.id_dania=:dishId') ;
        $sth->bindValue(':dishId', $_GET['dishId'], PDO::PARAM_INT);
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function insert($data) 
    {
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_firme (:nazwa_f, :nip)');
        $sth->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->bindValue(':nip', $data['nip'], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result['dodaj_firme'];
    }

    public function update($id, $data) 
    {
        $up=$this->pdo->prepare('SELECT katalog_foodtruck.zaktualizuj_firme (:nazwa_f, :nip, :id)');
        $up->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $up->bindValue(':nip', $data['nip'], PDO::PARAM_STR);
        $up->bindValue(':id', $id, PDO::PARAM_INT);
        $up->execute();
        $result = $up->fetch();
        return $result['zaktualizuj_firme'];
    }

    public function delete($id) 
    {
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.firma where id_firmy=:id');
        $del->bindValue(':id', $id, PDO::PARAM_INT);
        $del->execute();
    }
}