<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<div class="row mt-4 mb-3">
		<div class="col-md-3">
			<form action="<?php echo $link_search;?>" method="post">
			  	<div class="input-group mb-3">
					<input type="text" class="form-control rounded-0" name="search" placeholder="ค้นหาสินค้า">
					<div class="input-group-append">
						<button  class="btn btn-info rounded-0" type="submit"><i class="fas fa-search"></i> ค้นหา</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md text-right">
			<a href="<?php echo route('product/addProduct'); ?>" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่มสินค้า</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<?php if (!empty($success)): ?>
				<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
			<?php endif ?>
			<?php if (!empty($error)): ?>
				<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
			<?php endif ?>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-theme">
					<thead>
						<th>รหัส</th>
						<th>ชื่อสินค้า</th>
						<th>หมวดหมู่</th>
						<th class="text-right">ราคา</th>
						<th class="text-right">จำนวน</th>
						<th class="text-center">หน่วย</th>
						<th class="text-center">สถานะ</th>
						<th></th>
					</thead>
					<tbody>
						<?php foreach ($products as $product): ?>
						<tr>
							<td><?php echo $product['product_code']; ?></td>
							<td><?php echo $product['product_name']; ?></td>
							<td>
								<?php
									foreach($categories as $categorie){
										if($product['id_category'] == $categorie['id_category']){
											echo $categorie['category_name'];
										}
									}
								?>
							</td>
							<td class="text-right"><?php echo $product['product_special']>0 ? '<s>'.number_format($product['product_price'],2).'</s> '.number_format($product['product_special'],2) : number_format($product['product_price'],2); ?></td>
							<td class="text-right"><?php echo number_format($product['product_quantity'],2); ?></td>
							<td class="text-center"><?php echo $product['product_unit']; ?></td>
							<td class="text-center"><?php echo $product['product_status']==1?'เปิด':'ปิด'; ?></td>
							
							<td class="text-center">
								<a href="<?php echo route('product/editProduct').'&id='.encrypt($product['id_product']); ?>" class="btn btn-warning btn-sm">
									<i class="fas fa-edit"></i>
								</a>
								<a href="<?php echo route('product/deleteProduct').'&id='.encrypt($product['id_product']); ?>" onclick="return confirm('ยืนยันลบสินค้านี้');" class="btn btn-danger btn-sm">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<?php echo $pageing; ?>
		</div>
	</div>
		</div>
	</div>
</div>