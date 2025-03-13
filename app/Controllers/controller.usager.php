<?php

  require_once 'app/Models/model.usager.php';
  require_once 'app/Models/model.categorie.php';

  function usager() {
    $usagerManager = new UsagerManager();
    $categorieManager = new CategorieManager();

    $usager = $usagerManager->getAll();

    $tabUsager = [];
    foreach ($usager as $value) {
      $usagerFull = [
        'id_carte' => $value->id_carte(),
        'nom' => $value->nom(),
        'categorie' => $categorieManager->get($value->id_categorie())->libelle_categorie(),
        'montant_caution' => $value->montant_caution(),
        'date_carte' => $value->date_carte(),
      ];
      $tabUsager[] = $usagerFull;
    }

    require 'app/Views/view.usager.php';

  }

?>
