<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/image/logo.png" type="image/icon type">

  <title><?php echo (isset($title) ? $title : ''); ?></title>
  <link href="assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/sidebar.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <?php if (isset($style)) {
    foreach ($style as $key => $value) { ?>
      <link rel="stylesheet" href="<?php echo $value; ?>">
  <?php }
  } ?>


  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script src="assets/boostrap_jquery/js/popper.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Custom styles for this template -->
  <script src="assets/fontawesome/js/all.js"></script>
  <?php
  if (isset($script)) {
    foreach ($script as $key => $value) { ?>
      <script src="<?php echo $value; ?>"></script>
  <?php }
  } ?>
</head>

<body class="<?php echo (isset($class_body) ? $class_body : 'animsition site-navbar-small dashboard mm-wrapper site-menubar-fold site-navbar dashboard'); ?>">
  <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-right menu-left" id="sidebar-wrapper">
      <div class="sidebar-heading text-theme text-center"><img src="../assets/image/logo.png" alt="" width="100"></div>
      <div class="list-group menu-list list-group-flush">
        <a href="<?php echo route('home'); ?>" class="list-group-item list-group-item-action">
          <i class="fas fa-tachometer-alt"></i>
          แผงควบคุม
        </a>
        <!-- <a href="<?php echo route('rfq/home'); ?>" class="list-group-item list-group-item-action">
          <i class="fas fa-chalkboard-teacher"></i>
          RFQ Board
        </a> -->
      </div>

      <?php if (!empty($encode_id_company) && !empty($company_name)) { ?>
        <div class="list-group menu-list list-group-flush">
          <span class="list-group-item list-group-item-action list-name-company">
            <?php echo $company_name; ?>
          </span>

          <?php if (in_array('dashboard', $permission)) : ?>
            <a href="<?php echo route('dashboard/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-home"></i> หน้าหลัก</a>
          <?php endif ?>
          <a href="#accounting" class="list-group-item list-group-item-action dropdown" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="accounting">
            <i class="fas fa-file-invoice"></i> บัญชี <i class="fas fa-angle-down float-right"></i>
          </a>
          <div class="collapse multi-collapse" id="accounting">
            <?php if (in_array('accounting/sell', $permission)) : ?>
              <a href="<?php echo route('accounting/sell'); ?>" class="list-group-item list-group-item-action">ขาย</a>
            <?php endif ?>
            <?php if (in_array('accounting/buy', $permission)) : ?>
              <a href="<?php echo route('accounting/buy'); ?>" class="list-group-item list-group-item-action">ซื้อ</a>
            <?php endif ?>
            <?php if (in_array('accounting/cost', $permission)) : ?>
              <a href="<?php echo route('accounting/cost'); ?>" class="list-group-item list-group-item-action">ค่าใช้จ่าย</a>
            <?php endif ?>
          </div>
          <?php if (in_array('employee/home', $permission)) : ?>
            <a href="<?php echo route('employee/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-user-tie"></i> พนักงาน</a>
          <?php endif ?>
          <?php if (in_array('product/home', $permission)) : ?>
            <a href="<?php echo route('product/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-box"></i> สินค้า</a>
          <?php endif ?>
          <?php if (in_array('shop/home', $permission)) : ?>
            <a href="<?php echo route('shop/sale'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-tv"></i> ร้านค้า</a>
          <?php endif ?>
          <?php if (in_array('customer/home', $permission)) : ?>
            <a href="<?php echo route('customer/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-address-book"></i> ลูกค้า/ผู้จำหน่าย</a>
          <?php endif ?>
          <?php if (in_array('report/index', $permission)) : ?>
            <a href="<?php echo route('report/index'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-chart-pie"></i> รายงาน</a>
          <?php endif ?>
          <?php if (in_array('package/home', $permission)) : ?>
            <a href="<?php echo route('package/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-money-check-alt"></i> แพคเกจ</a>
          <?php endif ?>
          <?php if (in_array('upload/home', $permission)) : ?>
            <a href="<?php echo route('upload/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-folder"></i> จัดการไฟล์</a>
          <?php endif ?>
          <?php if (in_array('setting/home', $permission)) : ?>
            <a href="<?php echo route('setting/home'); ?>" class="list-group-item list-group-item-action"><i class="fas fa-cog"></i> ตั้งค่า</a>
          <?php endif ?>
          <?php /*?>
        <?php $r = get('route'); ?>
        <a href="<?php echo route('dashboard/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='dashboard/home'?'active':''); ?>">
          <i class="fas fa-home"></i> หน้าหลัก</a>
        <a href="<?php echo route('accounting/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='accounting/home'?'active':''); ?>">
          <i class="fas fa-file-invoice"></i> บัญชี</a>
        <a href="<?php echo route('employee/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='employee/home'?'active':''); ?>">
          <i class="fas fa-user-tie"></i> พนักงาน</a>
        <a href="<?php echo route('product/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='product/home'?'active':''); ?>">
          <i class="fas fa-box"></i> สินค้า</a>
        <a href="<?php echo route('shop/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='shop/home'?'active':''); ?>">
          <i class="fas fa-tv"></i> ร้านค้า</a>
        <a href="<?php echo route('customer/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='customer/home'?'active':''); ?>">
          <i class="fas fa-address-book"></i> ลูกค้า</a>
        <a href="<?php echo route('package/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='package/home'?'active':''); ?>">
          <i class="fas fa-address-book"></i> แพคเกจ</a>
        <a href="<?php echo route('upload/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='upload/home'?'active':''); ?>">
          <i class="fas fa-folder"></i> จัดการไฟล์</a>
        <a href="<?php echo route('setting/home'); ?>" 
          class="list-group-item list-group-item-action <?php echo ($r=='setting/home'?'active':''); ?>">
          <i class="fas fa-cog"></i> ตั้งค่า</a>
        <?php */ ?>
          <!-- <a href="#" class="list-group-item list-group-item-action bg-light">
          <i class="fas fa-cogs"></i>
          Module
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <i class="fas fa-server"></i>
          Project management
        </a>
        <a href="#" class="list-group-item list-group-item-action bg-light">
          <i class="fas fa-check-double"></i>
          Queue
        </a> -->
        </div>
      <?php } ?>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <a id="menu-toggle" href="#" class="text-white"><i class="fas fa-bars fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link text-white" href="#">Home </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Shortcut
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <?php foreach ($list_company as $val) { ?>
                  <a class="dropdown-item" href="<?php echo route('company&id_company=' . $val['id_company']); ?>"><?php echo $val['company_name']; ?></a>
                <?php } ?>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo route('user/logout'); ?>">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>