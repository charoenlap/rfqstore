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
							<div class="col-md-4">
								<?php Form::text('withholdingTax_doc_no','เลขที่เอกสาร.',is($bill,'withholdingTax_doc_no')); ?>
							</div>
							<dic class="col-md-4">
								<?php Form::date('withholdingTax_date','วันที่เอกสาร',is($bill,'withholdingTax_date')); ?>
							</dic>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
								<label for="">1.ชื่อ. ที่อยู่และเลขประจำตัวผู้เสียภาษีอากร (บุคคล คณะบุคคล นิติบุคคล ส่วนราชการองค์การ รัฐวิสาหกิจ ฯลฯ ) ของผู้มีหน้าที่หักภาษี ณ ที่จ่าย :</label>
							</div>
						</div>
						<div class="row"> 
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_no_1','เลขที่ทะเบียน/ID No.',is($bill,'withholdingTax_id_no_1')); ?>
							</div>
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_name_1','ชื่อ/Name',is($bill,'withholdingTax_id_name_1')); ?>
							</div>
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_address_1','ที่อยู่/Address',is($bill,'withholdingTax_id_address_1')); ?>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12">
								<label for="">1. ชื่อ. ที่อยู้และเลขประจำตัวผู้เสียภาษีอากรของผู้ถูกหักภาษี ณ ที่จ่าย :</label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<?php Form::select('customer',$customer_list,'select2-tag','id_customer','customer_company',is($customer,'id_customer')); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_no_2','เลขที่ทะเบียน/ID No.',is($bill,'withholdingTax_id_no_2')); ?>
							</div>
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_name_2','ชื่อ/Name',is($bill,'withholdingTax_id_name_2')); ?>
							</div>
							<div class="col-md-4">
								<?php Form::text('withholdingTax_id_address_2','ที่อยู่/Address',is($bill,'withholdingTax_id_address_2')); ?>
							</div>
						</div>
						<div class="row"><div class="col-md-12"><hr></div></div>
						<div class="row mt-4">
							<div class="col-md">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-list table-theme" id="list_order">
										<thead>
											<tr>
												<th></th>
												<th>วัน เดือน หรือปีภาษีที่จ่าย</th>
												<th>จำนวนเงินที่จ่าย</th>
												<th>จำนวนเงินภาษีที่หักไว้</th>
											</tr>
										</thead>
										<tbody id="sortable">

												<tr>
													<td width="40%">1. เงินเดือน ค่าจ้าง เบี้ยเลี้ยง โบนัส ฯลฯ ตามมาตรา 40(1)</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_1','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_1')); ?></td>
													<td><?php Form::text('withholdingTax_price_1','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_1')); ?></td>
													<td><?php Form::text('withholdingTax_tax_1','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_1')); ?></td>
												</tr>
												<tr>
													<td>2. ค่าธรรมเนียม ค่านายหน้า ฯลฯ ตามมาตรา 40(2)</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_2','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_2')); ?></td>
													<td><?php Form::text('withholdingTax_price_2','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_2')); ?></td>
													<td><?php Form::text('withholdingTax_tax_2','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_2')); ?></td>
												</tr>
												<tr>
													<td>3. ค่าแห่งลิขสิทธิ์ ฯลฯ ตามมาตรา 40(3)</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_3','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_3')); ?></td>
													<td><?php Form::text('withholdingTax_price_3','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_3')); ?></td>
													<td><?php Form::text('withholdingTax_tax_3','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_3')); ?></td>
												</tr>
												<tr>
													<td>4. ค่าดอกเบี้ย ฯลฯ ตามมาตรา 40(4)(ก)</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_4','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_4')); ?></td>
													<td><?php Form::text('withholdingTax_price_4','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_4')); ?></td>
													<td><?php Form::text('withholdingTax_tax_4','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_4')); ?></td>
												</tr>
												<tr>
													<td>
														5. การจ่ายเงินได้ที่ต้องหักภาษี ณ ที่จ่ายตามความสั่งกรม
														สรรพากรที่ออกตามมาตรา 3 เตรส เช่น ค่าซื้อพืชผลทางการเกษตร
														(ยางพารา มันสำปะหลัง ปอ ข่าว ฯลฯ)รางวัลในการประกวด การแข่งขัน การชิงโชค
														ค่าแสดงภาพยนตร์ ร้องเพลง ดนตรี ค่าจ้างทำของ ค่าจ้างโฆษณา ค่าเช่า ฯลฯ
													</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_5','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_5')); ?></td>
													<td><?php Form::text('withholdingTax_price_5','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_5')); ?></td>
													<td><?php Form::text('withholdingTax_tax_5','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_5')); ?></td>
												</tr>
												<tr>
													<td>6. อื่นๆ(ระบุ) Other 
														<?php Form::text('withholdingTax_other','อื่นๆ(ระบุ) Other',is($bill,'withholdingTax_other')); ?>
													</td>
													<td><?php Form::datetwo('withholdingTax_date_tax_6','วัน เดือน หรือปีภาษีที่จ่าย',is($bill,'withholdingTax_date_tax_6')); ?></td>
													<td><?php Form::text('withholdingTax_price_6','จำนวนเงินที่จ่าย',is($bill,'withholdingTax_price_6')); ?></td>
													<td><?php Form::text('withholdingTax_tax_6','จำนวนเงินภาษีที่หักไว้',is($bill,'withholdingTax_tax_6')); ?></td>
												</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- <div class="row mb-4">
							<div class="col-md text-right">
								<a href="#" id="addRowForm" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> เพิ่มรายการ</a>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md">
								<div class="row">
									<div class="col-md-6">
										<?php Form::text('withholdingTax_no','ลำดับที่ (ในแบบ)',is($bill,'withholdingTax_no')); ?>
									</div>
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-4">
												<?php Form::chk('withholdingTax_chk1','ภ.ง.ด.1 ก. <br> P.N.D. 1 Kor',is($bill,'withholdingTax_chk1')); ?>
												<?php Form::chk('withholdingTax_chk2','ภ.ง.ด.1 ก พิเศษ <br> P.N.D. 1 Kor(Special)',is($bill,'withholdingTax_chk2')); ?>
												<?php Form::chk('withholdingTax_chk3','ภ.ง.ด.2 <br> P.N.D. 2',is($bill,'withholdingTax_chk3')); ?>
											</div>
											<div class="col-md-4">
												<?php Form::chk('withholdingTax_chk4','ภ.ง.ด.2 ก. <br> P.N.D. 2 Kor',is($bill,'withholdingTax_chk4')); ?>
												<?php Form::chk('withholdingTax_chk5','ภ.ง.ด.3 <br> P.N.D. 3',is($bill,'withholdingTax_chk5')); ?>
												<?php Form::chk('withholdingTax_chk6','ภ.ง.ด.53 <br> P.N.D. 53',is($bill,'withholdingTax_chk6')); ?>
											</div>
											<div class="col-md-4">
												<?php Form::chk('withholdingTax_chk7','ออกภาษีให้ครั้งเดียว <br> paid for 1 time',is($bill,'withholdingTax_chk7')); ?>
												<?php Form::chk('withholdingTax_chk8','ออกภาษีให้ตลอดไป <br> paid all tax',is($bill,'withholdingTax_chk8')); ?>
												<?php Form::chk('withholdingTax_chk9','หักภาษี ณ ที่จ่าย <br> withhold tax at source',is($bill,'withholdingTax_chk9')); ?>
											</div>
											<div class="col-md-4">
										  		<?php Form::chk('withholdingTax_chk10','อื่นๆ / Other',is($bill,'withholdingTax_chk10')); ?>
										  		<?php Form::text('withholdingTax_chk10_other','อื่นๆ',is($bill,'withholdingTax_chk10_other')); ?>
										  	</div>
										</div>		
									</div>
									<div class="col-md-12">
										<?php Form::text('withholdingTax_price_security','เงินสะสมจ่ายกองทุนประกันสังคม',is($bill,'withholdingTax_price_security')); ?>
									</div>
									<div class="col-md-12">
										<?php Form::text('withholdingTax_no_account_boss','เลขที่บัญชีนายจ้าง',is($bill,'withholdingTax_no_account_boss')); ?>
									</div>
									<div class="col-md-12">
										<?php Form::text('withholdingTax_no_insurance','เลขที่บัตรประกันสังคมของผู้ถูกหักภาษี ณ ที่จ่าย',is($bill,'withholdingTax_no_insurance')); ?>
									</div>
									<!-- <div class="col-md-12">
										<?php Form::text('withholdingTax_signed','ลงชื่อ (Signed)  ผู้มีหน้าที่หักภาษี ณ ที่จ่าย / Person who deducts tax at source',is($bill,'withholdingTax_signed')); ?>
									</div> -->
								</div>
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

<script>
	$(document).ready(function() {
		$("#accounting").addClass('show');
	});
</script>