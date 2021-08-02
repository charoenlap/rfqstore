<?php echo $breadcrumb; ?>
<?php echo $headerMenu; ?>
<style>
	.nav-pills .nav-link.active,
	.nav-pills .show>.nav-link {
		background: #27a9b9;
		background-image: linear-gradient(to bottom right, #27a9b9, #65BAC6);
		color: #fff;
	}

	.nav-pills .nav-link {
		color: black;
	}
</style>
<div class="container-fluid" id="panel-page">
	<div class="row">
		<div class="col-12">
			<?php if (!empty($success)) : ?>
				<div class="card my-3">
					<div class="card-body">
						<div class="alert alert-success" role="alert"><?php echo $success; ?></div>
					</div>
				</div>

			<?php endif ?>
			<?php if (!empty($error)) : ?>
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
									<?php foreach ($list_pos as $key => $value) : ?>
										<option value="<?php echo $value['pos_no']; ?>" <?php echo $pos == $value['pos_no'] ? 'selected' : ''; ?>><?php echo $value['pos_name'] . ' (' . $value['pos_no'] . ')'; ?></option>
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

			<div class="card mt-3 rounded-0">
				<div class="card-body p-3">
					<p class="mb-2">หมวดหมู่สินค้า</p>
					<ul class="nav nav-pills">
						<?php foreach ($category as $keys => $cat) { ?>
							<li class="nav-item">
								<a class="nav-link <?php echo $keys == 0 ? "active" : ""; ?>" id="product-<?php echo $keys; ?>" data-toggle="tab" href="#product_<?php echo $keys; ?>" role="tab" aria-controls="product_<?php echo $keys; ?>" aria-selected="true"><?php echo $cat['category_name']; ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>

			<div class="tab-content">
				<?php foreach ($category as $key => $value) { ?>
					<div class="tab-pane fade <?php echo $key == 0 ? "show active" : ""; ?>" id="product_<?php echo $key; ?>" role="tabpanel" aria-labelledby="product-<?php echo $keys; ?>">
						<div class="card my-3 rounded-0">
							<div class="card-body">
								<div class="row"> 
									<div class="col-md-9 col-sm-8 w-50"> 
										<!-- <p class="mb-2">รายการสินค้า</p> -->
										<label class="mb-2">รายการสินค้า</label>
									</div>
									<div class="col-md-3 col-sm-4 w-50 text-right">
										<button class="btn btn-info mb-2 grid-table">
											<i class="fas fa-th"></i>
										</button>

										<button class="btn btn-info mb-2 grid-rows">
											<i class="fas fa-grip-lines"></i>
										</button>
									</div>
								</div>
								<div class="form-row d-none">
									<?php foreach ($product_cats[$key] as $product) : ?>
										<div class="form-group grid-size col-md-4 mb-0">
											<button class="addtocart" data-id="<?php echo encode($product['id_product'], KEY); ?>" style="width:100%;">
												<div class="card rounded-0 grid-img" style="width:100%;height:250px;background:url('<?php echo IMAGE . $product['product_image']; ?>');background-position:center;background-size: cover;">
													<div class="card-body grid-detail">
														<div class="bg-info">
															<span class=""><?php echo $product['product_name']; ?></span>
														</div>
														<div class="bg-success">
															<small><?php echo $product['product_special'] > 0 ? '<s>' . $product['product_price'] . '</s> <span class="text-danger font-weight-bold">' . $product['product_special'] . '</span>' : '<b>' . $product['product_price'] . '</b>'; ?></small>
														</div>
													</div>
												</div>
											</button>
										</div>
									<?php endforeach ?>
								</div>

								<div class="form-row ">
									<?php foreach ($product_cats[$key] as $product) : ?>
										<div class="form-group grid-size col-md-4 mb-0">
											<button class="addtocart" data-id="<?php echo encode($product['id_product'], KEY); ?>" style="width:100%;">
												<div class="card rounded-0 grid-img" style="width:100%;height:250px;background:url('<?php echo IMAGE . $product['product_image']; ?>');background-position:center;background-size: cover;">
													<div class="card-body grid-detail">
														<div class="bg-info">
															<span class=""><?php echo $product['product_name']; ?></span>
														</div>
														<div class="bg-success">
															<small><?php echo $product['product_special'] > 0 ? '<s>' . $product['product_price'] . '</s> <span class="text-danger font-weight-bold">' . $product['product_special'] . '</span>' : '<b>' . $product['product_price'] . '</b>'; ?></small>
														</div>
													</div>
												</div>
											</button>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<!-- <div class="card my-3 rounded-0">
				<div class="card-body">
					<p class="mb-2">รายการสินค้า</p>
					<div class="form-row">
						<?php foreach ($products as $product) : ?>
							<div class="form-group col-md-4 mb-0">
								<button class="addtocart" data-id="<?php echo encode($product['id_product'], KEY); ?>" style="width:100%;">
									<div class="card rounded-0" style="width:100%;height:250px;background:url('<?php echo IMAGE . $product['product_image']; ?>');background-position:center;background-size: cover;">
										<div class="card-body ">
											<div class="bg-info">
												<span class=""><?php echo $product['product_name']; ?></span>
											</div>
											<div class="bg-success">
												<small><?php echo $product['product_special'] > 0 ? '<s>' . $product['product_price'] . '</s> <span class="text-danger font-weight-bold">' . $product['product_special'] . '</span>' : '<b>' . $product['product_price'] . '</b>'; ?></small>
											</div>
										</div>
									</div>
								</button>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div> -->
		</div>
		<div class="col-md-4">
			<div class="card my-3 rounded-0">
				<div class="card-body">
					<form action="<?php echo route('shop/sale'); ?>" method="post">
						<div id="listcart"></div>
					</form>
				</div>
			</div>
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
						<button type="button" data-amount="1000" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">1,000 ฿</h3>
						</button>
						<button type="button" data-amount="500" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">500 ฿</h3>
						</button>
						<button type="button" data-amount="100" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">100 ฿</h3>
						</button>
						<button type="button" data-amount="50" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">50 ฿</h3>
						</button>
						<button type="button" data-amount="20" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">20 ฿</h3>
						</button>
					</div>
					<div class="mb-2">
						<button type="button" data-amount="10" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">10 ฿</h3>
						</button>
						<button type="button" data-amount="5" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">5 ฿</h3>
						</button>
						<button type="button" data-amount="2" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">2 ฿</h3>
						</button>
						<button type="button" data-amount="1" class="addamount btn btn-outline-dark btn-lg">
							<h3 class="mb-0">1 ฿</h3>
						</button>
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
	button.addtocart {
		background: none;
		border: 0;
	}

	#printorder {
		display: none;
	}

	@media print {
		#panel-page {
			display: none;
		}

		nav {
			display: none;
		}

		#sidebar-wrapper {
			display: none;
		}

		.nav-scroller {
			display: none;
		}

		.site-footer {
			display: none;
		}

		#printorder {
			display: block;
			margin-top: 100px;
			width: 300px;
			padding-left: 10px;
		}

		#modal_view {
			display: none !important;
		}

		.modal-backdrop {
			display: none !important;
		}
	}
