<?php

  require_once 'app/Models/model.categorie.php';

  function categorie() {
    $categorieManager = new CategorieManager();

    $categorie = $categorieManager->getAll();

    $tabCategorie = [];
    foreach ($categorie as $value) {
      $categorieFull = [
        'id' => $value->id_categorie(),
        'libelle' => $value->libelle_categorie(),
      ];
      $tabCategorie[] = $categorieFull;
    }

    require 'app/Views/view.categorie.php';

  }

  function createCategorie() {
    $categorieManager = new CategorieManager();

    if(isset($_POST['libelle'])) {
      $post = array(
        'libelle_categorie'=>$_POST['libelle'],
      );
      $categorie = new Categorie();
      $categorie->hydrate($post);
      $cate = $categorieManager->add($categorie);
    }
    categorie();

  }

  function editCategorie() {
    $categorieManager = new CategorieManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_categorie'=>$_POST['id'],
        'libelle_categorie'=>$_POST['libelle'],
      );
      $categorie = new Categorie();
      $categorie->hydrate($post);
      $cate = $categorieManager->update($categorie);
    }
    categorie();

  }

  function deleteCategorie() {
    $categorieManager = new CategorieManager();

    if(isset($_POST['id'])) {
      $post = array(
        'id_categorie'=>$_POST['id'],
      );
      $categorie = new Categorie();
      $categorie->hydrate($post);
      $cate = $categorieManager->delete($categorie);
    }
    categorie();

  }

?>
