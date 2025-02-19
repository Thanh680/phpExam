<?php

  require_once 'app/Models/model.prestation.php';

  function presta() {
    $prestationManager = new PrestationManager();

    $prestation = $prestationManager->getAll();

    $tabPresta = [];
    foreach ($prestation as $value) {
      $prestaFull = [
        'id' => $value->id_prestation(),
        'libelle' => $value->type_prestation(),
      ];
      $tabPresta[] = $prestaFull;
    }

    require 'app/Views/view.prestation.php';

  }

?>
