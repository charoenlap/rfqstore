<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			
		
	<div class="row">
		<div class="col-12">
			<h3>พนักงาน</h3>
			<hr>
		</div>
	</div>
	<form action="<?php echo $action;?>" method="post">

		<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
		<div class="row">
			<div class="col-sm-12 col-md-6">

				<?php if (!isset($_GET['id'])): ?>
				<div class="form-group row">
					<label for="" class="col-sm-12 col-md-3">ค้นหาอีเมล</label>
					<div class="col-sm-12 col-md-9">
						<input type="text" class="form-control" id="search_email" placeholder="ถ้ามีอีเมลในระบบข้อมูลจะถูกดึงมา" autofocus="on">
					</div>
				</div>
			  	<?php endif ?>	

				<div class="form-group row">
				    <label for="" class="col-sm-12 col-md-3">รหัสพนักงาน <span class="text-danger">*</span></label>
				    <div class="col-sm-12 col-md-9">
				    	<input type="text" name="employee_code" class="form-control" id="" value="<?php echo $employee_code; ?>" required>
					    <small id="alertcode" class="form-text text-danger"></small>
				    </div>
			  	</div>		
			  	<div class="form-group row">
				    <label for="" class="col-sm-12 col-md-3">อีเมล <span class="text-danger">*</span></label>
				    <div class="col-sm-12 col-md-9">
				    	<input type="text" name="employee_email" class="form-control" value="<?php echo $employee_email; ?>" <?php echo isset($_GET['id']) ? 'readonly' : '';?> required>
				    </div>
			  	</div>
			  	<div class="form-group row hasuser">
				    <label for="" class="col-sm-12 col-md-3">รหัสผ่าน</label>
				    <div class="col-sm-12 col-md-9">
					    <input type="password" name="password" class="form-control">
				    </div>
			  	</div>
			  	<div class="form-group row hasuser">
				    <label for="" class="col-sm-12 col-md-3">ยืนยันรหัสผ่าน</label>
				    <div class="col-sm-12 col-md-9">
					    <input type="password" name="confirm_password" class="form-control">
				    </div>
			  	</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="form-group row">
				    <label for="" class="col-sm-12 col-md-3">ชื่อ <span class="text-danger">*</span></label>
				    <div class="col-sm-12 col-md-9">
					    <input type="text" name="employee_firstname" class="form-control" placeholder="ชื่อพนักงาน" value="<?php echo $employee_firstname; ?>" required>
					    <small class="form-text text-muted"></small>
				    </div>
			  	</div>
			  	<div class="form-group row"> 
				    <label for="" class="col-sm-12 col-md-3">นามสกุล <span class="text-danger">*</span></label>
				    <div class="col-sm-12 col-md-9">
					    <input type="text" name="employee_lastname" class="form-control" placeholder="นามสกุลพนักงาน" value="<?php echo $employee_lastname; ?>" required>
					    <small class="form-text text-muted"></small>
				    </div>
			  	</div>
			  	<div class="form-group row">
			  		<label for="" class="col-sm-12 col-md-3">เงินเดือน</label>
			  		<div class="col-sm-12 col-md-9">
			  			<input type="number" name="employee_salary" class="form-control" placeholder="เงินเดือนพนักงาน" value="<?php echo $employee_salary;?>">
			  		</div>
			  	</div>
			  	<div class="form-group row">
			  		<label for="" class="col-sm-12 col-md-3">เริ่มเข้าทำงาน</label>
			  		<div class="col-sm-12 col-md-9">
			  			<!-- <input type="date"> -->
			  			<input type="text" name="employee_startwork" class="form-control inputdatepicker" placeholder="" >
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

<script type="text/javascript">
jQuery(document).ready(function($) {
	

	$('.hasuser').show();
	$('#search_email').keyup(function(event) {
		
		var search = $(this).val();
		$.ajax({
			url: '<?php echo $ajax_finduser;?>',
			type: 'POST',
			dataType: 'json',
			data: {email: search},
			success: function(data) {
				console.log(data.id_user);
				$('input:not(#search_email)').val('');
				$.each(data, function(index, val) {
					 $('[name="'+index+'"]').val(val);
				});
				if (data.id_user>0) {
					$('.hasuser').slideUp('fast');
				}
					
			}
		})
		.fail(function() {
			console.log("error");
			$('[type="text"]:not(#search_email,[name="employee_email"])').val('');
			$('.hasuser').slideDown('fast');
			$('[name="user_email"]').val(search);
		});
		$('[name="employee_email"]').val(search);
	});

	$('[name="code"]').keyup(function(event) {
		var codeval = $(this).val();
		$.ajax({
			url: '<?php echo $ajax_checkcode;?>',
			type: 'POST',
			dataType: 'json',
			data: {employee_code: codeval},
			success: function(data) {
				if (data>0) {
					$('#alertcode').html('รหัสผ่านนี้มีผู้ใช้งานในบริษัทแล้ว กรุณาเปลี่ยนรหัสพนักงานใหม่');
				} else {
					$('#alertcode').html('');
				}
			}
		});
	});

	
	
});
</script>