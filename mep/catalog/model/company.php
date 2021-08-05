<?php 
	class CompanyModel extends db {
		public function permission($data = array()){
			$result = false;
			$id_company = (int)$data['id_company'];
			$id_user 	= (int)$data['id_user'];
			$sql_get_permission = "SELECT id_user FROM com_user_take_company 
			WHERE id_company = '".$data['id_company']."' AND id_user='".$data['id_user']."' limit 0,1";
			$result_company = $this->query($sql_get_permission);
			if($result_company->num_rows>0){
				$result = true;
			}
			return $result;
		}
		public function listCompany($data = array()){
			$result = array();
			$id_user = (int)$data['id_user'];
			if(!empty($id_user)){
				// $sql_company = "SELECT * FROM com_user_take_company 
				// INNER JOIN com_company ON com_company.id_company = com_user_take_company.id_company 
				// WHERE id_user = '".$this->escape((int)$id_user)."'";

				// เลือกจาก Employee ที่มีสิทธิ์เข้าบริษัทนั้นๆ
				$sql_company = "
				SELECT *,c.id_company AS id_company FROM com_company c 
				LEFT JOIN com_employee e ON e.id_company = c.id_company
				WHERE e.id_user = ".(int)$id_user." OR c.id_user_create = ".(int)$id_user." GROUP BY c.id_company";

				// $sql_company_emp =";


				$result = $this->query($sql_company)->rows;
			}
			return $result;
		}
		public function getCompany() {
			$this->where('id_company', id_company());
			$result = $this->get('company');
			return $result->row;
		}
		public function companyDetail($data = array()){
			$result = array();
			$id_company = $data['id_company'];
			$sql_company = "SELECT * FROM com_company 
			INNER JOIN com_user_take_company ON com_company.id_company = com_user_take_company.id_company 
			WHERE com_company.id_company = '".$this->escape((int)$id_company)."' limit 0,1";
			$result_company = $this->query($sql_company);
			if($result_company->num_rows>0){
				$result = $result_company->row;
			}
			return $result;
		}
		public function addCompany($data = array()){
			$result = array();
			$data_insert = array(
				'id_user_create'      => isset($data['id_user_create']) ? $this->escape($data['id_user_create']) : '',
				'company_verify'      => isset($data['company_verify']) ? $this->escape($data['company_verify']) : '',
				'company_name'        => isset($data['company_name']) ? $this->escape($data['company_name']) : '',
				'company_url'         => isset($data['company_url']) ? $this->escape($data['company_url']) : '',
				'company_tax_no'      => isset($data['company_tax_no']) ? $this->escape($data['company_tax_no']) : '',
				'company_logo'        => isset($data['company_logo']) ? $this->escape($data['company_logo']) : '',
				'company_tel'         => isset($data['company_tel']) ? $this->escape($data['company_tel']) : '',
				'company_address'     => isset($data['company_address']) ? $this->escape($data['company_address']) : '',
				'company_province'    => isset($data['company_province']) ? $this->escape($data['company_province']) : '',
				'company_head_office' => isset($data['company_head_office']) ? $this->escape($data['company_head_office']) : '',
				'company_date_create' => isset($data['company_date_create']) ? $this->escape($data['company_date_create']) : '',
				'sellstock'           => $data['sellstock'],
				'buystock'            => $data['buystock'],
				'shopstock'           => $data['shopstock'],
				'company_layout' 	  => isset($data['company_layout']) ? $this->escape($data['company_layout']) : '',
			);
			$result_id_company = $this->insert('company',$data_insert);
			$data_insert_setting_bill = array(
				'id_company'	=> $result_id_company
			);
			$result_setting_bill = $this->insert('setting_bill',$data_insert_setting_bill);
			$data_insert_take_company = array(
				'id_company' 	=> $result_id_company,
				'id_user' 		=> $this->escape($data['id_user_create'])
			);
			$result_company = $this->insert('user_take_company',$data_insert_take_company);
			return $result_id_company;
		}
		public function editCompany($data = array()){
			$result = array();
			$data_update = array(
				// 'id_user_create' 		=> $data['id_user_create'],
				// 'company_verify' 		=> $data['company_verify'],
				'company_name' 			=> $this->escape($data['company_name']),
				'company_url' 			=> $this->escape($data['company_url']),
				'company_tax_no' 		=> $this->escape($data['company_tax_no']),
				'company_logo' 			=> $this->escape($data['company_logo']),
				'company_tel' 			=> $this->escape($data['company_tel']),
				'company_address' 		=> $this->escape($data['company_address']),
				'company_province' 		=> $this->escape($data['company_province']),
				'company_head_office' 	=> $this->escape($data['company_head_office']),
				'company_layout' 		=> $this->escape($data['company_layout'])
				// 'company_date_create' 	=> $data['company_date_create']
			);
			// $this->where('id_user_create', $data['id_user']);
			// $this->where('id_company', $data['id_company']);
			// $result = $this->update('company', $data);
			$result = $this->update('company',$data_update,"id_user_create='".$data['id_user']."' AND id_company='".$data['id_company']."'");
			return $result;
		}
		public function checkUrl($data = array()){
			$result = array();
			$sql_company = "SELECT * FROM com_company WHERE company_url = '".$data['company_url']."' AND id_company != '".$data['id_company']."'";
			$result_company = $this->query($sql_company);
			if($result_company->num_rows>0){
				$result = "success";
			}
			return $result;
		}
	}
?>