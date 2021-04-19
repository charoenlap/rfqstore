<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<div class="row mt-4">
				<div class="col-md-3">
					<form action="<?php echo $action_search; ?>" method="post">
					  <!-- <div class="form-row align-items-center">
					    <div class="col-auto">
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text"><i class="fas fa-search"></i></div>
					        </div>
					        <input type="text" name="search" value="<?php echo $search;?>" class="form-control input-sm" placeholder="ค้นหาคลังสินค้า">
					      </div>
					    </div>
					    <div class="col-auto">
					      <button type="submit" class="btn btn-primary btn-search btn-sm"><i class="fas fa-search"></i> ค้นหา</button>
					    </div>
					  </div> -->
					  	<div class="input-group mb-3">
							<input type="text" name="search" value="<?php echo $search;?>" class="form-control rounded-0" placeholder="ค้นหาคลังสินค้า">
							<div class="input-group-append">
								<button type="submit" class="btn btn-info rounded-0"><i class="fas fa-search"></i> ค้นหา</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md text-right">
					<a href="<?php echo route('product/listWerehouse'); ?>" class="btn btn-outline-primary rounded-0">รายการคลังรวม</a>
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
					<table class="table table-striped table-bordered table-theme">
						<thead>
							<th>คลังสินค้า</th>
							<th>สินค้า</th>
						</thead>
						<tbody>
							<?php foreach ($werehouses as $werehouse): ?>
							<tr>
								<td><?php echo $werehouse['werehouse_code'].' : '.$werehouse['werehouse_name']; ?></td>
								<td>
									<?php foreach ($werehouse['products'] as $product) { ?>
									<?php echo '- '.$product['product_name'].' ['.$product['product_quantity'].']<br>'; ?>
									<?php } ?>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
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