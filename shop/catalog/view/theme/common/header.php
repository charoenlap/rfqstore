<?php  
// if (!isset($_SESSION['id_admin'])) {
//   header('location:index.php?route=home/login');
//   exit();
// }
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- <title><?php echo $title;?></title> -->
  <meta name="robots" content="noindex, nofollow">
  <link href="assets/boostrap_jquery/css/bootstrap.css" rel="stylesheet" >
  <link href="assets/css/sidebar.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <?php if(isset($style)){ 
      foreach ($style as $key => $value) { ?>
    <link rel="stylesheet" href="<?php echo $value;?>">
  <?php } } ?>
  <script src="assets/boostrap_jquery/js/jquery.js"></script>
  <script src="assets/boostrap_jquery/js/popper.js"></script>
  <script src="assets/boostrap_jquery/js/bootstrap.js"></script>
  <script src="assets/js/main.js"></script>

  <!-- Custom styles for this template -->
  <script src="assets/fontawesome/js/all.js"></script>
  <?php 
  if(isset($script)){
  foreach ($script as $key => $value) { ?>
    <script src="<?php echo $value;?>"></script>
  <?php } } ?>
</head>

<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="container"> 
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
 
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg nav-head" id="header-sticky">

           <div class=" navbar-collapse">
          <ul class="navbar-nav mt-2 mt-lg-0">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSz_XGCAMlHhdvpCGFpckEI1_qg4Hy7Ufs4pg&usqp=CAU" width="35px" height="auto">
            <li class="nav-item ">
              <a class="nav-link" href="#">หน้าแรก </a>
            </li>
              <li class="nav-item ">
              <a class="nav-link" href="#">สินค้า </a>
            </li>
              <li class="nav-item ">
              <a class="nav-link" href="#">ติดต่อเรา </a>
            </li>
              <li class="nav-item ">
              <a class="nav-link" href="#">รีวิว </a>
            </li>

          </ul>
        </div>
       
  <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#"  data-toggle="modal" data-target="#myModal"  >เข้าสู่ระบบ </a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo route('home/logout'); ?>">Logout</a>
              </div>
            </li>
            <li class=" active">
              <a class="nav-link" href="#" style="font-size: 30px;">
                <!-- <span class="iconify" data-icon="bytesize:bag" data-inline="false"></span> -->
      </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">test </a>
            </li>

          </ul>
        </div>
        <!-- <div class="collapse navbar-collapse" >
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">เข้าสู่ระบบ </a>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo route('home/logout'); ?>">Logout</a>
              </div>
            </li>
            <li class=" active">
              <a class="nav-link" href="#" style="font-size: 30px;"><span class="iconify" data-icon="bytesize:bag" data-inline="false"></span>
      </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="#">test </a>
            </li>
          </ul>
        </div> -->
      </nav>
    </div>
</div>
  </div>