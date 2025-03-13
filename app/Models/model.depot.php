<?php
  class Depot {
    private $id_carte;
    private $date_depot;
    private $montant;

    public function id_carte() {return $this->id_carte;}
    public function date_depot() {return $this->date_depot;}
    public function montant() {return $this->montant;}

    public function setId_carte($id) {
      $this->id_carte = $id;
    }
    public function setDate_depot($date) {
      $this->date_depot = $date;
    }
    public function setMontant($montant) {
      $this->montant = $montant;
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

  class DepotManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Depot $depot) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO depot(id_carte, date_depot, prix) VALUES(:id_carte, :date_depot, :montant)');
        $req->bindValue(':id_carte', $tarif->id_carte(), PDO::PARAM_STR);
        $req->bindValue(':date_depot', $tarif->date_depot(), PDO::PARAM_STR);
        $req->bindValue(':montant', $tarif->montant(), PDO::PARAM_INT);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect();
    }

    public function delete(Depot $depot) {
      try{
        $this->dbConnect()->exec('DELETE FROM depot WHERE id_carte = '.$depot->id_carte().' AND date_depot = '.$depot->date_depot());
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get(Depot $depot) {
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM depot WHERE id_carte = :id_carte AND date_depot = :date_depot');
        $req->bindValue(':id_carte', $tarif->id_carte(), PDO::PARAM_STR);
        $req->bindValue(':date_depot', $tarif->date_depot(), PDO::PARAM_STR);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $depot = new Depot();
      $depot->hydrate($donnees);
      return $depot;
    }

    public function getAll() {
      $depots = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM depot');

        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $depot = new Depot();
          $depot->hydrate($donnees);
          $depots[] = $depot;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $depots;
    }

    public function update(Depot $depot) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE depot SET montant = :montant WHERE id_carte = :id_carte AND date_depot = :date_depot');

        $req->bindValue(':id_carte', $tarif->id_carte(), PDO::PARAM_STR);
        $req->bindValue(':date_depot', $tarif->date_depot(), PDO::PARAM_STR);
        $req->bindValue(':montant', $tarif->montant(), PDO::PARAM_INT);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
