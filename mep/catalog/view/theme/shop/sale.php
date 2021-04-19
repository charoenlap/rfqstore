<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<?php if (!empty($success)): ?>
				<div class="card my-3">
					<div class="card-body">
						<div class="alert alert-success" role="alert"><?php echo $success; ?></div>		
					</div>
				</div>
				
			<?php endif ?>
			<?php if (!empty($error)): ?>
				<div class="card my-3">
					<div class="card-body">
						<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>		
					</div>
				</div>
				
			<?php endif ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card mt-3 rounded-0">
				<div class="card-body p-3">
					<div class="row">
						<div class="col-md-4 py-0">
							<div class="form-group mb-0">
								<small for="" class="mb-1">เลขเครื่อง POS</small>
								<select name="pos" id="" class="form-control select2" form="formorder">
									<?php foreach ($list_pos as $key => $value): ?>
									<option value="<?php echo $value['pos_no']; ?>" <?php echo $pos==$value['pos_no']?'selected':'';?>><?php echo $value['pos_name'].' ('.$value['pos_no'].')'; ?></option>
									<?php endforeach ?>
								</select>
								<!-- <input type="text" class="form-control form-control-lg" name="pos" form="formorder" placeholder="เลขเครื่อง POS"> -->
							</div>
						</div>
						<div class="col-md-4 py-0">
						</div>
						<div class="col-md-4 py-0">
							<div class="form-group mb-0">
								<small for="" class="mb-1">ยอดชำระ</small>
								<input type="text" class="form-control form-control-lg" name="total" form="formorder" placeholder="ยอดชำระ">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card my-3 rounded-0">
				<div class="card-body">
					<p class="mb-2">รายการสินค้า</p>
					<div class="form-row">
						<?php foreach ($products as $product): ?>
						<div class="form-group col-md-4 mb-0">
							<button class="addtocart" data-id="<?php echo encode($product['id_product'],KEY);?>" >
							<div class="card rounded-0">
								<img class="card-img-top img-fluid" src="<?php echo IMAGE.$product['product_image']; ?>" alt="">
								<div class="card-body">
									<span><?php echo $product['product_name']; ?></span>
									<small><?php echo $product['product_special']>0?'<s>'.$product['product_price'].'</s> <span class="text-danger font-weight-bold">'.$product['product_special'].'</span>' : '<b>'.$product['product_price'].'</b>'; ?></small>
								</div>
							</div>
							</button>
						</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
			<div class="card my-3 rounded-0">
				<div class="card-body">
					<form action="<?php echo route('shop/sale');?>" method="post">
						<div id="listcart"></div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card rounded-0 mt-3">
				<div class="card-body p-0">
					<form action="<?php echo $action_save; ?>" method="post" id="formorder">
					<table class="table table-bordered mb-0 table-cal">
						<tbody>
							<tr>
								<td width="50%" colspan="2">
									<small class="position-absolute p-2 text-white">ได้รับเงิน</small>
									<input type="text" name="incash" class="form-control form-control-lg w-100 py-4 input-cal" value="0">
								</td>
								<td width="50%" colspan="2">
									<small class="position-absolute p-2 text-white">ทอน</small>
									<input type="text" name="returncash" class="form-control form-control-lg w-100 py-4 output-cal" value="0">
								</td>
							</tr>
							<tr>
								<td width="25%"><input type="button" value="7" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="8" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="9" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="ลบ" class="btn btn-danger btn-cal"></td>
							</tr>
							<tr>
								<td width="25%"><input type="button" value="4" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="5" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="6" class="btn btn-dark btn-cal"></td>
								<td width="25%" rowspan="3"><input type="button" onclick="this.form.submit()" value="ส่ง" class="btn btn-success submit-cal" style="height: 200px;"></td>
							</tr>
							<tr>
								<td width="25%"><input type="button" value="1" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="2" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="3" class="btn btn-dark btn-cal"></td>
							</tr>
							<tr>
								<td width="25%"><input type="button" value="0" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="00" class="btn btn-dark btn-cal"></td>
								<td width="25%"><input type="button" value="." class="btn btn-dark btn-cal"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<div class="card rounded-0">
				<div class="card-body">
					<div class="row m-0">
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="1000">1,000</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="500">500</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="100">100</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="50">50</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="20">20</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="10">10</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="5">5</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="2">2</button>
						</div>
						<div class="col-4 p-0">
							<button class="btn btn-outline-info w-100 rounded-0 py-3 addamount" style="font-size:1em;" data-amount="1">1</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_result">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="<?php echo $action_save; ?>" method="post" id="formsubmit">
				<div class="modal-header">
					<h4 class="modal-title">ยอดชำระ <span id="total" data-total="">0</span> บาท</h4>
					<input type="hidden" id="input_total" name="total" value="0">
					<button type="button" class="close" data-dismiss="modal" aria-label="ปิด">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">ปิด</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">รับเงิน</label>
								<div class="col-sm-7">
									<input type="text" id="checkamount" name="incash" data-amount="0" readonly class="form-control-plaintext" value="0">
								</div>
								<label class="col-sm-2 col-form-label">บาท</label>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">เงินทอน</label>
								<div class="col-sm-7">
									<input type="text" id="checkreturn" name="returncash" readonly class="form-control-plaintext" value="0">
								</div>
								<label class="col-sm-2 col-form-label">บาท</label>
							</div>
						</div>
					</div>
					<div class="mb-2">
						<button type="button" data-amount="1000" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">1,000 ฿</h3></button>
						<button type="button" data-amount="500" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">500 ฿</h3></button>
						<button type="button" data-amount="100" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">100 ฿</h3></button>
						<button type="button" data-amount="50" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">50 ฿</h3></button>
						<button type="button" data-amount="20" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">20 ฿</h3></button>
					</div>
					<div class="mb-2">
						<button type="button" data-amount="10" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">10 ฿</h3></button>
						<button type="button" data-amount="5" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">5 ฿</h3></button>
						<button type="button" data-amount="2" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">2 ฿</h3></button>
						<button type="button" data-amount="1" class="addamount btn btn-outline-dark btn-lg"><h3 class="mb-0">1 ฿</h3></button>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
