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
  <?php if(isset($style)){ 
    foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <link rel="stylesheet" href="<?php echo MURL; ?>p/assets/main.css">
  <link href="<?php echo MURL; ?>p/assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet" >
  <link href="<?php echo MURL; ?>p/assets/fontawesome/css/fontawesome.css" rel="stylesheet">

  <script src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/jquery.js"></script>
  <script 
    src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/popper.js"></script>
  <script src="<?php echo MURL; ?>p/assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="<?php echo MURL; ?>p/assets/fontawesome/js/all.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>
<body class="">