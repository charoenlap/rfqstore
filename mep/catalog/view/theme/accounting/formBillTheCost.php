<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card my-3">
				<div class="card-body">
					<form method="POST" action="<?php echo $action; ?>" id="formbill" data-company="<?php echo id_company();?>">
						<input type="hidden" name="type_method" value="<?php echo $type_method; ?>" id="type_form">
						<input type="hidden" name="type_bill" value="<?php echo $type_bill ?>" id="type_bill"> 
						<input type="hidden" name="id_bill" value="<?php echo $id; ?>">
						<div class="row mt-4 justify-content-end">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md">
										<?php Form::text('theCost_doc_no','เลขที่เอกสาร',is($bill,'theCost_doc_no')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::date('theCost_date_head','วันที่',is($bill,'theCost_date_head')); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><hr></div>
						</div>
						<div class="row mb-4">
							<div class="col-md text-right">
								<a href="#" id="addRowForm" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-md">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-list table-theme" id="list_order">
										<thead>
											<tr>
												<th></th>
												<th>วัน เดือน ปี ที่ชำระ</th>
												<th>รายละเอียดรายจ่าย</th>
												<th>จำนวนเงิน (บาท)</th>
												<th>หมายเหตุ</th>
											</tr>
										</thead>
										<tbody id="sortable">
											<?php 
											if(isset($bill['bill_detail'])){
												foreach($bill['bill_detail'] as $val_detail){ 
											?>
												<tr>
													<td><a href="#" class="btn btm-primary handle"><i class="fas fa-align-justify"></i></a></td>
													<td>
														<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
															<input type="text" name="theCost_date[]" class="form-control" value="<?php echo is($val_detail,'theCost_date'); ?>" placeholder="<?php echo date('Y-m-d'); ?>">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
														<small id="" class="form-text text-muted"></small>
													</td>
													<td><input type="text" class="form-control" name="theCost_detail[]" placeholder="รายละเอียดรายจ่าย" value="<?php echo is($val_detail,'theCost_detail'); ?>"></td>
													<td><input type="text" class="form-control text-price" name="theCost_price[]" placeholder="จำนวนเงิน (บาท)" value="<?php echo is($val_detail,'theCost_price'); ?>"></td>
													<td><input type="text" class="form-control" name="theCost_remark[]" placeholder="หมายเหตุ" value="<?php echo is($val_detail,'theCost_remark'); ?>"></td>
												</tr>
												<?php /* ?>
												<tr>
													<td><a href="#" class="btn btm-primary handle"><i class="fas fa-align-justify"></i></a></td>
													<td><input name="seq[]" type="text" class="form-control input-seq" value="<?php echo $val_detail['seq']; ?>"></td>
													<td>
														<?php Form::selectArr('product_code',$product_list,'select2-tag product_code','product_code','product_code',$val_detail['code_product']); ?>
													</td>
													<td>
														<?php Form::selectArr('product',$product_list,'select2-tag product_name','product_name','product_name',$val_detail['detail']); ?> 
													</td>
													<td><input name="no[]" 	type="number" value="<?php echo $val_detail['no']; ?>"		class="form-control text-no"></td>
													<td><input name="unit[]" type="text" value="<?php echo $val_detail['unit']; ?>"		class="form-control"></td>
													<td><input name="price[]" type="number" value="<?php echo $val_detail['price']; ?>"	class="form-control text-price text-right"></td>
													<td class="text-right text-sum">
														<span class=""><?php echo number_format($val_detail['total'],2); ?></span>
													</td>
													<td><a href="#" class="btn btn-danger btn-sm btn-del-row"><i class="fas fa-trash"></i></a></td>
												</tr>
												<?php */?>
											<?php }
											}else{ 
												for ($i=1; $i < 2; $i++) { ?>
												<tr>
													<td><a href="#" class="btn btm-primary handle"><i class="fas fa-align-justify"></i></a></td>
													<td>
														<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
															<input type="text" name="theCost_date[]" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="<?php echo date('Y-m-d'); ?>">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
														<small id="" class="form-text text-muted"></small>
													</td>
													<td><input type="text" class="form-control" name="theCost_detail[]" placeholder="รายละเอียดรายจ่าย"></td>
													<td><input type="text" class="form-control text-price" name="theCost_price[]" placeholder="จำนวนเงิน (บาท)"></td>
													<td><input type="text" class="form-control" name="theCost_remark[]" placeholder="หมายเหตุ"></td>
												</tr>
											<?php 
												}
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md">
								<div class="row">
									<div class="col-md-6">
										<?php Form::text('theCost_name','ข้าพเจ้า (ผู้เบิกจ่าย)',is($bill,'theCost_name')); ?>
									</div>
									<div class="col-md-6">
										<?php Form::text('theCost_position','ตำแหน่ง (ขอรับรองว่ารายจ่ายข้างต้นนี้)',is($bill,'theCost_position')); ?>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<label for="">ไม่อาจเรียกใบเสร็จรับเงินจากผู้รับได้ และข้าพเจ้าได้จ่ายไปในงานของทาง.</label>
										<?php Form::text('theCost_text','ไม่อาจเรียกใบเสร็จรับเงินจากผู้รับได้ และข้าพเจ้าได้จ่ายไปในงานของทาง.',is($bill,'theCost_text')); ?>
									</div>
								</div> -->
								<div class="row">
									<div class="col-md-6">
										<label for="">ตั้งแต่วันที่</label>
										<?php Form::date('theCost_date_start','ตั้งแต่วันที่',is($bill,'theCost_date_start')); ?>
									</div>
									<div class="col-md-6">
										<label for="">ถึงวันที่</label>
										<?php Form::date('theCost_date_end','ถึงวันที่',is($bill,'theCost_date_end')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="">ลงชื่อ (ผู้เบิกจ่าย)</label>
										<?php Form::text('theCost_name_pay','ลงชื่อ (ผู้เบิกจ่าย)',is($bill,'theCost_name_pay')); ?>
									</div>
									<div class="col-md-12">
										<label for="">ลงชื่อ (ผู้อนุมัติ)</label>
										<?php Form::text('theCost_name_approved','ลงชื่อ (ผู้อนุมัติ)',is($bill,'theCost_name_approved')); ?>
									</div>
								</div>
								<!-- <div class="row">
									<div class="col-md-12">
										<label for="">สำหรับบัญชี</label>
										<?php Form::text('theCost_accounting','จ่ายผ่าน (เงินสดย่อย/โอนเงิน) เมื่อวันที่',is($bill,'theCost_accounting')); ?>
									</div>
								</div> -->
							</div>
						</div>

<!-- 						<div class="row mt-4 justify-content-end">
							<div class="col-md-2  text-right">
								<input type="submit" class="btn btn-primary btn-lg btn-theme w-100 rounded-0" value="บันทึก" id="btn-form-bill-submit">
							</div>
						</div> -->
						<div class="row mt-4 justify-content-end">
							<div class="col-md-2 text-right">
								<input type="submit" class="btn btn-primary btn-lg btn-theme w-100 rounded-0" data-showmodal="false" value="บันทึก" id="btn-form-bill-submit2">
								
								<!-- <input type="button" class="btn btn-primary" value="บันทึก และพิมพ์" id="btn-form-bill-submit-print"> -->
							</div>
							<div class="col-md-2 text-right">
								<input type="submit" class="btn btn-primary btn-lg btn-theme w-100 rounded-0" data-showmodal="true" value="บันทึกและดู" id="btn-form-bill-submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#accounting").addClass('show');
	});
</script>