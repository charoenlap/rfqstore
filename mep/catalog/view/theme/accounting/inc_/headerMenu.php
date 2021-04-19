<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline">
    <a class="nav-link <?php echo ($active=='home'?'active':''); ?>" href="<?php echo route('accounting/home'); ?>">บัญชี</a>
    <a class="nav-link <?php echo ($active=='quotation'?'active':''); ?>" href="<?php echo route('accounting/quotation'); ?>">  
      ใบเสนอราคา
      <span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_quotation; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='billingnote'?'active':''); ?>" href="<?php echo route('accounting/billingnote'); ?>">
    	ใบวางบิล/ใบแจ้งหนี้
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_billingnote; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='receipt'?'active':''); ?>" href="<?php echo route('accounting/receipt'); ?>">
    	ใบเสร็จรับเงิน
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_receipt; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='purchaseOrder'?'active':''); ?>" href="<?php echo route('accounting/purchaseOrder'); ?>">
    	ใบสั่งซื้อ
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_purchaseOrder; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='productReceipt'?'active':''); ?>" href="<?php echo route('accounting/productReceipt'); ?>">
    	ใบรับสินค้า
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_productReceipt; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='theCost'?'active':''); ?>" href="<?php echo route('accounting/theCost'); ?>">
    	ค่าใช้จ่าย
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_theCost; ?></span>
    </a>
    <a class="nav-link <?php echo ($active=='withholdingTax'?'active':''); ?>" href="<?php echo route('accounting/withholdingTax'); ?>">
    	ใบหักภาษี ณ ที่จ่าย
    	<span class="badge badge-pill bg-light align-text-bottom"><?php echo $count_withholdingTax; ?></span>
    </a>
  </nav>
</div>