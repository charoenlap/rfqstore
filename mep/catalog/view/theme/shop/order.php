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
			<div class="row mt-4">
				<div class="col-md-3">
					<form>
					  <!-- <div class="form-row align-items-center">
					    <div class="col-auto">
					      <div class="input-group mb-2">
					        <div class="input-group-prepend">
					          <div class="input-group-text"><i class="fas fa-search"></i></div>
					        </div>
					        <input type="text" class="form-control input-sm" placeholder="ค้นหา">
					      </div>
					    </div>
					    <div class="col-auto">
					      <a href="#" class="btn btn-primary btn-search btn-sm"><i class="fas fa-search"></i> ค้นหา</a>
					    </div>
					  </div> -->
					  	<div class="input-group mb-3">
							<input type="text" class="form-control rounded-0" placeholder="ค้นหา">
							<div class="input-group-append">
								<a href="#" class="btn btn-info rounded-0"><i class="fas fa-search"></i> ค้นหา</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-theme">
							<thead>
								<th>ลำดับ</th>
								<th>วันที่</th>
								<th>เลขเครื่อง POS</th>
								<th>ยอดรวม</th>
								<th></th>
							</thead>
							<tbody>
								<?php foreach ($order as $key => $value): ?>
								<tr>
									<td><?php echo ($key+1); ?></td>
									<td><?php echo date('d/m/Y H:i', strtotime($value['date_added'])); ?></td>
									<td><?php echo $value['pos']; ?></td>
									<td><?php echo number_format($value['total'],0); ?></td>
									<td class="text-center">
										<button type="button" class="btn btn-primary btn-sm" data-id="<?php echo encrypt($value['id_order']);?>" data-toggle="modal" data-target="#modal_view">
											<i class="fas fa-eye"></i>
										</button>
										<!-- <a href="#" class="btn btn-warning btn-sm">
											<i class="fas fa-edit"></i>
										</a> -->
										<div class="btn-group" role="group">
										    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										      <i class="fas fa-print"></i>
										    </button>
										    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
										      <a class="dropdown-item" href="#"></a>
										    </div>
										</div>
										<!-- <a href="#" class="btn btn-info btn-sm">
											<i class="fas fa-paperclip"></i>
										</a> -->
										<a href="<?php echo route('shop/deleteOrder').'&id='.encrypt($value['id_order']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ');">
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

<div class="modal" tabindex="-1" role="dialog" id="modal_view">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="text-center">
					<!-- <img src="" alt="" id="company_logo" style="width:70%; margin:0 auto;"> -->
					<b><p class="mb-0">ใบกำกับภาษีอย่างย่อ</p></b>
					<p class="mb-1" id="company_taxid">Tax</p>
					<b><p class="mb-0" id="company_name">Company</p></b>
					<p class="mb-2" id="company_address">Address</p>
					<!-- <h4 class="mb-0" id="headtotal">100.00</h4> -->
					<!-- <p>ยอดชำระ</p> -->
				</div>
				<table class="table table-bordered">
					<tbody id="listitem"> 
						<tr>
							<td>1</td>
							<th>
								<p class="mb-0">Item @100.00</p>
							</th> 
							<td class="text-right">100.00</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<th class="px-2 py-1" colspan="2">ยอดชำระ</th> 
							<td class="px-2 py-1 text-right" id="total">100.00</td>
						</tr>
						<tr>
							<td class="px-2 py-1" colspan="2"><small>เงินสด</small></td>
							<td class="px-2 py-1 text-right"><small id="received">100.00</small></td>
						</tr>
						<tr>
							<td class="px-2 py-1" colspan="2"><small>เงินทอน</small></td>
							<td class="px-2 py-1 text-right"><small id="change">0.00</small></td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
				<!-- <button type="button" class="btn btn-primary"></button> -->
			</div>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function($) {
	$('#modal_view').on('shown.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var buttonid = button.data('id')
		$.ajax({
			url: '<?php echo route('shop/getOrder');?>',
			type: 'POST',
			dataType: 'json', 
			data: {id: buttonid},
			success: function(data) {
				console.log(data);
				// if (data.company.company_logo != null) {
				// 	$('#company_logo').attr('src', '<?php echo MURL;?>uploads'+data.company.company_logo);
				// }
				if (data.company.company_name != null) {
					$('#company_name').html(data.company.company_name);
				}
				if (data.company.company_tax_no != null) {
					$('#company_taxid').html(data.company.company_tax_no);
				}
				if (data.company.company_address != null) {
					$('#company_address').html(data.company.company_address);
				}
				$.each(data, function(index, val) {
					 $('#'+index).html(addCommas(val));
					 $('#head'+index).html(addCommas(val));
					 if (index=='products') {
					 	var html = ''; 
					 	$.each(val, function(indexProduct, valProduct) {
					 		var sum = parseFloat(valProduct['quantity']) * parseFloat(valProduct['price']);
							html += '<tr>'+
							'   <td>'+valProduct['quantity']+'</td>'+
							'	<td>'+
							'		<p class="mb-0">'+valProduct['name']+' @'+addCommas(valProduct['price'])+'</p>'+
							// '		<small>'+valProduct['quantity']+' x '+addCommas(valProduct['price'])+'</small>'+
							'	</td> '+
							'	<td class="text-right">'+addCommas(sum.toFixed(2))+'</td>'+
							'</tr>';
					 	});
					 	$('#listitem').html(html);
					 }
				});
			}
		});
	})
	function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
});
</script>