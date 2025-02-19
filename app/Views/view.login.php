<br>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-4">
      <h1>Identification</h1>
      <form action="index.php?action=login" method="post">
        <div class="form-group">
          <label for="mail">Mail</label><br>
          <input class="form-control" type="text" id="mail" name="mail">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label><br>
          <input class="form-control" type="password" id="password" name="password">
        </div>
        <div class="text-center">
          <br>
          <button type="submit" name="login" class="btn btn-outline-success" value="login">Enregistrer</button>
        </div>
      </form>
      <?php
        if(isset($_GET['errorLogin'])) {
          switch($_GET['errorLogin']) {
            case 'mdp':
              echo 'Le mot de passe est erroné';
              break;
            case 'pseudo':
              echo 'Le mail de l\'utilisateur n\'est pas enregistré';
              break;
            default:
              echo 'Unknown Error Login';
              break;
          }
        }
      ?>
    </div>
  </div>
</div>