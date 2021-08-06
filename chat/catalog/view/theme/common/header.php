<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  
  

    <meta name="Description" CONTENT="<?php echo $description;?>">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34="/>
    <title></title>
    <meta name="author" content="">


  <link rel="icon" href="assets/image/logo.png" type="image/icon type">

  <title><?php echo $title;?></title>
  <link rel="stylesheet" href="<?php echo MURL; ?>p/assets/main.css">
  <!-- <link href="<?php echo MURL; ?>p/assets/boostrap_jquery/css/bootstrap.min.css" rel="stylesheet" > -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="<?php echo MURL; ?>p/assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <?php if(isset($style)){ 
    foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo MURL.$value;?>">
  <?php } } ?>
  
  <script src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/jquery.js"></script>
  <script src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/popper.js"></script>
  <script src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="<?php echo MURL; ?>p/assets/fontawesome/js/all.js"></script>
  <!-- <?php 
    if(isset($script)){
    foreach ($script as $key => $value) { ?>
    <script src="<?php echo MURL.$value;?>"></script>
  <?php } } ?> -->
</head>
<body class="pt-4">