<br>
<div class="coontainer-fluid">
  <div class="row justify-content-center">
    <div class="col-8">
    <?php
        if(!isset($_SESSION['user'])) {
          echo '<h1>POV Tu es un visiteur</h1><br>';
        }elseif($_SESSION['droits'] == 1){
          echo '<h1>POV Tu es un administrateur</h1><br>';
        }else{
          echo '<h1>POV Tu es un utilisateur</h1><br>';
        }
      ?>
      <img src=/uploads/header.png alt="Logo" width="500" height="500">

      <h2>Bienvenue sur le site administratif du restaurant La Chèvre Bleu</h2>
      <p class="text-justify">
      <?php
        if(!isset($_SESSION['user'])) {
          echo 'En tant que visiteur, tu ne peux pas agir mais seuleument subir, alors permet moi de te présenter notre restaurant<br>Nous sommes un restaurant qui propose une grande variété de plats à base de chèvre, que ce soit de la viande, du fromage, de l\'huile,...<br>Nous manipulons la chèvre avec doigté afin d\'en extraire tout le potentiel qu\'elle propose, mais le plus important pour nous c\'est le respect de son bien-être, car une chèvre triste est une chèvre qu\'on ne digère pas.';
        }elseif($_SESSION['droits'] == 1){
          echo 'En tant qu\'administrateur, tu as tous les droits, tu peux désormais jouer à dieu.';
        }else{
          echo 'En tant qu\'utilisateur, tu peux toujours rien faire, mais tu peux subir plus, alors vas voir les onglets qui te sont attribués.';
        }
      ?>
        
      </p>
    </div>
  </div>
</div>