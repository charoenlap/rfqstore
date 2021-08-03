
<?php if(PRODUCTION){ ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<?php } ?>
<div class="container">
    <div class="row justify-content-center">
      	<div class="col-md-6">
      		<div class="card-theme mt-5">
      			<div class="card-theme-body">
      				<?php if (!empty($success)): ?>
						<div class="alert alert-success" role="alert"><small><?php echo $success; ?></small></div>
					<?php endif ?>
					<?php if (!empty($error)): ?>
						<div class="alert alert-danger" role="alert"><small><?php echo $error; ?></small></div>
					<?php endif ?>
	      			<form action="<?php echo $action; ?>" method="POST" id="regisform">
	      				<div class="row mb-3">
		      				<div class="col-md-12">
		      					<h3 class="text-secondary">สมัครสมาชิก</h3>
		      					<hr>
		      				</div>
		      			</div>
		      			<div class="row">
		      				<div class="col-md-12 mb-3">
		      					<input type="text" name="user_email" id="user_email" class="form-control rounded-0" placeholder="E-mail" required>
		      				</div>
		      				<div class="col-md-12 mb-3">
		      					<div class="input-group mb-2">
							        <input type="password" name="user_password" id="user_password" readonly="true" class="form-control rounded-0" placeholder="Password" required>
							        <div class="input-group-prepend">
							          <div class="input-group-text">
							          	<a href="#" class="text-info" id="btn-view-password"><i class="fas fa-eye"></i></a>
							          </div>
							        </div>
							    </div>
		      				</div>
		      				<div class="col-md-12 mb-3">
		      					<input type="text" name="user_name" id="user_name" readonly="true" class="form-control rounded-0" placeholder="ชื่อ">
		      				</div>
		      				<div class="col-md-12 mb-3">
		      					<input type="text" name="user_lastname" id="user_lastname" class="form-control rounded-0" placeholder="นามสกุล">
		      					<input type="hidden" name="fb_id" id="fb_id">
		      				</div>
		      				<div class="col-md-12 mb-3">
		      					<input type="text" name="user_phone" id="user_phone" class="form-control rounded-0" placeholder="เบอร์โทรศัพท์" required>
		      					<input type="hidden" name="fb_id" id="fb_id">
		      				</div>
		      			</div>
		      			<div class="row justify-content-end">
		      				<div class="col-md-8">
		      					<a href="<?php echo route('user/login');?>" class="text-secondary">เข้าสู่ระบบ</a>
		      				</div>
		      				<div class="col-md-4 text-right">

							  <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0 btn-login g-recaptcha" data-sitekey="6LedVqUZAAAAADR_lYfAllmKzo3OByJ930VUAMYt" data-callback='onSubmit' data-action='submit'>สมัครสมาชิก</button>
		      					<!-- <button class="btn btn-primary rounded-0 w-100 btn-login">สมัครสมาชิก</button> -->
		      				</div>
		      			</div>
		      			<!-- <div class="row">
		      				<div class="col-md-12">
		      					<a href="<?php echo $url_login_fb?>" class="btn btn-facebook rounded-0"><i class="fab fa-facebook-square"></i> Login facebook</a>
		      				</div>
		      			</div> -->
	      			</form>
	      		</div> 
      		</div>
      	</div>
    </div> 
</div>

<script>
function onSubmit(token) {
	document.getElementById("regisform").submit();
}
</script>

<script>
	$('#user_password').attr("readonly", false);
	setTimeout('$("#user_password").val("");', 2000);
	$('#user_name').attr("readonly", false);
	setTimeout('$("#user_name").val("");', 2000);
</script>
