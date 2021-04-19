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
					<div class="col-sm-12">
						<h4>ข้อมูลบริษัท</h4>
						<hr>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">รูปบริษัท</label>
							<div>
								<div style="width:100%">
									<img src="<?php echo !empty($company_logo) ? IMAGE.$company_logo : MURL.'assets/image/noimg.png'; ?>" alt="preview" id="preview_company_logo" class="img-thumbnail mb-2 img-fluid"><br>
									<input type="hidden" name="company_logo" id="input_company_logo" value="<?php echo !empty($company_logo) ? $company_logo : ''; ?>"> 
									<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal_filemanager" data-result="#input_company_logo" data-preview="#preview_company_logo">
									<i class="far fa-image"></i>
									</button>
									<button type="button" class="btn btn-outline-danger upload_removeimg" data-result="#input_company_logo" data-preview="#preview_company_logo">
									<i class="far fa-trash-alt"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label for="">ชื่อบริษัท</label>						
							<input type="text" name="company_name" class="form-control" placeholder="ชื่อบริษัท" value="<?php echo $setting['company_name']; ?>" />
						</div>
						<div class="form-group">
							<label for="">เลขประจำตัวผู้เสียภาษี</label>
							<input type="text" name="company_tax_no" class="form-control" placeholder="เลขประจำตัวผู้เสียภาษี" value="<?php echo $setting['company_tax_no']; ?>" />
						</div>
						<div class="form-group">
							<label for="">เบอร์โทรศัพท์</label>
							<input type="text" name="company_tel" class="form-control" placeholder="เบอร์โทรศัพท์" value="<?php echo $setting['company_tel']; ?>" />
						</div>
						<div class="form-group">
							<label for="">ที่อยู่</label>
							<input type="text" name="company_address" class="form-control" placeholder="ที่อยู่" value="<?php echo $setting['company_address']; ?>" />
						</div>
						<!-- <div class="form-group">
							<label for="">จังหวัด</label>
							<input type="text" name="company_province" class="form-control" placeholder="จังหวัด" value="<?php echo $setting['company_province']; ?>" />
						</div> -->
						<div class="form-group">
							<label for="">สำนักงานใหญ่</label>
							<input type="text" name="company_head_office" class="form-control" placeholder="สำนักงานใหญ่" value="<?php echo $setting['company_head_office']; ?>" />
						</div>
						<div class="form-group">
							<label for="">สำนักงานย่อย (ถ้าไม่ใช่สำนักงานใหญ่)</label>
							<input type="text" name="company_sub_office" class="form-control" placeholder="สำนักงานย่อย" value="<?php echo $setting['company_sub_office']; ?>" />
						</div>
						<!-- <?php Form::text('company_name','ชื่อบริษัท',is($setting,'company_name')); ?>
						<?php Form::text('company_tax_no','เลขประจำตัวผู้เสียภาษี',is($setting,'company_tax_no')); ?>
						<?php Form::text('company_tel','เบอร์โทรศัพท์',is($setting,'company_tel')); ?>
						<?php Form::text('company_address','ที่อยู่',is($setting,'company_address')); ?>
						<?php Form::text('company_province','จังหวัด',is($setting,'company_province')); ?>
						<?php Form::chk('company_head_office','สำนักงานใหญ่',is($setting,'company_head_office')); ?>
						<?php //echo is($setting,'company_verify'); ?> -->
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