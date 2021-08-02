<?php 
	class ShopModel extends db {
		public function getOrders($pos ="",$date_start="",$date_end="") {
			$order = array();
			$this->order_by('id_order', 'DESC');
			$this->where('id_company', id_company());
			if(!empty($pos)){
				$this->where('pos',$pos);
			}
			if(!empty($date_start) && !empty($date_end)){
				$this->where('date_added',$date_start,'>=');
				$this->where('date_added',$date_end,'<=');
			}
			$result = $this->get('order');
			foreach ($result->rows as $key => $value) {
				$this->where('id_order', $value['id_order']);
				$products = $this->get('order_product');
				$order[$key] = $value;
				$order[$key]['products'] = $products->rows;
			}
			return $order;
		}
		public function countOrders() {
			$this->where('id_company', id_company());
			$result = $this->get('order');
			return $result->num_rows;
		}
		public function getOrder($id) {
			$this->where('id_order', $id);
			$products = $this->get('order_product');

			$this->where('id_order', $id);
			$query = $this->get('order');
			$result = $query->row;
			$result['products'] = $products->rows;
			return $result;
		}

		public function addOrder($data) {
			$products = array();
			if (isset($data['products'])) {
				$products = $data['products'];
				unset($data['products']);
			}

			$id = $this->insert('order', $data);

			if (count($products)>0) {
				foreach ($products as $id_product => $product) {
					$product['id_order']   = $id;
					$product['id_product'] = $id_product;
					$this->insert('order_product', $product);

					// cutstock
					$this->where('id_company', id_company());
					$company_info = $this->get('company');
					if ($company_info->row['shopstock']==1) {
						$this->where('id_product', $id_product);
						$product_info = $this->get('product');
						if ($product_info->row['product_isstock']==1) {
							$sql = "update com_product set product_quantity = (product_quantity-".$product['quantity'].") WHERE id_product = ".$id_product;
							$this->query($sql);
						}
					}
					// cutstock
				}
			}
			return $id;
		}

		public function deleteOrder($id) {
			$this->where('id_order',$id);
			$result = $this->delete('order');

			$this->where('id_order',$id);
			$this->delete('order_product');
			
			return $result;
		}

		public function countShopPerMonth() {
			$sql = 'SELECT CONCAT(LPAD(MONTH (date_added),2,0),"-",YEAR (date_added)) AS `month`,count(*) AS `count` FROM com_order WHERE date_added IS NOT NULL AND date_added LIKE \''.date('Y',time()).'%\' GROUP BY YEAR (date_added),MONTH (date_added) ';
			$result = $this->query($sql);
			return $result->rows;
		}
		public function countTotalPerMonth() {
			$sql = 'SELECT CONCAT(LPAD(MONTH (date_added),2,0),"-",YEAR (date_added)) AS `month`,sum(total) AS `total` FROM com_order WHERE date_added IS NOT NULL AND date_added LIKE \''.date('Y',time()).'%\' GROUP BY YEAR (date_added),MONTH (date_added) ';
			$result = $this->query($sql);
			return $result->rows;
		}
	}
?>