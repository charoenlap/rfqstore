<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card mt-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-theme"><?php echo $text_title; ?></h3>
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="<?php echo $action; ?>" method="POST" id="form-company-<?php echo $form_id;?>">
							  <div class="form-group">
							    <label for="">ชื่อบริษัท</label>
							    <input type="text" class="form-control" placeholder="" name="company_name" value="<?php echo $company_name; ?>">
							    <small class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">ชื่อ Url เช่น https://www.rfqstore.com/xxx</label>
							    <input type="text" class="form-control" placeholder="xxx" name="company_url" value="<?php echo $company_url; ?>">
							    <small class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">Layout</label>
							    <select name="company_layout" id="" class="form-control">
									<option value="0" <?php if($company_layout == '0'){ echo "selected"; } ?>>Layout One</option>
									<option value="1" <?php if($company_layout == '1'){ echo "selected"; } ?>>Layout Two</option>
								</select>
							  </div>
							  <div class="form-group">
							    <label for="">หมายเลขผู้เสียภาษี</label>
							    <input type="text" class="form-control" placeholder="" name="company_tax_no" value="<?php echo $company_tax_no; ?>">
							    <small class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">ที่อยู่บริษัท</label>
							    <input type="text" class="form-control" placeholder="" name="company_address" value="<?php echo $company_address; ?>">
							    <small class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">จังหวัด</label>
							    <select  class="form-control" placeholder="" name="company_province">
							    	<?php foreach($province as $val){ 
							    		$selected = ($val==$company_province?'selected':'');
							    	?>
							    		<option value="<?php echo $val;?>" <?php echo $selected;?>>
							    			<?php echo $val;?>
							    		</option>
							    	<?php } ?>
							    </select>
							    <small class="form-text text-muted"></small>
							  </div>
							  <div class="form-group">
							    <label for="">เบอร์โทรศัพท์</label>
							    <input type="text" class="form-control" placeholder="" name="company_tel" value="<?php echo $company_tel; ?>">
							    <small class="form-text text-muted"></small>
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

