<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<form action="<?php echo $action; ?>" method="POST">
	<div class="container-fluid">
		<div class="card my-3">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<?php if (!empty($success)): ?>
							<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
						<?php endif ?>
						<?php if (!empty($error)): ?>
							<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
						<?php endif ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<h4>จัดการเลข POS</h4>
						<hr>
						<div class="form-group">
							<label for="">ชื่อเครื่อง</label>
							<input type="text" name="pos_name" id="" class="form-control" value="<?php echo $setting['pos_name']; ?>" required>
						</div>
						<div class="form-group">
							<label for="">เลขเครื่อง POS</label>
							<input type="text" name="pos_no" id="" class="form-control" value="<?php echo $setting['pos_no']; ?>" required>
						</div>
						<div class="form-group">
							<label for="">สถานะ</label>
							<select name="pos_status" id="" class="form-control">
								<option value="1" <?php echo $setting['pos_status']=='1'?'selected':'';?>>เปิด</option>
								<option value="0" <?php echo $setting['pos_status']=='0'?'selected':'';?>>ปิด</option>
							</select>
						</div>
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