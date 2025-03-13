<br>
<div class="container-fluid">
<?php
if(!isset($_SESSION['user'])) {
  echo'<img src=/uploads/header.png alt="Logo" width="500" height="500"><br><h2>Bravo vous avez trouvé une chèvre !</h2><p> Vous pouvez voir uniquement cette chèvre et pas le reste de cette page !</p>';
}else {?>
  <div class="row justify-content-center">
    <div class="col-8">
      <table class="table">
        <thead>
          <tr>
            <th>ID carte</th>
            <th>Nom</th>
            <th>categorie</th>
            <th>Montant caution</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($tabUsager as $value) {
              echo '
                <tr>
                  <td>'.$value['id_carte'].'</td>
                  <td>'.$value['nom'].'</td>
                  <td>'.$value['categorie'].'</td>
                  <td>'.$value['montant_caution'].'</td>
                  <td>'.$value['date_carte'].'</td>
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