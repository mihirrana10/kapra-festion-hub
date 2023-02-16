<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <?php 
  include_once('head_file.php');
  ?>
</head>
<body class="hold-transition skin-blue sidebar-mini  sidebar-collapse">
<div class="wrapper">

  <?php 
  include_once('header.php');
  ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php 
  include_once('left_menu.php');
  ?>

  <?php
    include_once($page_name.'.php'); 
  ?>
  
  <?php 
  include_once('footer.php');
  ?>

  <?php 
  include_once('control_sidebar.php');
  ?>
</div>
<!-- ./wrapper -->

<?php 
include_once('footer_file.php');
?>
</body>
</html>
