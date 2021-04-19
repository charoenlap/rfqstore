<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card-theme my-5">
				<div class="card-theme-body">
					<!-- <div class="row">
						<div class="col-md-12">
							<h3 class="text-secondary">ติดต่อเรา</h3>
							<hr>
						</div>
					</div> -->
					
					<div class="row">

						<div class="col-12">
							<?php if (!empty($success)): ?>
								<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
							<?php endif ?>
							<?php if (!empty($error)): ?>
								<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
							<?php endif ?>
						</div>
						<div class="col-md-6 mb-3">
							<div class="col-12">
								<h3 class="text-secondary">ติดต่อเรา</h3>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<img src="http://www.friendlysoftpro.com/assets/images/logo-friendly.png" alt="" class="img-fluid mt-3" height="100">
									</div>
									<div class="col-md-8">
										<p class="mb-0"><b>Friendlysoftpro.co.ltd ( เฟรนลี่ซอฟโปร )</b></p>
										<p class="mb-0"><i class="fas fa-map-marker-alt"></i> 91/568 พระรามที่ 2 ซอย 69 แขวง แสมดำ เขตบางขุนเทียน กรุงเทพมหานคร 10150</p>
										<p class="mb-0"><i class="fas fa-phone fa-flip-horizontal"></i> 082 - 721 - 8999</p>
										<a href="https://www.google.com/maps/place/friendlysoftpro+(+%E0%B9%80%E0%B8%9F%E0%B8%A3%E0%B8%99%E0%B8%A5%E0%B8%B5%E0%B9%88%E0%B8%8B%E0%B8%AD%E0%B8%9F%E0%B9%82%E0%B8%9B%E0%B8%A3+)+%E0%B8%97%E0%B8%B3%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A%E0%B9%84%E0%B8%8B%E0%B8%95%E0%B9%8C+%E0%B9%80%E0%B8%82%E0%B8%B5%E0%B8%A2%E0%B8%99%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B8%A3%E0%B8%A1+91%2F568+%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%A3%E0%B8%B2%E0%B8%A1%E0%B8%97%E0%B8%B5%E0%B9%88+2+%E0%B8%8B%E0%B8%AD%E0%B8%A2+69+Samae+Dam,+Bang+Khun+Thian,+Bangkok+10150,+Thailand/@13.643642,100.419032,16z/data=!4m2!3m1!1s0x30e2bcde69dda75d:0x33ba3a98a2e677a?hl=en-US&gl=US"><i class="fas fa-location-arrow"></i> Google Map</a>

									</div>
								</div>
							</div>
							<div class="col-12">
								<br>
								<div class="d-none d-md-block">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.2320712910728!2d100.41684291482926!3d13.643642390417504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x33ba3a98a2e677a!2zZnJpZW5kbHlzb2Z0cHJvICgg4LmA4Lif4Lij4LiZ4Lil4Li14LmI4LiL4Lit4Lif4LmC4Lib4LijICkg4LiX4Liz4LmA4Lin4LmH4Lia4LmE4LiL4LiV4LmMIOC5gOC4guC4teC4ouC4meC5guC4m-C4o-C5geC4geC4o-C4oQ!5e0!3m2!1sth!2s!4v1479486433559" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>	
								</div>
								
							</div>
						</div>
						<div class="col-md-6">
							<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="formsubmit">
							<div class="row">
								<div class="col-12">
									<h3 class="text-secondary">สอบถาม</h3>
									<hr>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="">ชื่อ-นามสกุล</label>
										<?php Form::text('name','ชื่อ-นามสกุลผู้ติดต่อ',is($data,'name')); ?>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="">อีเมล</label>
										<?php Form::email('email','อีเมลผู้ติดต่อ',is($data,'email')); ?>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="">เรื่อง</label>
										<?php Form::text('subject','เรื่องที่ติดต่อ',is($data,'subject')); ?>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="">ความสำคัญ</label>
										<?php  
										$option = array(
											array('index'=>0, 'value'=>'ต่ำสุด'),
											array('index'=>1, 'value'=>'ปานกลาง'),
											array('index'=>2, 'value'=>'สูงสุด'),
										);
										?>
										<?php Form::select('priority',$option,'','index','value',is($data,'priority')); ?>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="">ข้อความ</label>
										<?php Form::textarea('message','ข้อความ', is($data,'message')); ?>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="">ไฟล์แนบ</label>
										<input type="file" name="document" class="form-control">
										<small id="file2" class="form-text text-muted">Allowed File Extensions: .jpg, .gif, .jpeg, .png, .pdf</small>
									</div>
								</div>
								<div class="col-12">
									<button type="submit" class="btn btn-lg btn-primary btn-block rounded-0 btn-login g-recaptcha" data-sitekey="6LedVqUZAAAAADR_lYfAllmKzo3OByJ930VUAMYt" data-callback='onSubmit' data-action='submit' id="btnsubmit">ส่งเมล</button>
									<!-- <button type="submit" class="btn btn-primary btn-block" id="btnsubmit">ส่งเมล</button> -->
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function onSubmit(token) {
	document.getElementById("formsubmit").submit();
}
</script>
<script>
	$('#contact').addClass('active');
	$('#btnsubmit').click(function(event) {
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-warning');
		$(this).html('กำลังส่ง...');
		$(this).attr('disabled','disabled');
		$('#formsubmit').submit();
	});
</script>