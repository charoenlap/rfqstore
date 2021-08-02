<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">

			<div class="row">
				<div class="col-12">
					<?php if (!empty($success)) : ?>
						<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
					<?php endif ?>
					<?php if (!empty($error)) : ?>
						<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
					<?php endif ?>
				</div>
			</div>
			<form class="mt-4" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="">ชื่อสินค้า</label>
						<input type="text" name="product_name" class="form-control" id="" placeholder="ชื่อสินค้า" value="<?php echo $product_name; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="">รหัสสินค้า</label>
						<input type="text" name="product_code" class="form-control" id="" placeholder="รหัสสินค้า" value="<?php echo $product_code; ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="">รายละเอียดสินค้า</label>
						<textarea id="tinymce" rows="8" name="product_detail">
					<?php echo $product_detail; ?>
					</textarea>
						<!-- <input type="text" name="product_detail" class="form-control" id="" placeholder="รายละเอียดสินค้า" value="<?php echo $product_detail; ?>"> -->
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="">หมวดหมู่สินค้า</label>
						<select name="id_category" id="" class="form-control selectpicker" data-live-search="true" title="เลือกหมวดหมู่สินค้าที่ต้องการ" required>
							<?php foreach ($categories as $category) : ?>
								<option value="<?php echo $category['id_category']; ?>" <?php echo $id_category == $category['id_category'] ? 'selected' : ''; ?>><?php echo $category['category_code'] . ' ' . $category['category_name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="">คลังสินค้า</label>
						<select name="id_werehouse" id="" class="form-control selectpicker" data-live-search="true" title="เลือกคลังสินค้าที่ต้องการ" required>
							<?php foreach ($werehouses as $werehouse) : ?>
								<option value="<?php echo $werehouse['id_werehouse']; ?>" <?php echo $id_werehouse == $werehouse['id_werehouse'] ? 'selected' : ''; ?>><?php echo $werehouse['werehouse_code'] . ' ' . $werehouse['werehouse_name']; ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="">จำนวนสินค้า</label>
						<input type="number" name="product_quantity" class="form-control" id="" placeholder="จำนวนสต๊อกสินค้า" value="<?php echo $product_quantity; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="">หน่วย</label>
						<select class="form-control selectpicker" name="product_unit" data-live-search="true" title="เลือกหน่วยสินค้า">
							<option value="กก." <?php echo $product_unit == 'กก.' ? 'selected' : ''; ?>>กก.</option>
							<option value="กล่อง" <?php echo $product_unit == 'กล่อง' ? 'selected' : ''; ?>>กล่อง</option>
							<option value="ครั้ง" <?php echo $product_unit == 'ครั้ง' ? 'selected' : ''; ?>>ครั้ง</option>
							<option value="เครื่อง" <?php echo $product_unit == 'เครื่อง' ? 'selected' : ''; ?>>เครื่อง</option>
							<option value="ชม." <?php echo $product_unit == 'ชม.' ? 'selected' : ''; ?>>ชม.</option>
							<option value="ชิ้น" <?php echo $product_unit == 'ชิ้น' ? 'selected' : ''; ?>>ชิ้น</option>
							<option value="ชุด" <?php echo $product_unit == 'ชุด' ? 'selected' : ''; ?>>ชุด</option>
							<option value="เดือน" <?php echo $product_unit == 'เดือน' ? 'selected' : ''; ?>>เดือน</option>
							<option value="ตัว" <?php echo $product_unit == 'ตัว' ? 'selected' : ''; ?>>ตัว</option>
							<option value="ใบ" <?php echo $product_unit == 'ใบ' ? 'selected' : ''; ?>>ใบ</option>
							<option value="แผง" <?php echo $product_unit == 'แผง' ? 'selected' : ''; ?>>แผง</option>
							<option value="แผ่น" <?php echo $product_unit == 'แผ่น' ? 'selected' : ''; ?>>แผ่น</option>
							<option value="แพ็ค" <?php echo $product_unit == 'แพ็ค' ? 'selected' : ''; ?>>แพ็ค</option>
							<option value="ถุง" <?php echo $product_unit == 'ถุง' ? 'selected' : ''; ?>>ถุง</option>
							<option value="ม้วน" <?php echo $product_unit == 'ม้วน' ? 'selected' : ''; ?>>ม้วน</option>
							<option value="เมตร" <?php echo $product_unit == 'เมตร' ? 'selected' : ''; ?>>เมตร</option>
							<option value="เล่ม" <?php echo $product_unit == 'เล่ม' ? 'selected' : ''; ?>>เล่ม</option>
							<option value="วัน" <?php echo $product_unit == 'วัน' ? 'selected' : ''; ?>>วัน</option>
							<option value="เส้น" <?php echo $product_unit == 'เส้น' ? 'selected' : ''; ?>>เส้น</option>
							<option value="ห่อ" <?php echo $product_unit == 'ห่อ' ? 'selected' : ''; ?>>ห่อ</option>
							<option value="หีบ" <?php echo $product_unit == 'หีบ' ? 'selected' : ''; ?>>หีบ</option>
							<option value="โหล" <?php echo $product_unit == 'โหล' ? 'selected' : ''; ?>>โหล</option>
							<option value="อัน" <?php echo $product_unit == 'อัน' ? 'selected' : ''; ?>>อัน</option>
						</select>
					</div>
				</div>
				<div class="form-row">

					<div class="form-group col-md-6">
						<label for="">ราคาขาย</label>
						<input type="number" class="form-control" name="product_price" min="0" placeholder="ราคา" value="<?php echo $product_price; ?>">
					</div>
					<div class="form-group col-md-6">
						<label for="">ราคาลดพิเศษ <small>(หากใส่มากกว่า 0 ระบบจะขีดค่า "<s>ราคาขาย</s> และแสดงราคาลดพิเศษ" แทน)</small> </label>
						<input type="number" class="form-control" name="product_special" min="0" placeholder="ราคาลดพิเศษ" value="<?php echo $product_special; ?>">
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>รูปสินค้าหลัก</td>
								</tr>
								<tr>
									<td>
										<div style="width:30%">
											<img src="<?php echo !empty($product_image) ? IMAGE . $product_image : MURL . 'assets/image/noimg.png'; ?>" alt="preview" id="preview_product_image" class="img-thumbnail mb-2 img-fluid"><br>
											<input type="hidden" name="product_image" id="input_product_image" value="<?php echo !empty($product_image) ? $product_image : ''; ?>">
											<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal_filemanager" data-result="#input_product_image" data-preview="#preview_product_image">
												<i class="far fa-image"></i>
											</button>
											<button type="button" class="btn btn-outline-danger upload_removeimg" data-result="#input_product_image" data-preview="#preview_product_image">
												<i class="far fa-trash-alt"></i>
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered" id="list_thumb">
							<thead>
								<tr>
									<td>รูปสินค้าย่อย</td>
									<!-- <td width="20%"></td> -->
									<td width="20%"></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($product_thumb as $key => $thumb) : ?>
									<tr>
										<td>
											<div style="width:40%">
												<img src="<?php echo !empty($thumb['image']) ? IMAGE . $thumb['image'] : MURL . 'assets/image/noimg.png'; ?>" alt="preview" id="preview_product_thumb_<?php echo $key; ?>" class="img-thumbnail mb-2 img-fluid"><br>
												<input type="hidden" name="product_thumb[]" id="input_product_thumb_<?php echo $key; ?>" value="<?php echo !empty($thumb['image']) ? $thumb['image'] : ''; ?>">
												<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal_filemanager" data-result="#input_product_thumb_<?php echo $key; ?>" data-preview="#preview_product_thumb_<?php echo $key; ?>">
													<i class="far fa-image"></i>
												</button>
												<button type="button" class="btn btn-outline-danger upload_removeimg" data-result="#input_product_thumb_<?php echo $key; ?>" data-preview="#preview_product_thumb_<?php echo $key; ?>">
													<i class="far fa-trash-alt"></i>
												</button>
											</div>
										</td>
										<!-- <td><input type="text" class="form-control" name="thumb_sort[]" placeholder="เรียงลำดับ" value="<?php echo $thumb['sort_order']; ?>" ></td> -->
										<td>
											<button type="button" class="btn btn-danger delthumbimg" data-id="<?php echo encode($thumb['id_product_image'], $this->getSession('user_key')); ?>"><i class="fas fa-minus-circle"></i>
											</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td><button type="button" id="addthumbimg" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
								</tr>
							</tfoot>
						</table>
						

						<!-- <table class="table table-bordered" id="list_price_option">
							<thead>
								<tr>
									<td>Option สินค้า</td>
									<td width="20%"></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($product_option_price as $key => $thumb): 
								?>
								<tr>
									<td>
										<div class="form-row">
											<div class="form-group col-md-3">
												<label for="">ชื่อรายการ</label>
												<input type="number" class="form-control" name="product_option_name[]" min="0" placeholder="ราคา" value="<?php echo $product_price; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="">ราคาขาย</label>
												<input type="number" class="form-control" name="product_option_price[]" min="0" placeholder="ราคา" value="<?php echo $product_price; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="">ราคาลดพิเศษ</label>
												<input type="number" class="form-control" name="product_option_special[]" min="0" placeholder="ราคาลดพิเศษ" value="<?php echo $product_special; ?>">
											</div>
											<div class="form-group col-md-3">
												<label for="">ราคาลดพิเศษ</label>
												<input type="number" class="form-control" name="product_option_special[]" min="0" placeholder="ราคาลดพิเศษ" value="<?php echo $product_special; ?>">
											</div>
										</div>
									</td>
									<td><input type="text" class="form-control" name="thumb_sort[]" placeholder="เรียงลำดับ" value="<?php echo $thumb['sort_order']; ?>" ></td>
									<td>
										<button type="button" class="btn btn-danger delthumbimg" data-id="<?php echo encode($thumb['id_product_image'], $this->getSession('user_key')); ?>"><i class="fas fa-minus-circle"></i>
										</button>
									</td>
								</tr>
								<?php endforeach 
								?>
							</tbody>
							<tfoot>
								<tr>
									<td></td>
									<td><button type="button" id="addoption" class="btn btn-success"><i class="fas fa-plus-circle"></i></button></td>
								</tr>
							</tfoot>
						</table> -->

					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="">ตัดสต๊อกสินค้า</label>
						<select class="form-control selectpicker" name="product_isstock">
							<option value="1" <?php echo $product_isstock == 1 ? 'selected' : ''; ?>>ใช่</option>
							<option value="0" <?php echo $product_isstock == 0 ? 'selected' : ''; ?>>ไม่ใช่</option>
						</select>
					</div>
					<div class="form-group col-md-12">
						<label for="">สถานะ</label>
						<select class="form-control selectpicker" name="product_status">
							<option value="1" <?php echo $product_status == 1 ? 'selected' : ''; ?>>เปิด</option>
							<option value="0" <?php echo $product_status == 0 ? 'selected' : ''; ?>>ปิด</option>
						</select>
					</div>
				</div>

				<a href="<?php echo route('product/listProduct'); ?>" class="btn btn-outline-danger rounded-0">กลับ</a>
				<button type="submit" class="btn btn-primary rounded-0 float-right">บันทึก</button>
			</form>

		</div>
	</div>
</div>


<script src="https://cdn.tiny.cloud/1/94h1g0ysrpfyl70trxyvbcz5ry1ltc6prqljg1mndfxmicjn/tinymce/5/tinymce.min.js" referrerpolicy="origin" />
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		tinymce.init({
			selector: '#tinymce',
			height: 300,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table paste imagetools wordcount"
			],
			toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
			content_css: '//www.tiny.cloud/css/codepen.min.css',
			fontsize_formats: '11px 12px 14px 16px 18px 24px 36px 48px'
		});

		// $('.selectpicker').selectpicker();
		var imgrow = <?php echo isset($product_thumb) ? count($product_thumb) : 0; ?>;
		$('#addthumbimg').click(function(event) {
			$.ajax({
				url: '<?php echo route('product/addRowImage'); ?>',
				type: 'POST',
				dataType: 'html',
				data: {
					name: 'product_thumb[]',
					id: 'product_thumb_' + imgrow
				},
				success: function(data) {
					$('#list_thumb tbody').append('<tr><td><div style="width:40%">' + data + '</div></td><!--<td><input type="text" class="form-control" name="thumb_sort[]" placeholder="เรียงลำดับ" /></td>--><td><button type="button" class="btn btn-danger delthumbimg"><i class="fas fa-minus-circle"></i></button></td></tr>');
					imgrow++;
				}
			});
		});

		var optionrow = <?php echo isset($product_option_price) ? count($product_option_price) : 0; ?>;
		$('#addoption').on('click',function(event) {
			$.ajax({
				url: '<?php echo route('product/addRowOption'); ?>',
				type: 'POST',
				dataType: 'html',
				data: {
					name: 'product_option',
					id: optionrow
				},
				success: function(data) {
					$('#list_price_option tbody').append('<tr><td><div>' + data + '</div></td><td><button type="button" class="btn btn-danger delOption"><i class="fas fa-minus-circle"></i></button></td></tr>');
					optionrow++;
				}
			});
		});

		$("#list_price_option").on('click', '.delOption', function(event) {
			event.preventDefault();
			$(this).parents('tr').remove();
			// $.ajax({
			// 	url: '<?php echo route('product/deleteProductThumb'); ?>',
			// 	type: 'POST',
			// 	dataType: 'json',
			// 	data: {id: $(this).data('id')},
			// 	success:function(data) {
			// 		console.log(data);
			// 	}
			// });

		});
		$("#list_thumb").on('click', '.delthumbimg', function(event) {
			event.preventDefault();
			$(this).parents('tr').remove();
			// $.ajax({
			// 	url: '<?php echo route('product/deleteProductThumb'); ?>',
			// 	type: 'POST',
			// 	dataType: 'json',
			// 	data: {id: $(this).data('id')},
			// 	success:function(data) {
			// 		console.log(data);
			// 	}
			// });

		});
	});
</script>