<?php 
	class SettingModel extends db {
		public function addSetting($data=array()) {
			return $this->insert('setting_bill', $data);
		}
		public function saveSetting($data=array()){
			$result = array();
			$id_company = (int)$data['id_company'];
			$data_update = array(
				'company_logo'        => $data['company_logo'],
				'company_name'        => $data['company_name'],
				'company_tax_no'      => $data['company_tax_no'],
				'company_tel'         => $data['company_tel'],
				'company_address'     => $data['company_address'],
				'company_province'    => $data['company_province'],
				'company_head_office' => $data['company_head_office'],
				'sellstock'           => $data['sellstock'],
				'buystock'            => $data['buystock'], 
				'shopstock'           => $data['shopstock']
			);
			$this->update('company',$data_update,"id_company = '".$id_company."'");
			return $result;
		}
		public function getSetting($data=array()){
			$result = array();
			$id_company = (int)$data['id_company'];
			$result = $this->query("SELECT * FROM com_company WHERE id_company = '".$id_company."'")->row;
			return $result;
		}

		public function getSettingPOS($filter=array()) {
			$this->select('p.*, sum(o.total) as sumtotal, count(o.id_order) as count');
			$this->join('order o', 'o.pos=p.pos_no', 'LEFT');
			$this->where('p.id_company', id_company());
			if (count($filter)>0) {
				foreach ($filter as $key => $value) {
					if ($key == 'search') {
						$this->group_start();
						$this->where_like('p.pos_name', '%'.$value.'%');
						$this->where_like('p.pos_no', '%'.$value.'%', 'OR');
						$this->group_end();
					} else {
						$this->where('p.'.$key, $value);
					}
				}
			}
			$result = $this->get('company_pos p');
			return $result->rows;
		}
		public function getSettingPOSID($id) {
			$this->where('id_company', id_company());
			$this->where('id_company_pos', $id);
			$result = $this->get('company_pos');
			return $result->row;
		}
		public function sumPOSID($id) {
			// $this->select('sum()');
			// $this->where('id_company', id_company());
			// $this->where('id_company_pos', $id);
			// $result = $this->get('company_pos');
			// return $result->row;
		}
		public function countPos() {
			$this->where('id_company', id_company());
			$result = $this->get('company_pos');
			return $result->num_rows;
		}
		public function addPos($data) {
			if (!isset($data['id_company'])) {
				$data['id_company'] = id_company();
			}
			return $this->insert('company_pos', $data);
		}
		public function editPos($data, $id) {
			$this->where('id_company', id_company());
			$this->where('id_company_pos', $id);
			return $this->update('company_pos', $data);
		}
		public function delPos($id) {
			$this->where('id_company', id_company());
			$this->where('id_company_pos', $id);
			return $this->delete('company_pos');
		}
	}
?>