</style>
<div id="printorder">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 mb-5">
				<h5>ใบกำกับภาษีอย่างย่อ</h5>
				<h5 id="company_taxid_Print">Tax</h5>
				<h5 id="company_name_Print">Company</h5>
				<h5 id="company_address_Print">Address</h5>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered">
					<tbody id="listitemPrint">
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
							<td class="px-2 py-1 text-right" id="total_print">100.00</td>
						</tr>
						<tr>
							<td class="px-2 py-1" colspan="2"><small>เงินสด</small></td>
							<td class="px-2 py-1 text-right"><small id="received_print">100.00</small></td>
						</tr>
						<tr>
							<td class="px-2 py-1" colspan="2"><small>เงินทอน</small></td>
							<td class="px-2 py-1 text-right"><small id="change_print">0.00</small></td>
						</tr>
					</tfoot>
				</table>
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
					<b>
						<p class="mb-0">ใบกำกับภาษีอย่างย่อ</p>
					</b>
					<p class="mb-1" id="company_taxid">Tax</p>
					<b>
						<p class="mb-0" id="company_name">Company</p>
					</b>
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
							<td class="px-2 py-1 text-right"><span id="totals">100.00</span></td>
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
<script type="text/javascript">
	jQuery(document).ready(function($) {

		var buttonid = $('#id_order').text(); //button.data('id')
		// console.log(buttonid);
		if (buttonid != '') {
			$('#modal_view').modal('show');
			$.ajax({
				url: '<?php echo route('shop/getOrder'); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					id: buttonid
				},
				success: function(data) {

					console.log(data);
					// if (data.company.company_logo != null) {
					// 	$('#company_logo').attr('src', '<?php echo MURL; ?>uploads'+data.company.company_logo);
					// }
					if (data.company.company_name != null) {
						$('#company_name').html(data.company.company_name);
						$('#company_name_Print').html(data.company.company_name);
					}
					if (data.company.company_tax_no != null) {
						$('#company_taxid').html(data.company.company_tax_no);
						$('#company_taxid_Print').html(data.company.company_tax_no);
					}
					if (data.company.company_address != null) {
						$('#company_address').html(data.company.company_address);
						$('#company_address_Print').html(data.company.company_address);
					}
					if (data.total != null) {
						$('#totals').html(data.total);
						$('#received').html(data.received);
						$('#change').html(data.change);

						$('#total_print').html(data.total);
						$('#received_print').html(data.received);
						$('#change_print').html(data.change);
					}
					$.each(data, function(index, val) {
						$('#' + index).html(addCommas(val));
						$('#head' + index).html(addCommas(val));
						if (index == 'products') {
							var html = '';
							$.each(val, function(indexProduct, valProduct) {
								var sum = parseFloat(valProduct['quantity']) * parseFloat(valProduct['price']);
								html += '<tr>' +
									'   <td>' + valProduct['quantity'] + '</td>' +
									'	<td>' +
									'		<p class="mb-0">' + valProduct['name'] + ' @' + addCommas(valProduct['price']) + '</p>' +
									// '		<small>'+valProduct['quantity']+' x '+addCommas(valProduct['price'])+'</small>'+
									'	</td> ' +
									'	<td class="text-right">' + addCommas(sum.toFixed(2)) + '</td>' +
									'</tr>';
							});
							$('#listitem').html(html);
							$('#listitemPrint').html(html);
						}
					});
					window.print();
				}
			});
		}
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
				url: '<?php echo route('shop/getCart'); ?>',
				type: 'POST',
				dataType: 'json',
				success: function(data) {
					if ($('[name="pos"]').val().length == 0) {
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
				url: '<?php echo route('shop/delCart'); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					id: encryptid
				},
				success: function(data) {
					loadCart();
				}
			});

		});
		$('#listcart').on('keyup', '.inputqty', function(event) {
			event.preventDefault();
			var encryptid = $(this).data('id');
			$.ajax({
				url: '<?php echo route('shop/qtyCart'); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					id: encryptid,
					qty: $(this).val()
				},
				success: function(data) {
					loadCart();
				}
			});
		});
		$('#listcart').on('change', '.inputqty', function(event) {
			event.preventDefault();
			var encryptid = $(this).data('id');
			$.ajax({
				url: '<?php echo route('shop/qtyCart'); ?>',
				type: 'POST',
				dataType: 'json',
				data: {
					id: encryptid,
					qty: $(this).val()
				},
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
				data: {
					id_product: id
				},
				success: function(data) {
					console.log(data);
					loadCart();
				}
			});

		});

		function addCommas(nStr) {
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
			if (value == 'ลบ') {
				$('.input-cal,.output-cal').val('');
			} else {
				addInput($(this).val(), 1);
			}
		});
		$('.grid-table').on('click', function() {
			$('.grid-size').addClass('col-md-4');
			// $('.grid-img').addClass('visible');

			$('.grid-img').removeClass('h-25');
			$('.grid-img').removeClass('invisible');
			$('.grid-size').removeClass('col-md-12');
		});
		$('.grid-rows').on('click', function() {
			$('.grid-size').addClass('col-md-12');
			$('.grid-img').addClass('invisible');
			$('.grid-img').addClass('h-25');
			$('.addtocart').addClass('visible');
			$('.grid-detail').addClass('visible');

			// $('.grid-img').removeClass('visible');
			$('.grid-size').removeClass('col-md-4');
		})

		function addInput(inputNew, type = 1) {
			var cal = 0;
			if (type == 1) {
				var old = $('.input-cal').val().toString();
				if (old == '0') {
					old = '';
				}
				var cal = inputNew.toString();
				if (typeof old != undefined && typeof old != null) {
					cal = old + cal;
				}
			} else if (type == 2) {
				var old = parseFloat($('.input-cal').val());
				var cal = parseFloat(inputNew);
				if (old > 0) {
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