<?php
  class Tarif {
    private $id_prestation;
    private $id_tarif;
    private $prix;

    public function id_prestation() {return $this->id_prestation;}
    public function id_Tarif() {return $this->id_tarif;}
    public function prix() {return $this->prix;}

    public function setId_prestation($id) {
      $this->id_prestation = $id;
    }

    public function setId_Tarif($id) {
      $this->id_tarif = $id;
    }
    public function setPrix($prix) {
      $this->prix = $prix;
    }

    public function hydrate(array $donnees) {
      foreach ($donnees as $key => $value) {
        $method = 'set'.ucfirst($key);
        if(method_exists($this, $method)) {
          $this->$method($value);
        }
      }
    }
  }

  class TarifManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Tarif $tarif) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO tarif(id_prestation, id_tarif, prix) VALUES(:id_prestation, :id_tarif, :prix)');
        $req->bindValue(':id_prestation', $tarif->id_prestation());
        $req->bindValue(':id_tarif', $tarif->id_tarif());
        $req->bindValue(':prix', $tarif->prix());
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect();
    }

    public function delete(Tarif $tarif) {
      try{
        $this->dbConnect()->exec('DELETE FROM tarif WHERE id_tarif = '.$tarif->id_tarif().' AND id_prestation = '.$tarif->id_prestation());
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get(Tarif $tarif) {
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM tarif WHERE id_tarif = :id_tarif AND id_prestation = :id_prestation');
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':id_tarif', $tarif->id_tarif(), PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $Tarif = new Tarif();
      $Tarif->hydrate($donnees);
      return $Tarif;
    }

    public function getAll() {
      $tarifs = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM tarif');

        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $tarif = new Tarif();
          $tarif->hydrate($donnees);
          $tarifs[] = $tarif;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $tarifs;
    }

    public function update(Tarif $tarif) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE tarif SET prix = :prix WHERE id_tarif = :id_tarif AND id_prestation = :id_prestation');

        $req->bindValue(':id_tarif', $tarif->id_tarif(), PDO::PARAM_INT);
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':prix', $tarif->prix(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
