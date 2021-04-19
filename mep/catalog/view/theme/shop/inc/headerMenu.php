<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('shop/home'); ?>">หน้าหลักร้านค้า</a>
    <a class="nav-link <?php echo ($active=='sale'?'active':''); ?>" href="<?php echo route('shop/sale'); ?>">ร้านค้า</a>
    <a class="nav-link <?php echo ($active=='order'?'active':''); ?>" href="<?php echo route('shop/order'); ?>">
      รายงานการขาย
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
  </nav>
</div>