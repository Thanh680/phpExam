<?php

  require_once 'app/Models/model.achat.php';
  require_once 'app/Models/model.prestation.php';

  function achat() {
    $achatManager = new AchatManager();
    $prestationManager = new PrestationManager();

    $achat = $achatManager->getAll();

    $tabAchat = [];
    foreach ($achat as $value) {
      $achatFull = [
        'id_ticket' => $value->id_ticket(),
        'prestation' => $prestationManager->get($value->id_prestation())->type_prestation(),
        'nombre' => $value->nombre(),
      ];
      $tabAchat[] = $achatFull;
    }

    require 'app/Views/view.achat.php';

  }

?>
