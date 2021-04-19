<?php 
	class CustomerModel extends db {
		public function getCustomers($data = array()){
			if (count($data)>0) {
				$this->group_start();
				foreach ($data as $key => $value) {
					$this->where_like($key, "%".$value."%",'OR');	
				}
				$this->group_end();
			}
			$this->where('id_company', id_company());
			$result = $this->get('customer');
			return $result->rows;
		}
		public function getCustomerByIdCompany($data = array()){
			$this->where('id_customer',$data['id_customer']);
			$this->where('id_company',$data['id_company']);
			$result = $this->get('customer');
			return $result->row;
		}
		public function countCustomerByIdCompany($id_company){
			$this->where('id_company',$id_company);
			$result = $this->get('customer');
			return $result->num_rows;
		}
		public function getCustomer($id){
			$this->where('id_customer',$id);
			$result = $this->get('customer');
			return $result->row;
		}
		public function addCustomer($data=array()) {
			return $this->insert('customer', $data);
		}
		public function editCustomer($data=array(),$id) {
			$this->where('id_customer', $id);
			return $this->update('customer', $data);
		}
		public function deleteCustomer($id) {
			$this->where('id_customer',$id);
			return $this->delete('customer');
		}
		public function countCustomerPerMonth($id_company) {
			$sql = 'SELECT CONCAT(LPAD(MONTH(date_added),2,0),"-",YEAR(date_added)) as `month`, count(*) as `count` FROM com_customer WHERE id_company = '.$id_company.' AND date_added is not null AND date_added LIKE \''.date('Y', time()).'%\' GROUP BY YEAR(date_added), MONTH(date_added) ';
			$result = $this->query($sql);
			return $result->rows;
		}





		public function getCategories($array=array()) {
			if (count($array)>0) {
				$this->group_start();
				foreach ($array as $key => $value) {
					$this->where_like($key,"%".$value."%",'OR');
				}
				$this->group_end();
			}
			$this->where('id_company', id_company());
			$result = $this->get('customer_category');
			return $result->rows;
		}
		public function countCategories($id_company) {
			$this->where('id_company', $id_company);
			$result = $this->get('customer_category');
			return $result->num_rows;
		}
		public function getCategory($id) {
			$this->where('id_company', id_company());
			$this->where('id_customer_category', $id);
			$result = $this->get('customer_category');
			return $result->row;
		}
		public function getCategoryByCode($code) {
			$this->where('id_company', id_company());
			$this->where('category_code', $code);
			$result = $this->get('customer_category');
			return $result->row;
		}
		public function addCategory($data=array()) {
			return $this->insert('customer_category',$data);
		}

		public function editCategory($data=array(),$id) {
			$this->where('id_customer_category', $id);
			return $this->update('customer_category', $data);
		}
		public function deleteCategory($id) {
			$this->where('id_customer_category', $id);
			return $this->delete('customer_category');
		}
	}
?>