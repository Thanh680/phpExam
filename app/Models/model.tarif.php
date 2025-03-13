<?php
  class Tarif {
    private $id_prestation;
    private $id_categorie;
    private $prix;

    public function id_prestation() {return $this->id_prestation;}
    public function id_categorie() {return $this->id_categorie;}
    public function prix() {return $this->prix;}

    public function setId_prestation($id) {
      $this->id_prestation = $id;
    }
    public function setId_categorie($id) {
      $this->id_categorie = $id;
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
        $req = $this->dbConnect()->prepare('INSERT INTO tarif(id_prestation, id_categorie, prix) VALUES(:id_prestation, :id_categorie, :prix)');
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $tarif->id_categorie(), PDO::PARAM_INT);
        $req->bindValue(':prix', $tarif->prix(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect();
    }

    public function delete(Tarif $tarif) {
      try{
        $this->dbConnect()->exec('DELETE FROM tarif WHERE id_categorie = '.$tarif->id_categorie().' AND id_prestation = '.$tarif->id_prestation());
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get(Tarif $tarif) {
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM tarif WHERE id_categorie = :id_categorie AND id_prestation = :id_prestation');
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $tarif->id_categorie(), PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $tarif = new Tarif();
      $tarif->hydrate($donnees);
      return $tarif;
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
        $req = $this->dbConnect()->prepare('UPDATE tarif SET prix = :prix WHERE id_categorie = :id_categorie AND id_prestation = :id_prestation');

        $req->bindValue(':id_categorie', $tarif->id_categorie(), PDO::PARAM_INT);
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':prix', $tarif->prix(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
