<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><?php echo $package_detail['package_name'];?></h5>
					<div class="row">
						<div class="col-md-6">
							<h5><?php echo $package_detail['package_price'];?> บาท/เดือน</h5>
							<table class="table">
				    			<tr>
				    				<td>จำนวนบิล</td>
				    				<td class="text-right"><?php echo number_format($package_detail['package_total_bill'],0);?></td>
				    			</tr>
				    			<tr>
				    				<td>จำนวนพื้นที่ใช้งาน</td>
				    				<td class="text-right"><?php echo number_format($package_detail['package_total_space_mb'],0);?> MB</td>
				    			</tr>
				    			<tr>
				    				<td>จำนวนพนักงาน</td>
				    				<td class="text-right"><?php echo number_format($package_detail['package_total_employee'],0);?></td>
				    			</tr>
				    			<tr>
				    				<td>จำนวนสินค้า</td>
				    				<td class="text-right"><?php echo number_format($package_detail['package_total_product'],0);?></td>
				    			</tr>
				    			<tr>
				    				<td>จำนวนลูกค้า</td>
				    				<td class="text-right"><?php echo number_format($package_detail['package_total_customer'],0);?></td>
				    			</tr>
				    		</table>
						</div>
						<div class="col-md-6">
							<h5 class="text-theme">วิธีการชำระค่าบริการ</h5>
							<p>โอนเงินผ่านช่องทาง ธนาคาร</p>
							<p>บริษัท เฟรนลี่ซอฟท์โปร จำกัด</p>
							<p>ธนาคารกสิกรไทย</p>
							<p>เลขที่บัญชี 857-2-61388-8</p>
							<a href="<?php echo route('package/payment&id_package='.$package_detail['id_package']); ?>" class="btn btn-primary">แจ้งการชำระเงินแพคเกจ</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
