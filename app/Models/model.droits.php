<?php
  class Droits {
    private $id_droits;
    private $libelle_droits;

    public function id_droits() {return $this->id_droits;}
    public function libelle_droits() {return $this->libelle_droits;}

    public function setId_droits($id) {
      $this->id_droits = $id;
    }

    public function setLibelle_droits($libelle) {
      $this->libelle_droits = $libelle;
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

  class DroitsManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Droits $droits) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO droits(libelle_droits) VALUES(:libelle_droits)');
        $req->bindValue(':libelle_droits', $droits->libelle_droits(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect()->lastInsertId();
    }

    public function delete(Droits $droits) {
      try{
        $this->dbConnect()->exec('DELETE FROM droits WHERE id_droits = '.$droits->id_droits());
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get($id) {
      $id = (int) $id;
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM droits WHERE id_droits = ?');
        $req->execute(array($id));
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $droits = new Droits();
      $droits->hydrate($donnees);
      return $droits;
    }

    public function getAll() {
      $droits = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM droits');

        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $droit = new Droits();
          $droit->hydrate($donnees);
          $droits[] = $droit;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $droits;
    }

    public function update(Droits $droits) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE droits SET libelle_droits = :libelle_droits WHERE id_droits = :id_droits');

        $req->bindValue(':id_droits', $droits->id_droits(), PDO::PARAM_INT);
        $req->bindValue(':libelle_droits', $droits->libelle_droits(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
