<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">แพคเกจปัจจุบัน</h5>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr>
										<td width="50%">ชื่อแพคเกจ: <?php echo is($detail_package,'name'); ?></td>
										<td>พนักงาน: <?php echo is($detail_package,'total_employee'); ?></td> 
									</tr>
									<tr>
										<td>บิลที่: <?php echo is($detail_package,'total_bill'); ?></td>
										<td>สินค้า: <?php echo is($detail_package,'total_product'); ?></td>
									</tr>
									<tr>
										<td>พื้นที่: <?php echo is($detail_package,'total_space_mb'); ?> MB</td>
										<td>ลูกค้า: <?php echo is($detail_package,'total_customer'); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row mt-4">
						<?php foreach($listPackage as $val){ ?>
				        <div class="col-md mb-4">
				          <div class="card">
							  <div class="card-body">
							    <div class="row">
							    	<div class="col-md">
							    		<h5 class="card-title"><?php echo $val['package_name'];?></h5>
							    		<p class="card-text"><?php echo $val['package_price'];?></p>
							    		<table class="table">
							    			<tr>
							    				<td>จำนวนบิล</td>
							    				<td class="text-right"><?php echo number_format($val['package_total_bill'],0);?></td>
							    			</tr>
							    			<tr>
							    				<td>จำนวนพื้นที่ใช้งาน</td>
							    				<td class="text-right"><?php echo number_format($val['package_total_space_mb'],0);?> MB</td>
							    			</tr>
							    			<tr>
							    				<td>จำนวนพนักงาน</td>
							    				<td class="text-right"><?php echo number_format($val['package_total_employee'],0);?></td>
							    			</tr>
							    			<tr>
							    				<td>จำนวนสินค้า</td>
							    				<td class="text-right"><?php echo number_format($val['package_total_product'],0);?></td>
							    			</tr>
							    			<tr>
							    				<td>จำนวนลูกค้า</td>
							    				<td class="text-right"><?php echo number_format($val['package_total_customer'],0);?></td>
							    			</tr>
							    		</table>
							    	</div>
							    </div>
							    <div class="row">
							    	<!-- <div class="col-md-6">
							    		<a href="<?php echo route('shop/home'); ?>" class="btn btn-outline-primary btn-sm rounded-0 w-100">View</a>
							    	</div> -->
							    	<div class="col-md-12">
							    		<a href="<?php echo route('package/getpackage&id_package='.$val['id_package']); ?>" class="btn btn-primary btn-theme rounded-0 w-100">เลือก</a>
							    	</div>
							    </div>
							  </div>
							</div>
				        </div>
				    	<?php } ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>