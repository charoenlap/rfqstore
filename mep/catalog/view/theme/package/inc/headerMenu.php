 <div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('package/home'); ?>">
    	แพคเกจ
	</a>
    <a class="nav-link <?php echo ($active=='history'?'active':''); ?>" href="<?php echo route('package/history'); ?>">  
      ประวัติการใช้งาน
    </a>
    <a class="nav-link <?php echo ($active=='payment'?'active':''); ?>" href="<?php echo route('package/payment'); ?>">  
      แจ้งการชำระเงินแพคเกจ
    </a>
  </nav>
</div>