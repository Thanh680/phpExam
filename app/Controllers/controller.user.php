<?php
  require_once 'app/Models/model.user.php';
  

  function register() {
    $userManager = new UserManager();
    if(isset($_POST['register'])) { 
      if($_POST['password'] != $_POST['verifyPassword']) {
        header('Location:index.php?action=register&errorRegister=mdp');
      } else {
        /* ---- CHECK IMAGE ---- */
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
              /* ---- FIN CHECK IMAGE ---- */
              $fileNameNew = uniqid('', true).".".$fileActualExt;
              $fileDestination = 'uploads/'.$fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);
              $post = array(
                'nom'=>$_POST['nom'],
                'prenom'=>$_POST['prenom'],
                'mail'=>$_POST['mail'],
                'droits'=>2,
                'avatar'=>$fileDestination,
                'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)
              );
              $user = new User();
              $user->hydrate($post);
              $id = $userManager->add($user);
              $_SESSION['user'] = $id;
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
            /* ---- ERREUR IMAGE ---- */
            } else {
              echo "Pas plus de 100MB sinon je meurs !";
            }
          } else {
            echo "Oupsi, je crois qu'on a un léger soucis avec le fichier.";
          }
        } else {
          echo "Oupsi, on prend uniquement les jpg, jpeg, png et cartes bleues.";
        }
        /* ---- FIN ERREUR IMAGE ---- */
      }
    } else {
      require 'app/Views/view.register.php';
    }
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