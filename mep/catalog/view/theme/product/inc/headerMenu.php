<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('product/home'); ?>">ภาพรวมสินค้า</a>
    <a class="nav-link <?php echo ($active=='product'?'active':''); ?>" href="<?php echo route('product/listProduct'); ?>">
      รายการสินค้า
      <!-- <span class="badge badge-pill bg-light align-text-bottom">27</span> -->
    </a>
    <a class="nav-link <?php echo ($active=='category'?'active':''); ?>" href="<?php echo route('product/listCategory'); ?>">
      หมวดหมู่
      <!-- <span class="badge badge-pill bg-light align-text-bottom">27</span> -->
    </a>
    <a class="nav-link <?php echo ($active=='werehouse'?'active':''); ?>" href="<?php echo route('product/listWerehouse'); ?>">
      คลังสินค้า
      <!-- <span class="badge badge-pill bg-light align-text-bottom">27</span> -->
    </a>
  </nav>
</div>