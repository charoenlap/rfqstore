<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<div class="row mt-4 mb-3">
				<div class="col-md-3">
					<form action="<?php echo $action_search; ?>" method="post">
					  <!-- <div class="form-row align-items-center">
					    <div class="col-auto">
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text"><i class="fas fa-search"></i></div>
					        </div>
					        <input type="text" name="search" value="<?php echo $search;?>" class="form-control input-sm" placeholder="ค้นหาหมวดหมู่สินค้า">
					      </div>
					    </div>
					    <div class="col-auto">
					      <button type="submit" class="btn btn-primary btn-search btn-sm"><i class="fas fa-search"></i> ค้นหา</button>
					    </div>
					  </div> -->
					  	<div class="input-group mb-3">
							 <input type="text" name="search" value="<?php echo $search;?>" class="form-control rounded-0" placeholder="ค้นหาหมวดหมู่สินค้า">
							<div class="input-group-append">
								<button type="submit" class="btn btn-info rounded-0"><i class="fas fa-search"></i> ค้นหา</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md text-right">
					<a href="<?php echo route('product/addCategory'); ?>" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่มหมวดหมู่สินค้า</a>
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
								<th>วันที่เริ่มงาน</th>
								<th>ชื่อหมวดหมู่สินค้า</th>
								<th></th>
							</thead>
							<tbody>
								<?php foreach ($categories as $category): ?>
								<tr>
									<td><?php echo $category['category_code']; ?></td>
									<td><?php echo date('d/m/Y', strtotime($category['date_created'])); ?></td>
									<td><?php echo $category['category_name']; ?></td>
									<td class="text-center">
										<a href="<?php echo route('product/editCategory').'&id='.encrypt($category['id_category'],$user_key); ?>" class="btn btn-warning btn-sm">
											<i class="fas fa-edit"></i>
										</a>
										<a href="<?php echo route('product/deleteCategory').'&id='.encrypt($category['id_category'],$user_key); ?>" onclick="return confirm('ยืนยันลบหมวดหมู่นี้');" class="btn btn-danger btn-sm">
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