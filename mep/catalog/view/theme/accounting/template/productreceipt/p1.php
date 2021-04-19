<style type="text/css">
	table {
		position: relative;
		width: 100% !important;
		border-collapse: collapse;
	}

	/* table title */
	table.title tbody tr td {
		vertical-align: top;
	}
	table.title {
		margin-bottom: 40px;
	}

	/* table center */
	table.table-product thead tr th {
		background: #97040c;
		color: #fff;
		padding: 10px;
		text-align: center;
	}	
	table.table-product tfoot tr th {
		padding: 10px;
	}
	table.table-product tbody tr td {
		padding: 10px;
	}
	table.table-product {
		margin-bottom: 20px;
	}
	/* table footer */
	table.table-footer tr td {
		vertical-align: top;
		padding: 10px;
	}

	/* text */
	h1,h2,h3,h4,h5 {
		margin-top: 0;
		margin-bottom: 0;
	}
	p {
		margin-top: 0;
		margin-bottom: 5px;
	}
	.text-center {
		text-align: center;
	}
	.text-right {
		text-align: right;
	}

	.head {
		display: block;
		border: 1px solid #97040c;
		padding: 10px;
		width: 200px;
		text-align: center;
		margin-left: 250px;
		border-top-left-radius: 10px;
		border-bottom-right-radius: 10px;
	}
	.head h4 {
		font-weight: bold;
		font-size: 20px;
	}
	.head-right {
		display: block;
		border: 1px solid #97040c;
		padding: 20px 10px;
		width: 150px;
		text-align: center;
		border-radius: 5px;
	}
	.head-right p {
		font-size: 16px;
		font-weight: bold;
	}

	/* margin */
	.mb-1 {
		margin-bottom: 10px;
	}

	/* */
	.total-text {
		display: block;
		border: 1px solid #333;
		padding: 10px;
		text-align: center;
		background: #eee;
		position: relative;
		width: 490px;
		margin-top: 10px;
	}

</style>

<page orientation="p">
<table class="title">
	<tbody>
		<tr>
			<td>
				{$company_logo}
			</td>
			<td width="430">
				<h1>{$company_name}</h1>
				<h1 class="mb-1">{$company_name_en}</h1>
				<p>{$company_address}</p>
				<p>{$company_tel} {$company_tax_no}</p>
			</td>
			<td>
				<div class="head-right">
					<p>( ไม่ใช่ใบกำกับภาษี )</p>
				</div>
				<br><br><br>
				<!-- <p class="text-center">สำหรับลูกค้า</p> -->
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div class="head">
					<h4>ใบรับสินค้า</h4>
					<h4>PRODUCT RECEIPT</h4>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<p>บริษัทลูกค้า {$customer_company}</p>
				<p>ที่อยู่ <div style="word-wrap: break-word;width:500px;">{$customer_address}</div></p>
			</td>
			<td>
				<p>เลขที่  {$doc_no}</p>
				<p>วันที่ : {$date_start}</p>
				<p>อ้างอิงถึง : {$ref}</p>
				<p>วัน ครบกําหนด :{$date_end}</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>เลขประจำตัวผู้เสียภาษี {$customer_tax_no}</p>
			</td>
			<td class="text-center">
				<p>{$customer_branch_no}</p>
			</td>
		</tr>
	</tbody>	
</table>

<table border="1" cellspacing="0" cellpadding="10" class="table-product">
	<thead>
		<tr>
			<th>ลำดับ</th>
			<th>รหัสสินค้่า</th>
			<th width="300">รายการ</th>
			<th>จำนวน</th>
			<th>หน่วย</th>
			<th>ราคา</th>
			<th>จำนวนเงิน</th>
		</tr>
	</thead>
	<tbody>
		{$row_data}
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">
				ระยะเครดิต  {$term}<br>
				เงื่อนไขการชําระเงิน {$condition}<br>
				หมายเหตุ : <br>
				{$remark}
				<!-- 1.กรณีชำระเงินโดยเช็คกรุณาสั่งจ่ายเช็คขีดคร่อมในนาม "{$company_name}" เท่านั้น <br>
				2.บริษัทฯ ขอสงวนสิทธิในการแก้ไขใบกำกับภาษีภายใน 7 วัน นับจากวันที่ระบุในใบกำกับภาษี (ผิด ตก ยกเว้น E. & OE.) <br> -->
				<br>
				<div class="total-text">
					<p>({$text_money})</p>
				</div>
			</th>
			<th colspan="2">
				<p>รวมเงิน</p>
				<p>ส่วนลด {$percent_discount}%</p>
				<p>รวมก่อนภาษีมูลค่าเพิ่ม</p>
				<p>ภาษีมูลค่าเพิ่ม  {$select_check_vat}%</p>
				
				<p>หัก ณ ที่จ่าย  {$select_check_tax}%</p>
				<p>จำนวนเงินทั้งสิ้น</p>
			</th>
			<th  colspan="2" class="text-right">
				<p>{$input_sum_bill}</p>
				<p>{$input_text_discount}</p>
				<p>{$input_text_discount_total}</p>
				<p>{$input_text_vat}</p>
				
				<p>{$total_tax}</p>
				<p>{$input_net_total_vat}</p>
			</th>
		</tr>
	</tfoot>
</table>

<table border="1" cellspacing="0" cellpadding="10" class="table-footer">
	<tbody>
		<tr>
			<td width="210">
				<p class="text-center">ได้รับสินค้าตามรายการข้างบนไว้เรียบร้อยแล้ว</p>
				<br><br><br>
				<p>ผู้รับสินค้า</p>
				<p>วันที่</p>
			</td>
			<td width="210">
				<br><br><br><br>
				<p>ผู้ส่งสินค้า</p>
				<p>วันที่</p>
			</td>
			<td width="210">
				<p class="text-center">ในนาม {$customer_name}</p>
				<br><br><br><br>
				<p>ผู้มีอำนาจลงนาม</p>
			</td>
		</tr>
	</tbody>
</table>
</page>