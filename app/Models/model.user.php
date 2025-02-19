<?php

  class User {
    private $id_users;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $avatar;
    private $droits;

    public function id_users() {return $this->id_users;}
    public function nom() {return $this->nom;}
    public function prenom() {return $this->prenom;}
    public function mail() {return $this->mail;}
    public function password() {return $this->password;}
    public function avatar() {return $this->avatar;}
    public function droits() {return $this->droits;}

    public function setId_users($id) {
      $this->id_users =$id;
    }

    public function setNom($nom) {
      $this->nom =$nom;
    }

    public function setPrenom($prenom) {
      $this->prenom =$prenom;
    }

    public function setMail($mail) {
      $this->mail =$mail;
    }

    public function setPassword($password) {
      $this->password =$password;
    }

    public function setAvatar($avatar) {
      $this->avatar =$avatar;
    }

    public function setDroits($droits) {
      $this->droits =$droits;
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

  class UserManager {
    private function dbConnect() {
      $bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      return $bdd;
    }

    public function add(User $user) {

      $req = $this->dbConnect()->prepare('INSERT INTO users(nom, prenom, mail, password, avatar, droits) VALUES(:nom, :prenom, :mail, :password, :avatar, :droits)');
      $req->bindValue(':nom', $user->nom(),
       PDO::PARAM_STR);
      $req->bindValue(':prenom', $user->prenom(),
      PDO::PARAM_STR);
      $req->bindValue(':mail', $user->mail());
      $req->bindValue(':password', $user->password(), PDO::PARAM_STR);
      $req->bindValue(':avatar', $user->avatar());
      $req->bindValue(':droits', $user->droits());
  
      $req->execute();

      return $this->dbConnect()->lastInsertId();
     }
  
     public function delete(User $user) {
       $this->dbConnect()->exec('DELETE FROM users WHERE id_users = '.$user->id_users());
     }
  
     public function get($id) {
      $id = (int) $id;
  
      $req = $this->dbConnect()->prepare('SELECT * FROM users WHERE id_users = ?');
      $req->execute(array($id));
      $donnees = $req->fetch(PDO::FETCH_ASSOC);
      $user = new User();
      $user->hydrate($donnees);
      return $user;
     }
  
     public function getAll() {
      $users = [];
  
      $req = $this->dbConnect()->query('SELECT * FROM users');
  
      while($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
        $user = new User();
        $user->hydrate($donnees);
        $users[] = $user;
      }
  
      return $users;
     }
  
     public function update(User $user) {
      $req = $this->dbConnect()->prepare('UPDATE users SET nom = :nom, prenom = :prenom, mail = :mail, password = :password WHERE id_users = :id');
  
      $req->bindValue(':id', $user->id_users(), PDO::PARAM_INT);
      $req->bindValue(':nom', $user->nom(), PDO::PARAM_STR);
      $req->bindValue(':prenom', $user->prenom(), PDO::PARAM_STR);
      $req->bindValue(':mail', $user->mail());
      $req->bindValue(':password', $user->password(), PDO::PARAM_STR);
  
      $req->execute();
     }
  
  
     public function login($mail) {
        $req = $this->dbConnect()->prepare('SELECT * FROM users WHERE mail = ?');
        $req->execute(array($mail));
        if($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            $user->hydrate($donnees);
            return $user;
        } else {
          return false;
        }
     }
  }

?>