<?php 
	class PackageModel extends db {
		public function getUserDetail($id_user){
			$result = array();
			$this->where('id_user', $id_user);
			$result = $this->get('user');
			return $result->row; 
		} 
		
		public function insertPayment($data = array()){
			$result = array();
			$data_insert = array(
				'id_package'		=> $data['id_package'],
    			'id_user'			=> $data['id_user'],
    			'id_company'		=> $data['id_company'],
    			'payment_customer'	=> $data['payment_customer'],
    			'payment_bank'		=> $data['payment_bank'],
    			'payment_price'		=> $data['payment_price'],
    			'payment_date'		=> $data['payment_date'],
    			'payment_month'		=> $data['payment_month'],
    			'payment_file'		=> $data['payment_file']
			);
			$id_payment = $this->insert('payment',$data_insert);
			return $id_payment;
		}
		public function listHistoryPackage($data = array()){
			$result = array();
			$id_user = (int)$data['id_user'];
			$sql_history_package = "SELECT * FROM com_user_take_package 
			LEFT JOIN com_package ON com_user_take_package.id_package = com_package.id_package
			WHERE id_user = '".$id_user."'";
			$result_history = $this->query($sql_history_package);
			foreach($result_history->rows as $val){
				$status = array(
					0 => 'รอการอนุมัติ',
					1 => 'อนุมัติ'
				);
				$result[] = array(
					'id_package' 		=> $val['id_package'],
					'date_start' 		=> $val['date_start'],
					'date_expired' 		=> $val['date_expired'],
					'status_approve' 	=> $val['status_approve'],
					'date_create'	 	=> $val['date_create'],
					'package_name' 		=> $val['package_name'],
					'status'			=> $status[(int)$val['status_approve']]
				);
			}
			return $result;
		}
		public function getPackageDetail($data = array()){
			$result = array();
			$id_package = (isset($data['id_package'])?$data['id_package']:'');
			$sql_list_package = "SELECT * FROM com_package WHERE package_price > 0 AND id_package = ".(int)$id_package;
			$result = $this->query($sql_list_package)->row;
			return $result;
		}
		public function listPackage($data = array()){
			$result = array();
			$sql_list_package = "SELECT * FROM com_package WHERE package_price > 0";
			$result = $this->query($sql_list_package)->rows;
			return $result;
		}
		public function getPackage($data = array()){
			$result = array();
			$id_company = (int)$data['id_company'];
			$id_user 	= (int)$data['id_user'];
			$sql_get_package = "SELECT * FROM com_user_take_package 
			WHERE id_company = '".$data['id_company']."' 
			AND NOW() < date_expired 
			AND status_approve = 1 
			ORDER BY id_user_take_package ASC 
			limit 0,1";
			$result_package = $this->query($sql_get_package);
			if($result_package->num_rows>0){
				$result = $result_package->row;
				$sql_package_detail = "SELECT * FROM com_package WHERE id_package = '".$result['id_package']."'";
				$result_package_detail = $this->query($sql_package_detail);
				$result['result'] = 'success';
				$result['detail'] = $result_package_detail->row;
			}else{
				$result['result'] = 'success';
				$sql_package_detail = "SELECT * FROM com_package WHERE id_package = '1'";
				$result_package_detail = $this->query($sql_package_detail);
				$result['detail'] = $result_package_detail->row;
			}
			return $result;
		}
		public function getDiskspaceDetail($data = array()){
			$result = array();
			$sql_employee = "SELECT count(id_employee) AS count FROM com_employee WHERE id_company = '".$data['id_company']."'";
			$query_employee = $this->query($sql_employee);
			$result['employee'] = $query_employee->row['count'];
			$sql_product = "SELECT count(id_product) AS count FROM com_product WHERE id_company = '".$data['id_company']."'";
			$query_product = $this->query($sql_product);
			$result['product'] = $query_product->row['count'];
			$sql_customer = "SELECT count(id_customer) AS count FROM com_customer WHERE id_company = '".$data['id_company']."'";
			$query_customer = $this->query($sql_customer);
			$result['customer'] = $query_employee->row['count'];
			return $result;
		}
		public function getDiskspace($data = array()){
			$result = array();
			$id_company = (int)$data['id_company'];
			$id_user 	= (int)$data['id_user'];
			$result_disk_space = $this->query("SELECT SUM(size) as sum_size FROM com_file WHERE id_company = '".$id_company."'");
			$result['size'] = $result_disk_space->row['sum_size'];
			return $result;
		}
		public function getDetailCompany($data = array()){

		}
	}
?>