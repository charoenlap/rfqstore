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
			      <label for="">รหัสหมวดหมู่สินค้า</label>
			      <input type="text" name="category_code" class="form-control" value="<?php echo $category_code;?>" placeholder="รหัสหมวดหมู่" required>
			    </div>
			    <div class="form-group col-md-12">
			      <label for="">ชื่อหมวดหมู่</label>
			      <input type="text" name="category_name" class="form-control" value="<?php echo $category_name;?>" placeholder="ชื่อหมวดหมู่" required>
			    </div>
			  </div>
				<a href="<?php echo route('product/listCategory');?>" class="btn btn-outline-danger">กลับ</a>
			  <button type="submit" class="btn btn-primary float-right">บันทึก</button>
			</form>
		</div>
	</div>
</div>
