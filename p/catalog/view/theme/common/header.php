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
<body class="">
<!-- <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
  <a class="navbar-brand text-info font-weight-bold" href="#"><?php echo $title;?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active text-secondary font-weight-bold" href="#">Home</a>
      <a class="nav-item nav-link text-secondary font-weight-bold" href="#">Features</a>
      <a class="nav-item nav-link text-secondary font-weight-bold" href="#">Pricing</a>
    </div>
  </div>
</nav> -->
<section class="py-5 bg-white">
  <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="font-weight-bold mb-0"><?php echo $title; ?></h1>
        </div>
      </div>
  </div>
</section>
<nav class="navbar navbar-expand-lg navbar-dark bg-navbar-dark sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active font-weight-bold px-md-5" href="#">Home</a>
      <a class="nav-item nav-link font-weight-bold px-md-5" href="#">Product</a>
      <a class="nav-item nav-link font-weight-bold px-md-5" href="#">Contact</a>
    </div>
  </div>
</nav>