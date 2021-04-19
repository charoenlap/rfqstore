<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container">
	<div class="row mt-4">
		<div class="col-md">
			<form method="GET" action="<?php echo $action; ?>">
			  <div class="form-row align-items-center">
			    <div class="col-auto">
			      <div class="input-group mb-2">
			        <div class="input-group-prepend">
			          <div class="input-group-text"><i class="fas fa-search"></i></div>
			        </div>
			        <input type="text" class="form-control" name="search" placeholder="ค้นหาใบเสนอราคา" value="<?php echo $search; ?>">
			        <input type="hidden" name="route" value="<?php echo $route; ?>">
			      </div>
			    </div>
			    <div class="col-auto">
			      <button class="btn btn-primary btn-search btn-sm" type="submit"><i class="fas fa-search"></i> ค้นหา</button>
			    </div>
			  </div>
			</form>
		</div>
		<div class="col-md text-right">
			<a href="<?php echo route('accounting/addQuotation'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มใบเสนอราคา</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th>รหัส</th>
						<th>วันที่</th>
						<th>ลูกค้า</th>
						<th class="text-right">รวม</th>
						<th style="width: 250px;"></th>
					</thead>
					<tbody>
						<?php if($bill_list){ ?> 
							<?php foreach($bill_list as $val){?>
							<tr>
								<td><?php echo $val['doc_no']; ?></td>
								<td><?php echo $val['date']; ?></td>
								<td><?php echo $val['customer']; ?></td>
								<td class="text-right">
									<?php echo number_format($val['price']); ?>
								</td>
								<td>
									<a href="<?php echo route('accounting/gettheCost'); ?>" target="_blank" class="btn btn-primary btn-sm">
										<i class="fas fa-print"></i>
									</a>
									<a href="#" class="btn btn-secondary btn-sm">
										<i class="fas fa-envelope"></i>
									</a>
									<a href="#" class="btn btn-warning btn-sm">
										<i class="fas fa-edit"></i>
									</a>
									<div class="btn-group" role="group">
									    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									      <i class="fas fa-redo"></i>
									    </button>
									    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									      <a class="dropdown-item" href="#">คัดลอกไป ..</a>
									    </div>
									</div>
									<a href="#" class="btn btn-info btn-sm">
										<i class="fas fa-paperclip"></i>
									</a>
									<a href="#" class="btn btn-danger btn-sm">
										<i class="fas fa-trash"></i>
									</a>
								</td>
							</tr>
							<?php } ?>
						<?php }else{ ?>
							<tr>
								<td colspan="99">ไม่พบข้อมูล</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<?php echo $pageing; ?>
		</div>
	</div>
</div>