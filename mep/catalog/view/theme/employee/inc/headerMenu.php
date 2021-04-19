<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('employee/home'); ?>">พนักงาน</a>
    <a class="nav-link <?php echo ($active=='list'?'active':''); ?>" href="<?php echo route('employee/listEmployee'); ?>">
      รายการพนักงาน
      <span class="badge badge-pill bg-light align-text-bottom">27</span>
    </a>
  </nav>
</div>