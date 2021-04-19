<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card my-3">
				<div class="card-body">
					<h5 class="card-title">สิทธิ์การเข้าใช้งานของพนักงาน</h5>
					<hr>
					<form action="<?php echo $action;?>" method="post">
						<div class="row">
							<div class="col-sm-12 col-md-3 col-lg-2">
								<p><strong>ตัวเลือกสิทธิ์</strong></p>
							</div>
							<div class="col-sm-12 col-md-9 col-lg-10">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="permisall">
									<label class="form-check-label" for="permisall"><b>เลือกทั้งหมด</b></label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_dashboard">
									<label class="form-check-label" for="permis_dashboard">หน้าหลัก</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_accounting">
									<label class="form-check-label" for="permis_accounting">บัญชี</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_employee">
									<label class="form-check-label" for="permis_employee">พนักงาน</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_product">
									<label class="form-check-label" for="permis_product">สินค้า</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_shop">
									<label class="form-check-label" for="permis_shop">ร้านค้า</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_customer">
									<label class="form-check-label" for="permis_customer">ลูกค้า</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_package">
									<label class="form-check-label" for="permis_package">แพคเกจ</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_report">
									<label class="form-check-label" for="permis_report">รายงาน</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_upload">
									<label class="form-check-label" for="permis_upload">จัดการไฟล์</label>
								</div>	
								<div class="form-check">
									<input class="form-check-input cbpermis" type="checkbox" value="" id="permis_setting">
									<label class="form-check-label" for="permis_setting">ตั้งค่า</label>
								</div>	 
								<a class="btn btn-outline-dark btn-sm mt-2" data-toggle="collapse" href="#collapseClass" role="button" aria-expanded="false" aria-controls="collapseClass">
									ตัวเลือกขั้นสูง
							 	</a>
								<div class="collapse" id="collapseClass">
									<div class="card card-body">
										<?php $hide = array('user','home','api','common','company','rfq'); ?>
										<?php foreach ($route as $class => $functions): ?>
											<p class="mb-0 mt-2 <?php echo (in_array(strtolower($class), $hide)==true) ? 'd-none' : '';?>">
												<strong><?php echo $class; ?></strong>
											</p>
											<div class="form-check <?php echo (in_array(strtolower($class), $hide)==true) ? 'd-none' : '';?>">
												<input class="form-check-input" type="checkbox" value="" id="all_function_<?php echo strtolower($class);?>" <?php echo isset($count_class[strtolower($class)])&&count($functions)==$count_class[strtolower($class)] ? 'checked': ''; ?>>
												<label class="form-check-label" for="all_function_<?php echo strtolower($class);?>"><b>เลือกทั้งหมดใน <?php echo $class; ?></b></label>
											</div>	
											<?php foreach ($functions as $function): ?> 
												<div class="form-check <?php echo (in_array(strtolower($class), $hide)==true) ? 'd-none' : '';?>">
													<input class="form-check-input class_<?php echo strtolower($class);?>" type="checkbox" name="function[]" value="<?php echo strtolower($function);?>" id="function_<?php echo strtolower($function);?>" <?php echo in_array($function,$permission) ? 'checked': '';?>>
													<label class="form-check-label" for="function_<?php echo strtolower($function);?>"><?php echo $function; ?></label>
												</div>	
											<?php endforeach ?>
										<?php endforeach ?>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<hr>
							  	<a href="<?php echo route('employee/listEmployee');?>" class="btn btn-outline-danger">กลับ</a>
							  	<button type="submit" class="btn btn-primary float-right">บันทึก</button>		
							</div>
						</div>
					  	
					  	
					</form>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// for check
	<?php foreach ($route as $class => $functions): ?>
	if ($('#all_function_<?php echo strtolower($class);?>').is(':checked')) {
		$('#permis_<?php echo strtolower($class);?>').prop('checked',true);
	} else {
		$('#permis_<?php echo strtolower($class);?>').prop('checked',false);
	}
	<?php endforeach ?>

	var cbpermisall = true;
	$('.cbpermis').each(function(index, el) {
		if ($(this).is(':checked')==false) {
			cbpermisall = false;
		}
	});
	if (cbpermisall==true) {
		$('#permisall').prop('checked', true);
	}

	$('#permisall').change(function(event) {
		if ($(this).is(':checked')) {
			$('.cbpermis').prop('checked',true).trigger('change');
		} else {
			$('.cbpermis').prop('checked',false).trigger('change');
		}
		check(); 
	});

	$('#all_function_user').prop('checked',true);
	$('.class_user').prop('checked', true);
	$('#all_function_home').prop('checked',true);
	$('.class_home').prop('checked', true);
	$('#all_function_api').prop('checked',true);
	$('.class_api').prop('checked', true);
	$('#all_function_common').prop('checked',true);
	$('.class_common').prop('checked', true);
	$('#all_function_company').prop('checked',true);
	$('.class_company').prop('checked', true);
	$('#all_function_rfq').prop('checked',true);
	$('.class_rfq').prop('checked', true);

	$('#permis_dashboard').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_dashboard').prop('checked',true).trigger('change');
		} else {
			$('#all_function_dashboard').prop('checked',false).trigger('change');
		}
	});
	$('#permis_accounting').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_accounting').prop('checked',true).trigger('change');
		} else {
			$('#all_function_accounting').prop('checked',false).trigger('change');
		}
	});
	$('#permis_employee').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_employee').prop('checked',true).trigger('change');
		} else {
			$('#all_function_employee').prop('checked',false).trigger('change');
		}
	});
	$('#permis_product').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_product').prop('checked',true).trigger('change');
		} else {
			$('#all_function_product').prop('checked',false).trigger('change');
		}
	});
	$('#permis_shop').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_shop').prop('checked',true).trigger('change');
		} else {
			$('#all_function_shop').prop('checked',false).trigger('change');
		}
	});
	$('#permis_customer').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_customer').prop('checked',true).trigger('change');
		} else {
			$('#all_function_customer').prop('checked',false).trigger('change');
		}
	});
	$('#permis_package').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_package').prop('checked',true).trigger('change');
		} else {
			$('#all_function_package').prop('checked',false).trigger('change');
		}
	});
	$('#permis_report').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_report').prop('checked',true).trigger('change');
		} else {
			$('#all_function_report').prop('checked',false).trigger('change');
		}
	});
	$('#permis_upload').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_upload').prop('checked',true).trigger('change');
		} else {
			$('#all_function_upload').prop('checked',false).trigger('change');
		}
	});
	$('#permis_setting').change(function(event) {
		if ($(this).is(':checked')) {
			$('#all_function_setting').prop('checked',true).trigger('change');
		} else {
			$('#all_function_setting').prop('checked',false).trigger('change');
		}
	});
	function checkpermis() {
		$('.cbpermis').each(function(index, el) {
			if ($(this).is('checked')==false) {
				$('#permisall').prop('checked', false).trigger('change');
			}
		});
	}


	<?php foreach ($route as $class => $functions): ?>
	$('#all_function_<?php echo strtolower($class);?>').change(function(event) {
		if ($(this).is(':checked')) {
			$('.class_<?php echo strtolower($class);?>').prop('checked', true);
		} else {
			$('.class_<?php echo strtolower($class);?>').prop('checked', false);
		}
	});
	$('.class_<?php echo strtolower($class);?>').change(function(event) {
		check();
	});
	<?php endforeach ?>

	function check() {
		<?php foreach ($route as $class => $functions): ?>
		$('.class_<?php echo strtolower($class);?>').each(function(index, el) {
			if ($(this).is(':checked')==false) {
				$('#all_function_<?php echo strtolower($class);?>').prop('checked',false).trigger('change');
			}
		});
		<?php endforeach ?>
	}
	
});
</script>