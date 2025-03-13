<?php

  require_once 'app/Models/model.droits.php';

  function droits() {
    $droitsManager = new DroitsManager();

    $droits = $droitsManager->getAll();

    $tabDroits = [];
    foreach ($droits as $value) {
      $droitsFull = [
        'id' => $value->id_droits(),
        'libelle' => $value->libelle_droits(),
      ];
      $tabDroits[] = $droitsFull;
    }

    require 'app/Views/view.droits.php';

  }

  function createDroits() {
    $droitsManager = new DroitsManager();

    if(isset($_POST['libelle'])) {
      $post = array(
        'libelle_droits'=>$_POST['libelle'],
      );
      $droits = new Droits();
      $droits->hydrate($post);
      $droit = $droitsManager->add($droits);
    }
    droits();

  }

  function editdroits() {
    $droitsManager = new DroitsManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_droits'=>$_POST['id'],
        'libelle_droits'=>$_POST['libelle'],
      );
      $droits = new Droits();
      $droits->hydrate($post);
      $droit = $droitsManager->update($droits);
    }
    droits();

  }

  function deletedroits() {
    $droitsManager = new DroitsManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_droits'=>$_POST['id'],
      );
      $droits = new Droits();
      $droits->hydrate($post);
      $droit = $droitsManager->delete($droits);
    }
    droits();

  }

?>
