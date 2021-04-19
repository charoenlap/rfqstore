
 <table class="table table-bordered my-2" id="tablecart"> 
	<thead>
		<tr>
			<th>รายการ</th>
			<th colspan="2">ราคา</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($cart as $key => $value): ?>
		<tr>
			<td>
				<!-- <img src="<?php echo IMAGE.$value['image'];?>" alt="" class="img-fluid"> -->
				<?php echo $value['name']; ?>
			</td>
			<td width="30%"><input type="number" min="1" class="form-control form-control-sm in inputqty" data-id="<?php echo encode($key,KEY);?>" value="<?php echo $value['qty']; ?>"></td>
			<td width="10%" class="text-center"><button type="button" class="btn btn-danger btn-sm delcart" data-id="<?php echo encode($key,KEY);?>"><i class="fas fa-trash"></i></button></td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<a href="<?php echo route('shop/clearCart');?>" class="btn btn-outline-danger w-100 rounded-0" onclick="return confirm('ยืนยันการล้างตะกร้า');">ล้างตะกร้า</a>
<style>
#tablecart { border-top-left-radius: 5px; }
</style>