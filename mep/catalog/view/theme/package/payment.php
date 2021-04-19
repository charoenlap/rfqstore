 <?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<form action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="route" value="<?php echo get('route'); ?>">
			<div class="col-md-12">
				<div class="card mt-3">
					<div class="card-body">
						<div class="row mb-3">
							 <div class="col-md-12">
							 	<h5>แจ้งชำระเงิน</h5>
							 </div>
						</div>
						<?php if($result=='success'){?>
						<p class="alert alert-success">บันทึกสำเร็จ กรุณารอเจ้าหน้าที่ตรวจสอบ</p>
						<?php }elseif($result=='fail'){?>
						<p class="alert alert-danger">บันทึกไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่</p>
						<?php } ?>
						<div class="row mb-3">
							<div class="col-md-6 mb-3">
								<div class="row">
									<div class="col-md-6">
										<label for="">ชื่อแพคเกจ</label>
										<select name="id_package" id="id_package" class="form-control select2">
										<?php 
											$i = 0;
											foreach($listPackage as $val){ 
												$selected = '';
												if($i==0){
													$package_price = $val['package_price'];
												}
												if($id_package==$val['id_package']){
													$selected = 'selected';
													$package_price = $val['package_price'];
												}
										?>
											<option value="<?php echo $val['id_package']; ?>" <?php echo $selected; ?> package_price="<?php echo $val['package_price']; ?>">
												<?php echo $val['package_name']; ?>
											</option>
										<?php $i++; } ?>
										</select>
									</div>
									<div class="col-md-6">
										<label for="">ราคาแพคเกจ</label>
										<div id="package_price_text"><?php echo $package_price; ?></div>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="">ชื่อ-สกุล</label>
								<input type="text" class="form-control" name="payment_customer" value="<?php echo is($user_detail,'user_name').' '.is($user_detail,'user_lastname'); ?>" required>
							</div>
							<div class="col-md-6 mb-3">
								<label for="">ธนาคารที่โอนเข้า</label>
								<select name="payment_bank" id="" class="form-control select2">
									<option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								<div class="row">
									<div class="col-md-6">
										<label for="">จำนวนเดือน</label>
										<div class="input-group">
											<select name="payment_month" id="payment_month" class="form-control select2"> 
												<option value="1">1 เดือน</option>
												<option value="3">3 เดือน</option>
												<option value="6">6 เดือน</option>
												<option value="12">1 ปี</option>
												<option value="24">2 ปี</option>
												<option value="36">3 ปี</option>
												<option value="60">5 ปี</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<label for="">จำนวนเงินที่โอน</label>
										<div class="input-group">
											<input type="text" name="payment_price" id="payment_price" class="form-control text-right" aria-label="" value="<?php echo $package_price; ?>" required>
											<div class="input-group-append">
												<span class="input-group-text">บาท</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="">วันที่โอน</label>
								<?php Form::date('payment_date'); ?>
							</div>
							<div class="col-md-6 mb-3">
								<label for="">เวลาที่โอน</label>
								<div class="row">
									<div class="col-md">
										<?php Form::text('payment_time_hour','ชั่วโมงที่โอน',date('H')); ?>
									</div>
									<div class="col-md">
										<?php Form::text('payment_time_min','นาทีที่โอน',date('i')); ?>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="">หลักฐานการโอนเงิน</label>
								<div class="custom-file">
								    <input type="file" name="payment_file" class="custom-file-input" id="customFile">
								    <label class="custom-file-label" for="customFile">ยังไม่ได้เลือกไฟล์</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-right">
								<button class="btn btn-primary btn-theme rounded-0">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
$(function(e){
   $('.select2').select2({
        width: 'resolve'
   });
});
$('#id_package').on('change',function(e){
	var package_price = $('option:selected', this).attr('package_price');
	$('#package_price_text').text(package_price);
	$('#payment_price').val(package_price * parseFloat($('#payment_month').val()));
});
$('#payment_month').on('change',function(e){
	$('#payment_price').val(parseFloat($('#package_price_text').text()) * parseFloat($('#payment_month').val()));
});
</script>