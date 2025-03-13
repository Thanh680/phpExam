<?php

  require_once 'app/Models/model.depot.php';

  function depot() {
    $depotManager = new DepotManager();

    $depot = $depotManager->getAll();

    $tabDepot = [];
    foreach ($depot as $value) {
      $depotFull = [
        'id_carte' => $value->id_carte(),
        'date_depot' => $value->date_depot(),
        'montant' => $value->montant(),
      ];
      $tabDepot[] = $depotFull;
    }

    require 'app/Views/view.depot.php';

  }

?>
