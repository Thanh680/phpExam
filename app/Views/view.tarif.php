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
        Créer une tarif
        </button>
      </p>
      <div class="collapse" id="collapseCreate">
        <div class="card card-body">
        <form action="admin.php?action=createTarif" method="post">
          <div class="form-group">
            <label for="libelle">Prestation</label><br>
            <select class="w-100" name="id_prestation">
            <?php  foreach ($tabPresta as $value){ ?>
            <option value="<?php echo $value['id']?>">
            <?php echo $value['libelle']; ?>
            <?php } ?>
            </select>
            <br>
            <label for="libelle">Catégorie</label><br>
            <select class="w-100" name="id_categorie">
            <?php  foreach ($tabCategorie as $value){ ?>
            <option value="<?php echo $value['id']?>">
            <?php echo $value['libelle']; ?>
            <?php } ?>
            </select>
            <br>
            <label for="libelle">Prix</label><br>
            <input class="form-control" type="text" id="prix" name="prix">
          </div>
          <div class="text-center">
            <br>
            <button type="submit" name="createTarif" class="btn btn-outline-success" value="createTarif">Créer</button>
          </div>
        </form>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Prestation</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th class="d-flex gap-3 justify-content-end">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($tabTarif as $value) {
              echo '
                <tr>
                  <td>'.$value['prestation'].'</td>
                  <td>'.$value['categorie'].'</td>
                  <td>'.$value['prix'].'</td>
                  <td class="d-flex gap-3 justify-content-end">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal'.$value['id_prestation'].''.$value['id_categorie'].'">
                      Modifier
                    </button>

                  
                  <form action="admin.php?action=deleteTarif" method="post">
                      <input type="hidden" id="id_prestation" name="id_prestation" value='.$value['id_prestation'].'>
                      <input type="hidden" id="id_categorie" name="id_categorie" value='.$value['id_categorie'].'>
                      <input type="submit" class="btn btn-primary" name="deleteTarif" value="Supprimer">
                  </form>
                  </td>
                  <div class="modal fade" id="editModal'.$value['id_prestation'].$value['id_categorie'].'" tabindex="-1" aria-labelledby="editModal'.$value['id_prestation'].$value['categorie'].'" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editModal'.$value['id_prestation'].''.$value['id_categorie'].'">Modfier le tarif</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form action="admin.php?action=editTarif" method="post">
                        <div class="form-group">
                  <div class="form-group">
                      <label for="libelle">Prestation</label><br>
                      <select class="w-100" name="id_prestation">'?>
                      <?php  foreach ($tabPresta as $presta){ ?>
                      <option value="<?php echo $presta['id']?>"<?php if ($presta['id'] == $value['id_prestation']) echo ' selected="selected"'; ?>>
                      <?php echo $presta['libelle']; ?>
                      <?php } ?>
                      </select>
                      <br>
                      <label for="libelle">Catégorie</label><br>
                      <select class="w-100" name="id_categorie">
                      <?php  foreach ($tabCategorie as $categorie){ ?>
                      <option value="<?php echo $categorie['id']?>"<?php if ($categorie['id'] == $value['id_categorie']) echo ' selected="selected"'; ?>>
                      <?php echo $categorie['libelle']; ?>
                      <?php } ?>
                      <?php echo '
                      </select>
                      <br>
                      <label for="libelle">Prix</label><br>
                      <input class="form-control" type="text" id="prix" name="prix" value="'.$value['prix'].'">
                    </div>
                        </div>
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