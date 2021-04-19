<style type="text/css">
	p {
		margin-top: 0;
		margin-bottom: 5px;
	}
	/* table */
	table {
		position: relative;
		width: 100% !important;
		border-collapse: collapse;
	}
	/* top */
	table.top {
		vertical-align: top;
		margin-bottom: 10px;
		margin-top: 35px;
	}
	/* body */
	table.body {
		vertical-align: top;
	}

	/* table product */
	table.table-product {
		margin-bottom: 20px;
	}
	table.table-product tr td,
	table.table-product tr th {
		padding: 5px;
	}
	table.table-product tbody tr.bt-0 td {
		border-bottom: 0;
	}
	
	/* text */
	.text-right {
		text-align: right;
	}
	.text-center {
		text-align: center;
	}

	/* checkbox */
	.checkbox {
	  width:20px;
	  height:20px;
	  border: 1px solid #000;
	  display: inline-block;
	  padding-left: 5px;
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
			<td width="600">
				<p>หนังสือรับรองการหักภาษี ณ ที่จ่าย ตามมาตรา 50 ทวิ แห่งประมวลรัษฎากร</p>
				<p>WITHHOLDING TAX CERTIFICATE UNDER SECTION 50 BIS OF THE REVENUE CODE</p>
			</td>
			<td>
				<p class="text-right">เลขที่ / NO. {$withholdingTax_doc_no}</p>
			</td>
		</tr>
	</tbody>
</table>


<table class="body" border="1" cellspacing="0">
	<tbody>
		<tr>
			<td width="370" style="padding-bottom: 20px;">
				<table>
					<tbody>
						<tr>
							<td><p>1.</p></td>
							<td colspan="2">
								<p>
									'ชื่อ. ที่อยู่และเลขประจำตัวผู้เสียภาษีอากร (บุคคล คณะบุคคล นิติบุคคล  ส่วนราชการ  <br>
									องค์การ รัฐวิสาหกิจ  ฯลฯ ) ของผู้มีหน้าที่หักภาษี ณ ที่จ่าย : <br>
									Name, address and tax identity number of person withholding tax at source <br>
									'(person, partnership, company, association, body of person, government, <br>
									organization municipality, sanitation district.)
								</p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><p>เลขที่ทะเบียน/ ID No. </p></td>
							<td>{$withholdingTax_id_no_1}</td>
						</tr>
						<tr>
							<td></td>
							<td><p>ชื่อ / Name</p></td>
							<td>
								<p>{$withholdingTax_id_name_1}</p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><p>ที่อยู่ / Address</p></td>
							<td>
								<p>
									{$withholdingTax_id_address_1}
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td width="370">
				<table>
					<tbody>
						<tr>
							<td height="70"><p>2.</p></td>
							<td colspan="2">
								<p>
									ชื่อ. ที่อยู่และเลขประจำตัวผู้เสียภาษีอากรของผู้ถูกหักภาษี ณ ที่จ่าย : <br>
									'Name, address and tax identity number of person who has tax withheld at <br>
									source.
								</p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><p>เลขที่ทะเบียน/ ID No. </p></td>
							<td>{$withholdingTax_id_no_2}</td>
						</tr>
						<tr>
							<td></td>
							<td><p>ชื่อ / Name</p></td>
							<td>
								<p>{$withholdingTax_id_name_2}</p>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><p>ที่อยู่ / Address</p></td>
							<td>
								<p>
									{$withholdingTax_id_address_2}
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border-bottom: 0;">
				<table border="1" cellspacing="0" class="table-product">
					<thead>
						<tr>
							<th width="300"></th>
							<th class="text-center" width="115">
								<p>
									วัน เดือน หรือปีภาษีที่จ่าย <br>
									Date month <br>
									or year payable								 								
								</p>
							</th>
							<th class="text-center" width="115">
								<p>
									จำนวนเงินที่จ่าย <br>
									Amount paid								
								</p>
							</th>
							<th class="text-center" width="115">
								<p>
									จำนวนเงินภาษีที่หักไว้ <br>
									Amount of tax <br>
									deducted at source								
								</p>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="bt-0">
							<td>
								1. เงินเดือน ค่าจ้าง เบี้ยเลี้ยง โบนัส ฯลฯ ตามมาตรา 40(1) <br>
								Salary, wage, per diem, bonus etc.under Section 40(1)
							</td>
							<td>{$withholdingTax_date_tax_1}</td>
							<td>{$withholdingTax_price_1}</td>
							<td>{$withholdingTax_tax_1}</td>
						</tr>
						<tr class="bt-0">
							<td>
								2. ค่าธรรมเนียม ค่านายหน้า ฯลฯ ตามมาตรา 40(2) <br>
								Fee, brokerage etc. under Section 40(2)
							</td>
							<td>{$withholdingTax_date_tax_2}</td>
							<td>{$withholdingTax_price_2}</td>
							<td>{$withholdingTax_tax_2}</td>
						</tr>
						<tr class="bt-0">
							<td>
								3. ค่าแห่งลิขสิทธิ์ ฯลฯ ตามมาตรา 40(3) <br>
								Royalty under Section 40(3)
							</td>
							<td>{$withholdingTax_date_tax_3}</td>
							<td>{$withholdingTax_price_3}</td>
							<td>{$withholdingTax_tax_3}</td>
						</tr>
						<tr class="bt-0">
							<td>
								4. ค่าดอกเบี้ย ฯลฯ ตามมาตรา 40(4)(ก) <br>
								Interest etc. under Section 40(4) (a)
							</td>
							<td>{$withholdingTax_date_tax_4}</td>
							<td>{$withholdingTax_price_4}</td>
							<td>{$withholdingTax_tax_4}</td>
						</tr>
						<tr class="bt-0">
							<td>
								5. การจ่ายเงินได้ที่ต้องหักภาษี ณ ที่จ่ายตามความสั่งกรม <br>
								สรรพากรที่ออกตามมาตรา 3 เตรส เช่น ค่าซื้อพืชผลทางการเกษตร <br>
								(ยางพารา มันสำปะหลัง ปอ ข้าว ฯลฯ)รางวัลในการประกวด การแข่งขัน การชิงโชค <br>
								ค่าแสดงภาพยนตร์ ร้องเพลง ดนตรี ค่าจ้างทำของ ค่าจ้างโฆษณา ค่าเช่า ฯลฯ <br>
								Income which will be deducted tax at source under Section 3 tredecim <br>
								such as sugar cane, rubber, rice, interest, public entertainers, contest prizes
							</td>
							<td>{$withholdingTax_date_tax_5}</td>
							<td>{$withholdingTax_price_5}</td>
							<td>{$withholdingTax_tax_5}</td>
						</tr>
						<tr>
							<td>
								6. อื่นๆ(ระบุ) Other {$withholdingTax_other}
							</td>
							<td>{$withholdingTax_date_tax_6}</td>
							<td>{$withholdingTax_price_6}</td>
							<td>{$withholdingTax_tax_6}</td>
						</tr>
						<tr>
							<td style="border-left: 0; border-bottom: 0; border-right: 0;"></td>
							<td style="border-left: 0; border-bottom: 0;"></td>
							<td class="text-right">{$sum_price}</td>
							<td class="text-right">{$sum_tax}</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<tbody>
						<tr>
							<td width="300" rowspan="4">
								<p>'ลำดับที่ / No. {$withholdingTax_no} ในแบบ / of the form</p>
								<br><br>
								<p>
									ผู้จ่ายเงินได้ <br>
									Condltion for withholding tax at source
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk1}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.1 ก. <br>
									P.N.D. 1 Kor
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk2}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.1 ก พิเศษ <br>
									'P.N.D. 1 Kor(Special)
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk3}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.2  <br>
									P.N.D. 2 
								</p>
							</td>
						</tr>
						<tr>
							<td width="40">
								{$withholdingTax_chk4}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.2 ก. <br>
									P.N.D. 2 Kor
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk5}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.3 <br>
									P.N.D. 3
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk6}
							</td>
							<td width="100">
								<p>
									ภ.ง.ด.53   <br>
									P.N.D. 53 
								</p>
							</td>
						</tr>
						<tr>
							<td width="40">
								{$withholdingTax_chk7}
							</td>
							<td width="100">
								<p>
									ภออกภาษีให้ครั้งเดียว <br>
									paid for 1 time
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk8}
							</td>
							<td width="100">
								<p>
									ออกภาษีให้ตลอดไป <br>
									paid all tax
								</p>
							</td>
							<td width="40">
								{$withholdingTax_chk9}
							</td>
							<td width="100">
								<p>
									หักภาษี ณ ที่จ่าย   <br>
									withhold tax at source
								</p>
							</td>
						</tr>
						<tr>
							<td width="40">
								{$withholdingTax_chk10}
							</td>
							<td width="100">
								<p>อื่นๆ / Other {$withholdingTax_chk10_other}</p>
							</td>
							<td width="40"></td>
							<td width="100"></td>
							<td width="40"></td>
							<td width="100"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td style="border-right: 0;">
				<p>รวมเงินภาษีที่หักนำส่ง (ตัวอักษร) </p>
			</td>
			<td>
				<p>({$text_sum_tax})</p>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="padding-top: 20px;">
				<table>
					<tbody>
						<tr>
							<td colspan="2">
								<p>
									เงินสะสมจ่ายกองทุนประกันสังคม <br>
									Sacial Security Fund amount {$withholdingTax_price_security} Baht
								</p>
							</td>
						</tr>
						<tr>
							<td width="250">
								<p>เลขที่บัญชีนายจ้าง/Account No. of payer {$withholdingTax_no_account_boss}</p>
							</td>
							<td>
								<p>
									เลขที่บัตรประกันสังคมของผู้ถูกหักภาษี ณ ที่จ่าย/Social Security No. of the person who is withheld tax {$withholdingTax_no_insurance}
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-center">
				<p>ขอรับรองว่าข้อความและตัวเลขดังกล่าวข้างต้นถูกต้องตรงกับความจริงทุกประการ</p>
				<p>I hereby certify the contents and figures hereabove are correct in all respects</p>
				<br><br><br><br><br><br><br><br><br><br>
				<p>ลงชื่อ (Signed) {$withholdingTax_signed} ผู้มีหน้าที่หักภาษี ณ ที่จ่าย / Person who deducts tax at source</p>
				<p>{$withholdingTax_date}</p>
				<p> วัน เดือน ปี ที่ออกหนังสือรับรอง / Date, Month, year of issuing withholding tax certificate</p>
			</td>
		</tr>
	</tbody>
</table>
</page>