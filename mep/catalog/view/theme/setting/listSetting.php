<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container">
	<div class="row mt-4">
		<div class="col-md">
			<form>
			  <div class="form-row align-items-center">
			    <div class="col-auto">
			      <div class="input-group mb-2">
			        <div class="input-group-prepend">
			          <div class="input-group-text"><i class="fas fa-search"></i></div>
			        </div>
			        <input type="text" class="form-control input-sm" placeholder="ค้นหาหมวดหมู่ตั้งค่า">
			      </div>
			    </div>
			    <div class="col-auto">
			      <a href="#" class="btn btn-primary btn-search btn-sm"><i class="fas fa-search"></i> ค้นหา</a>
			    </div>
			  </div>
			</form>
		</div>
		<div class="col-md text-right">
			<a href="<?php echo route('employee/addEmployee'); ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> เพิ่มหมวดหมู่ตั้งค่า</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<table class="table table-striped">
				<thead>
					<th>รหัส</th>
					<th>วันที่เริ่มงาน</th>
					<th>ชื่อหมวดหมู่ตั้งค่า</th>
					<th></th>
				</thead>
				<tbody>
					<?php for($i=0;$i<=10;$i++){?>
					<tr>
						<td>test</td>
						<td>2020-01-01</td>
						<td>test</td>
						<td class="text-right">
							<a href="#" class="btn btn-warning btn-sm">
								<i class="fas fa-edit"></i>
							</a>
							<div class="btn-group" role="group">
							    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							      <i class="fas fa-print"></i>
							    </button>
							    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							      <a class="dropdown-item" href="#">ใบรับรองเงินเดือน</a>
							    </div>
							</div>
							<!-- <a href="#" class="btn btn-info btn-sm">
								<i class="fas fa-paperclip"></i>
							</a> -->
							<a href="#" class="btn btn-danger btn-sm">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
					<?php } ?>
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