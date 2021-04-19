<style type="text/css">
	table {
		position: relative;
		width: 100% !important;
		border-collapse: collapse;
	}
	/* table top */
	table.top {
		table-layout: fixed;
	}
	table.top tbody tr td {
		vertical-align: top;
	}
	/* table title */
	table.title tbody tr td {
		vertical-align: top;
	}
	table.title {
		margin-top: 20px;
		margin-bottom: 40px;
	}

	/* table center */
	table.table-product thead tr th {
		padding: 5px;
		text-align: center;
	}	
	table.table-product tfoot tr th {
		padding: 5px;
	}
	table.table-product tbody tr td {
		padding: 5px;
	}
	table.table-product { 
		margin-left: 50px;
		margin-bottom: 50px;
	}

	/* table bottom */
	table.table-bottom h3 {
		font-weight: normal;
		font-size: 18px;
	}
	table.table-bottom {
		margin-bottom: 30px;
		margin-left: 50px;
	}
	table.table-bottom2 {
		margin-left: 50px;
		margin-bottom: 30px;
	}
	table.table-bottom2 h3 {
		font-weight: normal;
		font-size: 18px;
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

<!-- <h1>{$member_name}</h1>
<table>
	<thead>
		<tr>
			<td>ลำดับ</td>
			<td>ชื่อ</td>
		</tr>
	</thead>
	<tbody>{$row_data}</tbody>
</table>
 -->
<page orientation="p">
	<table class="top">
		<tbody>
			<tr>
				<td width="375" class="logo-company">{$company_logo}</td>
				<td width="375" class="text-right">
					<h1>{$company_name}</h1>
					<p>{$company_address}</p>
					<p>{$company_tel} {$company_tax_no}</p>
				</td>
			</tr>
		</tbody>
	</table>
	<table class="title">
		<tbody>
			<tr>
				<td class="text-center" width="750"><h1>ใบรับรองแทนใบเสร็จรับเงิน</h1></td>
			</tr>
			<tr>
				<td class="text-right" width="750"><h3>เลขที่ {$theCost_doc_no}</h3></td>
			</tr>
			<tr>
				<td class="text-right" width="750"><h3>วันที่ {$theCost_date_head}</h3></td>
			</tr>
		</tbody>
	</table>

	<table border="1" class="table-product">
		<thead>
			<tr>
				<th>วัน เดือน ปี</th>
				<th>รายละเอียดรายจ่าย</th>
				<th>จำนวนเงิน (บาท)</th>
				<th>หมายเหตุ</th>
			</tr>
		</thead>
		<tbody>
			{$row_data}
			<tr>
				<td width="100" style="border-left: 0; border-bottom: 0;"></td>
				<td width="250" class="text-center">รวมทั้งสิ้น</td>
				<td width="80">{$sum_total_price}</td>
				<td width="100" style="border-right: 0; border-bottom: 0;"></td>
			</tr>
			<tr>
				<td width="100" style="border-left: 0; border-bottom: 0;"></td>
				<td width="250" colspan="2" style="padding-top: 30px;">ตัวอักษร( {$text_sum_total_price} )</td>
				<td width="100" style="border-right: 0; border-bottom: 0;"></td>
			</tr>
		</tbody>
	</table>

	<table class="table-bottom">
		<tbody>
			<tr>
				<td width="750"><h3>ข้าพเจ้า {$theCost_name} (ผู้เบิกจ่าย) ตำแหน่ง {$theCost_position} ขอรับรองว่ารายจ่ายข้างต้นนี้</h3></td>
			</tr>
			<tr>
				<td width="750"><h3>ไม่อาจเรียกใบเสร็จรับเงินจากผู้รับได้ และข้าพเจ้าได้จ่ายไปในงานของทาง {$theCost_text} </h3></td>
			</tr>
			<tr>
				<td width="750"><h3>โดยแท้ ตั้งแต่วันที่ {$theCost_date_start} ถึงวันที่ {$theCost_date_end} </h3></td>
			</tr>
		</tbody>
	</table>

	<table class="table-bottom2">
		<tbody>
			<tr>
				<td class="text-right" width="650"><h3>(……........................................................................…..)</h3></td>
			</tr>
			<tr>
				<td class="text-right" width="650" style="padding-bottom: 40px;"><h3>ลงชื่อ {$theCost_name_pay}(ผู้เบิกจ่าย)</h3></td>
			</tr>
			<tr>
				<td class="text-right" width="650"><h3>(……........................................................................…..)</h3></td>
			</tr>
			<tr>
				<td class="text-right" width="650" style="padding-bottom: 40px;"><h3>ลงชื่อ {$theCost_name_approved} (ผู้อนุมัติ)</h3></td>
			</tr>
			<tr>
				<td width="650"><h3>สำหรับบัญชี</h3></td>
			</tr>
			<tr>
				<td width="650"><h3>จ่ายผ่าน (เงินสดย่อย/โอนเงิน) เมื่อวันที่ {$theCost_accounting}' </h3></td>
			</tr>
		</tbody>
	</table>

	<table style="margin-left: 50px;">
		<tbody>
			<tr>
				<td><i>**เอกสารนี้ใช้ทดแทนเอกสารที่ไม่สามารถได้รับใบเสร็จรับเงินได้ สำหรับผู้ขายหรือผู้ให้บริการที่ไม่อยู่ในระบบภาษีมูลค่าเพิ่ม</i></td>
			</tr>
			<tr>
				<td><i>เพื่อใช้เป็นเอกสารประกอบใบเบิกเงินที่สำรองจ่ายไปก่อน</i></td>
			</tr>
		</tbody>
	</table>
</page>