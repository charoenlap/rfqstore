<?php 
	class EmployeeModel extends db {
		public function listEmp($data = array()){
			$result = array();
			$id_company = id_company();
			if(isset($data['id_company'])){ 
				$id_company = $data['id_company'];
			}
			$this->where('id_company', $id_company);

			if(isset($data['employee_name'])){
				$this->where('e.employee_firstname', '%'.$data['employee_name'].'%', 'LIKE');
				$this->where_or('e.employee_lastname', '%'.$data['employee_name'].'%', 'LIKE');
				$this->where_or('e.employee_code', '%'.$data['employee_name'].'%', 'LIKE');
			}
			$this->join('user u','u.id_user=e.id_user','LEFT');
			$result = $this->get('employee e');
			// $sql = "SELECT e.* FROM com_employee e LEFT JOIN com_user u ON u.id_user = e.id_user WHERE e.id_employee<>'' ".$where;
			// $result_employee = $this->query($sql);
			// $result = $result_employee->rows;
			// echo $this->last_query();
			return $result->rows;
		}
		public function getEmpByIdUser() {
			$this->where('id_company', id_company());
			$this->where('id_user', id_user());
			$result = $this->get('employee');
			return $result->row;
		}
		public function getEmpById($id) {
			$this->where('id_company', id_company());
			$this->where('id_employee', $id);
			$result = $this->get('employee');
			// $result = $this->query("SELECT * FROM com_employee WHERE id_employee = '".(int)$id."' AND id_company = '".id_company()."'");
			return $result->row;
		}
		public function countEmployee() {
			$this->where('id_company', id_company());
			$query = $this->get('employee');
			return $query->num_rows;
		}
		public function countEmployeePerMonth() {
			$sql = 'SELECT CONCAT(LPAD(MONTH(date_added),2,0),"-",YEAR(date_added)) as `month`, count(*) as `count` FROM com_employee WHERE id_company = '.id_company().' AND date_added is not null AND date_added LIKE \''.date('Y', time()).'%\' GROUP BY YEAR(date_added), MONTH(date_added) ';
			$result = $this->query($sql);
			return $result->rows;
		}

		public function checkEmpByCodeAndEmail($code,$email,$id_company) {
			$this->where('e.employee_code', $code);
			$this->where_or('u.user_email', $email);
			$this->where('e.id_company', $id_company);
			$this->join('employee e','e.id_user=u.id_user','LEFT');
			$result = $this->get('user u');
			// $result = $this->query("SELECT * FROM com_user u LEFT JOIN com_employee e ON e.id_user = u.id_user WHERE (e.employee_code = '".$this->escape($code)."' OR u.user_email = '".$this->escape($email)."') AND e.id_company = '".$this->escape($id_company)."';");
			return $result->num_rows;
		}

		public function countEmpByCode($code) {
			$this->where('employee_code',$code);
			$this->where('id_company', id_company());
			$result = $this->get('employee');
			// $result = $this->query("SELECT * FROM com_employee WHERE employee_code = '".$this->escape($code)."' AND id_company = '".id_company()."' ");
			return $result->num_rows;
		}

		public function addEmp($data=array()) {
			return $this->insert('employee', $data);
		}

		public function editEmp($data=array(), $id) {
			$this->where('id_employee', (int)$id);
			return $this->update('employee', $data);
		}

		public function delEmp($id) {
			$this->where('id_employee', (int)$id);
			return $this->delete("employee");
		}


	}
?>