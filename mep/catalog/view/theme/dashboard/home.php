<?php echo $breadcrumb; ?>
<div class="container-fluid">
  <div class="card mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <p><b>ชื่อบริษัท</b>: <?php echo $company_name; ?></p>
          <p><b>แพคเกจปัจจุบัน</b>: <b><?php echo is($package_detail,'package_name'); ?></b></p>
        </div>
        <div class="col-md">
          <p><b>พื้นที่</b>:<?php echo number_format($total_size,3); ?> / <?php echo number_format($total_space,3); ?> MB (<?php echo number_format($percent_space,2); ?> %)</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percent_space; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percent_space; ?>%"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md">
          <p><b>บัญชี</b>:<?php echo $sum_bill; ?> / <?php echo $package_detail['package_total_bill']; ?> บิล (<?php echo number_format($sum_bill/$package_detail['package_total_bill']*100,2); ?> %)</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percent_space; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $sum_bill/$package_detail['package_total_bill']; ?>%"></div>
          </div>
        </div>
        <div class="col-md">
          <p><b>พนักงาน</b>:<?php echo $count_employee; ?> / <?php echo $package_detail['package_total_employee']; ?> คน (<?php echo number_format($count_employee/$package_detail['package_total_employee']*100,2); ?> %)</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percent_space; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count_employee/$package_detail['package_total_employee']; ?>%"></div>
          </div>
        </div>
        <div class="col-md">
          <p><b>สินค้า</b>:<?php echo $count_product; ?> / <?php echo $package_detail['package_total_product']; ?>  (<?php echo number_format($count_product/$package_detail['package_total_product']*100,2); ?> %)</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percent_space; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count_product/$package_detail['package_total_product']; ?>%"></div>
          </div>
        </div>
        <div class="col-md">
          <p><b>ลูกค้า</b>:<?php echo $count_customer; ?> / <?php echo $package_detail['package_total_customer']; ?> ราย (<?php echo number_format($count_customer/$package_detail['package_total_customer']*100,2); ?> %)</p>
          <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?php echo $percent_space; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count_customer/$package_detail['package_total_customer']; ?>%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <?php //var_dump($package_detail); ?>
  <div class="row mt-4">
    <div class="col-md-2">
      <a href="<?php echo route('accounting/home'); ?>" class="btn-dashboard">
        <i class="fas fa-file-invoice"></i>
        <h5>บัญชี</h5>
      </a>
    </div>
    <div class="col-md-2">
      <a href="<?php echo route('employee/home'); ?>" class="btn-dashboard">
        <i class="fas fa-user-tie"></i>
        <h5>พนักงาน</h5>
      </a>
    </div>
    <div class="col-md-2">
      <a href="<?php echo route('product/home'); ?>" class="btn-dashboard">
        <i class="fas fa-box"></i>
        <h5>สินค้า</h5>
      </a>
    </div>
    <div class="col-md-2">
      <a href="<?php echo route('customer/home'); ?>" class="btn-dashboard">
        <i class="fas fa-address-book"></i>
        <h5>ลูกค้า</h5>
      </a>
    </div>
    <div class="col-md-2">
      <a href="<?php echo route('shop/home'); ?>" class="btn-dashboard">
        <i class="fas fa-tv"></i>
        <h5>ร้านค้า</h5>
      </a>
    </div>
      <!-- <div class="col-md">
        <div class="card mb-4">
          <div class="card-body bg-white">
            <h5 class="card-title">บัญชี</h5>
            <p class="card-text"></p>
            
            <a href="<?php echo route('accounting/home'); ?>" class="btn btn-outline-primary btn-lg btn-block">View</a>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="card mb-4">
          <div class="card-body bg-white">
            <h5 class="card-title">พนักงาน</h5>
            <p class="card-text"></p>
            
            <a href="<?php echo route('employee/home'); ?>" class="btn btn-outline-primary btn-lg btn-block">View</a>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="card mb-4">
          <div class="card-body bg-white">
            <h5 class="card-title">สินค้า</h5>
            <p class="card-text"></p>
            
            <a href="<?php echo route('product/home'); ?>" class="btn btn-outline-primary btn-lg btn-block">View</a>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="card mb-4">
          <div class="card-body bg-white">
            <h5 class="card-title">ลูกค้า</h5>
            <p class="card-text"></p>
            
            <a href="<?php echo route('customer/home'); ?>" class="btn btn-outline-primary btn-lg btn-block">View</a>
          </div>
        </div>
      </div>
      <div class="col-md">
        <div class="card mb-4">
          <div class="card-body bg-white">
            <h5 class="card-title">ร้านค้า</h5>
            <p class="card-text"></p>
            
            <a href="<?php echo route('shop/home'); ?>" class="btn btn-outline-primary btn-lg btn-block">View</a>
          </div>
        </div>
      </div> -->
  </div>
</div>