<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('customer/home'); ?>">ลูกค้า</a>
    <a class="nav-link <?php echo ($active=='category'?'active':''); ?>" href="<?php echo route('customer/listCategory'); ?>">
      หมวดหมู่
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
    <a class="nav-link <?php echo ($active=='list'?'active':''); ?>" href="<?php echo route('customer/listCustomer'); ?>">
      รายการลูกค้า
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
  </nav>
</div>