<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-theme">เพิ่มบริษัท</h3>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="<?php echo $action; ?>" method="POST" id="form-company-<?php echo $form_id;?>">
							  <div class="form-group">
							    <label for="">ชื่อบริษัท</label>
							    <input type="text" class="form-control" id="" placeholder="" name="company_name" value="<?php echo $company_name; ?>">
							    <small id="" class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">หมายเลขผู้เสียภาษี</label>
							    <input type="text" class="form-control" id="" placeholder="" name="company_tax_no" value="<?php echo $company_tax_no; ?>">
							    <small id="" class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">ที่อยู่บริษัท</label>
							    <input type="text" class="form-control" id="" placeholder="" name="company_address" value="<?php echo $company_address; ?>">
							    <small id="" class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">จังหวัด</label>
							    <input type="text" class="form-control" id="" placeholder="" name="company_province" value="<?php echo $company_province; ?>">
							    <small id="" class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">เบอร์โทรศัพท์</label>
							    <input type="text" class="form-control" id="" placeholder="" name="company_tel" value="<?php echo $company_tel; ?>">
							    <small id="" class="form-text text-muted"></small>
							  </div>
							  <button type="submit" class="btn btn-primary">ยืนยัน</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

