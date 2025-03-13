<?php
  class Ticket {
    private $id_ticket;
    private $id_carte;
    private $date_achat;

    public function id_ticket() {return $this->id_ticket;}
    public function id_carte() {return $this->id_carte;}
    public function date_achat() {return $this->date_achat;}


    public function setId_ticket($id) {
      $this->id_ticket = $id;
    }

    public function setId_carte($id) {
      $this->id_carte = $id;
    }

    public function setDate_achat($date) {
      $this->date_achat = $date;
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

  class TicketManager {
    private function dbConnect() {
      try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(PDOException $e){ 
        die("OUPSI : Impossible de se connecter à la BDD. " . $e->getMessage());
      }
      return $bdd;
    }

    public function add(Ticket $ticket) {
      try{
        $req = $this->dbConnect()->prepare('INSERT INTO ticket(id_carte, date_achat) VALUES(:id_carte, :date_achat)');
        $req->bindValue(':id_carte', $ticket->id_carte(), PDO::PARAM_STR);
        $req->bindValue(':date_achat', $ticket->date_achat(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){
        die("OUPSI : L'ajout a échouée. " . $e->getMessage());
      }
      return $this->dbConnect()->lastInsertId();
    }

    public function delete(Ticket $ticket) {
      try{
        $this->dbConnect()->prepare('DELETE FROM ticket WHERE id_ticket = :id_ticket');
        $req->bindValue(':id_ticket',$ticket->id_ticket(), PDO::PARAM_STR);
        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La suppression a échouée. " . $e->getMessage());
      }
    }

    public function get($id) {
      $id = (string) $id;
      try{
        $req = $this->dbConnect()->prepare('SELECT * FROM ticket WHERE id_ticket = ?');
        $req->execute(array($id));
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      $ticket = new Ticket();
      $ticket->hydrate($donnees);
      return $ticket;
    }

    public function getAll() {
      $tickets = [];
      try{
        $req = $this->dbConnect()->query('SELECT * FROM ticket');
        while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
          $ticket = new Ticket();
          $ticket->hydrate($donnees);
          $tickets[] = $ticket;
        }
      } catch(PDOException $e){ 
        die("OUPSI : La récupération de donnée a échouée. " . $e->getMessage());
      }
      return $tickets;
    }

    public function update(Ticket $ticket) {
      try{
        $req = $this->dbConnect()->prepare('UPDATE ticket SET id_carte = :id_carte AND date_achat = :date_achat WHERE id_ticket = :id_ticket');

        $req->bindValue(':id_ticket', $ticket->id_ticket(), PDO::PARAM_STR);
        $req->bindValue(':date_achat', $ticket->date_achat(), PDO::PARAM_STR);
        $req->bindValue(':id_carte', $categorie->id_carte(), PDO::PARAM_INT);

        $req->execute();
      } catch(PDOException $e){ 
        die("OUPSI : La modification a échouée. " . $e->getMessage());
      }
    }

  }
?>
