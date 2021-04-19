<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<form class="mt-4" action="<?php echo $action; ?>" method="post">
				<div class="row">
					<div class="col-md-6">
						<h3>ข้อมูลผู้ติดต่อ</h3>
						<hr>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">หมวดหมู่ลูกค้า</label>
							<div class="col-md-9">
								<select name="id_customer_category" id="" class="form-control selectpicker">
									<?php foreach ($categories as $category) { ?>
									<option value="<?php echo $category['id_customer_category']; ?>" <?php echo $id_customer_category==$category['id_customer_category'] ? 'selected' : ''; ?>><?php echo $category['category_name']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ประเภทผู้ติดต่อ</label>
							<div class="col-md-9">
								<select name="customer_type" id="" class="form-control selectpicker">
									<option <?php echo $customer_type=='นิติบุคคล'?'selected':'';?> value="นิติบุคคล">นิติบุคคล</option>
									<option <?php echo $customer_type=='บุคคลธรรมดา'?'selected':'';?> value="บุคคลธรรมดา">บุคคลธรรมดา</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ประเภท</label> 
							<div class="col-md-9">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="customer_contacttype" id="customer_contacttype1" value="1" <?php echo $customer_contacttype=='1'?'checked':'';?>>
									<label class="form-check-label" for="customer_contacttype1">ลูกค้า</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="customer_contacttype" id="customer_contacttype2" value="2" <?php echo $customer_contacttype=='2'?'checked':'';?>>
									<label class="form-check-label" for="customer_contacttype2">ผู้จำหน่าย</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เครดิต(วัน)</label>
							<div class="col-md-9">
								<input type="number" min="1" name="customer_credit" class="form-control" placeholder="เครดิตบิล" value="<?php echo $customer_credit;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">รหัสผู้ติดต่อ</label>
							<div class="col-md-9">
								<input type="text" name="customer_code" class="form-control" placeholder="รหัสผู้ติดต่อ" value="<?php echo $customer_code;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ชื่อธุรกิจ</label>
							<div class="col-md-9">
								<input type="text" name="customer_company" class="form-control" placeholder="ชื่อธุรกิจ" value="<?php echo $customer_company;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เลขผู้เสียภาษี</label>
							<div class="col-md-9">
								<input type="text" name="customer_tax" class="form-control" placeholder="เลขผู้เสียภาษี" value="<?php echo $customer_tax;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">สำนักงาน/สาขา</label>
							<div class="col-md-9">
								<input type="text" name="customer_branch" class="form-control" placeholder="สำนักงาน/สาขา" value="<?php echo $customer_branch;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ที่อยู่</label>
							<div class="col-md-9">
								<textarea name="customer_address" id="" cols="30" rows="4" class="form-control" placeholder="ที่อยู่"><?php echo $customer_address; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ที่อยู่จัดส่ง</label>
							<div class="col-md-9">
								<textarea name="customer_shippingaddress" id="" cols="30" rows="4" class="form-control" placeholder="ที่อยู่จัดส่ง"><?php echo $customer_shippingaddress; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เบอร์สำนักงาน</label>
							<div class="col-md-9">
								<input type="text" name="customer_phone" class="form-control" placeholder="เบอร์สำนักงาน" value="<?php echo $customer_phone; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เบอร์โทรสาร</label>
							<div class="col-md-9">
								<input type="text" name="customer_fax" class="form-control" placeholder="เบอร์โทรสาร" value="<?php echo $customer_fax; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เว็บไซต์</label>
							<div class="col-md-9">
								<input type="text" name="customer_website" class="form-control" placeholder="เว็บไซต์" value="<?php echo $customer_website; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<h3>รายละเอียดผู้ติดต่อ</h3>
						<hr>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ชื่อผู้ติดต่อ</label>
							<div class="col-md-9">
								<input type="text" name="customer_name" class="form-control" placeholder="ชื่อผู้ติดต่อ" value="<?php echo $customer_name; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">อีเมล</label>
							<div class="col-md-9">
								<input type="text" name="customer_email" class="form-control" placeholder="อีเมล" value="<?php echo $customer_email; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เบอร์มือถือ</label>
							<div class="col-md-9">
								<input type="text" name="customer_telephone" class="form-control" placeholder="เบอร์มือถือ" value="<?php echo $customer_telephone; ?>">
							</div>
						</div>
						<br>
						<h3>ข้อมูลธนาคาร</h3>
						<hr>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ธนาคาร</label>
							<div class="col-md-9">
								<select name="customer_bank" id="" class="form-control selectpicker" data-live-search="true" title="เลือกธนาคาร">
									<option <?php echo $customer_bank=='ธ.กสิกรไทย'?'selected':'';?> value="ธ.กสิกรไทย">ธ.กสิกรไทย</option>
									<option <?php echo $customer_bank=='ธ.ไทยพาณิชย์'?'selected':'';?> value="ธ.ไทยพาณิชย์">ธ.ไทยพาณิชย์</option>
									<option <?php echo $customer_bank=='ธ.กรุงเทพ'?'selected':'';?> value="ธ.กรุงเทพ">ธ.กรุงเทพ</option>
									<option <?php echo $customer_bank=='ธ.กรุงไทย'?'selected':'';?> value="ธ.กรุงไทย">ธ.กรุงไทย</option>
									<option <?php echo $customer_bank=='ธ.ทหารไทย'?'selected':'';?> value="ธ.ทหารไทย">ธ.ทหารไทย</option>
									<option <?php echo $customer_bank=='ธ.กรุงศรีอยุธยา'?'selected':'';?> value="ธ.กรุงศรีอยุธยา">ธ.กรุงศรีอยุธยา</option>
									<option <?php echo $customer_bank=='ธ.ออมสิน'?'selected':'';?> value="ธ.ออมสิน">ธ.ออมสิน</option>
									<option <?php echo $customer_bank=='ธ.ธนชาต'?'selected':'';?> value="ธ.ธนชาต">ธ.ธนชาต</option>
									<option <?php echo $customer_bank=='ธ.ซีไอเอ็มบี ไทย'?'selected':'';?> value="ธ.ซีไอเอ็มบี ไทย">ธ.ซีไอเอ็มบี ไทย</option>
									<option <?php echo $customer_bank=='ธ.ยูโอบี'?'selected':'';?> value="ธ.ยูโอบี">ธ.ยูโอบี</option>
									<option <?php echo $customer_bank=='ธ.ทิสโก้'?'selected':'';?> value="ธ.ทิสโก้">ธ.ทิสโก้</option>
									<option <?php echo $customer_bank=='ธ.ซิตี้แบงก์'?'selected':'';?> value="ธ.ซิตี้แบงก์">ธ.ซิตี้แบงก์</option>
									<option <?php echo $customer_bank=='ธ.แลนด์ แอนด์ เฮ้าส์'?'selected':'';?> value="ธ.แลนด์ แอนด์ เฮ้าส์">ธ.แลนด์ แอนด์ เฮ้าส์</option>
									<option <?php echo $customer_bank=='ธ.เกียรตินาคิน'?'selected':'';?> value="ธ.เกียรตินาคิน">ธ.เกียรตินาคิน</option>
									<option <?php echo $customer_bank=='ธ.เพื่อการเกษตรและสหกรณ์การเกษตร'?'selected':'';?> value="ธ.เพื่อการเกษตรและสหกรณ์การเกษตร">ธ.เพื่อการเกษตรและสหกรณ์การเกษตร</option>
									<option <?php echo $customer_bank=='ธ.เพื่อการส่งออกและนำเข้าแห่งประเทศไทย'?'selected':'';?> value="ธ.เพื่อการส่งออกและนำเข้าแห่งประเทศไทย">ธ.เพื่อการส่งออกและนำเข้าแห่งประเทศไทย</option>
									<option <?php echo $customer_bank=='ธ.สแตนดาร์ดชาร์เตอร์ด'?'selected':'';?> value="ธ.สแตนดาร์ดชาร์เตอร์ด">ธ.สแตนดาร์ดชาร์เตอร์ด</option>
									<option <?php echo $customer_bank=='ธ.อาคารสงเคราะห์'?'selected':'';?> value="ธ.อาคารสงเคราะห์">ธ.อาคารสงเคราะห์</option>
									<option <?php echo $customer_bank=='ธ.พัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย'?'selected':'';?> value="ธ.พัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย">ธ.พัฒนาวิสาหกิจขนาดกลางและขนาดย่อมแห่งประเทศไทย</option>
									<option <?php echo $customer_bank=='ธ.อิสลามแห่งประเทศไทย'?'selected':'';?> value="ธ.อิสลามแห่งประเทศไทย">ธ.อิสลามแห่งประเทศไทย</option>
									<option <?php echo $customer_bank=='ธ.แห่งประเทศจีน (ไทย)'?'selected':'';?> value="ธ.แห่งประเทศจีน (ไทย)">ธ.แห่งประเทศจีน (ไทย)</option>
									<option <?php echo $customer_bank=='ธ.ไอซีบีซี (ไทย)'?'selected':'';?> value="ธ.ไอซีบีซี (ไทย)">ธ.ไอซีบีซี (ไทย)</option>
									<option <?php echo $customer_bank=='ธ.เมกะ สากลพาณิชย์'?'selected':'';?> value="ธ.เมกะ สากลพาณิชย์">ธ.เมกะ สากลพาณิชย์</option>
									<option <?php echo $customer_bank=='ธ.ซูมิโตโม มิตซุย แบงกิ้ง คอร์ปอเรชั่น'?'selected':'';?> value="ธ.ซูมิโตโม มิตซุย แบงกิ้ง คอร์ปอเรชั่น">ธ.ซูมิโตโม มิตซุย แบงกิ้ง คอร์ปอเรชั่น</option>
									<option <?php echo $customer_bank=='ธ.มิซูโฮ จำกัด (กรุงเทพฯ)'?'selected':'';?> value="ธ.มิซูโฮ จำกัด (กรุงเทพฯ)">ธ.มิซูโฮ จำกัด (กรุงเทพฯ)</option>
									<option <?php echo $customer_bank=='ธ.ฮ่องกงและเซี่ยงไฮ้แบงกิ้งคอร์ปอเรชั่น'?'selected':'';?> value="ธ.ฮ่องกงและเซี่ยงไฮ้แบงกิ้งคอร์ปอเรชั่น">ธ.ฮ่องกงและเซี่ยงไฮ้แบงกิ้งคอร์ปอเรชั่น</option>
									<option <?php echo $customer_bank=='ธ.ไทยเครดิต เพื่อรายย่อย'?'selected':'';?> value="ธ.ไทยเครดิต เพื่อรายย่อย">ธ.ไทยเครดิต เพื่อรายย่อย</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">เลขที่บัญชี</label>
							<div class="col-md-9">
								<input type="text" name="customer_bankaccount" class="form-control" placeholder="เลขที่บัญชี" value="<?php echo $customer_bankaccount;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">สาขาธนาคาร</label>
							<div class="col-md-9">
								<input type="text" name="customer_bankbranch" class="form-control" placeholder="สาขาธนาคาร" value="<?php echo $customer_bankbranch;?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">ประเภทบัญชี</label>
							<div class="col-md-9">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="customer_banktype" id="customer_banktype1" value="บัญชีออมทรัพย์" <?php echo $customer_banktype=='บัญชีออมทรัพย์'?'checked':'';?>>
									<label class="form-check-label" for="customer_banktype1">บัญชีออมทรัพย์</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="customer_banktype" id="customer_banktype2" value="บัญชีกระแสรายวัน" <?php echo $customer_banktype=='บัญชีกระแสรายวัน'?'checked':'';?>>
									<label class="form-check-label" for="customer_banktype2">บัญชีกระแสรายวัน</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<br>
				<a href="<?php echo route('customer/listCustomer');?>" class="btn btn-outline-danger">กลับ</a>
				<button type="submit" class="btn btn-primary float-right">บันทึก</button>
			</form>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function($) {
	$.fn.selectpicker.Constructor.BootstrapVersion = '4';

	$('.selectpicker').selectpicker();
});
</script>