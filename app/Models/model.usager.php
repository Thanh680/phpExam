<?php
  class Usager {
    private $id_carte;
    private $nom;
    private $id_categorie;
    private $montant_caution;
    private $date_carte;

    public function id_carte() {return $this->id_carte;}
    public function nom() {return $this->nom;}
    public function id_categorie() {return $this->id_categorie;}
    public function montant_caution() {return $this->montant_caution;}
    public function date_carte() {return $this->date_carte;}

    public function setId_carte($id) {
      $this->id_carte = $id;
    }

    public function setNom($nom) {
      $this->nom = $nom;
    }

    public function setId_categorie($id) {
      $this->id_categorie = $id;
    }

    public function setMontant_caution($montant) {
      $this->montant_caution = $montant;
    }

    public function setDate_carte($date) {
      $this->date_carte = $date;
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

  class usagerManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Usager $usager) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO usager(id_carte, nom, id_categorie, montant_caution, date_carte) VALUES(:id_carte,: nom, :id_categorie, :montant_caution, :date_carte)');
        $req->bindValue(':id_carte', $usager->id_carte(), PDO::PARAM_STR);
        $req->bindValue(':nom', $usager->nom(), PDO::PARAM_STR);
        $req->bindValue(':id_categorie', $usager->id_categorie(), PDO::PARAM_INT);
        $req->bindValue(':montant_caution', $usager->montant_caution(), PDO::PARAM_INT);
        $req->bindValue(':date_carte', $usager->date_carte(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect()->lastInsertId();
    }

    public function delete(Usager $usager) {
      try{
        $req->dbConnect()->exec('DELETE FROM usager WHERE id_carte = '.$usager->id_carte());
        $req->bindValue(':id_carte', $usager->id_carte(), PDO::PARAM_STR);
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get($id) {
      $id = (string) $id;
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM usager WHERE id_carte = ?');
        $req->execute(array($id));
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $categorie = new Usager();
      $categorie->hydrate($donnees);
      return $categorie;
    }

    public function getAll() {
      $usagers = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM usager');
        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $usager = new Usager();
          $usager->hydrate($donnees);
          $usagers[] = $usager;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $usagers;
    }

    public function update(Usager $usager) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE usager SET montant_caution = :montant_caution WHERE id_categorie = :id_categorie');

        $req->bindValue(':id_categorie', $categorie->id_categorie(), PDO::PARAM_INT);
        $req->bindValue(':montant_caution', $categorie->montant_caution(), PDO::PARAM_STR);

        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
