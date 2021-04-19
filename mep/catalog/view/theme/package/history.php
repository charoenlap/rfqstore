<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">ประวัติการใช้งานแพคเกจ</h5>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-theme">
						 			<thead>
						 				<tr>
						 					<th>No.</th>
						 					<th>ชื่อแพคเกจ</th>
							 				<th>วันที่สร้าง</th>
							 				<th>วันที่เริ่ม</th>
							 				<th>วันที่สิ้นสุด</th>
							 				<th>สถานะ</th>
							 			</tr>
						 			</thead>
						 			<tbody>
						 				<?php 
							 				if($listHistory){
								 				$i=1;
								 				foreach($listHistory as $val){ ?>
								 				<tr>
								 					<td><?php echo $i++; ?>.</td>
								 					<td><?php echo $val['package_name']; ?></td>
								 					<td><?php echo $val['date_create']; ?></td>
								 					<td><?php echo $val['date_start']; ?></td>
								 					<td><?php echo $val['date_expired']; ?></td>
								 					<td><?php echo $val['status']; ?></td>
								 				</tr>
								 			<?php }
								 			}else{ ?>
												<tr>
													<td colspan="6">ยังไม่มีข้อมูล</td>
												</tr>
								 			<?php }
						 				?>
						 			</tbody>
						 		</table>
						 	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <div class="container-fluid">
	<div class="row mt-4">
		<div class="col-md">
			<div class="form-group">
			    <label for="">แพคเกจปัจจุบัน: </label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
		    <p>ชื่อแพคเกจ: </p>
		    <p>บิลที่: </p>
		    <p>พื้นที่: </p>
		    <p>บริษัท: </p>
		</div>
		<div class="col-md">
			<p>พนักงาน: </p>
		    <p>สินค้า: </p>
		    <p>ร้าน: </p>
		    <p>ลูกค้า: </p>
		</div>
	</div>
    <div class="row mt-4">
        <div class="col-md-3 mb-4">
          <div class="card">
			  <div class="card-body">
			    <h5 class="card-title"><a href="<?php echo route('accounting/quotation&typeBill=quotation'); ?>">แพคเกจ 1</a></h5>
			    <p class="card-text">Some quick example text to build on the Company and make up the bulk of the card's content.</p>
			    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<a class="btn btn-secondary" href="<?php echo route('accounting/addBill&typeBill=quotation'); ?>"><i class="fas fa-plus"></i> เลือก</a>
				</div>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card">
			  <div class="card-body">
			    <h5 class="card-title">แพคเกจ 2</h5>
			    <p class="card-text">Some quick example text to build on the Company and make up the bulk of the card's content.</p>
			    <a href="<?php echo route('shop/home'); ?>" class="btn btn-outline-primary">View</a>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card">
			  <div class="card-body">
			    <h5 class="card-title">แพคเกจ 3</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			    <a href="<?php echo route('shop/home'); ?>" class="btn btn-outline-primary">View</a>
			  </div>
			</div>
        </div>
        <div class="col-md-3 mb-4">
          <div class="card">
			  <div class="card-body">
			    <h5 class="card-title">แพคเกจ 4</h5>
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			    <a href="<?php echo route('shop/home'); ?>" class="btn btn-outline-primary">View</a>
			  </div>
			</div>
        </div>
    </div>
</div> -->