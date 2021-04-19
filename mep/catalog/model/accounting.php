<?php 
	class AccountingModel extends db {
		public function copy($data=array()){
			$result = array();
			$to = $data['to'];
			$date = date('Y-m-d H:i:s');
			$type_bill = $data['type_bill'];
			$sql_get_main = "SELECT * FROM com_".$type_bill." WHERE id_".$type_bill." = '".(int)$data['id_bill']."'";
			
			$result_get_main = $this->query($sql_get_main);
			if($result_get_main->num_rows > 0 ){
				$data_main_insert = array(
					'id_user_create' 					=> $data['id_user'],
					'id_company'						=> $result_get_main->row['id_company'],
					'id_customer'						=> $result_get_main->row['id_customer'],
					$to.'_project' 						=> $result_get_main->row[$type_bill.'_project'],
					$to.'_customer_name' 				=> $result_get_main->row[$type_bill.'_customer_name'],
					// $to.'_doc_no'						=> $result_get_main->row[$type_bill.'_doc_no'],
					$to.'_doc_no' => $data['doc_no'],
					$to.'_price'						=> $result_get_main->row[$type_bill.'_price'],
					$to.'_ref'							=> $result_get_main->row[$type_bill.'_ref'],
					$to.'_term'							=> $result_get_main->row[$type_bill.'_term'],
					$to.'_condition'					=> $result_get_main->row[$type_bill.'_condition'],
					$to.'_date'							=> $result_get_main->row[$type_bill.'_date'],
					$to.'_date_end'						=> $result_get_main->row[$type_bill.'_date_end'],
					$to.'_date_create'					=> $date,
					$to.'_file_name'					=> $result_get_main->row[$type_bill.'_file_name'],
					$to.'_file_size'					=> $result_get_main->row[$type_bill.'_file_size'],
					$to.'_type_vat'						=> $result_get_main->row[$type_bill.'_type_vat'],
					$to.'_remark'						=> $result_get_main->row[$type_bill.'_remark'],
					$to.'_sum_bill'						=> $result_get_main->row[$type_bill.'_sum_bill'],
					$to.'_percent_discount'				=> $result_get_main->row[$type_bill.'_percent_discount'],
					$to.'_text_discount'				=> $result_get_main->row[$type_bill.'_text_discount'],
					$to.'_text_discount_total'			=> $result_get_main->row[$type_bill.'_text_discount_total'],
					$to.'_check_vat'					=> $result_get_main->row[$type_bill.'_check_vat'],
					$to.'_text_vat'						=> $result_get_main->row[$type_bill.'_text_vat'],
					$to.'_text_not_include_vat'			=> $result_get_main->row[$type_bill.'_text_not_include_vat'], 
					$to.'_chk_tax'						=> $result_get_main->row[$type_bill.'_chk_tax'],
					$to.'_check_tax'					=> $result_get_main->row[$type_bill.'_check_tax'],
					$to.'_total_tax'					=> $result_get_main->row[$type_bill.'_total_tax'],
					$to.'_net_total_vat'				=> $result_get_main->row[$type_bill.'_net_total_vat']
				);
				// $file_name = $result_get_main->row[$type_bill.'_file_name'];
				// if(!empty($file_name)){
				// 	// $result = copy(DOCUMENT_ROOT.'mep/file/'.$type_bill.'/'.$file_name,DOCUMENT_ROOT.'mep/file/'.$to.'/'.$file_name);
				// }
				$new_bill_insert_id = $this->insert($to,$data_main_insert);
				if($new_bill_insert_id>0){
					$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_".$to."=setting_bill_count_".$to."+1 WHERE id_company='".(int)$data['id_company']."'");

					$sql_get_sub = "SELECT * FROM com_".$type_bill."_detail WHERE id_".$type_bill." = '".(int)$data['id_bill']."'";
					$result_get_sub = $this->query($sql_get_sub);
					foreach($result_get_sub->rows as $val){
						$arr_insert_detail = array(
							'id_'.$to 					=>	$new_bill_insert_id,
							'id_user_create'			=>	$data['id_user'],
							'id_product'				=>	$val['id_product'],
							$to.'_code_product'			=> 	$val[$type_bill.'_code_product'],
							$to.'_detail'				=>	$val[$type_bill.'_detail'],
							$to.'_seq'					=>	$val[$type_bill.'_seq'],
							$to.'_no'					=>	$val[$type_bill.'_no'],
							$to.'_unit'					=>	$val[$type_bill.'_unit'],
							$to.'_price'				=>	$val[$type_bill.'_price'],
							$to.'_total'				=>	$val[$type_bill.'_total'],
							$to.'_detail_date_create' 	=>  $date,
						);
						$result_insert_detail = $this->insert($to.'_detail',$arr_insert_detail);

						// cutstock
						$this->where('id_company', id_company());
						$company_info = $this->get('company');
						$condition1 = ($company_info->row['sellstock']==$to);
						$condition2 = ($company_info->row['buystock']==$to);
						if ($condition1==true) {
							$symbol = '-';
						} else if ($condition2==true) {
							$symbol = '+';
						}
						if ($condition1 || $condition2) {
							$this->where('id_product', $val['id_product']);
							$product_info = $this->get('product');
							if ($product_info->row['product_isstock']==1) {
								$sql = "update com_product set product_quantity = (product_quantity".$symbol.$val[$type_bill.'_no'].") WHERE id_product = ".$val['id_product'];
								$this->query($sql);
							}
						}
						// cutstock
					}
				}
				
			}
			return $new_bill_insert_id;
		}
		public function getBill($data=array()){
			$result = array(
				'result' => 'fail'
			);
			$type = $data['type_bill'];
			$doc_no = $this->escape($data['doc_no']);
			$sql = "SELECT * FROM com_".$type." WHERE id_company = '".(int)$data['id_company']."' AND ".$type."_doc_no = '".$doc_no."'";
			$result_query = $this->query($sql);
			if($result_query->num_rows>0){
				$result['file_name'] = $result_query->row[$type.'_file_name'];
			}
			return $result;
		}
		public function getBillCount($data = array()){
			$result = array(
				'count_quotation'=>0
			);
			$id_company = (int)$data['id_company'];
			$sql = "SELECT 
						setting_bill_count_quotation 		AS count_quotation,
						setting_bill_count_billingnote 		AS count_billingnote,
						setting_bill_count_receipt 			AS count_receipt,
						setting_bill_count_purchaseOrder 	AS count_purchaseOrder,
						setting_bill_count_productReceipt 	AS count_productReceipt,
						setting_bill_count_theCost 			AS count_theCost,
						setting_bill_count_withholdingTax 	AS count_withholdingTax 
					FROM com_setting_bill 
			WHERE id_company = '".id_company()."' limit 0,1";
			$result_query = $this->query($sql); 
			if($result_query->num_rows>0){
				$val = $result_query->row;
				$result = array(
					'count_quotation'		=> $val['count_quotation'],
					'count_billingnote'		=> $val['count_billingnote'],
					'count_receipt'			=> $val['count_receipt'],
					'count_purchaseOrder'	=> $val['count_purchaseOrder'],
					'count_productReceipt'	=> $val['count_productReceipt'],
					'count_theCost'			=> $val['count_theCost'],
					'count_withholdingTax'	=> $val['count_withholdingTax']
				);
			}
			return $result;
		}
		public function getListBill($data=array()){
			$result = array(
				'num_rows' 	=> 0,
				'list'		=>	array()
			);
			$type = $data['type'];
			$id_company = (int)$data['id_company'];
			$limit = (isset($data['limit'])?$data['limit']:'');
			$search = (isset($data['search'])?$data['search']:'');
			$where = '';
			if(!empty($search)){
				$where .= " AND (".$type."_doc_no LIKE '%".$this->escape($search)."%')";
				// $this->group_start();
				// $this->where_like('b.'.$type.'_doc_no', '%'.$search.'%');
				// $this->group_end();
			}
			// $this->select('*,c.customer_company as customer_company, f.name as file_name');
			// $this->join('customer c', 'b.id_customer=c.id_customer','LEFT');
			// $this->join('file f', 'f.id_file=b.id_file','LEFT');
			// $this->join('company com', 'b.id_company=com.id_company','LEFT');
			// $this->where('b.id_company',$data['id_company']);
			// $this->order_by('id_'.$type,'DESC');
			// $this->get($type.' b');
			$select = '*,com_customer.customer_company as customer_company, com_file.name AS file_name';
			$sql_get_bill = "SELECT ".$select."  FROM com_".$type." 
			LEFT JOIN com_customer ON com_".$type.".id_customer = com_customer.id_customer 
			LEFT JOIN com_file ON com_file.id_file = com_".$type.".id_file 
			LEFT JOIN com_company ON com_".$type.".id_company = com_company.id_company
			WHERE com_".$type.".id_company = '".$data['id_company']."' ".$where."
			ORDER BY id_".$type.' DESC '.$limit; 
			// echo $sql_get_bill;
			$query_get_bill = $this->query($sql_get_bill);
			if($query_get_bill->num_rows>0){
				$sql_get_bill_num_row = "SELECT *,com_file.name AS file_name FROM com_".$type." 
				LEFT JOIN com_customer ON com_".$type.".id_company = com_customer.id_customer 
				LEFT JOIN com_file ON com_file.id_file = com_".$type.".id_file 
				WHERE com_".$type.".id_company = '".$data['id_company']."' ".$where."
				ORDER BY ".$type.'_date '; 
				$result_count_view = $this->query($sql_get_bill_num_row);

				$result['num_rows'] = $result_count_view->num_rows;
				foreach($query_get_bill->rows as $val){
					if ($type=='withholdingTax') {
						$sum_wht = 0;
						for ($i=1;$i<=6;$i++) {
							$sum_wht += (float)$val['withholdingTax_tax_'.$i];
						}
					}

					$file_name = (isset($val['file_name'])?$val['file_name']:'');
					$result['list'][] = array(
						'doc_no'           => $val[$type.'_doc_no'],
						'date'             => date_f($val[$type.'_date'], 'd-m-Y'),
						'customer'         => $val['customer_name'],
						'customer_company' => $type=='theCost' ? $val[$type.'_name_pay'] : $val['customer_company'],
						'price'            => $type=='withholdingTax' ? $sum_wht : $val[$type.'_net_total_vat'],
						'file_name'        => $file_name,
						'id'               => encrypt($val['id_'.$type])
					);
				} 
			}
			return $result;
		}
		public function addBill($data = array()){
			$result = array(
				'result' => 'fail',
				'id'=> '' 
			);
			$type = $data['type'];
			if(!empty($data['id_user']) and !empty($data['id_company']) ){
				$id_customer = 0;
				$customer_name = '';
				$id_product = 0;
				$product_name = '';
				$date = date('Y-m-d H:i:s');
				if(!empty($data['customer'])){
					$sql_customer = "SELECT * FROM com_customer 
					WHERE id_customer = '".(int)$data['customer']."' 
					AND id_company='".(int)$data['id_company']."'";
					$result_customer = $this->query($sql_customer);
					$id_customer 	= $result_customer->row['id_customer'];
					$customer_name 	= $result_customer->row['customer_name'];
				}else {
					$customer_name = $data['customer'];
					$data_customer = array(
						'id_company' 			=> $data['id_company'], 
						// 'customer_company' 		=> $data['customer_company'], 
						'customer_name' 		=> $data['customer_name'], 
						'customer_address' 		=> $data['customer_address'], 
						'customer_tax' 			=> $data['customer_tax'], 
						'customer_branch' 		=> $data['customer_branch'], 
						'customer_phone' 		=> $data['customer_phone'], 
						'customer_email' 		=> $data['customer_email']
					);
					$id_customer = $this->insert('customer',$data_customer);
				}
				$data_insert_file = array(
					'id_company' 	=> (int)$data['id_company'],
					'id_user'		=> $data['id_user'],
					'name'			=> $data['file_name'],
					'type'			=> 'pdf',
					'size'			=> $data['size'],
					'date_added'	=> $date
				);
				$insert_file = $this->insert('file',$data_insert_file);

				$data_insert_bill = array(
					'id_user_create' 				=> is($data,'id_user'),
					'id_company'					=> is($data,'id_company'),
					'id_customer'					=> $id_customer,
					'id_file'						=> $insert_file,
					$type.'_project' 				=> is($data,'customer_project'),
					$type.'_customer_name' 			=> $customer_name,
					$type.'_doc_no'					=> is($data,'doc_no'),
					$type.'_price'					=> is($data,'price'),
					$type.'_ref'					=> is($data,'ref'),
					$type.'_term'					=> is($data,'term'),
					$type.'_condition'				=> is($data,'condition'),
					$type.'_date'					=> is($data,'date_start'),
					$type.'_date_end'				=> is($data,'date_end'),
					$type.'_date_create'			=> $date,
					// $type.'_file_name'				=> is($data,'file_name'),
					// $type.'_file_size'				=> is($data,'size'),
					$type.'_type_vat'				=> is($data,'rdoVat'),
					$type.'_remark'					=> is($data,'remark'),
					$type.'_sum_bill'				=> is($data,'sum_bill'),
					$type.'_percent_discount'		=> is($data,'percent_discount'),
					$type.'_text_discount'			=> is($data,'text_discount'),
					$type.'_text_discount_total'	=> is($data,'text_discount_total'),
					$type.'_check_vat'				=> is($data,'check_vat'),
					$type.'_text_vat'				=> is($data,'text_vat'),
					$type.'_text_not_include_vat'	=> is($data,'text_not_include_vat'), 
					$type.'_chk_tax'				=> is($data,'chk_tax'),
					$type.'_check_tax'				=> is($data,'check_tax'),
					$type.'_total_tax'				=> is($data,'total_tax'),
					$type.'_net_total_vat'			=> is($data,'net_total_vat')
				);
				$result_insert = $this->insert($type,$data_insert_bill); 
				if($result_insert>0){
					$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_".$type."=setting_bill_count_".$type."+1 WHERE id_company='".(int)$data['id_company']."'");
				}
				foreach($data['detail'] as $val){
					// $sql_product = "SELECT * FROM com_product 
					// 	WHERE id_product = '".$this->escape($val['product_code'])."' 
					// 	AND id_company='".(int)$data['id_company']."'";
					// 	$result_product = $this->query($sql_product);
					$this->where('product_code', $val['product_code']);
					$this->where('id_company', id_company());
					$result_product = $this->get('product');

					if($result_product->num_rows > 0){
						$id_product 	= $result_product->row['id_product'];
						$product_name 	= $result_product->row['product_name'];
					}else{
						$product_name = $val['product'];
					}
					$arr_insert_detail = array(
						'id_'.$type 				=>	$result_insert,
						'id_user_create'			=>	$data['id_user'],
						'id_product'				=>	$id_product,
						$type.'_code_product'		=> 	$val['product_code'],
						$type.'_detail'				=>	$product_name,
						$type.'_seq'				=>	$val['seq'],
						$type.'_no'					=>	$val['no'],
						$type.'_unit'				=>	$val['unit'],
						$type.'_price'				=>	$val['price'],
						$type.'_total'				=>	$val['total'],
						$type.'_detail_date_create' =>  $date,
					);
					$result_insert_detail = $this->insert($type.'_detail',$arr_insert_detail);

					// cutstock
					$this->where('id_company', id_company());
					$company_info = $this->get('company');
					$condition1 = ($company_info->row['sellstock']==$type);
					$condition2 = ($company_info->row['buystock']==$type);
					if ($condition1==true) {
						$symbol = '-';
					} else if ($condition2==true) {
						$symbol = '+';
					}
					if ($condition1 || $condition2) {
						$this->where('id_product', $result_product->row['id_product']);
						$product_info = $this->get('product');
						if ($product_info->row['product_isstock']==1) {
							$sql = "update com_product set product_quantity = (product_quantity".$symbol.$val['no'].") WHERE id_product = ".$result_product->row['id_product'];
							$this->query($sql);
						}
					}
					// cutstock
				}

				$result = array(
					'result' => 'success',
					'id'     => $result_insert,
					'file'   => $data['file_name']
				);
			}
			return $result;
		}
		public function editBill($data = array()){

			$id_bill = $data['id_bill'];
			// echo $id_bill;
			$result = array(
				'result' => 'fail',
				'id_quotation'=> $data['id_bill']
			);
			$type = $data['type'];
			if(!empty($data['id_user']) and !empty($data['id_company']) ){
				$id_customer = 0;
				$customer_name = '';
				$id_product = 0;
				$product_name = '';
				$date = date('Y-m-d H:i:s');
				if(!empty($data['customer'])){
					$sql_customer = "SELECT * FROM com_customer 
					WHERE id_customer = '".(int)$data['customer']."' 
					AND id_company='".(int)$data['id_company']."'";
					$result_customer = $this->query($sql_customer);
					$id_customer 	= $result_customer->row['id_customer'];
					$customer_name 	= $result_customer->row['customer_name'];
				}else {
					$customer_name = $data['customer'];
					$data_customer = array(
						'id_company' 			=> $data['id_company'], 
						// 'customer_company' 		=> $data['customer_company'], 
						'customer_name' 		=> is($data,'customer_name'), 
						'customer_address' 		=> is($data,'customer_address'), 
						'customer_tax' 			=> is($data,'customer_tax_no'), 
						'customer_branch' 		=> is($data,'customer_branch_no'), 
						'customer_phone' 		=> is($data,'customer_phone'), 
						'customer_email' 		=> is($data,'customer_email')
					);
					$id_customer = $this->insert('customer',$data_customer);
				}
				

				$result_bill = $this->query("SELECT com_file.name AS file_name  FROM com_".$type." 
					LEFT JOIN com_file ON com_file.id_file = com_".$type.".id_file 
					WHERE id_".$type." = '".$id_bill."'");
				$old_file_name = $result_bill->row['file_name'];
				$delete_old_file = DOCUMENT_ROOT.'uploads/'.$type.'/'.$old_file_name;
				@unlink($delete_old_file);
				$id_file = (int)(isset($result_bill->row['id_file'])?$result_bill->row['id_file']:'');
				$delete_old_file = $this->delete('file',"id_file='".$id_file."'");
				$data_insert_file = array(
					'id_company' 	=> (int)$data['id_company'],
					'id_user'		=> $data['id_user'],
					'name'			=> $data['file_name'],
					'type'			=> 'pdf',
					'size'			=> $data['size'],
					'date_added'	=> $date
				);

				$insert_file = $this->insert('file',$data_insert_file);
				$data_update_bill = array(
					'id_user_create' 				=> is($data,'id_user'),
					'id_company'					=> is($data,'id_company'),
					'id_customer'					=> $id_customer,
					'id_file'						=> $insert_file,
					$type.'_project' 				=> is($data,'customer_project'),
					$type.'_customer_name' 			=> $customer_name,
					$type.'_doc_no'					=> is($data,'doc_no'),
					$type.'_price'					=> is($data,'price'),
					$type.'_ref'					=> is($data,'ref'),
					$type.'_term'					=> is($data,'term'),
					$type.'_condition'				=> is($data,'condition'),
					$type.'_date'					=> is($data,'date_start'),
					$type.'_date_end'				=> is($data,'date_end'),
					$type.'_date_create'			=> $date,
					// $type.'_file_name'				=> is($data,'file_name'),
					// $type.'_file_size'				=> is($data,'size'),
					$type.'_type_vat'				=> is($data,'rdoVat'),
					$type.'_remark'					=> is($data,'remark'),
					$type.'_sum_bill'				=> is($data,'sum_bill'),
					$type.'_percent_discount'		=> is($data,'percent_discount'),
					$type.'_text_discount'			=> is($data,'text_discount'),
					$type.'_text_discount_total'	=> is($data,'text_discount_total'),
					$type.'_check_vat'				=> is($data,'check_vat'),
					$type.'_text_vat'				=> is($data,'text_vat'),
					$type.'_text_not_include_vat'	=> is($data,'text_not_include_vat'),
					$type.'_chk_tax'				=> is($data,'chk_tax'),
					$type.'_check_tax'				=> is($data,'check_tax'),
					$type.'_total_tax'				=> is($data,'total_tax'),
					$type.'_net_total_vat'			=> is($data,'net_total_vat')
				);
				$result_insert = $this->update($type,$data_update_bill,'id_'.$type." = '".$id_bill."'");


				// restock
				$this->where('id_company', id_company());
				$company_info = $this->get('company');
				$condition1 = ($company_info->row['sellstock']==$type);
				$condition2 = ($company_info->row['buystock']==$type);
				if ($condition1==true) {
					$symbol = '+';
				} else if ($condition2==true) {
					$symbol = '-';
				}
				if ($condition1 || $condition2) {
					$this->where('id_'.$type, $id_bill);
					$bill_detail = $this->get($type.'_detail');
					$bill_detail = $bill_detail->rows;
					foreach ($bill_detail as $bd) {
						// check isstock
						$this->where('id_product', $bd['id_product']);
						$product_info = $this->get('product');
						if ($product_info->row['product_isstock']==1) {
							$sql = "update com_product set product_quantity = (product_quantity".$symbol.$bd[$type.'_no'].") WHERE id_product = ".$bd['id_product'];
							$this->query($sql);	
						}
					}
				}
				// restock
				$result_delete = $this->delete($type.'_detail','id_'.$type." = '".$id_bill."'");
				foreach($data['detail'] as $val){
					// $sql_product = "SELECT * FROM com_product 
					// 	WHERE id_product = '".$this->escape($val['product_code'])."' 
					// 	AND id_company='".(int)$data['id_company']."'";
					// 	$result_product = $this->query($sql_product);
					$this->where('product_code', $val['product_code']);
					$this->where('id_company', id_company());
					$result_product = $this->get('product');

					if($result_product->num_rows > 0){
						$id_product 	= $result_product->row['id_product'];
						$product_name 	= $result_product->row['product_name'];
					}else{
						$product_name = $val['product'];
					}
					$arr_insert_detail = array(
						'id_'.$type 				=>	$id_bill,
						'id_user_create'			=>	is($data,'id_user'),
						'id_product'				=>	$id_product,
						$type.'_code_product'		=> 	$val['product_code'],
						$type.'_detail'				=>	$product_name,
						$type.'_seq'				=>	$val['seq'],
						$type.'_no'					=>	$val['no'],
						$type.'_unit'				=>	$val['unit'],
						$type.'_price'				=>	$val['price'],
						$type.'_total'				=>	$val['total'],
						$type.'_detail_date_create' => $date,
					);
					$result_insert_detail = $this->insert($type.'_detail',$arr_insert_detail,'id_'.$type." = '".$id_bill."'");

					// cutstock
					// check isstock
					if ($condition1==true) {
						$symbol = '-';
					} else if ($condition2==true) {
						$symbol = '+';
					}
					if ($condition1 || $condition2) {
						$this->where('id_product', $result_product->row['id_product']);
						$product_info = $this->get('product');
						if ($product_info->row['product_isstock']==1) {
							$sql = "update com_product set product_quantity = (product_quantity".$symbol.$val['no'].") WHERE id_product = ".$result_product->row['id_product'];
							$this->query($sql);
						}
					}
					// cutstock
				}
				$result = array(
					'result' 		=> 'success',
					'id_quotation' 	=> $id_bill,
					'file'			=> $data['file_name']
				);
			}
			return $result;
		}
		public function addBillTheCost($data=array()){
			$result = array();
			$type = $this->escape($data['type']);
			$date = date('Y-m-d H:i:s');
			$data_insert_file = array(
				'id_company' 	=> (int)$data['id_company'],
				'id_user'		=> $data['id_user'],
				'name'			=> $data['file_name'],
				'type'			=> 'pdf',
				'size'			=> $data['size'],
				'date_added'	=> $date
			);
			$insert_file = $this->insert('file',$data_insert_file);
			$data_insert_bill = array(
				'id_user_create' 				=> is($data,'id_user'),
				'id_company'					=> is($data,'id_company'),
				'id_file' 						=> $insert_file,
				'theCost_date_create'			=> $date,
				'theCost_doc_no'				=> is($data,'theCost_doc_no'),
				'theCost_price'					=> is($data,'theCost_price'),
				'theCost_date'					=> is($data,'theCost_date'),
				'theCost_name'					=> is($data,'theCost_name'),
				'theCost_position'				=> is($data,'theCost_position'),
				'theCost_text'					=> is($data,'theCost_text'),
				'theCost_date_start'			=> is($data,'theCost_date_start'),
				'theCost_date_end'				=> is($data,'theCost_date_end'),
				'theCost_name_pay'				=> is($data,'theCost_name_pay'),
				'theCost_name_approved'			=> is($data,'theCost_name_approved'),
				'theCost_accounting'			=> is($data,'theCost_accounting'),
			);
			$result_insert = $this->insert($type,$data_insert_bill);
			if($result_insert){
				$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_".$type."=setting_bill_count_".$type."+1 WHERE id_company='".(int)$data['id_company']."'");
			}
			foreach($data['detail'] as $val){ 
				$arr_insert_detail = array(
					'id_'.$type 				=>	$result_insert,
					'id_user_create'			=>	$data['id_user'],
					'theCost_date'				=>	$val['theCost_date'],
					'theCost_detail'			=>	$val['theCost_detail'],
					'theCost_price'				=>	$val['theCost_price'],
					'theCost_remark'			=>	$val['theCost_remark'],
					$type.'_detail_date_create' =>	$date,
				);
				$result_insert_detail = $this->insert($type.'_detail',$arr_insert_detail);
			}
			$result = array(
				'result' 		=> 'success',
				'id' 			=> $result_insert,
				'file'			=> $data['file_name']
			);
			return $result;
		}
		public function editBillTheCost($data = array()){
			$result = array();
			$id_bill = $data['id_bill'];
			$type = $this->escape($data['type']);
			$date = date('Y-m-d H:i:s');

			

			$result_bill = $this->query("SELECT com_file.name AS file_name  FROM com_".$type." 
				LEFT JOIN com_file ON com_file.id_file = com_".$type.".id_file 
				WHERE id_".$type." = '".$id_bill."'");
			$old_file_name = $result_bill->row['file_name'];
			$delete_old_file = DOCUMENT_ROOT.'uploads/'.$type.'/'.$old_file_name;
			@unlink($delete_old_file);
			$id_file = (int)(isset($result_bill->row['id_file'])?$result_bill->row['id_file']:'');
			$delete_old_file = $this->delete('file',"id_file='".$id_file."'");
			$data_insert_file = array(
				'id_company' 	=> (int)$data['id_company'],
				'id_user'		=> $data['id_user'],
				'name'			=> $data['file_name'],
				'type'			=> 'pdf',
				'size'			=> $data['size'],
				'date_added'	=> $date
			);

			$insert_file = $this->insert('file',$data_insert_file);
			$data_insert_bill = array(
				'id_user_create' 				=> is($data,'id_user'),
				'id_company'					=> is($data,'id_company'),
				'id_file'						=> $insert_file,
				'theCost_date_create'			=> $date,
				'theCost_doc_no'				=> is($data,'theCost_doc_no'),

				'theCost_price'					=> is($data,'theCost_price'),
				'theCost_date'					=> is($data,'theCost_date'),

				'theCost_name'					=> is($data,'theCost_name'),
				'theCost_position'				=> is($data,'theCost_position'),
				'theCost_text'					=> is($data,'theCost_text'),
				'theCost_date_start'			=> is($data,'theCost_date_start'),
				'theCost_date_end'				=> is($data,'theCost_date_end'),
				'theCost_name_pay'				=> is($data,'theCost_name_pay'),
				'theCost_name_approved'			=> is($data,'theCost_name_approved'),
				'theCost_accounting'			=> is($data,'theCost_accounting'),
			);
			$result_insert = $this->update($type,$data_insert_bill,'id_'.$type." = '".$id_bill."'");
			$result_delete = $this->delete($type.'_detail','id_'.$type." = '".$id_bill."'");
			foreach($data['detail'] as $val){ 
				$arr_insert_detail = array(
					'id_'.$type 				=>	$id_bill,
					'id_user_create'			=>	is($data,'id_user'),
					'theCost_date'				=>	$val['theCost_date'],
					'theCost_detail'			=>	$val['theCost_detail'],
					'theCost_price'				=>	$val['theCost_price'],
					'theCost_remark'			=>	$val['theCost_remark'],
					$type.'_detail_date_create' =>	$date,
				);
				$result_insert_detail = $this->insert($type.'_detail',$arr_insert_detail,'id_'.$type." = '".$id_bill."'");
			}
			$result = array(
				'result' 		=> 'success',
				'id' 			=> $result_insert,
				'file'			=> is($data,'file_name')
			);
			return $result;
		}
		public function addBillWithholdingTaxDataPost($data = array()){
			$result = array();
			$type = $this->escape($data['type']);
			$date = date('Y-m-d H:i:s');
			$data_insert_file = array(
				'id_company' 	=> (int)$data['id_company'],
				'id_user'		=> $data['id_user'],
				'name'			=> $data['file_name'],
				'type'			=> 'pdf',
				'size'			=> $data['size'],
				'date_added'	=> $date
			);
			$insert_file = $this->insert('file',$data_insert_file);

			$data_insert_bill = array(
				'id_user_create'                 => $data['id_user'],
				'id_company'                     => $data['id_company'],
				'id_file'                        => $insert_file,
				'id_customer'                    => $data['id_customer'],
				'withholdingTax_doc_no'          => $data['withholdingTax_doc_no'],
				'withholdingTax_date'            => $data['withholdingTax_date'],
				'withholdingTax_id_no_1'         => $data['withholdingTax_id_no_1'],
				'withholdingTax_id_name_1'       => $data['withholdingTax_id_name_1'],
				'withholdingTax_id_address_1'    => $data['withholdingTax_id_address_1'],
				'withholdingTax_id_no_2'         => $data['withholdingTax_id_no_2'],
				'withholdingTax_id_name_2'       => $data['withholdingTax_id_name_2'],
				'withholdingTax_id_address_2'    => $data['withholdingTax_id_address_2'],
				'withholdingTax_date_tax_1'      => $data['withholdingTax_date_tax_1'],
				'withholdingTax_price_1'         => $data['withholdingTax_price_1'],
				'withholdingTax_tax_1'           => $data['withholdingTax_tax_1'],
				'withholdingTax_date_tax_2'      => $data['withholdingTax_date_tax_2'],
				'withholdingTax_price_2'         => $data['withholdingTax_price_2'],
				'withholdingTax_tax_2'           => $data['withholdingTax_tax_2'],
				'withholdingTax_date_tax_3'      => $data['withholdingTax_date_tax_3'],
				'withholdingTax_price_3'         => $data['withholdingTax_price_3'],
				'withholdingTax_tax_3'           => $data['withholdingTax_tax_3'],
				'withholdingTax_date_tax_4'      => $data['withholdingTax_date_tax_4'],
				'withholdingTax_price_4'         => $data['withholdingTax_price_4'],
				'withholdingTax_tax_4'           => $data['withholdingTax_tax_4'],
				'withholdingTax_date_tax_5'      => $data['withholdingTax_date_tax_5'],
				'withholdingTax_price_5'         => $data['withholdingTax_price_5'],
				'withholdingTax_tax_5'           => $data['withholdingTax_tax_5'],
				'withholdingTax_other'           => $data['withholdingTax_other'],
				'withholdingTax_date_tax_6'      => $data['withholdingTax_date_tax_6'],
				'withholdingTax_price_6'         => $data['withholdingTax_price_6'],
				'withholdingTax_tax_6'           => $data['withholdingTax_tax_6'],
				'withholdingTax_no'              => $data['withholdingTax_no'],
				'withholdingTax_chk1'            => $data['withholdingTax_chk1'],
				'withholdingTax_chk2'            => $data['withholdingTax_chk2'],
				'withholdingTax_chk3'            => $data['withholdingTax_chk3'],
				'withholdingTax_chk4'            => $data['withholdingTax_chk4'],
				'withholdingTax_chk5'            => $data['withholdingTax_chk5'],
				'withholdingTax_chk6'            => $data['withholdingTax_chk6'],
				'withholdingTax_chk7'            => $data['withholdingTax_chk7'],
				'withholdingTax_chk8'            => $data['withholdingTax_chk8'],
				'withholdingTax_chk9'            => $data['withholdingTax_chk9'],
				'withholdingTax_chk10'           => $data['withholdingTax_chk10'],
				'withholdingTax_chk10_other'     => $data['withholdingTax_chk10_other'],
				'withholdingTax_price_security'  => $data['withholdingTax_price_security'],
				'withholdingTax_no_account_boss' => $data['withholdingTax_no_account_boss'],
				'withholdingTax_no_insurance'    => $data['withholdingTax_no_insurance'],
				'withholdingTax_signed'          => $data['withholdingTax_signed'],
			);
			$result_insert = $this->insert($type,$data_insert_bill);
			if($result_insert){
				$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_".$type."=setting_bill_count_".$type."+1 WHERE id_company='".(int)$data['id_company']."'");
			}
			// foreach($data['detail'] as $val){ 
			// 	$arr_insert_detail = array(
			// 		'id_'.$type 				=>	$result_insert,
			// 		'id_user_create'			=>	$data['id_user'],
			// 		'theCost_date'				=>	$val['theCost_date'],
			// 		'theCost_detail'			=>	$val['theCost_detail'],
			// 		'theCost_price'				=>	$val['theCost_price'],
			// 		'theCost_remark'			=>	$val['theCost_remark'],
			// 		$type.'_detail_date_create' =>	$date,
			// 	);
			// 	$result_insert_detail = $this->insert($type.'_detail',$arr_insert_detail);
			// }
			$result = array(
				'result' 		=> 'success',
				'id' 			=> $result_insert,
				'file'			=> $data['file_name']
			);
			return $result;
		}
		public function editBillWithholdingTaxDataPost($data = array()){
			$result = array();
			$id_bill = $data['id_bill'];
			$type = $this->escape($data['type']);
			$date = date('Y-m-d H:i:s');
			

			$result_bill = $this->query("SELECT com_file.id_file,com_file.name AS file_name  FROM com_".$type." 
				LEFT JOIN com_file ON com_file.id_file = com_".$type.".id_file 
				WHERE id_".$type." = '".$id_bill."'");
			if (!empty($result_bill->row['file_name'])) {
				$old_file_name = $result_bill->row['file_name'];
				$delete_old_file = DOCUMENT_ROOT.'uploads/'.$type.'/'.$old_file_name;
				@unlink($delete_old_file);	
			}
			
			$id_file = (int)(isset($result_bill->row['id_file'])?$result_bill->row['id_file']:'');
			$delete_old_file = $this->delete('file',"id_file='".$id_file."'");
			$data_insert_file = array(
				'id_company' 	=> (int)$data['id_company'],
				'id_user'		=> $data['id_user'],
				'name'			=> $data['file_name'],
				'type'			=> 'pdf',
				'size'			=> $data['size'],
				'date_added'	=> $date
			);

			$insert_file = $this->insert('file',$data_insert_file);

			$data_insert_bill = array(
				'id_user_create'                 => $data['id_user'],
				'id_company'                     => $data['id_company'],
				'withholdingTax_date'            => $date,
				'withholdingTax_doc_no'          => $data['withholdingTax_doc_no'],
				'withholdingTax_id_no_1'         => $data['withholdingTax_id_no_1'],
				'withholdingTax_id_name_1'       => $data['withholdingTax_id_name_1'],
				'withholdingTax_id_address_1'    => $data['withholdingTax_id_address_1'],
				'withholdingTax_id_no_2'         => $data['withholdingTax_id_no_2'],
				'withholdingTax_id_name_2'       => $data['withholdingTax_id_name_2'],
				'withholdingTax_id_address_2'    => $data['withholdingTax_id_address_2'],
				'withholdingTax_date_tax_1'      => $data['withholdingTax_date_tax_1'],
				'withholdingTax_price_1'         => $data['withholdingTax_price_1'],
				'withholdingTax_tax_1'           => $data['withholdingTax_tax_1'],
				'withholdingTax_date_tax_2'      => $data['withholdingTax_date_tax_2'],
				'withholdingTax_price_2'         => $data['withholdingTax_price_2'],
				'withholdingTax_tax_2'           => $data['withholdingTax_tax_2'],
				'withholdingTax_date_tax_3'      => $data['withholdingTax_date_tax_3'],
				'withholdingTax_price_3'         => $data['withholdingTax_price_3'],
				'withholdingTax_tax_3'           => $data['withholdingTax_tax_3'],
				'withholdingTax_date_tax_4'      => $data['withholdingTax_date_tax_4'],
				'withholdingTax_price_4'         => $data['withholdingTax_price_4'],
				'withholdingTax_tax_4'           => $data['withholdingTax_tax_4'],
				'withholdingTax_date_tax_5'      => $data['withholdingTax_date_tax_5'],
				'withholdingTax_price_5'         => $data['withholdingTax_price_5'],
				'withholdingTax_tax_5'           => $data['withholdingTax_tax_5'],
				'withholdingTax_other'           => $data['withholdingTax_other'],
				'withholdingTax_date_tax_6'      => $data['withholdingTax_date_tax_6'],
				'withholdingTax_price_6'         => $data['withholdingTax_price_6'],
				'withholdingTax_tax_6'           => $data['withholdingTax_tax_6'],
				'withholdingTax_no'              => $data['withholdingTax_no'],
				'withholdingTax_chk1'            => $data['withholdingTax_chk1'],
				'withholdingTax_chk2'            => $data['withholdingTax_chk2'],
				'withholdingTax_chk3'            => $data['withholdingTax_chk3'],
				'withholdingTax_chk4'            => $data['withholdingTax_chk4'],
				'withholdingTax_chk5'            => $data['withholdingTax_chk5'],
				'withholdingTax_chk6'            => $data['withholdingTax_chk6'],
				'withholdingTax_chk7'            => $data['withholdingTax_chk7'],
				'withholdingTax_chk8'            => $data['withholdingTax_chk8'],
				'withholdingTax_chk9'            => $data['withholdingTax_chk9'],
				'withholdingTax_chk10'           => $data['withholdingTax_chk10'],
				'withholdingTax_chk10_other'     => $data['withholdingTax_chk10_other'],
				'withholdingTax_price_security'  => $data['withholdingTax_price_security'],
				'withholdingTax_no_account_boss' => $data['withholdingTax_no_account_boss'],
				'withholdingTax_no_insurance'    => $data['withholdingTax_no_insurance'],
				'withholdingTax_signed'          => $data['withholdingTax_signed'],
			);
			$result_insert = $this->update($type,$data_insert_bill,'id_'.$type." = '".$id_bill."'");
			if($result_insert){
				$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_".$type."=setting_bill_count_".$type."+1 WHERE id_company='".(int)$data['id_company']."'");
			}
			$result = array(
				'result' 		=> 'success',
				'id' 			=> $result_insert,
				'file'			=> $data['file_name']
			);
			return $result;
		}
		public function billDetailWithholdingTax($data = array()){ 
			$bill_detail = array();
			$id = (int)$data['id'];
			$result = array(
				'result' => 'fail', 
				'id'=> $id,
			);
			$type = $data['type'];
			if(!empty($data['id_user']) and !empty($data['id_company']) and !empty($id)){
				$result_bill = $this->query("SELECT * FROM com_".$type." WHERE id_".$type." = '".(int)$id."'");
				if($result_bill->num_rows > 0){
					$result_bill = $result_bill->row;
					$result = array(
						'result'                         => 'success',
						'id'                             => $id,
						'id_customer'                    => $result_bill['id_customer'],
						// 'theCost_date_create'         => $result_bill['theCost_date_create'],
						'withholdingTax_date'            => $result_bill['withholdingTax_date'],
						'withholdingTax_doc_no'          => $result_bill['withholdingTax_doc_no'],
						'withholdingTax_id_no_1'         => $result_bill['withholdingTax_id_no_1'],
						'withholdingTax_id_name_1'       => $result_bill['withholdingTax_id_name_1'],
						'withholdingTax_id_address_1'    => $result_bill['withholdingTax_id_address_1'],
						'withholdingTax_id_no_2'         => $result_bill['withholdingTax_id_no_2'],
						'withholdingTax_id_name_2'       => $result_bill['withholdingTax_id_name_2'],
						'withholdingTax_id_address_2'    => $result_bill['withholdingTax_id_address_2'],
						'withholdingTax_date_tax_1'      => $result_bill['withholdingTax_date_tax_1'],
						'withholdingTax_price_1'         => $result_bill['withholdingTax_price_1'],
						'withholdingTax_tax_1'           => $result_bill['withholdingTax_tax_1'],
						'withholdingTax_date_tax_2'      => $result_bill['withholdingTax_date_tax_2'],
						'withholdingTax_price_2'         => $result_bill['withholdingTax_price_2'],
						'withholdingTax_tax_2'           => $result_bill['withholdingTax_tax_2'],
						'withholdingTax_date_tax_3'      => $result_bill['withholdingTax_date_tax_3'],
						'withholdingTax_price_3'         => $result_bill['withholdingTax_price_3'],
						'withholdingTax_tax_3'           => $result_bill['withholdingTax_tax_3'],
						'withholdingTax_date_tax_4'      => $result_bill['withholdingTax_date_tax_4'],
						'withholdingTax_price_4'         => $result_bill['withholdingTax_price_4'],
						'withholdingTax_tax_4'           => $result_bill['withholdingTax_tax_4'],
						'withholdingTax_date_tax_5'      => $result_bill['withholdingTax_date_tax_5'],
						'withholdingTax_price_5'         => $result_bill['withholdingTax_price_5'],
						'withholdingTax_tax_5'           => $result_bill['withholdingTax_tax_5'],
						'withholdingTax_other'           => $result_bill['withholdingTax_other'],
						'withholdingTax_date_tax_6'      => $result_bill['withholdingTax_date_tax_6'],
						'withholdingTax_price_6'         => $result_bill['withholdingTax_price_6'],
						'withholdingTax_tax_6'           => $result_bill['withholdingTax_tax_6'],
						'withholdingTax_no'              => $result_bill['withholdingTax_no'],
						'withholdingTax_chk1'            => $result_bill['withholdingTax_chk1'],
						'withholdingTax_chk2'            => $result_bill['withholdingTax_chk2'],
						'withholdingTax_chk3'            => $result_bill['withholdingTax_chk3'],
						'withholdingTax_chk4'            => $result_bill['withholdingTax_chk4'],
						'withholdingTax_chk5'            => $result_bill['withholdingTax_chk5'],
						'withholdingTax_chk6'            => $result_bill['withholdingTax_chk6'],
						'withholdingTax_chk7'            => $result_bill['withholdingTax_chk7'],
						'withholdingTax_chk8'            => $result_bill['withholdingTax_chk8'],
						'withholdingTax_chk9'            => $result_bill['withholdingTax_chk9'],
						'withholdingTax_chk10'           => $result_bill['withholdingTax_chk10'],
						'withholdingTax_chk10_other'     => $result_bill['withholdingTax_chk10_other'],
						'withholdingTax_price_security'  => $result_bill['withholdingTax_price_security'],
						'withholdingTax_no_account_boss' => $result_bill['withholdingTax_no_account_boss'],
						'withholdingTax_no_insurance'    => $result_bill['withholdingTax_no_insurance'],
						'withholdingTax_signed'          => $result_bill['withholdingTax_signed'],
					);
				}
				
			}
			return $result;
		}
		public function billDetailCost($data = array()){ 
			$bill_detail = array();
			$id = (int)$data['id'];
			$result = array(
				'result' => 'fail', 
				'id'=> $id,
			);
			$type = $data['type'];
			if(!empty($data['id_user']) and !empty($data['id_company']) and !empty($id)){
				$result_bill = $this->query("SELECT * FROM com_".$type." WHERE id_".$type." = '".(int)$id."'");
				if($result_bill->num_rows > 0){
					$result_bill = $result_bill->row;
					// $id_customer  = $result_bill['id_customer'];
					// $result_customer = $this->query("SELECT * FROM com_customer WHERE id_customer = '".(int)$id_customer."'")->row;
					// $data_customer = array(
					// 	'id_customer' 			=> $result_bill['id_customer'],
					// 	'customer_name' 		=> $result_customer['customer_name'], 
					// 	'customer_address' 		=> $result_customer['customer_address'], 
					// 	'customer_tax_no' 		=> $result_customer['customer_tax'], 
					// 	'customer_branch_no' 	=> $result_customer['customer_branch'], 
					// 	'customer_phone' 		=> $result_customer['customer_phone'], 
					// 	'customer_email' 		=> $result_customer['customer_email']
					// );
					$result_bill_detail = $this->query("SELECT * FROM com_".$type."_detail WHERE id_".$type." = '".$id."'")->rows;
					foreach($result_bill_detail as $val){
						$bill_detail[] = array(
							'id_theCost_detail' 	=> $val['id_theCost_detail'],
							'theCost_date' 			=> $val['theCost_date'],
							'theCost_detail' 		=> $val['theCost_detail'],
							'theCost_price'			=> $val['theCost_price'],
							'theCost_remark' 		=> $val['theCost_remark'],
							'theCost_detail_date_create' => $val['theCost_detail_date_create'],
						);
					}
					$result = array(
						'result' 				=> 'success',
						'id' 					=> $id,
						'theCost_date_create'	=> $result_bill['theCost_date_create'],
						'theCost_doc_no'		=> $result_bill['theCost_doc_no'],
						'theCost_price'			=> $result_bill['theCost_price'],
						'theCost_date'			=> $result_bill['theCost_date'],
						'theCost_name'			=> $result_bill['theCost_name'],
						'theCost_position'		=> $result_bill['theCost_position'],
						'theCost_text'			=> $result_bill['theCost_text'],
						'theCost_date_start'	=> $result_bill['theCost_date_start'],
						'theCost_date_end'		=> $result_bill['theCost_date_end'],
						'theCost_name_pay'		=> $result_bill['theCost_name_pay'],
						'theCost_name_approved'	=> $result_bill['theCost_name_approved'],
						'theCost_accounting'	=> $result_bill['theCost_accounting'],
						'bill_detail'			=> $bill_detail
						// 'doc_no'				=> $result_bill[$type.'_doc_no'],
						// 'ref'					=> $result_bill[$type.'_ref'],
						// 'term'					=> $result_bill[$type.'_term'],
						// 'type_vat'				=> $result_bill[$type.'_type_vat'],

						// 'condition'				=> $result_bill[$type.'_condition'],
						// 'project'				=> $result_bill[$type.'_project'],
						// 'remark' 				=> $result_bill[$type.'_remark'],
						// 'sum_bill' 				=> $result_bill[$type.'_sum_bill'],
						// 'percent_discount' 		=> $result_bill[$type.'_percent_discount'],
						// 'text_discount' 		=> $result_bill[$type.'_text_discount'],
						// 'text_discount_total' 	=> $result_bill[$type.'_text_discount_total'],
						// 'check_vat' 			=> $result_bill[$type.'_check_vat'],
						// 'text_vat' 				=> $result_bill[$type.'_text_vat'],
						// 'text_not_include_vat' 	=> $result_bill[$type.'_text_not_include_vat'],
						// 'chk_tax'				=> $result_bill[$type.'_chk_tax'],
						// 'check_tax' 			=> $result_bill[$type.'_check_tax'],
						// 'total_tax' 			=> $result_bill[$type.'_total_tax'],
						// 'net_total_vat' 		=> $result_bill[$type.'_net_total_vat'],

						// 'date_start'	=> date_f($result_bill[$type.'_date'],'Y-m-d'),
						// 'date_end'		=> date_f($result_bill[$type.'_date_end'],'Y-m-d'),
						// 'bill_detail'	=> $bill_detail
					);
				}
				
			}
			return $result;
		}
		public function delBill($data = array()){
			$type_bill = $data['type_bill'];
			$id_bill = $data['id_bill'];
			$result = array(
				'result' => 'fail', 
				'id_bill'=> $id_bill
			);
			$result_selct_bill = $this->query("SELECT * FROM com_".$type_bill." WHERE id_".$type_bill." = '".(int)$id_bill."' AND id_company='".(int)$data['id_company']."'");
			$file_bill = $result_selct_bill->row[$type_bill.'_file_name'];
			$doc_root = str_replace('private_html','public_html',DOCUMENT_ROOT);
			if(!empty($file_bill)){
				unlink($doc_root.'mep/file/'.$type_bill.'/'.$file_bill);
			}
			$result_del_bill = $this->delete($type_bill,"id_".$type_bill." = '".(int)$id_bill."' AND id_company='".(int)$data['id_company']."'");
			if($result_del_bill){
				$update_bill = $this->query("UPDATE com_setting_bill SET setting_bill_count_quotation=setting_bill_count_quotation-1 WHERE id_company='".(int)$data['id_company']."'");
				$result_del_bill_detail = $this->delete($type_bill.'_detail',"id_".$type_bill." = '".(int)$id_bill."'");
				$result = array(
					'result' => 'success', 
					'id_bill'=> $id_bill
				);
			}
			return $result;
		}
		public function billDetail($data = array()){ 
			$bill_detail = array();
			$id = (int)$data['id'];
			$result = array(
				'result' => 'fail', 
				'id'=> $id,
			);
			$type = $data['type'];
			if(!empty($data['id_user']) and !empty($data['id_company']) and !empty($id)){
				$result_bill = $this->query("SELECT * FROM com_".$type." WHERE id_".$type." = '".(int)$id."'");
				if($result_bill->num_rows > 0){
					$result_bill = $result_bill->row;
					$id_customer  = $result_bill['id_customer'];
					$result_customer = $this->query("SELECT * FROM com_customer WHERE id_customer = '".(int)$id_customer."'")->row;
					$data_customer = array(
						'id_customer' 			=> $result_bill['id_customer'],
						'customer_name' 		=> (isset($result_customer['customer_name'])?$result_customer['customer_name']:''), 
						'customer_address' 		=> (isset($result_customer['customer_address'])?$result_customer['customer_address']:''), 
						'customer_tax_no' 		=> (isset($result_customer['customer_tax'])?$result_customer['customer_tax']:''), 
						'customer_branch_no' 	=> (isset($result_customer['customer_branch'])?$result_customer['customer_branch']:''), 
						'customer_phone' 		=> (isset($result_customer['customer_phone'])?$result_customer['customer_phone']:''), 
						'customer_email' 		=> (isset($result_customer['customer_email'])?$result_customer['customer_email']:'')
					);
					$result_bill_detail = $this->query("SELECT * FROM com_".$type."_detail WHERE id_".$type." = '".$id."'")->rows;
					foreach($result_bill_detail as $val){
						$bill_detail[] = array(
							'id_product' 	=> $val['id_product'],
							'code_product' 	=> $val[$type.'_code_product'],
							'detail' 		=> $val[$type.'_detail'],
							'seq'			=> $val[$type.'_seq'],
							'no' 			=> $val[$type.'_no'],
							'unit' 			=> $val[$type.'_unit'],
							'price' 		=> $val[$type.'_price'],
							'total' 		=> $val[$type.'_total']
						);
					}
					$result = array(
						'result' 				=> 'success',
						'id_quotation' 			=> $id,
						'customer'				=> $data_customer, 
						'doc_no'				=> $result_bill[$type.'_doc_no'],
						'ref'					=> $result_bill[$type.'_ref'],
						'term'					=> $result_bill[$type.'_term'],
						'type_vat'				=> $result_bill[$type.'_type_vat'],

						'condition'				=> $result_bill[$type.'_condition'],
						'project'				=> $result_bill[$type.'_project'],
						'remark' 				=> $result_bill[$type.'_remark'],
						'sum_bill' 				=> $result_bill[$type.'_sum_bill'],
						'percent_discount' 		=> $result_bill[$type.'_percent_discount'],
						'text_discount' 		=> $result_bill[$type.'_text_discount'],
						'text_discount_total' 	=> $result_bill[$type.'_text_discount_total'],
						'check_vat' 			=> $result_bill[$type.'_check_vat'],
						'text_vat' 				=> $result_bill[$type.'_text_vat'],
						'text_not_include_vat' 	=> $result_bill[$type.'_text_not_include_vat'],
						'chk_tax'				=> $result_bill[$type.'_chk_tax'],
						'check_tax' 			=> $result_bill[$type.'_check_tax'],
						'total_tax' 			=> $result_bill[$type.'_total_tax'],
						'net_total_vat' 		=> $result_bill[$type.'_net_total_vat'],

						'date_start'	=> date_f($result_bill[$type.'_date'],'d-m-Y'),
						'date_end'		=> date_f($result_bill[$type.'_date_end'],'d-m-Y'),
						'bill_detail'	=> $bill_detail
					);
				}
				
			}
			return $result;
		}
	}
?>