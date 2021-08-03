<?php if(PRODUCTION){ ?>
<style>
	.g-recaptcha {
	    transform:scale(0.95);
	    transform-origin:0 0;
	}
</style>
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- <script src="https://www.google.com/recaptcha/api.js?render=6LedVqUZAAAAADR_lYfAllmKzo3OByJ930VUAMYt"></script> -->
<?php } ?>
<div class="container">
    <div class="row">
      	<div class="col-md-12">
        	<form action="<?php echo $action; ?>" method="POST" class="form-signin mt-5" id="loginform">
        		<?php if (!empty($success)): ?>
					<div class="alert alert-success" role="alert"><small><?php echo $success; ?></small></div>
				<?php endif ?>
				<?php if (!empty($error)): ?>
					<div class="alert alert-danger" role="alert"><small><?php echo $error; ?></small></div>
				<?php endif ?>
			  <h1 class="h3 mb-3 font-weight-normal text-secondary">เข้าสู่ระบบ</h1>
			  <hr>
			  <label for="inputEmail" class="sr-only">อีเมล</label>
			  <input type="text" name="user_email" id="inputEmail" class="form-control mb-4 rounded-0" placeholder="Email address" required autofocus>
			  <label for="inputPassword" class="sr-only">รหัสผ่าน</label>
			  <input type="password" name="user_password" id="inputPassword" class="form-control mb-4 rounded-0" placeholder="Password" required>
			  	<?php if($result){ ?>
					<div class="alert alert-danger"><span class="text-danger"><?php echo $result; ?></span></div>
				<?php } ?>
			  <div class="text-right mb-2">
			  	<a href="<?php echo route('user/register'); ?>" class="text-secondary">สมัครสมาชิก</a>
			  </div>
			  <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0 btn-login g-recaptcha" data-sitekey="6LedVqUZAAAAADR_lYfAllmKzo3OByJ930VUAMYt" data-callback='onSubmit' data-action='submit'>เข้าสู่ระบบ</button>
			  <!-- <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0 btn-login">เข้าสู่ระบบ</button> -->
			</form>
      	</div>
    </div>
</div>

<script>
function onSubmit(token) {
	document.getElementById("loginform").submit();
}
</script>
<script>
$('#login').addClass('active');
</script>