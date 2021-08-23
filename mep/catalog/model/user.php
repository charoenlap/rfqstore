<?php 
	class UserModel extends db {
		public function test(){
			return "test";
		}
		public function getUserByEmail($email){
			$result = array();
			$result = $this->query("SELECT * FROM com_user WHERE user_email = '$email' ");
			return $result->row;
		}

		public function getUserByKey($key) {
			$result = $this->query("SELECT * FROM com_user WHERE key = '$key'");
			return $result->row;
		}

		public function getUserById($id) {
			$this->where('id_user', $id);
			$result = $this->get('user');
			return $result->row;
		}

		public function addUser($data=array()) {
			return $this->insert('user', $data);
		}

		public function editUser($data=array(),$id) {
			return $this->update('user',$data,"id_user=$id");
		}

		public function addUserTakeCompany($data) {
			return $this->insert('user_take_company', $data);
		}
		public function delUserTakeCompnay($id_company, $id_user) {
			$this->where('id_company',$id_company);
			$this->where('id_user', $id_user);
			return $this->delete('user_take_company'); 
		}
		
		public function getPermission($id_company, $id_user) {
			$this->where('id_company', $id_company);
			$this->where('id_user', $id_user);
			$result = $this->get('user_permission');
			return $result->row;
		}
		public function checkUserPermission($routing, $id_company, $id_user) {
			$this->where('id_company', $id_company);
			$this->where('id_user', $id_user);
			$query = $this->get('user_permission');
			return $query->row; 
		}
		public function addPermission($data) {
			return $this->insert('user_permission', $data);
		}
		public function editPermission($data, $id) {
			$this->where('id_user_permission', $id);
			return $this->update('user_permission',$data);
		}
		public function delPermission($id) {
			$this->where('id_user_permission', $id);
			return $this->delete('user_permission');
		}
	}
?>