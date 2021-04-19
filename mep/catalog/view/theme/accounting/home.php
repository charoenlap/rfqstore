<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<?php /*
	<div class="btn-group" role="group"> 
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      เพิ่มเติม
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      	<a class="dropdown-item" href="#"><i class="fas fa-file"></i> รายงานเดือนปัจจุบัน</a>
    </div>
  </div>
*/ ?>
<div class="container-fluid">
    <div class="row mt-4"> 
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบเสนอราคา</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=quotation'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/quotation&typeBill=quotation'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบวางบิล/ใบแจ้งหนี้</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=billingnote'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/billingnote&typeBill=billingnote'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบเสร็จรับเงิน</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=receipt'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/receipt&typeBill=receipt'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบสั่งซื้อ</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=purchaseOrder'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/purchaseOrder&typeBill=purchaseOrder'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบรับสินค้า</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=productReceipt'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/productReceipt&typeBill=productReceipt'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ค่าใช้จ่าย</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=theCost'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/theCost&typeBill=theCost'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card card-accounting">
			  <div class="card-body text-center">
			  	<p class="icon-accounting"><i class="fas fa-file-invoice"></i></p>
			    <h4 class="card-title">ใบหักภาษี ณ ที่จ่าย</h4>
			    <p class="card-text"></p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-info" href="<?php echo route('accounting/addBill&typeBill=withholdingTax'); ?>"><i class="fas fa-plus"></i> สร้าง</a>
					<a class="btn btn-info" href="<?php echo route('accounting/withholdingTax&typeBill=withholdingTax'); ?>"><i class="fas fa-eye"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>


<script>
	$(document).ready(function() {
		$('#accounting').addClass('show');
	});
</script>