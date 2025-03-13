<?php

  require_once 'app/Models/model.user.php';
  require_once 'app/Models/model.droits.php';

  function user() {
    $userManager = new UserManager();
    $droitsManager = new DroitsManager();

    $user = $userManager->getAll();
    $droits = $droitsManager->getAll();

    $tabUser = [];
    foreach ($user as $value) {
      $userFull = [
        'id' => $value->id_users(),
        'nom' => $value->nom(),
        'prenom' => $value->prenom(),
        'mail' => $value->mail(),
        'avatar' => $value->avatar(),
        'droits' => $droitsManager->get($value->droits())->libelle_droits(),
      ];
      $tabUser[] = $userFull;
    }

    $tabDroits = [];
    foreach ($droits as $value) {
      $droitsFull = [
        'id' => $value->id_droits(),
        'libelle' => $value->libelle_droits(),
      ];
      $tabDroits[] = $droitsFull;
    }

    require 'app/Views/view.user.php';

  }


  function register() {
    $userManager = new UserManager();
    if(isset($_POST['register'])) { 
      if (isset($_POST['mail']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['password']) && isset($_POST['avatar'])){
        echo "Oupsi, tous les champs n'ont pas été remplis correctement";
      }else{
      if($_POST['password'] != $_POST['verifyPassword']) {
        header('Location:index.php?action=register&errorRegister=mdp');
      } else {
        $fileName = $_FILES['avatar']['name'];
        $fileTmpName = $_FILES['avatar']['tmp_name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileError = $_FILES['avatar']['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $allowed)) {
          if ($fileError === 0){
            if ($fileSize < 1000000){
              $fileNameNew = uniqid('', true).".".$fileActualExt;
              $fileDestination = 'uploads/'.$fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);
              $droits = 1;
              if(isset($_POST["droits"]))
              {
                  $droits = $_POST["droits"];
              }
              $post = array(
                'nom'=>$_POST['nom'],
                'prenom'=>$_POST['prenom'],
                'mail'=>$_POST['mail'],
                'droits'=>$droits,
                'avatar'=>$fileDestination,
                'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)
              );
              $user = new User();
              $user->hydrate($post);
              $id = $userManager->add($user);
              if ($_SESSION['droits'] == 1){
                user();
              } else {
              $_SESSION['user'] = $id;
              $_SESSION['nom'] = $user->nom();
              $_SESSION['prenom'] = $user->prenom();
              $_SESSION['mail'] = $user->mail();
              $_SESSION['avatar'] = $user->avatar();
              $_SESSION['droits'] = $user->droits();
              header('Location: index.php');
              }
            } else {
              echo "Pas plus de 100MB sinon je meurs !";
            }
          } else {
            echo "Oupsi, je crois qu'on a un léger soucis avec le fichier.";
          }
        } else {
          echo "Oupsi, il y a un problème avec l'importation d'image";
        }
      } 
    }
    } else {
      require 'app/Views/view.register.php';
    }
  }

  function editUser() {
    $userManager = new UserManager();

    if (isset($_POST['mail']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['password']) && isset($_FILES['avatar'])){
        if($_POST['password'] != $_POST['verifyPassword']) {
          header('Location:index.php?action=register&errorRegister=mdp');
        } else {
          $fileName = $_FILES['avatar']['name'];
          $fileTmpName = $_FILES['avatar']['tmp_name'];
          $fileSize = $_FILES['avatar']['size'];
          $fileError = $_FILES['avatar']['error'];
  
          $fileExt = explode('.', $fileName);
          $fileActualExt = strtolower(end($fileExt));
  
          $allowed = array('jpg', 'jpeg', 'png');
  
          if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0){
              if ($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $post = array(
                  'id_users'=>$_POST['id'],
                  'nom'=>$_POST['nom'],
                  'prenom'=>$_POST['prenom'],
                  'mail'=>$_POST['mail'],
                  'droits'=>$_POST['droits'],
                  'avatar'=>$fileDestination,
                  'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)
                );
                $user = new User();
                $user->hydrate($post);
                $id = $userManager->update($user);
              } else {
                echo "Pas plus de 100MB sinon je meurs !";
              }
            } else {
              echo "Oupsi, je crois qu'on a un léger soucis avec le fichier.";
            }
          } else {
            echo "Oupsi, on prend uniquement les jpg, jpeg, png et cartes bleues.";
          }
        }
      user();
    }else{
      echo "Oupsi, on prend uniquement les jpg, jpeg, png et cartes bleues.";
    }

  }

  function deleteUser() {
    $userManager = new UserManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_users'=>$_POST['id'],
      );
      $user = new User();
      $user->hydrate($post);
      $use = $userManager->delete($user);
    }
    user();

  }


  function login() {
    $userManager = new UserManager();
    if(isset($_POST['login'])) {
      $mail = $_POST['mail'];
      $pwd = $_POST['password'];
      $user = $userManager->login($mail);
      if($user) {
        if(password_verify($pwd, $user->password())) {
          $_SESSION['user'] = $user->id_users();
          $_SESSION['nom'] = $user->nom();
          $_SESSION['prenom'] = $user->prenom();
          $_SESSION['mail'] = $user->mail();
          $_SESSION['avatar'] = $user->avatar();
          $_SESSION['droits'] = $user->droits();
          if ($_SESSION['droits'] == 1){
            header('Location: admin.php');
          } else {
            header('Location: index.php');
          }
        } else {
          header('Location: index.php?action=login&errorLogin=mdp');
        }
      } else {
        header('Location: index.php?action=login&errorLogin=mail');
      }
    } else {
      require 'app/Views/view.login.php';
    }
  }

  function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
  }

?>