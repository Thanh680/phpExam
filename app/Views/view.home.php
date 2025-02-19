<br>
<div class="coontainer-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
      <h1>Home</h1>
      <p class="text-justify">
        <?php
          if(isset($_SESSION['user'])) {
            echo 'Bonsoir '.$_SESSION['nom'].'<br>';
          }
        ?>
        MVC
      </p>
    </div>
  </div>
</div>