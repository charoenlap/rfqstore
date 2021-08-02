<?php 
	class CustomerController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'Customer';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('home');

	    	$data['chart'] = array();
	    	$data['chart'][] = array('Year', 'Number of Customer / Supplier applied');
	    	$model_customer = $this->model('customer');
	    	$results = $model_customer->countCustomerPerMonth(id_company());
	    	if (count($results)>0){
	    		foreach ($results as $key => $value) {
		    		$data['chart'][] = array($value['month'], (int)$value['count']);
		    	}	
	    	} else {
	    		$data['chart'][] = array(date('Y'), 0);
	    	}
	    	$data['chart'] = json_encode($data['chart']);

 	    	$this->view('customer/home',$data);
	    }

	    public function getMenu($active=''){
	    	$model_customer = $this->model('customer');

	    	$result = '<div class="nav-scroller bg-white shadow-sm">
						  <nav class="nav nav-underline">
						    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('customer/home').'">ลูกค้า</a>
						    <a class="nav-link '.($active=='category'?'active':'').'" href="'.route('customer/listCategory').'">
						      หมวดหมู่
						      <span class="badge badge-pill bg-light align-text-bottom">'.$model_customer->countCategories(id_company()).'</span>
						    </a>
						    <a class="nav-link '.($active=='list'?'active':'').'" href="'.route('customer/listCustomer').'">
						      รายการลูกค้า
						      <span class="badge badge-pill bg-light align-text-bottom">'.$model_customer->countCustomerByIdCompany(id_company()).'</span>
						    </a>
						  </nav>
						</div>';
			return $result;
	    }

	    // customer
	    public function listCustomer() {
	    	$data = array();
	    	$data['title'] = 'List Customer';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('list');

			$data['success'] = ''; 
			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			} 
			$data['error'] = ''; 
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			} 

			$data['action_search'] = route('customer/listCustomer');

			$model_customer = $this->model('customer');
			$filter = array();
			// $filter['id_company'] = id_company();
			if (method_post()) {
				$filter['customer_name'] = post('search');
				$filter['customer_code'] = post('search');
				$filter['customer_company'] = post('search');
			}
			$data['customers'] = $model_customer->getCustomers($filter);
			$data['categories'] = $model_customer->getCategories();

 	    	$this->view('customer/listCustomer',$data);
	    }
	    public function addCustomer() {
	    	$data = array();
	    	$data['title'] = 'Add Customer';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('customer/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/addCustomer'));
	    	$breadcrumb[] = array('text'=>'เพิ่มลูกค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('list');
	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;
	    	$data['action'] = route('customer/addCustomer');

	    	$model_customer = $this->model('customer');
	    	$data['categories'] = $model_customer->getCategories();

	    	$data['id_customer_category'] = 0;
			$data['customer_type']            = '';
			$data['customer_contacttype']     = '';
			$data['customer_credit']          = '';
			$data['customer_code']            = '';
			$data['customer_company']         = '';
			$data['customer_tax']             = '';
			$data['customer_branch']          = '';
			$data['customer_address']         = '';
			$data['customer_shippingaddress'] = '';
			$data['customer_phone']           = '';
			$data['customer_fax']             = '';
			$data['customer_website']         = '';
			$data['customer_name']            = '';
			$data['customer_email']           = '';
			$data['customer_telephone']       = '';
			$data['customer_bank']            = '';
			$data['customer_bankaccount']     = '';
			$data['customer_bankbranch']      = '';
			$data['customer_banktype']        = '';

	    	if (method_post()) {
	    		$input = array(
					'id_company'               => id_company(),
					'customer_type'            => post('customer_type'),
					'customer_contacttype'     => post('customer_contacttype'),
					'customer_credit'          => post('customer_credit'),
					'customer_code'            => post('customer_code'),
					'customer_company'         => post('customer_company'),
					'customer_tax'             => post('customer_tax'),
					'customer_branch'          => post('customer_branch'),
					'customer_address'         => post('customer_address'),
					'customer_shippingaddress' => post('customer_shippingaddress'),
					'customer_phone'           => post('customer_phone'),
					'customer_fax'             => post('customer_fax'),
					'customer_website'         => post('customer_website'),
					'customer_name'            => post('customer_name'),
					'customer_email'           => post('customer_email'),
					'customer_telephone'       => post('customer_telephone'),
					'customer_bank'            => post('customer_bank'),
					'customer_bankaccount'     => post('customer_bankaccount'),
					'customer_bankbranch'      => post('customer_bankbranch'),
					'customer_banktype'        => post('customer_banktype'),
					'date_added'               => date('Y-m-d H:i:s',time()),
				);
	    		$model_customer = $this->model('customer');
	    		$result = $model_customer->addCustomer($input);
	    		if ($result>0) {
	    			$this->setSession('success', 'เพิ่มลูกค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error', 'เกิดข้อผิดพลาดในการเพิ่มลูกค้า');
	    		}
	    		redirect('customer/listCustomer');
	    	}
 	    	$this->view('customer/formCustomer',$data);
	    }
	    public function editCustomer() {
	    	$data = array();
	    	$data['title'] = 'Edit Customer';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('customer/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/editCustomer'));
	    	$breadcrumb[] = array('text'=>'แก้ไขลูกค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('list');

	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;

	    	$data['action'] = route('customer/editCustomer').'&id='.get('id');
	    	$id = decrypt(get('id'));

	    	$model_customer = $this->model('customer');
	    	$customer_info = $model_customer->getCustomer($id);

	    	$model_customer = $this->model('customer');
	    	$data['categories'] = $model_customer->getCategories();

	    	$data['id_customer_category'] = $customer_info['id_customer_category'];
			$data['customer_type']            = $customer_info['customer_type'];
			$data['customer_contacttype']     = $customer_info['customer_contacttype'];
			$data['customer_credit']          = $customer_info['customer_credit'];
			$data['customer_code']            = $customer_info['customer_code'];
			$data['customer_company']         = $customer_info['customer_company'];
			$data['customer_tax']             = $customer_info['customer_tax'];
			$data['customer_branch']          = $customer_info['customer_branch'];
			$data['customer_address']         = $customer_info['customer_address'];
			$data['customer_shippingaddress'] = $customer_info['customer_shippingaddress'];
			$data['customer_phone']           = $customer_info['customer_phone'];
			$data['customer_fax']             = $customer_info['customer_fax'];
			$data['customer_website']         = $customer_info['customer_website'];
			$data['customer_name']            = $customer_info['customer_name'];
			$data['customer_email']           = $customer_info['customer_email'];
			$data['customer_telephone']       = $customer_info['customer_telephone'];
			$data['customer_bank']            = $customer_info['customer_bank'];
			$data['customer_bankaccount']     = $customer_info['customer_bankaccount'];
			$data['customer_bankbranch']      = $customer_info['customer_bankbranch'];
			$data['customer_banktype']        = $customer_info['customer_banktype'];

			if (method_post()) {
				$input = array(
					'id_company'               => id_company(),
					'id_customer_category'	   => post('id_customer_category'),
					'customer_type'            => post('customer_type'),
					'customer_contacttype'     => post('customer_contacttype'),
					'customer_credit'          => post('customer_credit'),
					'customer_code'            => post('customer_code'),
					'customer_company'         => post('customer_company'),
					'customer_tax'             => post('customer_tax'),
					'customer_branch'          => post('customer_branch'),
					'customer_address'         => post('customer_address'),
					'customer_shippingaddress' => post('customer_shippingaddress'),
					'customer_phone'           => post('customer_phone'),
					'customer_fax'             => post('customer_fax'),
					'customer_website'         => post('customer_website'),
					'customer_name'            => post('customer_name'),
					'customer_email'           => post('customer_email'),
					'customer_telephone'       => post('customer_telephone'),
					'customer_bank'            => post('customer_bank'),
					'customer_bankaccount'     => post('customer_bankaccount'),
					'customer_bankbranch'      => post('customer_bankbranch'),
					'customer_banktype'        => post('customer_banktype'),
					'date_modify'               => date('Y-m-d H:i:s',time()),
				);
				$result = $model_customer->editCustomer($input,$id);
				if ($result==1) {
	    			$this->setSession('success', 'แก้ไขลูกค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error', 'เกิดข้อผิดพลาดในการแก้ไขลูกค้า');
	    		}
	    		redirect('customer/listCustomer');
			}

 	    	$this->view('customer/formCustomer',$data);
	    }
	    public function deleteCustomer() {
	    	if (isset($_GET['id'])&&!empty($_GET['id'])) {
	    		$id = decrypt(get('id'));
	    		$model_customer = $this->model('customer');
	    		$result = $model_customer->deleteCustomer($id);
				if ($result==1) {
	    			$this->setSession('success', 'ลบลูกค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error', 'เกิดข้อผิดพลาดในการลบลูกค้า');
	    		}
	    		redirect('customer/listCustomer');
	    	}
	    }
	    // customer

	    // category
	    public function listCategory() {
	    	$data = array();
	    	$data['title'] = 'List Customer';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['action_search'] = route('customer/listCategory');

	    	$model_customer = $this->model('customer');

	    	$filter = array();
	    	if (method_post()) { 
	    		$filter['category_name'] = post('search');
	    		$filter['category_code'] = post('search');
	    	}
	    	$data['categories'] = $model_customer->getCategories($filter);

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

 	    	$this->view('customer/listCategory',$data);
	    }
	    public function addCategory() {
	    	$data = array();
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/home'),'active'=>1);
	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['title'] = 'Add Category';
	    	$data['action'] = route('customer/addCategory');

	    	$model_customer = $this->model('customer');
	    	$data['categories'] = $model_customer->getCategories();

	    	$data['filemanager'] = $this->getHtml('upload/index');

			$data['category_code']  = '';
			$data['category_name']  = '';
			$data['category_image'] = '';
			// $data['id_category']    = 0;
			$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	if (method_post()) { 
	    		$check = $model_customer->getCategoryByCode(post('category_code'));
	    		if (isset($check['id_customer_category'])&&$check['id_customer_category']>0) {
	    			$this->setSession('error', 'รหัสหมวดหมู่ลูกค้าซ้ำ');
	    			redirect('customer/addCategory'); 
	    			exit();
	    		} else {
		    		$insert = array(
		    			'id_company' => id_company(),
						'category_code'  => post('category_code'),
						'category_name'  => post('category_name'),
						// 'id_category'    => post('id_category'),
						'category_image' => post('category_image'),
						'date_added'     => date('Y-m-d H:i:s', time())
		    		);
		    		$result = $model_customer->addCategory($insert);
		    		if ($result>0) {
		    			$this->setSession('success', 'เพิ่มหมวดหมู่ลูกค้าเรียบร้อยแล้ว');
		    		} else {
		    			$this->setSession('error', 'เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่ลูกค้า');
		    		}
		    	}
	    		redirect('customer/listCategory'); 
	    	}

	    	$this->view('customer/formCategory', $data);
	    }
	    public function editCategory() {
	    	$data = array();
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ลูกค้า','url'=>route('customer/home'),'active'=>1);
	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['title'] = 'Add Category';
	    	$data['action'] = route('customer/editCategory').'&id='.get('id');

	    	$model_customer = $this->model('customer');
	    	$data['categories'] = $model_customer->getCategories();

	    	$data['filemanager'] = $this->getHtml('upload/index');

	    	$id = decrypt(get('id'));

	    	$category_info = $model_customer->getCategory($id);
			$data['category_code']  = $category_info['category_code'];
			$data['category_name']  = $category_info['category_name'];
			$data['category_image'] = $category_info['category_image'];
			// $data['id_category']    = (int)$category_info['id_category'];
			$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	if (method_post()) {
					$update = array(
						'id_company' => id_company(),
						'category_code'  => post('category_code'),
						'category_name'  => post('category_name'),
						// 'id_category'    => post('id_category'),
						'category_image' => post('category_image'),
						'date_modify'    => date('Y-m-d H:i:s', time())
					);
					$result = $model_customer->editCategory($update, $id);
					if ($result==1) {
						$this->setSession('success', 'แก้ไขหมวดหมู่ลูกค้าเรียบร้อยแล้ว');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการแก้ไขหมวดหมู่ลูกค้า');
					}
	    		
	    		redirect('customer/listCategory'); 
	    	}

	    	$this->view('customer/formCategory', $data);
	    }
	    public function deleteCategory() {
	    	if (isset($_GET['id'])&&!empty($_GET['id'])) {
	    		$id = decrypt(get('id'));
	    		$model_customer = $this->model('customer');
	    		$result = $model_customer->deleteCategory($id);
	    		if ($result==1) {
	    			$this->setSession('success', 'ลบหมวดหมู่ลูกค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error', 'เกิดข้อผิดพลาดในการลบหมวดหมู่ลูกค้า');
	    		}
	    	}
	    	redirect('customer/listCategory');
	    }
	    // category
	    
	}
?>