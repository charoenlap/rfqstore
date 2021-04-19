<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="card my-3">
		<div class="card-body">
			<div class="row mt-4 mb-3">
		<div class="col-md-3">
			<form action="<?php echo $action;?>" method="post">
			  	<div class="input-group mb-3">
					<input type="text" class="form-control rounded-0" name="search" placeholder="ค้นหา POS" value="<?php echo $search; ?>">
					<div class="input-group-append">
						<button  class="btn btn-info rounded-0" type="submit"><i class="fas fa-search"></i> ค้นหา</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md text-right">
			<a href="<?php echo route('setting/addpos'); ?>" class="btn btn-outline-primary rounded-0"><i class="fas fa-plus"></i> เพิ่ม POS</a>
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
						<th>#</th>
						<th class="text-left">ชื่อเครื่อง</th>
						<th class="text-left">เลขเครื่อง</th>
						<th class="text-right">จำนวนขาย</th>
						<th class="text-right">ยอดเงินขายรวม</th>
						<th></th>
					</thead>
					<tbody>
						<?php foreach ($pos as $key => $value): ?>
						<tr>
							<td class="text-center"><?php echo ++$key; ?></td>
							<td class="text-center"><?php echo $value['pos_name']; ?></td>
							<td class="text-center"><?php echo $value['pos_no']; ?></td>
							<td class="text-center"><?php echo number_format($value['count']); ?></td>
							<td class="text-center"><?php echo number_format($value['sumtotal'],2); ?></td>
							<td class="text-center">
								<a href="<?php echo route('setting/editpos').'&id='.($value['id_company_pos']); ?>" class="btn btn-warning btn-sm">
									<i class="fas fa-edit"></i>
								</a>
								<a href="<?php echo route('setting/delpos').'&id='.($value['id_company_pos']); ?>" onclick="return confirm('ยืนยัน POS นี้');" class="btn btn-danger btn-sm">
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