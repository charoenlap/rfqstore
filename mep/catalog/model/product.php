<?php 
	class ProductModel extends db {
		public function test() {
			// $this->set_prefix('com_');
			// $this->select('i.image as i');
			// $this->where('p.id_product',1587370434);
			// $this->order_by('p.id_product', 'asc');
			// $this->limit(0,10);
			// $this->join('product_image i','i.id_product = p.id_product');
			// $this->get('product p');
		}
		public function getProducts($data=array()) {
			$result = array();
			$id_company = id_company();
			if(isset($data['id_company'])){
				$id_company = $data['id_company'];
			}
			unset($data['id_company']);
			$this->where('id_company', (int)$id_company);
			if (isset($data['search'])) {
				$this->group_start();
					foreach ($data as $key => $value) {
						$this->where_like('product_name', '%'.$data['search'].'%', 'AND');
						$this->where_like('product_code', '%'.$data['search'].'%', 'OR');
					}
				$this->group_end();
			}
			$this->where('id_product', 0, '>');
			$this->order_by('product_code', 'ASC');
			$products = $this->get('product');
			foreach ($products->rows as $product) {
				$this->where('id_product', $product['id_product']);
				$product_image = $this->get('product_image');
				$product['product_thumb'] = $product_image;
				$result[] = $product;
			}

			return $result;
		}
		public function getProductsByWerehouseid($id_werehouse) {
			$this->where('id_company', id_company());
			$this->where('id_werehouse', $id_werehouse);
			$result = $this->get('product');
			return $result->rows;
		}
		public function countProduct($id_company){
			$this->where('id_company', $id_company);
			$query = $this->get('product');
			return $query->num_rows; 
		}
		public function getProductByProductCode($data=array()){
			$this->where('id_company', (int)$data['id_company']);
			$this->where('product_code', $this->escape($data['product_code']));
			$result = $this->get('product');
			$product = $result->row;
			return $product; 
		} 
		public function getProductByName($data=array()){
			$this->where('id_company', (int)$data['id_company']);
			$this->where('product_name', $this->escape(trim($data['product_name'])));
			$result = $this->get('product');
			$product = $result->row;
			return $product;
		}
		public function getProduct($id){
			$this->where('id_product', (int)$id);
			$thumb = $this->get('product_image');

			
			$this->where('id_product',(int)$id);
			$option = $this->get('product_option');

			$this->where('id_product', (int)$id);
			$result = $this->get('product');
			$product = $result->row;
			$product['product_thumb'] = $thumb->rows;
			$product['product_option_price'] = $option->rows;

			return $product;
		}
		public function getProductByCategory($id_category){
			$this->where('id_category', $id_category);
			$result = $this->get('product');
			return $result->rows;
		}
		public function addProduct($data=array()) {
			$product_thumb = (isset($data['product_thumb'])?$data['product_thumb']:'');
			unset($data['product_thumb']);

			$lastid = $this->insert('product', $data);

			if (isset($product_thumb)) {
				foreach ($product_thumb as $thumb) {
					$this->insert('product_image', array('id_product'=>$lastid,'image'=>$thumb));
				}
			}

			return $lastid;
		}
		public function editProduct($data=array(),$id) {
			$product_thumb = $data['product_thumb'];
			$product_option_price = $data['product_option'];
			unset($data['product_thumb']);
			unset($data['product_option']);

			$result = $this->update('product',$data,'id_product='.(int)$id);

			$this->where('id_product',$id);
			$this->delete('product_image');
			foreach ($product_thumb as $thumb) {
				$this->insert('product_image', array('id_product'=>$id,'image'=>$thumb));
			}
			foreach ($product_option_price as $option) {
				$this->insert('product_option_price',array(
					'id_product'				=> $id,
					'product_option_price'		=> $option['product_option_price'],
					'product_option_special'	=> $option['product_option_special'],
					'product_option_quantity'	=> $option['product_option_quantity'],
					'product_option_name'		=> $option['product_option_name'],
					'product_option_sort'		=> $option['product_option_sort']
				));
			}

			return $result;
		}
		public function deleteProduct($id) {
			$this->where('id_product',$id);
			$this->delete('product_image');

			$this->where('id_product',$id);
			$this->delete('product_option');

			$this->where('id_product', $id);
			return $this->delete('product');
		}	
		public function deleteProductThumb($id) {
			$this->where('id_product_image', $id);
			return $this->delete('product_image');
		}
		public function deleteProductOption($id){
			$this->where('id_product_option',$id);
			return $this->delete('product_option');
		}
		public function countProductPerMonth() {
			$sql = 'SELECT CONCAT(LPAD(MONTH (date_created),2,0),"-",YEAR (date_created)) AS `month`,count(*) AS `count` FROM com_product WHERE id_company = '.id_company().' AND date_created IS NOT NULL AND date_created LIKE \''.date('Y',time()).'%\' GROUP BY YEAR (date_created),MONTH (date_created) ';
			$result = $this->query($sql);
			return $result->rows;
		}


		public function getCategories($filter=array()) {
			$sql = "SELECT * FROM com_category WHERE id_category > 0 AND id_company = '".id_company()."'";
			if (count($filter)>0) {
				if (isset($filter['id_company'])) {
					$sql .= "AND id_company = '".$filter['id_company']."' ";
					unset($filter['id_company']);
				}
				if (count($filter)>0) {
					$sql .= "AND ( ";
					$search = array();
					foreach ($filter as $index => $value) {
						if ($index!='id_company') {
							$search[] = " $index LIKE '%".$this->escape($value)."%' ";	
						}
					}
					$sql .= implode(' OR ',$search);
					$sql .= ") ";
				}
			}
			$sql .= "ORDER BY category_code ASC ";
			$result = $this->query($sql);
			return $result->rows;
		}
		public function countCategories($id_company) {
			$this->where('id_company', $id_company);
			$query = $this->get('category');
			return $query->num_rows;
		}
		public function getCategory($id) {
			$this->where('id_company',id_company());
			$result = $this->query("SELECT * FROM com_category WHERE id_category = ".(int)$id);
			return $result->row;
		}
		public function findCategoryByCode($code) {
			$result = $this->query("SELECT * FROM com_category WHERE category_code = ".$this->escape($code));
			return $result->num_rows;	
		}
		public function addCategory($data=array()) {
			return $this->insert('category', $data);
		}
		public function editCategory($data=array(),$id) {
			return $this->update('category', $data, 'id_category='.(int)$id);
		}
		public function deleteCategory($id) {
			return $this->delete('category','id_category='.(int)$id);
		}
		public function countCategoryPerMonth() {
			$sql = 'SELECT CONCAT(LPAD(MONTH (date_created),2,0),"-",YEAR (date_created)) AS `month`,count(*) AS `count` FROM com_category WHERE id_company = '.id_company().' AND date_created IS NOT NULL AND date_created LIKE \''.date('Y',time()).'%\' GROUP BY YEAR (date_created),MONTH (date_created) ';
			$result = $this->query($sql);
			return $result->rows;
		}






		public function getWerehouses($data=array()) {
			$this->where('id_company', id_company());
			foreach ($data as $key => $value) {
				$this->where($key, $value);
			}
			$this->order_by('werehouse_code', 'ASC');
			$result = $this->get('werehouse');
			return $result->rows;
		}
		public function countWerehouse($id_company) {
			$this->where('id_company', $id_company);
			$query = $this->get('werehouse');
			return $query->num_rows;
		}
		public function getWerehouse($id){
			$this->where('id_company', id_company());
			$this->where('id_werehouse', $id);
			$result = $this->get('werehouse');
			return $result->row;
		}
		public function addWerehouse($data=array()) {
			return $this->insert('werehouse', $data);
		}
		public function editWerehouse($data=array(),$id) {
			return $this->update('werehouse',$data,'id_werehouse='.(int)$id);
		}
		public function deleteWerehouse($id) {
			return $this->delete('werehouse','id_werehouse='.(int)$id);
		}
	}
?>