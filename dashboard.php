<?php
session_start();
include('database/dbconfig.php');

if (!$_SESSION['username']) {
    header('Location: login.php');
    // exit();
}

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="content-wrapper">
  sbuadnansdbasiduiandiasndiasndinandiasdias
  <?php 
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>
</div>
