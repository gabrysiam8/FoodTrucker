<?php
 
include 'model/model.php';
 
class MenuModel extends Model
{
    public function getAll() 
    {
        $sth = $this->pdo->prepare('SELECT d.id_dania, d.nazwa AS nazwa_d, t.nazwa AS nazwa_t FROM katalog_foodtruck.danie d, katalog_foodtruck.typ_kuchni t WHERE t.id_typu_kuch=d.id_typu_kuch') ;
        $sth->execute() ;
        $result = $sth->fetchAll();
        return $result ;
    }

    public function selectByCompany($data) 
    {
        $sth = $this->pdo->prepare('SELECT f.id_firmy, d.id_dania, d.nazwa AS nazwa_d, t.nazwa AS nazwa_t FROM katalog_foodtruck.danie d,katalog_foodtruck.typ_kuchni t, katalog_foodtruck.firma_danie fd, katalog_foodtruck.firma f 
            WHERE LOWER(f.nazwa)=LOWER(:nazwa) AND fd.id_firmy=f.id_firmy AND fd.id_dania=d.id_dania AND t.id_typu_kuch=d.id_typu_kuch');
        $sth->bindValue(':nazwa', $data['nazwa_f'], PDO::PARAM_STR);
        $sth->execute() ;
        $result = $sth->fetchAll() ;
        return $result ;
    }

    public function insert($id_firmy, $data) 
    {
        $sth=$this->pdo->prepare('BEGIN');
        $sth->execute();
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_danie (:nazwa_d, :nazwa_t)');
        $sth->bindValue(':nazwa_d', $data['nazwa_d'], PDO::PARAM_STR);
        $sth->bindValue(':nazwa_t', $data['nazwa_t'], PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        
        $sth=$this->pdo->prepare('SELECT katalog_foodtruck.dodaj_firma_danie (:id_firmy, :id_dania)');
        $sth->bindValue(':id_firmy', $id_firmy, PDO::PARAM_INT);
        $sth->bindValue(':id_dania', $result['dodaj_danie'], PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch();
        $sth=$this->pdo->prepare('COMMIT');
        $sth->execute();
        return $result['dodaj_firma_danie'];
    }

    public function delete($id_firmy, $id_dania) 
    {
        $del=$this->pdo->prepare('DELETE FROM katalog_foodtruck.firma_danie WHERE id_firmy=:id_firmy AND id_dania=:id_dania');
        $del->bindValue(':id_firmy', $id_firmy, PDO::PARAM_INT);
        $del->bindValue(':id_dania', $id_dania, PDO::PARAM_INT);
        $del->execute();
    }
}