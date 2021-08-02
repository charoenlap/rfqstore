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
					        <input type="text" class="form-control input-sm" name="search" placeholder="ค้นหาลูกค้า">
					      </div>
					    </div>
					    <div class="col-auto">
					      <button type="submit" class="btn btn-primary btn-search btn-sm"><i class="fas fa-search"></i> ค้นหา</button>
					    </div>
					  </div> -->
						<div class="input-group mb-3">
							<input type="text" class="form-control" name="search" placeholder="ค้นหาลูกค้า">
							<div class="input-group-append">
								<button type="submit" class="btn btn-info rounded-0"><i class="fas fa-search"></i> ค้นหา</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md text-right">
					<a href="<?php echo route('customer/addCustomer'); ?>" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่มลูกค้า</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-theme">
							<thead>
								<th>รายชื่อ</th>
								<th>ชื่อผู้ติดต่อ</th>
								<th>เบอร์ติดต่อ</th>
								<th>อีเมล</th>
								<th>ประเภท</th>
								<th>หมวดหมูุ่</th>
								<th width="15%"></th>
							</thead>
							<tbody>
								<?php foreach ($customers as $customer) : ?>
									<tr>
										<td>
											<?php echo $customer['customer_company']; ?><br>
											<small>
												<?php echo !empty($customer['customer_code']) ? $customer['customer_code'] . ' / ' : '' ?>
												<?php echo $customer['customer_branch']; ?>
											</small>

										</td>
										<td><?php echo $customer['customer_name']; ?></td>
										<td><?php echo $customer['customer_telephone']; ?></td>
										<td><?php echo $customer['customer_email']; ?></td>
										<td><?php echo $customer['customer_type']; ?></td>
										<td>
											<?php foreach ($categories as $categorie) { ?>
												<?php if ($categorie['id_customer_category'] == $customer['id_customer_category']) {
													echo $categorie['category_name'];
												} ?>
											<?php } ?>
										</td>
										<td class="text-center">
											<a href="<?php echo route('customer/editCustomer') . '&id=' . encrypt($customer['id_customer']); ?>" class="btn btn-warning btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a href="<?php echo route('customer/deleteCustomer') . '&id=' . encrypt($customer['id_customer']); ?>" onclick="return confirm('ยืนยันการลบลูกค้า');" class="btn btn-danger btn-sm">
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