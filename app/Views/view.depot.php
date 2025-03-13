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
            <th>ID Carte</th>
            <th>Date</th>
            <th>Montant</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($tabDepot as $value) {
              echo '
                <tr>
                  <td>'.$value['id_carte'].'</td>
                  <td>'.$value['date_depot'].'</td>
                  <td>'.$value['montant'].'</td>
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