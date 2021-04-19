<?php $description = 'ระบบจัดการ ลดขั้นตอนการทำงาน ของบริษัท ทำบริษัทให้ขยาย เติบโตแบบมีคุณภาพ ต้องใช้โปรแกรม ที่มีคุณภาพ รองรับฟังก์ชั่นการใช้งาน อย่างครบถ้วน'; ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  
  

    <meta name="Description" CONTENT="<?php echo $description;?>">
    <meta name="description" content="<?php echo $description;?>">
    <meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34="/>
    <title>RFQ Store - บัญชี, เอกสารออนไลน์, POS</title>
    <meta name="author" content="">


  <link rel="icon" href="assets/image/logo.png" type="image/icon type">

  <title><?php echo $title;?></title>
  <?php if(isset($style)){ 
    foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <link rel="stylesheet" href="assets/main.css">
  <link href="assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet" >
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">

  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script 
    src="assets/boostrap_jquery/js/popper.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="assets/fontawesome/js/all.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172956143-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-172956143-1');
</script>
<!-- Global site tag (gtag.js) - Google Ads: 967008138 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-967008138"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-967008138');
</script>

<!-- Event snippet for Website sale conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-967008138/CP7YCKrfiNgBEIq_jc0D',
      'transaction_id': ''
  });
</script>

</head>
<body class="<?php echo (isset($class_body)?$class_body:''); ?>">
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 0px 8px 20px -10px rgba(0,64,128,0.2);">
  <a class="navbar-brand" href="#"><img src="assets/image/logo.png" alt="" width="100"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li id="home" class="nav-item">
        <a class="nav-link" href="<?php echo route('home'); ?>">หน้าหลัก</a>
      </li>
      <li id="contact" class="nav-item">
        <a class="nav-link" href="<?php echo route('contact'); ?>">แนะนำ/ติดต่อเรา</a>
      </li>
      <li id="login" class="nav-item">
        <a class="nav-link" href="<?php echo route('user/login'); ?>">เข้าสู่ระบบ</a>
      </li>
      <li id="register" class="nav-item">
        <a class="nav-link" href="<?php echo route('user/register'); ?>">สมัครสมาชิก</a>
      </li>
    </ul>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ธรุกิจ
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>