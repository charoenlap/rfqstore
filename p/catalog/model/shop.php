<?php 
	class ShopModel extends db {
		public function findShop($data=array()){
			$result = array();
			$shop = trim((isset($data['shop'])?$data['shop']:''));
			if(!empty($shop)){
				$query = $this->query("SELECT * FROM com_company WHERE company_url = '".$shop."'");
				$result['detail'] = $query->row;
				$id_company = $result['detail']['id_company'];

				$product = $this->query("SELECT * FROM com_product WHERE id_company = '".$id_company."'");
				$result['product'] = $product->rows;
			}
			return $result;
		}
	}
?>