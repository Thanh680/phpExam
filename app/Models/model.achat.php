<?php
  class Achat {
    private $id_ticket;
    private $id_prestation;
    private $nombre;

    public function id_ticket() {return $this->id_ticket;}
    public function id_prestation() {return $this->id_prestation;}
    public function nombre() {return $this->nombre;}

    public function setId_ticket($id) {
      $this->id_ticket = $id;
    }

    public function setId_prestation($id) {
      $this->id_prestation = $id;
    }

    public function setNombre($nombre) {
      $this->nombre = $nombre;
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

  class AchatManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Achat $achat) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO achat(id_ticket, id_prestation, nombre) VALUES(:id_ticket, :id_prestation, :nombre)');
        $req->bindValue(':id_ticket', $tarif->id_ticket(), PDO::PARAM_STR);
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':nombre', $tarif->nombre(), PDO::PARAM_INT);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect();
    }

    public function delete(Achat $achat) {
      try{
        $this->dbConnect()->prepare('DELETE FROM achat WHERE id_ticket = '.$achat->id_ticket().' AND id_prestation = '.$achat->id_prestation());
        $req->bindValue(':id_ticket',$achat->id_ticket(), PDO::PARAM_STR);
        $req->bindValue(':id_prestation',$achat->id_prestation(), PDO::PARAM_INT);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get(Achat $achat) {
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM achat WHERE id_ticket = :id_ticket AND id_prestation = :id_prestation');
        $req->bindValue(':id_ticket', $achat->id_ticket(), PDO::PARAM_STR);
        $req->bindValue(':id_prestation', $achat->id_prestation(), PDO::PARAM_INT);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $achat = new Achat();
      $achat->hydrate($donnees);
      return $achat;
    }

    public function getAll() {
      $achats = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM achat');
        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $achat = new Achat();
          $achat->hydrate($donnees);
          $achats[] = $achat;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $achats;
    }

    public function update(Achat $achat) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE achat SET nombre = :nombre WHERE id_ticket = :id_ticket AND id_prestation = :id_prestation');

        $req->bindValue(':id_ticket', $tarif->id_ticket(), PDO::PARAM_STR);
        $req->bindValue(':id_prestation', $tarif->id_prestation(), PDO::PARAM_INT);
        $req->bindValue(':nombre', $tarif->nombre(), PDO::PARAM_INT);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