button.addtocart { background: none; border:0; }
</style> 
<script type="text/javascript">
	jQuery(document).ready(function($) {
		// $('#modal_result').on('show.bs.modal', function (event) {
		// 	var button = $(event.relatedTarget) 
		// 	var total = button.data('total')
		// 	var modal = $(this)
		// 	modal.find('#total').html(addCommas(total));
		// 	modal.find('#total').attr('data-total', total);
		// 	modal.find('#input_total').val(total);
		// 	$('#modal_result #checkamount').attr('data-amount', 0).val(0);
		// 	$('#modal_result #checkreturn').attr('data-amount', 0).val(0);
		// })
		// $('#modal_result .addamount').click(function(event) {
		// 	var amount = $(this).data('amount');

		// 	var total = $('#total').data('total');
		// 	var old = $('#modal_result #checkamount').attr('data-amount');
		// 	console.log(old); console.log(amount);
		// 	var sum = parseInt(old) + parseInt(amount);
		// 	if (sum>total) {
		// 		var re = parseInt(sum) - parseInt(total);	
		// 	} else {
		// 		var re = 0;
		// 	}
			
		// 	$('#modal_result #checkamount').attr('data-amount', sum);
		// 	$('#modal_result #checkamount').val(addCommas(sum));

		// 	$('#modal_result #checkreturn').val(addCommas(re));
		// });
		loadCart();
		function loadCart() {
			$.ajax({
				url: '<?php echo route('shop/getCart');?>',
				type: 'POST',
				dataType: 'json',
				success:function(data) {
					if ( $('[name="pos"]').val().length == 0 ) {
						$('[name="pos"]').val(data.pos);	
					}
					
					$('[name="total"]').val(addCommas(data.data.total));
					$('#listcart').html(data.html);
				}
			});
		}
		$('#listcart').on('click', '.delcart', function(event) {
			event.preventDefault();
			var encryptid = $(this).data('id');
			$.ajax({
				url: '<?php echo route('shop/delCart');?>',
				type: 'POST',
				dataType: 'json',
				data: {id: encryptid},
				success: function(data) {
					loadCart();
				}
			});
			
		});
		$('#listcart').on('keyup', '.inputqty', function(event) {
			event.preventDefault();
			var encryptid = $(this).data('id');
			$.ajax({
				url: '<?php echo route('shop/qtyCart');?>',
				type: 'POST',
				dataType: 'json',
				data: {id: encryptid, qty: $(this).val()},
				success: function(data) {
					loadCart();
				}
			});
		});
		$('#listcart').on('change', '.inputqty', function(event) {
			event.preventDefault();
			var encryptid = $(this).data('id');
			$.ajax({
				url: '<?php echo route('shop/qtyCart');?>',
				type: 'POST',
				dataType: 'json',
				data: {id: encryptid, qty: $(this).val()},
				success: function(data) {
					loadCart();
				}
			});
		});
		$('.addtocart').click(function(event) {
			console.log('click'); 
			var id = $(this).data('id');
			var img = $(this).data('img');
			var productname = $(this).data('name');
			$.ajax({
				url: '<?php echo route('shop/addtocart'); ?>',
				type: 'POST',
				// dataType: 'json',
				data: {id_product: id},
				success: function(data) {
					console.log(data);
					loadCart();
				}
			});
			
		});
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

<script>
	$(document).ready(function() {
		$('.select2').select2();
		$('.addamount').click(function(event) {
			var value = $(this).data('amount');
			addInput(value, 2);
		});
		$('.btn-cal').click(function(event) {
			var value = $(this).val();
			if (value=='ลบ') {
				$('.input-cal,.output-cal').val('');
			} else {
				addInput($(this).val(), 1);	
			}
		});
		function addInput(inputNew, type=1) {
			var cal = 0;
			if (type==1) {
				var old = $('.input-cal').val().toString();
				if (old == '0') {
					old = '';
				}
				var cal = inputNew.toString();
				if (typeof old != undefined && typeof old != null) {
					cal = old + cal;
				}	
			} else if (type==2) {
				var old = parseFloat($('.input-cal').val());
				var cal = parseFloat(inputNew);
				if (old>0) {
					cal = old + cal;
				} else {
					cal = cal;
				}
			}
			$('.input-cal').val(cal);
			var sum = parseFloat($('[name="total"]').val());
			sum = cal - sum;
			$('.output-cal').val(sum);
		}
	});
</script>