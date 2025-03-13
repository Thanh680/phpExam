<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/8688d368c4.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Admin</title>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a href="admin.php" class="navbar-brand">
      <img src=/uploads/Logo.png alt="Logo" width="35" height="25">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse menu" id="navbarScroll">
        <?php
           if(isset($_SESSION['user'])) { 
        ?>
          <ul class="navbar-nav">
          <li class="nav-item">
              <a href="admin.php?action=prestation" class="nav-link">
                Prestation
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=categorie" class="nav-link">
                Catégorie
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=tarif" class="nav-link">
                Tarif
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=droits" class="nav-link">
                Droits
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=usager" class="nav-link">
                Usager
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=achat" class="nav-link">
                Achat
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=ticket" class="nav-link">
                Ticket
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=depot" class="nav-link">
                Depot
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=user" class="nav-link">
                User
              </a>
            </li>
          </ul>
        <?php
           } 
        ?>
        <span class="clear"></span>
        <ul class="navbar-nav">
          <?php  if(!isset($_SESSION['user'])) {  ?>
            <li class="nav-item">
              <a href="admin.php?action=login" class="nav-link">
              Se connecter
              </a>
            </li>
            <li class="nav-item">
            <a href="admin.php?action=register" class="nav-link">
            S'enregistrer
            </a>
            </li>
          <?php  } else {  ?>
            <li class="nav-item">
              <a href="admin.php?action=sign-out" class="nav-link">
              Se déconnecter
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?action=admin" class="nav-link">
              <img src=<?php echo $_SESSION['avatar'];?> alt="Avatar" width="35" height="25">
              </a>
            </li>
          <?php  }  ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php
            require './app/Controllers/controller.prestation.php';
            require './app/Controllers/controller.categorie.php';
            require './app/Controllers/controller.tarif.php';
            require './app/Controllers/controller.droits.php';
            require './app/Controllers/controller.usager.php';
            require './app/Controllers/controller.ticket.php';
            require './app/Controllers/controller.depot.php';
            require './app/Controllers/controller.achat.php';
            require './app/Controllers/controller.user.php';
            if(isset($_GET['action'])) {
              $action = $_GET['action'];
              switch ($action) {
                case 'prestation':
                  presta();
                  break;
                case 'createPrestation':
                  createPrestation();
                  break; 
                case 'editPrestation':
                  editPrestation();
                  break;
                case 'deletePrestation':
                  deletePrestation();
                  break; 
                case 'categorie':
                  categorie();
                  break;
                case 'createCategorie':
                  createCategorie();
                  break; 
                case 'editCategorie':
                  editCategorie();
                  break;
                case 'deleteCategorie':
                  deleteCategorie();
                  break;
                case 'tarif':
                  tarif();
                  break;
                case 'createTarif':
                  createTarif();
                  break; 
                case 'editTarif':
                  editTarif();
                  break;
                case 'deleteTarif':
                  deleteTarif();
                  break;
                case 'droits':
                  droits();
                  break;
                case 'createDroits':
                  createDroits();
                  break; 
                case 'editDroits':
                  editDroits();
                  break;
                case 'deleteDroits':
                  deleteDroits();
                  break;
                case 'achat':
                  achat();
                  break;
                case 'usager':
                  usager();
                  break;
                case 'depot':
                  depot();
                  break;
                case 'ticket':
                  ticket();
                  break;
                case 'user':
                  user();
                  break;
                 case 'createUser':
                  register();
                  break; 
                case 'editUser':
                  editUser();
                  break;
                case 'deleteUser':
                  deleteUser();
                  break;
                case 'register':
                  register();
                  break;
                case 'sign-out':
                  logout();
                  break;
                case 'login':
                  login();
                  break;
                case 'admin':
                  header('Location: admin.php');
                  break;
                default:
                  require './app/Views/view.home.php';
                  break;
              }
            } else {
              require './app/Views/view.home.php';
            }
        ?>
</body>
</html>