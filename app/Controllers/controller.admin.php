<?php
  require_once 'app/Models/model.user.php';
  function admin() {
    $userManager = new UserManager();
    $users = $userManager->getAll();
    require 'admin/view/view.admin.php';
  }

  function user() {
    $userManager = new UserManager();
    $post = array(
      'id_users'=>$_POST['id_users'],
      'pseudo'=>$_POST['pseudo'],
      'mail'=>$_POST['mail'],
      'password'=>password_hash($_POST['password'], PASSWORD_DEFAULT)
    );
    $user = new User();
    $user->hydrate($post);
    if($_POST['submitUser'] == 'modifUser') {
      $userManager->update($user);
    } else if ($_POST['submitUser'] == 'deleteUser' && $_SESSION['user'] != $_POST['id_users']) {
      $userManager->delete($user);
    } else {
      echo 'Unknown Value of SubmitUser';
    }
    echo("<script>location.href = 'admin.php#collapseTwo';</script>");
  }
?>