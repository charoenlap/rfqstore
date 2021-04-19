<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<form action="<?php echo $action; ?>" method="POST">
	<div class="container-fluid">
		<div class="card my-3">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<?php if($result=='success'){?>
						<p class="alert alert-success">บันทึกสำเร็จ</p>
						<?php }elseif($result=='fail'){?>
						<p class="alert alert-danger">บันทึกไม่สำเร็จ</p>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<h4>เงื่อนไข</h4>
						<hr>
						<div class="form-group">
							<label for="">ตัดสต๊อก (ขาย)</label>
							<select name="sellstock" id="" class="form-control">
								<option value="quotation" <?php echo $setting['sellstock']=='quotation'?'selected':'';?>>ใบเสนอราคา</option>
								<option value="billingnote" <?php echo $setting['sellstock']=='billingnote'?'selected':'';?>>ใบวางบิล/ใบแจ้งหนี้/ใบส่งของ</option>
								<option value="receipt" <?php echo $setting['sellstock']=='receipt'?'selected':'';?>>ใบเสร็จรับเงิน</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">เพิ่มสต๊อก (ซื้อ)</label>
							<select name="buystock" id="" class="form-control">
								<option value="purchaseOrder" <?php echo $setting['buystock']=='purchaseOrder'?'selected':'';?>>ใบสั่งซื้อ</option>
								<option value="productReceipt" <?php echo $setting['buystock']=='productReceipt'?'selected':'';?>>ใบรับสินค้า</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">ร้านค้าตัดสต๊อก</label>
							<select name="shopstock" id="" class="form-control">
								<option value="1" <?php echo $setting['shopstock']=='1'?'selected':'';?>>ใช่</option>
								<option value="0" <?php echo $setting['shopstock']=='0'?'selected':'';?>>ไม่</option>
							</select>
						</div>
					</div>
					<div class="col-12">
						<hr>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="บันทึก">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>