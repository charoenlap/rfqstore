<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<?php if (!empty($success)): ?>
						<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
					<?php endif ?>
					<?php if (!empty($error)): ?>
						<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
					<?php endif ?>
				</div>
			</div>
			<form class="mt-4" action="<?php echo $action;?>" method="post">
			  <div class="form-row">
			    <div class="form-group col-md-12">
			      <label for="">รหัสคลังสินค้า</label>
			      <input type="text" name="werehouse_code" class="form-control" value="<?php echo $werehouse_code;?>" placeholder="รหัสคลัง" required>
			    </div>
			    <div class="form-group col-md-12">
			      <label for="">ชื่อคลัง</label>
			      <input type="text" name="werehouse_name" class="form-control" value="<?php echo $werehouse_name;?>" placeholder="ชื่อคลัง" required>
			    </div>
			  </div>
				<a href="<?php echo route('product/listWerehouse');?>" class="btn btn-outline-danger">กลับ</a>
			  <button type="submit" class="btn btn-primary float-right">บันทึก</button>
			</form>
		</div>
	</div>
</div>
