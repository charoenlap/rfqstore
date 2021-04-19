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
			<form class="mt-4" action="<?php echo $action; ?>" method="post">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="">รหัสหมวดหมู่</label>
						<input type="text" class="form-control" name="category_code" id="" placeholder="รหัส" value="<?php echo $category_code;?>">
					</div>
					<div class="form-group col-md-4">
						<label for="">ชื่อหมวดหมู่</label>
						<input type="text" class="form-control" name="category_name" id="" placeholder="ชื่อหมวดหมู่" value="<?php echo $category_name;?>">
					</div>
					<!-- <div class="form-group col-md-4">
						<label for="">หมวดหมู่หลัก</label>
						<select name="id_category" id="" class="form-control selectpicker">
							<option value="0" <?php echo $id_category==0?'selected':'';?>>ไม่มีหมวดหมู่หลัก</option>
							<?php foreach ($categories as $category): ?>
							<option value="<?php echo $category['id_customer_category']; ?>" <?php echo $id_category==$category['id_category']?'selected':'';?>><?php echo $category['category_name']; ?></option>	
							<?php endforeach ?>
						</select>
					</div> -->
				</div>
				<div class="form-row">
					<div class="form-group col-md-2">
						<label for="">รูปลูกค้าหลัก</label>
						<div>
							<!-- <img src="https://via.placeholder.com/150/" alt=""> -->
								<img src="<?php echo !empty($category_image) ? IMAGE.$category_image : MURL.'assets/image/noimg.png'; ?>" alt="preview" id="preview_category_image" class="img-thumbnail mb-2 img-fluid"><br>
								<input type="hidden" name="category_image" id="input_category_image" value="<?php echo !empty($category_image) ? $category_image : ''; ?>"> 
								<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal_filemanager" data-result="#input_category_image" data-preview="#preview_category_image">
									<i class="far fa-image"></i>
								</button>
								<button type="button" class="btn btn-outline-danger upload_removeimg" data-result="#input_category_image" data-preview="#preview_category_image">
									<i class="far fa-trash-alt"></i>
								</button>
						</div>
					</div>
				</div>
				<hr>
				<a href="<?php echo route('customer/listCategory');?>" class="btn btn-outline-danger">กลับ</a>
				<button type="submit" class="btn btn-primary float-right">บันทึก</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.selectpicker').selectpicker();
});
</script>

<?php echo $filemanager; ?>