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
						<div class="row mt-4">
							<div class="col-md">
								<div class="row">
									<div class="col-md">
										<?php  	
											Form::select('customer',$customer_list,'select2-tag','id_customer','customer_company',is($customer,'id_customer'));
											Form::text('customer_address','ที่อยู่ลูกค้า',is($customer,'customer_address')); 
										?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::text('customer_tax_no','เลขประจำตัวผู้เสียภาษี',is($customer,'customer_tax_no')); ?>
									</div>
									<div class="col-md">
										<?php Form::text('customer_branch_no','สำนักงาน/สาขาเลขที่',is($customer,'customer_branch_no')); ?>
									</div>
								</div>
							</div>
							<div class="col-md">
								<div class="row">
									<div class="col-md">
										<?php Form::text('customer_name','ชื่อลูกค้า',is($customer,'customer_name')); ?>
									</div>
									<div class="col-md">
										<?php Form::text('customer_phone','เบอร์โทรลูกค้า',is($customer,'customer_phone')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::text('customer_email','อีเมล',is($customer,'customer_email')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::text('customer_project','ชื่อโปรเจค',is($bill,'project')); ?>
									</div>
								</div>
							</div>
							<div class="col-md">
								<div class="row">
									<div class="col-md">
										<?php Form::text('doc_no','เลขที่เอกสาร',is($bill,'doc_no')); ?>
									</div>
									<div class="col-md">
										<?php Form::text('ref','อ้างอิงถึง',is($bill,'ref')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<div class="form-group">
										<input type="text" name="date_start" class="form-control inputdatepicker" placeholder="วันที่เริ่ม" value="<?php echo is($bill,'date_start');?>">
										</div>
									</div>
									<div class="col-md"> 
										<div class="form-group">
										<input type="text" name="date_end" class="form-control inputdatepicker" placeholder="วันที่ครบกำหนด" value="<?php echo is($bill,'date_end');?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::text('term','ระยะเครดิต',is($bill,'term')); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"> 
								<hr>
							</div>
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
												<!-- <th width="50px"></th>
												<th width="70px">ลำดับ</th>
												<th width="140px">รหัส</th>
												<th>รายการ</th>
												<th width="80px">จำนวน</th>
												<th width="100px">หน่วย</th>
												<th width="150px">ราคาต่อหน่วย</th>
												<th width="150px">จำนวนเงิน</th>
												<th width="50px"></th> -->
												<th></th>
												<th width="15px">ลำดับ</th>
												<th>รหัส</th>
												<th>รายการ</th>
												<th>จำนวน</th>
												<th>หน่วย</th>
												<th>ราคาต่อหน่วย</th>
												<th>จำนวนเงิน</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="sortable">
											<?php 
											if(isset($data['bill_detail'])){
												foreach($data['bill_detail'] as $val_detail){ 
											?>
												<tr>
													<td><a href="#" class="btn btm-primary handle"><i class="fas fa-align-justify"></i></a></td>
													<td><input name="seq[]" type="text" class="form-control input-seq" value="<?php echo $val_detail['seq']; ?>"></td>
													<td>
														<select name="product_code[]" class="form-control select2-tag product_code" style="width: 100%">
															<!-- <option value="">&nbsp;</option> -->
															<?php foreach($product_list as $val){ ?>
															<option value="<?php echo $val['product_code']; ?>" <?php echo $val_detail['code_product']==$val['product_code']?'selected':''; ?>>
																<?php echo $val['product_code']; ?>
															</option>
															<?php } ?>
														</select>
													</td>
													<td>
														<select name="product[]" class="form-control select2-tag product_name" style="width: 100%">
															<!-- <option value="">&nbsp;</option> -->
															<?php foreach($product_list as $val){ ?>
															<option value="<?php echo $val['product_name']; ?>" <?php echo $val_detail['detail']==$val['product_name']?'selected':'';?>>
																<?php echo $val['product_name']; ?>
															</option>
															<?php } ?>
														</select>
													</td>
													<td><input name="no[]" 	type="number" value="<?php echo $val_detail['no']; ?>"		class="form-control text-no"></td>
													<td><input name="unit[]" type="text" value="<?php echo $val_detail['unit']; ?>"		class="form-control text-unit"></td>
													<td><input name="price[]" type="number" value="<?php echo $val_detail['price']; ?>"	class="form-control text-price text-right"></td>
													<td class="text-right text-sum">
														<span class=""><?php echo number_format($val_detail['total'],2); ?></span>
													</td>
													<td><a href="#" class="btn btn-danger btn-sm btn-del-row"><i class="fas fa-trash"></i></a></td>
												</tr>
											<?php }
											}else{ 
												for ($i=1; $i < 2; $i++) { ?>
												<tr>
													<td><a href="#" class="btn btm-primary handle"><i class="fas fa-align-justify"></i></a></td>
													<td><input name="seq[]" type="text" class="form-control input-seq" value="<?php echo $i; ?>"></td>
													<td>
														<select name="product_code[]" class="form-control select2-tag product_code" style="width: 100%">
															<option value="">&nbsp;</option>
															<?php foreach($product_list as $val){ ?>
															<option value="<?php echo $val['product_code']; ?>">
																<?php echo $val['product_code']; ?>
															</option>
															<?php } ?>
														</select>
													</td>
													<td>
														<select name="product[]" class="form-control select2-tag product_name" style="width: 100%">
															<option value="">&nbsp;</option>
															<?php foreach($product_list as $val){ ?>
															<option value="<?php echo $val['product_name']; ?>">
																<?php echo $val['product_name']; ?>
															</option>
															<?php } ?>
														</select>
													</td>
													<td><input name="no[]" 		type="number" 	class="form-control text-no"></td>
													<td><input name="unit[]" 	type="text" 	class="form-control text-unit"></td>
													<td><input name="price[]" 	type="number" 	class="form-control text-price"></td>
													<td class="text-right text-sum">
														<span class="">0</span>
													</td>
													<td><a href="#" class="btn btn-danger btn-sm btn-del-row"><i class="fas fa-trash"></i></a></td>
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
							<div class="col-md-8">
								<div class="row">
									<div class="col-md">
										<?php 
											$type_vat = is($bill,'type_vat');
										?>
										<div class="form-check">
										  <input class="form-check-input radioVat" type="radio" name="rdoVat" id="excluding_vat" 
										  	value="ex" <?php echo ($type_vat=='ex'?'checked':''); ?> <?php echo ($type_method=="add"?'checked':''); ?>>
										  <label class="form-check-label" for="excluding_vat">
										    คำนวณภาษี <b>แยก</b>กับราคาสินค้า
										  </label>
										</div>
										<div class="form-check">
										  <input class="form-check-input radioVat" type="radio" name="rdoVat" id="including_vat" 
										  	value="in" <?php echo ($type_vat=='in'?'checked':''); ?>>
										  <label class="form-check-label" for="including_vat">
										    คำนวณภาษี <b>รวม</b>กับราคาสินค้า
										  </label>
										</div>
									</div>
								</div>
								<div class="row mt-4">
									<div class="col-md">
										<?php Form::text('condition','เงื่อนไขการชำระเงิน',is($bill,'condition')); ?>
									</div>
								</div>
								<div class="row">
									<div class="col-md">
										<?php Form::text('remark','หมายเหตุ',is($bill,'remark')); ?>
									</div>
								</div>
								<div class="row d-none">
									<div class="col-md">
										<div class="form-group">
											<label for="">แนบเอกสาร</label>
											<div>
										    	<?php //echo $document; ?>
										    </div>
										    <small id="" class="form-text text-muted"></small>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 float-right">
								<table class="table table-totle table-bordered table-striped">
									<tbody>
										<tr>
											<!-- <td width="100px"></td> -->
											<td>ราคารวม</td>
											<td width="100px"></td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_sum_bill = (float)is($bill,'sum_bill'); 
													$sum_bill = number_format($input_sum_bill,2);
												?>
												<span id="sum_bill"><?php echo $sum_bill; ?></span>
												<?php 
													Form::hidden('input_sum_bill',$input_sum_bill); ?>
											</td>
										</tr>
										<tr>
											<!-- <td></td> -->
											<td>ส่วนลด</td>
											<td>
												<?php 
													$percent_discount = is($bill,'percent_discount');
													Form::number('percent_discount','ส่วนลด',($percent_discount?$percent_discount:'0'),'min-box'); ?>
											</td>
											<td>%</td>
											<td class=text-right>
												<?php 
													$input_text_discount = (float)is($bill,'text_discount');
													$text_discount = number_format($input_text_discount,2);
												?>
												<span id="text-discount"><?php echo $text_discount; ?></span>
												<?php 
													Form::hidden('input_text_discount',$input_text_discount); ?>
											</td>
										</tr>
										<tr>
											<!-- <td></td> -->
											<td>จำนวนเงินรวม</td>
											<td></td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_text_discount_total = (float)is($bill,'text_discount_total');
													$text_discount_total = number_format($input_text_discount_total,2);
												?>
												<span id="text-discount-total"><?php echo $text_discount_total; ?></span>
												<?php 
												Form::hidden('input_text_discount_total',$input_text_discount_total); ?>
											</td>
										</tr>
										<tr>
											<!-- <td>
												
											</td> -->
											<td><label for="">ภาษี</label></td>
											<td>
												<?php 
													$vat_list = array(
														array('val'=>'7'),
														array('val'=>'0')
													); 
												?>
												<?php Form::select('select_check_vat',$vat_list,'min-box','val','val',is($bill,'check_vat')); ?>
											</td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_text_vat = (float)is($bill,'text_vat'); 
													$text_vat = number_format($input_text_vat,2);
												?>
												<span id="text_vat"><?php echo $text_vat; ?></span>
												<?php Form::hidden('input_text_vat',$input_text_vat); ?>
											</td>
										</tr>
										<tr> 
											<!-- <td></td> -->
											<td><label for="" id="text_pricewithvat">ราคาไม่รวมภาษีมูลค่าเพิ่ม</label></td>
											<td></td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_text_not_include_vat = (float)is($bill,'text_not_include_vat'); 
													$text_not_include_vat = number_format($input_text_not_include_vat,2);
												?>
												<span id="text_not_include_vat"><?php echo $text_not_include_vat; ?></span>
												<?php Form::hidden('input_text_not_include_vat',$input_text_not_include_vat); ?>
											</td>
										</tr>
										<tr>
											<!-- <td>
												<div class="form-check">
													<?php 
														$chk_tax = is($bill,'chk_tax'); 
													?>
													<input class="form-check-input" type="checkbox" name="chk_tax" id="check_tax" <?php echo ($type_method=="add"?'checked':''); ?> 
														value="1" <?php echo ($chk_tax?'checked':''); ?>> 
												</div>
											</td> -->
											<td>
												<div class="form-check">
													<?php 
														$chk_tax = is($bill,'chk_tax'); 
													?>
													<input class="form-check-input" type="checkbox" name="chk_tax" id="check_tax" <?php echo ($type_method=="add"?'checked':''); ?> 
														value="1" <?php echo ($chk_tax?'checked':''); ?>> 
													<label class="form-check-label" for="check_tax">หัก ณ ที่จ่าย</label>
												</div>
												<!-- <label for="check_tax">หัก ณ ที่จ่าย</label> -->
											</td>
											<td>
												<?php  
													$vat_list = array(
														array('val'=>'0'),
														array('val'=>'0.5'),
														array('val'=>'0.75'),
														array('val'=>'1'),
														array('val'=>'1.5'),
														array('val'=>'2'),
														array('val'=>'3'),
														array('val'=>'5'),
														array('val'=>'10'),
														array('val'=>'15')
													); 
												?>
												<?php
													$check_tax = is($bill,'check_tax'); 
													Form::select('select_check_tax',$vat_list,'min-box','val','val',$check_tax); ?>
											</td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_total_tax = (float)is($bill,'total_tax'); 
													$total_tax = number_format($input_total_tax,2);
												?> 
												<span id="total_tax"><?php echo $total_tax; ?></span>
												<?php Form::hidden('input_total_tax',$input_total_tax); ?>
											</td>
										</tr>
										<tr>
											<!-- <td></td> -->
											<td>ยอดชำระ</td>
											<td></td>
											<td></td>
											<td class=text-right>
												<?php 
													$input_net_total_vat = (float)is($bill,'net_total_vat');
													$net_total_vat = number_format($input_net_total_vat,2);
												?>
												<span id="net_total_vat"><?php echo $net_total_vat; ?></span>
												<?php Form::hidden('input_net_total_vat',$input_net_total_vat); ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

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
<style>
	
</style>
<script>
	$(document).ready(function() {
		$('#list_order tbody#sortable [name="product_name[]"]').select2();
		$("#accounting").addClass('show');

		<?php if ($customer>0) : ?>
		$('#customer').val("<?php echo $customer;?>").trigger('change');
		<?php endif; ?>
	});
</script>