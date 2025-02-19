<br>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Libellé</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($tabPresta as $value) {
              echo '
                <tr>
                  <td>'.$value['id'].'</td>
                  <td>'.$value['libelle'].'</td>
                </tr>
              ';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>