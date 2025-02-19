<br>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Utilisateurs
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>Identifiants</th>
                    <th>Pseudo</th>
                    <th>Mail</th>
                    <th>Password</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($users as $user) {
                    echo '
                     <tr>
                       <form action="admin.php?action=user" method="post">
                          <td>
                          '.$user->id_users().'
                           <input type="hidden" class="form-control" value="'.$user->id_users().'" name="id_users">
                          </td> 
                          <td>
                           <input type="text" class="form-control" value="'.$user->pseudo().'" name="pseudo">
                          </td> 
                          <td>
                           <input type="text" class="form-control" value="'.$user->mail().'" name="mail">
                          </td> 
                          <td>
                           <input type="password" class="form-control" value="'.$user->password().'" name="password">
                          </td> 
                          <td>
                            <button class="btn btn-outline-warning" type="submit" value="modifUser" name="submitUser">Modifier</button>
                          </td> 
                          <td>
                          <button class="btn btn-outline-danger" type="submit" value="deleteUser" name="submitUser">Supprimer</button>
                          </td>
                       </form>
                     </tr>
                   ';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Auteurs
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                  
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Livres
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>