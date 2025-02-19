<?php
  class Prestation {
    private $id_prestation;
    private $type_prestation;

    public function id_prestation() {return $this->id_prestation;}
    public function type_prestation() {return $this->type_prestation;}

    public function setId_prestation($id) {
      $this->id_prestation = $id;
    }

    public function setType_prestation($type) {
      $this->type_prestation = $type;
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

  class PrestationManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Prestation $prestation) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO prestation(type_prestation) VALUES(:type_prestation)');
        $req->bindValue(':type_prestation', $prestation->type_prestation(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect()->lastInsertId();
    }

    public function delete(Prestation $prestation) {
      try{
        $this->dbConnect()->exec('DELETE FROM prestation WHERE id_prestation = '.$prestation->id_prestation());
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get($id) {
      $id = (int) $id;
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM prestation WHERE id_prestation = ?');
        $req->execute(array($id));
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $prestation = new Prestation();
      $prestation->hydrate($donnees);
      return $prestation;
    }

    public function getAll() {
      $prestations = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM prestation');

        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $presta = new Prestation();
          $presta->hydrate($donnees);
          $prestations[] = $presta;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $prestations;
    }

    public function update(Prestation $prestation) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE prestation SET type_prestation = :type_prestation WHERE id_prestation = :id_prestation');

        $req->bindValue(':id_prestation', $prestation->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':type_prestation', $prestation->type_prestation(), PDO::PARAM_STR);

        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
