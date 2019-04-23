<?php
 
include 'model/model.php';
 
class OpinionModel extends Model
{
    public function insert($data) 
    {
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_opinie (:nazwa_f, :ocena, :info, :autor)');
        $sth->bindValue(':nazwa_f', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->bindValue(':ocena', $data['ocena'], PDO::PARAM_STR);
        $sth->bindValue(':info', $data['info'], PDO::PARAM_STR);
        $sth->bindValue(':autor', $data['autor'], PDO::PARAM_STR);
        $sth->execute() ;
        $result = $sth->fetch();
        return $result['dodaj_opinie'];
    }
}