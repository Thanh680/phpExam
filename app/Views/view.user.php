<br>
<div class="container-fluid">
<?php
if(!isset($_SESSION['user'])) {
  echo'<img src=/uploads/header.png alt="Logo" width="500" height="500"><br><h2>Bravo vous avez trouvé une chèvre !</h2><p> Vous pouvez voir uniquement cette chèvre et pas le reste de cette page !</p>';
}else {?>
  <div class="row justify-content-center">
    <div class="col-8">
      <p class="d-inline-flex gap-1">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCreate" aria-expanded="false" aria-controls="collapseCreate">
        Créer une compte
        </button>
      </p>
      <div class="collapse" id="collapseCreate">
        <div class="card card-body">
          <form action="index.php?action=register" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="mail">Mail</label><br>
              <input class="form-control" type="text" id="mail" name="mail">
            </div>
            <div class="form-group">
              <label for="nom">Nom</label><br>
              <input class="form-control" type="text" id="nom" name="nom">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label><br>
              <input class="form-control" type="text" id="prenom" name="prenom">
            </div>
            <div class="form-group">
              <label for="avatar">Avatar</label><br>
              <input class="form-control" type="file" id="avatar" name="avatar">
            </div>
            <div class="form-group">
              <label for="password">Mot de passe</label><br>
              <input class="form-control" type="password" id="password" name="password">
            </div>
            <div class="form-group">
              <label for="verifyPassword">Vérification de mot de passe</label><br>
              <input class="form-control" type="password" id="verifyPassword" name="verifyPassword">
            </div>
            <label for="libelle">Droits</label><br>
            <select class="w-100" name="droits">
            <?php  foreach ($tabDroits as $value){ ?>
            <option value="<?php echo $value['id']?>">
            <?php echo $value['libelle']; ?>
            <?php } ?>
            </select>
            <div class="text-center">
              <br>
              <button type="submit" name="register" class="btn btn-outline-success" value="register">Enregistrer</button>
            </div>
        </form>
        <?php
        if(isset($_GET['errorRegister'])) {
          switch ($_GET['errorRegister']) {
            case 'mdp':
              echo 'Les deux mots de passes ne sont pas égaux';
              break;
            
            default:
              echo 'Unknown Error register';
              break;
          }
        }
      ?>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Avatar</th>
            <th>Droits</th>
            <th class="d-flex gap-3 justify-content-end">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($tabUser as $value) {
              echo '
                <tr>
                  <td>'.$value['id'].'</td>
                  <td>'.$value['nom'].'</td>
                  <td>'.$value['prenom'].'</td>
                  <td>'.$value['mail'].'</td>
                  <td><img src='.$value['avatar'].' alt="Avatar" width="35" height="25"></td>
                  <td>'.$value['droits'].'</td>
                  <td class="d-flex gap-3 justify-content-end">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal'.$value['id'].'">
                      Modifier
                    </button>

                  
                  <form action="admin.php?action=deleteUser" method="post">
                      <input type="hidden" id="id" name="id" value='.$value['id'].'>
                      <input type="submit" class="btn btn-primary" name="deleteUser" value="Supprimer">
                  </form>
                  </td>
                  <div class="modal fade" id="editModal'.$value['id'].'" tabindex="-1" aria-labelledby="editModal'.$value['id'].'" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModal'.$value['id'].'">Modfier le compte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form action="admin.php?action=editUser" method="post" enctype="multipart/form-data">
                      <input type="hidden" id="id" name="id" value='.$value['id'].'>
                        <div class="form-group">
                        <label for="mail">Mail</label><br>
                        <input class="form-control" type="text" id="mail" name="mail" value="'.$value['mail'].'">
                      </div>
                      <div class="form-group">
                        <label for="nom">Nom</label><br>
                        <input class="form-control" type="text" id="nom" name="nom" value="'.$value['nom'].'">
                      </div>
                      <div class="form-group">
                        <label for="prenom">Prénom</label><br>
                        <input class="form-control" type="text" id="prenom" name="prenom" value="'.$value['prenom'].'">
                      </div>
                      <div class="form-group">
                        <label for="avatar">Avatar</label><br>
                        <input class="form-control" type="file" id="avatar" name="avatar" value="'.$value['avatar'].'">
                      </div>
                      <div class="form-group">
                        <label for="password">Mot de passe</label><br>
                        <input class="form-control" type="password" id="password" name="password">
                      </div>
                      <div class="form-group">
                        <label for="verifyPassword">Vérification de mot de passe</label><br>
                        <input class="form-control" type="password" id="verifyPassword" name="verifyPassword">
                      </div>
                      <label for="libelle">Droits</label><br>
                      <select class="w-100" name="droits">'?>
                      <?php  foreach ($tabDroits as $value){ ?>
                      <option value="<?php echo $value['id']?>">
                      <?php echo $value['libelle']; ?>
                      <?php } ?>
                      <?php echo '
                      </select>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                </tr>
              ';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php        }?>
</div>