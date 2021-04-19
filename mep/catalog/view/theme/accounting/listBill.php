<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3 rounded-0">
				<div class="card-body">
					<div class="row mt-4 mb-3">
						<div class="col-md-3">
							<form method="GET" action="<?php echo $action; ?>">
							  <!-- <div class="form-row align-items-center">
							    <div class="col-auto">
							      <div class="input-group mb-2">
							        <div class="input-group-prepend">
							          <div class="input-group-text"><i class="fas fa-search"></i></div>
							        </div>
							        <input type="text" class="form-control" name="search" placeholder="ค้นหา<?php echo $type_bill;?>" value="<?php echo $search; ?>">
							        <input type="hidden" name="route" value="<?php echo $route; ?>">
							      </div>
							    </div>
							    <div class="col-auto">
							      <button class="btn btn-primary btn-search" type="submit"><i class="fas fa-search"></i> ค้นหา</button>
							    </div>
							  </div> -->
								<div class="input-group mb-3">
									<input type="text" class="form-control rounded-0" name="search" placeholder="ค้นหา<?php echo $type_bill;?>" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?php echo $search; ?>">
									<input type="hidden" name="route" value="<?php echo $route; ?>">
									<div class="input-group-append">
										<button class="btn btn-info rounded-0" type="submit"><i class="fas fa-search"></i> ค้นหา</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-9 text-right">
							<a href="<?php echo route('accounting/addBill&typeBill='.$type_bill); ?>" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่ม<?php echo $title;?></a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-theme">
									<thead>
										<th>รหัส</th>
										<th>วันที่</th>
										<th><?php echo $type_bill=='theCost' ? 'ชื่อผู้เบิก' : 'บริษัท';?></th>
										<th class="text-right">รวม</th>
										<th style="width: 270px;"></th>
									</thead>
									<tbody>
										<?php if($bill_list){ ?>
											<?php foreach($bill_list as $val){ 
												$where = '&id='.$val['id'].'&typeBill='.$type_bill;
											?>
											<tr>
												<td><?php echo $val['doc_no']; ?></td>
												<td><?php echo $val['date']; ?></td>
												<td><?php echo $val['customer_company']; ?></td>
												<td class="text-right">
													<?php echo number_format($val['price'],2); ?>
												</td> 
												<td class="text-center">
													<a href="<?php echo MURL; ?>uploads/<?php echo id_company().'/'.$type_bill.'/'.$val['file_name']; ?>" target="_blank" class="btn btn-primary btn-sm">
														<i class="fas fa-print"></i>
													</a>
													
													<a href="<?php echo route('accounting/editBill'.$where); ?>"  class="btn btn-warning btn-sm">
														<i class="fas fa-edit"></i>
													</a>
												    <?php if ($group_bill!='pay'): ?>
													<div class="btn-group" role="group">
													    <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													      <i class="fas fa-redo"></i>
													    </button>
													    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
													    	<?php if ($group_bill=='sell'): ?>
													    	<a class="dropdown-item" href="<?php echo route('accounting/coppy&to=quotation'.$where); ?>">คัดลอกไป ใบเสนอราคา</a>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=billingnote'.$where); ?>">คัดลอกไป ใบวางบิล/ใบแจ้งหนี้</a>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=receipt'.$where); ?>">คัดลอกไป ใบเสร็จรับเงิน</a>
															<?php endif; ?>
															<?php if ($group_bill=='buy'): ?>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=purchaseOrder'.$where); ?>">คัดลอกไป ใบสั่งซื้อ</a>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=productReceipt'.$where); ?>">คัดลอกไป ใบรับสินค้า</a>
														    <?php endif; ?>
														   <!--  <?php if ($group_bill=='pay'): ?>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=theCost'.$where); ?>">คัดลอกไป ค่าใช้จ่าย</a>
														    <a class="dropdown-item" href="<?php echo route('accounting/coppy&to=withholdingTax'.$where); ?>">คัดลอกไป ใบหักภาษี ณ ที่จ่าย</a>
														    <?php endif; ?> -->
													    </div>
													</div>
												    <?php endif; ?>
													<div class="btn-group" role="group">
													    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													      เพิ่มเติม
													    </button>
													    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
													      <!-- <a class="dropdown-item" href="#">
													      	<i class="fas fa-paperclip"></i> เอกสาร
													      </a> -->
													      <a class="dropdown-item btn-email" href="#" 
													      	  data-toggle="modal" 
														      data-target="#emailModel" 
														      data-doc-no="<?php echo $val['doc_no']; ?>" 
														      data-customer="<?php echo $val['customer']; ?>" 
														      data-price="<?php echo number_format($val['price'],2); ?>">
																<i class="fas fa-envelope"></i> ส่งอีเมล
														  </a>
														  <a href="#" data-link="<?php echo route('accounting/delBill'.$where); ?>"  class="dropdown-item btn-delBill text-danger">
															<i class="fas fa-trash"></i> ลบ
														  </a>
													    </div>
													</div>
													
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
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="emailModel" tabindex="-1" role="dialog" aria-labelledby="emailModelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="#" id="form-submit-email">
    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="emailModelLabel">ส่งอีเมล</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button> 
	      </div> 
	      <div class="modal-body">
	      	<table class="table">
	      		<tr>
	      			<td>ชื่อลูกค้า</td>
	      			<td><span id="email_txt_customer"></span></td>
	      		</tr>
	      		<tr>
	      			<td>ราคา</td>
	      			<td><span id="email_txt_price"></span></td>
	      		</tr>
	      		<tr>
	      			<td>เลขที่เอกสาร</td>
	      			<td><span id="email_txt_doc_no"></span></td>
	      		</tr>
	      		<tr>
	      			<td>กรุณากรอกอีเมล</td>
	      			<td><input type="email" class="form-control" id="txt_email" placeholder="Ex. xxx@email.com" required></td>
	      		</tr>
	      	</table>
	      </div>
	      <div class="modal-footer">
	      	<input type="hidden" name="type_bill" id="type_bill" value="quotation">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
	        <button type="submit" class="btn btn-primary" id="btn-email">ส่งอีเมล</button>
	      </div>
	    </div>
    </form>
  </div>
</div>


<script>
	$(document).ready(function() {
		$('#accounting').addClass('show');
	});
</script>