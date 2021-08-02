<?php 
	class ShopController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'Shop';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลักร้านค้า','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ร้านค้า','url'=>route('shop/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('home');

	    	$data['chart'] = array();
	    	$data['chart'][] = array('Year', 'Number of count order');
	    	$model_shop = $this->model('shop');
	    	$results = $model_shop->countShopPerMonth();
	    	if (count($results)>0) {
		    	foreach ($results as $key => $value) {
		    		$data['chart'][] = array($value['month'], (int)$value['count']);
		    	}
		    } else {
		    	$data['chart'][] = array(date('Y'), 0);
		    }
	    	$data['chart'] = json_encode($data['chart']);

	    	$data['chart2'] = array();
	    	$data['chart2'][] = array('Year', 'Number of total order');
	    	$results = $model_shop->countTotalPerMonth();
	    	if (count($results)>0) {
		    	foreach ($results as $key => $value) {
		    		$data['chart2'][] = array($value['month'], (int)$value['total']);
		    	}
		    } else {
		    	$data['chart2'][] = array(date('Y'), 0);
		    }
	    	$data['chart2'] = json_encode($data['chart2']);

 	    	$this->view('shop/home',$data);
	    }
	    public function sale() {
	    	$data = array();
	    	$data['title'] = 'List Shop';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);


	    	$style = array(
	    		'assets/css/select2.css',
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/select2.full.js',
	    	);
	    	$data['script'] = $script;

	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลักร้านค้า','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'หน้าขาย','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('sale');

			
	    	$model_product = $this->model('product');
			// NEW PRODUCT
			$filter = array();
			$data['category'] = $model_product->getCategories($filter);
			$data['product_cats'] = array();
			$product_detail = array();
			foreach($data['category'] as $keys => $values){
				$product_detail[$keys] = $model_product->getProductByCategory($values['id_category']);
				foreach($product_detail[$keys] as $key => $val){
					$data['product_cats'][$keys][] = $model_product->getProduct($val['id_product']);
				}
			}
			// END NEW

			// OLD PRODUCT
	    	$products = $model_product->getProducts();
	    	$data['products'] = array();
	    	foreach ($products as $key => $value) {
	    		$data['products'][$key] = $value;
	    		$data['products'][$key]['product_name'] = $this->utf8_substr(strip_tags(html_entity_decode($value['product_name'], ENT_QUOTES, 'UTF-8')), 0, 20 ).'...';
	    	}

	    	$model_setting = $this->model('setting');
	    	$data['list_pos'] = $model_setting->getSettingPOS();
	    	$data['pos'] = $this->hasSession('pos') ? $this->getSession('pos') : '';

	    	$data['action_save'] = route('shop/sale');

	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} else {
	    		$data['success'] = '';
	    	}

	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} else {
	    		$data['error'] = '';
	    	}

				$data['totals']      = "";
				$data['received']   = "";
				$data['change']     = "";
	    	if (method_post()) {
				$data['totals']      = (double)str_replace(',', '', $_POST['total']);
				$data['received']   = (double)str_replace(',', '', $_POST['incash']);
				$data['change']     = (double)str_replace(',', '', $_POST['returncash']);

	    		$insert = array();
				$products = json_decode(decode($this->getSession('addtocart'), KEY), true);
				foreach ($products as $id_product => $product) {
					$insert['products'][$id_product] = array(
						'image'    => $product['image'],
						'name'     => $product['name'],
						'price'    => (double)str_replace(',', '', $product['price']),
						'quantity' => $product['qty']
					);
				}

				$insert['pos']        = $_POST['pos'];
				$this->setSession('pos', $_POST['pos']);
				$insert['total']      = (double)str_replace(',', '', $_POST['total']);
				$insert['received']   = (double)str_replace(',', '', $_POST['incash']);
				$insert['change']     = (double)str_replace(',', '', $_POST['returncash']);
				$insert['id_company'] = id_company();
				$insert['date_added'] = date('Y-m-d H:i:s', time());

				$model_shop = $this->model('shop');
				$result = $model_shop->addOrder($insert);
				if ($result>0) {
					$this->rmSession('addtocart');
					$this->setSession('success', 'ชำระเงินเรียบร้อย <div id="id_order" style="display:none;">'.encrypt($result).'</div>');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการชำระเงิน');
				}
				redirect('shop/sale');
	    		exit();
	    	}

 	    	$this->view('shop/sale',$data);
	    }
	    public function getCart() {
	    	$data['cart'] = array();
	    	$data['total'] = 0.00;
	    	if ($this->hasSession('addtocart')) {
	    		$data['cart'] = json_decode(decode($this->getSession('addtocart'), KEY), true);
	    		foreach ($data['cart'] as $cart) { 
	    			(float)$data['total'] += ((float)$cart['price'] * (float)$cart['qty']);
	    		}
	    	}

	    	$html = '
		    	<p class="mb-2">ตะกร้าสินค้า</p>
	    		<table class="table table-bordered my-2" id="tablecart"> 
					<thead>
						<tr>
							<th class="p-2">รายการ</th>
							<th class="p-2" colspan="2">ราคา</th>
						</tr>
					</thead>
					<tbody>';
						foreach ($data['cart'] as $key => $value) {
						$html .= '<tr>
							<td class="p-2">'.$value['name'].'</td>
							<td class="p-2" width="30%"><input type="number" min="1" class="form-control form-control-sm in inputqty" data-id="'.encode($key,KEY).'" value="'.$value['qty'].'"></td>
							<td class="p-2" width="10%" class="text-center"><button type="button" class="btn btn-danger btn-sm delcart" data-id="'.encode($key,KEY).'"><i class="fas fa-trash"></i></button></td>
						</tr>';
						}
					$html .= '</tbody>
				</table>
				<a href="'.route('shop/clearCart').'" class="btn btn-outline-danger w-100 rounded-0" onclick="return confirm(\'ยืนยันการล้างตะกร้า\');">ล้างตะกร้า</a>
				<style>
				#tablecart { border-top-left-radius: 5px; }
				</style>';


			$pos = $this->hasSession('pos') ? $this->getSession('pos') : '';

	    	$json = array();
	    	// $json['html'] =  $this->render('shop/cart',$data); 
	    	$json['html'] = $html;
	    	$json['data'] = $data;
	    	$json['pos'] = $pos;
	    	echo json_encode($json);
	    	
	    }
	    public function qtyCart() {
	    	$cart = json_decode(decode($this->getSession('addtocart'), KEY), true);
	    	$id = decode(post('id'), KEY);
	    	$cart[$id]['qty'] = post('qty');
	    	$this->setSession('addtocart', encode(json_encode($cart),KEY));
	    	$this->json(true);
	    }
	    public function delCart() {
	    	$cart = json_decode(decode($this->getSession('addtocart'), KEY), true);
	    	$id = decode(post('id'), KEY);
	    	unset($cart[$id]);
	    	$this->setSession('addtocart', encode(json_encode($cart), KEY));
	    	$this->json(true);
	    }
	    public function clearCart() {
	    	$this->rmSession('addtocart');
	    	$cart = array();
	    	$this->setSession('addtocart', encode(json_encode($cart), KEY));
	    	redirect('shop/sale');
	    }
	    public function addtocart() {
	    	$result = false;
			$id = decode(post('id_product'),KEY);
			$model_product = $this->model('product');
			$product_info = $model_product->getProduct($id);
	    	if ($this->hasSession('addtocart')) {
	    		$cart = json_decode(decode($this->getSession('addtocart'), KEY), true);
	    		if (is_array($cart)) {
	    			if (isset($cart[$id])) {
		    			$cart[$id] = array(
							'image' => $product_info['product_image'],
							'name'  => $product_info['product_name'],
							'price' => ($product_info['product_special']>0) ? (double)$product_info['product_special'] : (double)$product_info['product_price'],
							'qty'   => (double)$cart[$id]['qty'] + 1, 
		    			);
		    			$this->setSession('addtocart', encode(json_encode($cart), KEY));
		    			$result = true;
	    			}  else {
		    			$cart[$id] = array(
							'image' => $product_info['product_image'],
							'name'  => $product_info['product_name'],
							'price' => ($product_info['product_special']>0) ? (double)$product_info['product_special'] : (double)$product_info['product_price'],
							'qty'   => 1, 
		    			);
		    			$this->setSession('addtocart', encode(json_encode($cart), KEY));
		    			$result = true;
	    			}
	    		}
	    	} else {
	    		$cart[$id] = array(
					'image' => $product_info['product_image'],
					'name'  => $product_info['product_name'],
					'price' => ($product_info['product_special']>0) ? (double)$product_info['product_special'] : (double)$product_info['product_price'],
					'qty'   => 1, 
    			);
    			$this->setSession('addtocart', encode(json_encode($cart), KEY));
    			$result = true;
	    	}
	    	$this->json($result);
	    }

	    public function getOrder() {
	    	$json = false;
	    	if (method_post()) {
	    		$id = decrypt(post('id'));

	    		$model_shop = $this->model('shop');
	    		$json = $model_shop->getOrder($id);
	    		$model_company = $this->model('company');
		    	$json['company'] = $model_company->getCompany();
	    	}	
	    	$this->json($json);
	    }
	    public function order() {
	    	$data = array();
	    	$data['title'] = 'รายงานการขาย';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลักร้านค้า','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รายงาน','url'=>'','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('order');
			$style = array(
				'assets/css/select2.css',
				'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
			);
			$data['style'] = $style;
			$script = array(
				'assets/js/select2.full.js',
				'assets/boostrap_jquery/js/jquery-ui.js',
				'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
				'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
				'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js',
			);
			$data['script'] = $script;

			$model_setting = $this->model('setting');
	    	$data['list_pos'] = $model_setting->getSettingPOS();
	    	$data['pos'] = $this->hasSession('pos') ? $this->getSession('pos') : '';
	    	$data['action_search'] = route('shop/order');
	    	$data['action_export'] = route('shop/export_order');
			$data['date_start'] = '01-'.date('m').'-'.(date('Y')+543);
			$data['date_end']   = sprintf('%02d', date('t')).'-'.date('m').'-'.(date('Y')+543);
			$filter = array();
			$pos = '';
			$date_start = '';
			$date_end = '';
			if(method_post()){
				$data['date_start'] = post('date_start');
				$data['date_end']   = post('date_end');

				$date_start = $data['date_start'];
				$ex = explode('-', $date_start);
				$ex[2] -= 543;
				$new = array();
				for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
				$date_start = implode('-', $new);
	
				$date_end = $data['date_end'];
				$ex = explode('-', $date_end);
				$ex[2] -= 543;
				$new = array();
				for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
				$date_end = implode('-', $new);

				if(!empty($values['pos'])){
					$pos = $values['pos'];
				}
			}
	    	$model_shop = $this->model('shop');
	    	$data['order'] = $model_shop->getOrders($pos,$date_start,$date_end);
	    	// echo '<pre>';
	    	// print_r($data['order']);
	    	// echo '</pre>';
	    	// exit();
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} else {
	    		$data['success'] = '';
	    	}

	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} else {
	    		$data['error'] = '';
	    	}

 	    	$this->view('shop/order',$data);
	    }
	    public function deleteOrder() {
	    	$id = decrypt(get('id'));
	    	if ($id>0) {
	    		$result = $this->model('shop')->deleteOrder($id);
	    		if ($result>0) {
					$this->setSession('success', 'ลบออเดอร์เรียบร้อย');
				} else {
					$this->setSession('error', 'เกิดข้อผิดพลาดในการลบออเดอร์');
				}
				
	    	} else {
	    		$this->setSession('error', 'เกิดข้อผิดพลาดในการลบออเดอร์');
	    	}
	    	redirect('shop/order');
	    	exit();
	    }

	     public function getMenu($active=''){
	     	$model_shop = $this->model("shop");
	     	$count = $model_shop->countOrders();
	    	$result = '<div class="nav-scroller bg-white shadow-sm">
					  <nav class="nav nav-underline">
					    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('shop/home').'">หน้าหลักร้านค้า</a>
					    <a class="nav-link '.($active=='sale'?'active':'').'" href="'.route('shop/sale').'">ร้านค้า</a>
					    <a class="nav-link '.($active=='order'?'active':'').'" href="'.route('shop/order').'">
					      รายงานการขาย
					      <span class="badge badge-pill bg-light align-text-bottom">'.$count.'</span>
					    </a>
					  </nav>
					</div>';
			return $result;
	    }
		public function export_order(){
			$data = array();
			$pos = '';
			$date_start = '';
			$date_end = '';
			$data['date_start'] = '01-'.date('m').'-'.(date('Y')+543);
			$data['date_end']   = sprintf('%02d', date('t')).'-'.date('m').'-'.(date('Y')+543);
			if(method_post()){
				$data['date_start'] = post('date_start');
				$data['date_end']   = post('date_end');

				$date_start = $data['date_start'];
				$ex = explode('-', $date_start);
				$ex[2] -= 543;
				$new = array();
				for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
				$date_start = implode('-', $new);
	
				$date_end = $data['date_end'];
				$ex = explode('-', $date_end);
				$ex[2] -= 543;
				$new = array();
				for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
				$date_end = implode('-', $new);

				if(!empty($values['pos'])){
					$pos = $values['pos'];
				}
			}
			$model_shop = $this->model('shop');
	    	$data['order'] = $model_shop->getOrders($pos,$date_start,$date_end);
			$this->view('shop/export_order',$data,false);
		}
	    
	}
?>