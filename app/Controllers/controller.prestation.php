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

  function createPrestation() {
    $prestationManager = new PrestationManager();

    if(isset($_POST['libelle'])) {
      $post = array(
        'type_prestation'=>$_POST['libelle'],
      );
      $prestation = new Prestation();
      $prestation->hydrate($post);
      $presta = $prestationManager->add($prestation);
    }
    presta();

  }

  function editPrestation() {
    $prestationManager = new PrestationManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_prestation'=>$_POST['id'],
        'type_prestation'=>$_POST['libelle'],
      );
      $prestation = new Prestation();
      $prestation->hydrate($post);
      $presta = $prestationManager->update($prestation);
    }
    presta();

  }

  function deletePrestation() {
    $prestationManager = new PrestationManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_prestation'=>$_POST['id'],
      );
      $prestation = new Prestation();
      $prestation->hydrate($post);
      $presta = $prestationManager->delete($prestation);
    }
    presta();

  }

?>
