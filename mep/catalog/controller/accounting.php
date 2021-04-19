<?php 
	class AccountingController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array(); 
	    	$data['title'] = 'Accounting';
	    	$style = array(
	    		'assets/css/accounting/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/accounting/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$data['script'] = $script;
	    	$get_menu = array(0,1,2,3,4,5,6,7);
	    	$data['headerMenu'] = $this->getMenu('home',$get_menu);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
	    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/quotation'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
 	    	$this->view('accounting/home',$data);
	    }
	    public function sell(){
	    	$data = array();
	    	$data['title'] = 'Accounting';
	    	$style = array(
	    		'assets/css/accounting/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/accounting/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$data['script'] = $script;
	    	$get_menu = array(0,1,2);
	    	$data['headerMenu'] = $this->getMenu('home',$get_menu);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/sell'));
	    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/quotation'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$this->view('accounting/sell',$data);
	    }
	    public function buy(){
	    	$data = array();
	    	$data['title'] = 'Accounting';
	    	$style = array(
	    		'assets/css/accounting/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/accounting/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$data['script'] = $script;
	    	$get_menu = array(0,4,5);
	    	$data['headerMenu'] = $this->getMenu('home',$get_menu);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/buy'));
	    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/quotation'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$this->view('accounting/buy',$data);
	    }
	    public function cost(){
	    	$data = array();
	    	$data['title'] = 'Accounting';
	    	$style = array(
	    		'assets/css/accounting/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/accounting/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$data['script'] = $script;
	    	$get_menu = array(0,6,7);
	    	$data['headerMenu'] = $this->getMenu('home',$get_menu);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/cost'));
	    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/quotation'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$this->view('accounting/cost',$data);
	    }
	    public function getMenu($active='',$type=array(0,1,2,3,4,5,6,7)){
	    	$result = '';
	    	$data = array();

	    	$id_company = id_company(); 
	    	$accounting = $this->model('accounting');
	    	$data_bill = array(
	    		'id_company' => $id_company
	    	);
	    	$result_accounting = $accounting->getBillCount($data_bill);
 
	    	$count_quotation 		= isset($result_accounting['count_quotation']) ? $result_accounting['count_quotation'] : 0;
			$count_billingnote 		= isset($result_accounting['count_billingnote']) ? $result_accounting['count_billingnote'] : 0;
			$count_receipt 			= isset($result_accounting['count_receipt']) ? $result_accounting['count_receipt'] : 0;
			$count_purchaseOrder	= isset($result_accounting['count_purchaseOrder']) ? $result_accounting['count_purchaseOrder'] : 0;
			$count_productReceipt 	= isset($result_accounting['count_productReceipt']) ? $result_accounting['count_productReceipt'] : 0;
			$count_theCost 			= isset($result_accounting['count_theCost']) ? $result_accounting['count_theCost'] : 0;
			$count_withholdingTax 	= isset($result_accounting['count_withholdingTax']) ? $result_accounting['count_withholdingTax'] : 0;

			$link[0] = 	array( 'text'		=> 	'บัญชี',
							 'url'		=>	route('accounting/home'),
							 'active'	=>	'home'
						);
			$link[1] = 	array( 'text'		=> 	'ใบเสนอราคา',
							 'url'		=>	route('accounting/quotation'),
							 'active'	=>	'quotation', 
							 'no'		=> 	$count_quotation 
						);
			$link[2] = 	array( 'text'		=> 	'ใบวางบิล/ใบแจ้งหนี้/ใบส่งของ',
							 'url'		=>	route('accounting/billingnote'),
							 'active'	=>	'billingnote', 
							 'no'		=> 	$count_billingnote 
						);
			$link[3] = 	array( 'text'		=> 	'ใบเสร็จรับเงิน',
							 'url'		=>	route('accounting/receipt'),
							 'active'	=>	'receipt', 
							 'no'		=> 	$count_receipt 
						);
			$link[4] = 	array( 'text'		=> 	'ใบสั่งซื้อ',
							 'url'		=>	route('accounting/purchaseOrder'),
							 'active'	=>	'purchaseOrder', 
							 'no'		=> 	$count_purchaseOrder 
						);
			$link[5] = 	array( 'text'		=> 	'ใบรับสินค้า',
							 'url'		=>	route('accounting/productReceipt'),
							 'active'	=>	'productReceipt', 
							 'no'		=> 	$count_productReceipt 
						);
			$link[6] = 	array( 'text'		=> 	'ค่าใช้จ่าย',
							 'url'		=>	route('accounting/theCost'),
							 'active'	=>	'theCost', 
							 'no'		=> 	$count_theCost 
						);
			$link[7] = 	array( 'text'		=> 	'ใบหักภาษี ณ ที่จ่าย',
							 'url'		=>	route('accounting/withholdingTax'),
							 'active'	=>	'withholdingTax', 
							 'no'		=> 	$count_withholdingTax 
						);

			$result = 	'<div class="nav-scroller bg-white shadow-sm">
							<nav class="nav nav-underline">';
				foreach($type as $key => $val){
					$result .=	'<a class="nav-link '.($link[$val]['active']==$active?'active':'').'"	href="'.$link[$val]['url'].'">'.$link[$val]['text'];
					if(!empty($link[$val]['no'])){
						$result .=	'<span class="badge badge-pill bg-light align-text-bottom">'.$link[$val]['no'].'</span>';
					}
					$result .=	'</a>';
				}
			$result .=	'	</nav>';
			$result .=	'</div>';
			return $result;
	    }
	    public function addBill(){
	    	$data 			= array(); 
	    	$id 			= get('id');
	    	$id_company 	= id_company();
	    	$id_user 		= id_user();
	    	$type_bill 		= get('typeBill');
	    	$id_bill 		= decrypt($id);
	    	$data['id'] 	= $id;
	    	$type_method 	= (post('type_method')?post('type_method'):'');
	    	$arr_detail 	= array();
	    	$result_accounting = array();
	    	if(method_post()){ 
	    		if($type_method == 'add'){
	    			$accounting = $this->model('accounting');
	    			$type_bill = post('type_bill');
	    			if($type_bill=='theCost'){
		 	    		$data_bill = $this->billTheCostDataPost();
	    				$result_accounting = $accounting->addBillTheCost($data_bill);
	    				$this->json($result_accounting);
		 	    	}elseif($type_bill=='withholdingTax'){
		 	    		$data_bill = $this->billWithholdingTaxDataPost();
	    				$result_accounting = $accounting->addBillWithholdingTaxDataPost($data_bill);
	    				$this->json($result_accounting);
		 	    	}else{
		    			$data_bill = $this->billDataPost();
	    				$result_accounting = $accounting->addBill($data_bill);
	    				echo $this->json($result_accounting);
	    				exit();
		    		}
	    		}
	    	}else{
		    	$data['title'] = 'Add '.$type_bill;
		    	$data['date'] = date('Y-m-d');
		    	$style = array(
		    		'assets/css/select2.css',
		    		'assets/css/accounting/home.css',
		    		'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
		    		// 'assets/boostrap_jquery/css/bootstrap-datepicker3.css',
		    	);
		    	$data['style'] = $style;
		    	$script = array(
		    		'assets/js/select2.full.js',
		    		
	  				'assets/boostrap_jquery/js/jquery-ui.js',
		    		'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
		    		'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
		    		'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js',
		    		'assets/js/accounting/main.js',
		    	// 	'assets/boostrap_jquery/js/bootstrap-datepicker.js',
	  				// 'assets/boostrap_jquery/js/locales/bootstrap-datepicker.th.min.js',
		    		'assets/js/accounting/quotation.js'
		    	);
		    	$data['script'] = $script;
		    	$customer = $this->model('customer');
		    	$product = $this->model('product');
		    	$data_select_product = array(
		    		'id_company'	=> $id_company
		    	);	
		    	$data['product_list'] = $product->getProducts($data_select_product);
		    	$data['customer_list'] = array();
		    	$data_customer = array(
		    		'id_company' => $id_company
		    	);
		    	// $customer->aa();

		    	$data['customer_list'] = $customer->getCustomers($data_customer);
		    	$blank_val = array('id_customer'=>'','customer_company'=>'+ ลูกค้า');
		    	array_unshift($data['customer_list'],$blank_val);

		    	$breadcrumb = array();
		    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
		    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
		    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/home'));
		    	$breadcrumb[] = array('text'=>'ใบเสนอราคา','url'=>'accounting/quotation');
		    	$breadcrumb[] = array('text'=>'เพิ่มใบเสนอราคา','url'=>'','active'=>1);
		    	$data['type_method'] = 'add';
		    	$data['breadcrumb'] = breadcrumb($breadcrumb);
		    	$data['headerMenu'] = $this->getMenu($type_bill);
		    	$data['action'] = 'index.php?route=accounting/addBill';

		    	$id='file';
		    	$multiple=false;
		    	$default="";
		    	$data['document'] = $this->file($id, $multiple, $default);
		    	// $data['document'] = $this->file('file');
		    	$model_accounting = $this->model('accounting');
		    	$nobill = (int)$model_accounting->getBillCount(array('id_company'=>id_company()))['count_'.$type_bill]+1;
		    	$data['bill'] = array();

		    	$company_model = $this->model('company');
		    	$company_info = $company_model->getCompany();


		    	if ($type_bill=='theCost') {
		    		$data['bill']['theCost_doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
		    	} else if ($type_bill=='withholdingTax') {
					$data['bill']['withholdingTax_date']         = date('Y-m-d');
					$data['bill']['withholdingTax_id_no_1']      = $company_info['company_tax_no'];
					$data['bill']['withholdingTax_id_name_1']    = $company_info['company_name'];
					$data['bill']['withholdingTax_id_address_1'] = $company_info['company_address'];
					$data['bill']['withholdingTax_id_no_2']      = '';
					$data['bill']['withholdingTax_id_name_2']    = '';
					$data['bill']['withholdingTax_id_address_2'] = '';
		    		
		    		$data['bill']['withholdingTax_doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
		    	} else {
		    		$data['bill']['doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
		    	}
		    	
				$data['customer']  = 0;
				$data['id']        = '';
				$data['type_bill'] = $type_bill;
				$date_start = date('d-m-Y');
				$ex = explode('-',$date_start);
				$ex[2] = $ex[2]+543;
				$data['bill']['date_start'] = implode('-',$ex);
				$date_end = date('d-m-Y', strtotime('+1week'));
				$ex = explode('-',$date_end);
				$ex[2] = $ex[2]+543;
				$data['bill']['date_end'] = implode('-',$ex);
	 	    	if($type_bill=='theCost'){
	 	    		$this->view('accounting/formBillTheCost',$data);
	 	    	}elseif($type_bill=='withholdingTax'){ 
	 	    		$this->view('accounting/formBillWithholdingTax',$data);
	 	    	}else{
	 	    		$this->view('accounting/formBill',$data);
	 	    	}
	 	    }
	    }
	    public function editBill(){
	    	$data 			= array(); 
	    	$id 			= get('id');
	    	$id_company 	= id_company();
	    	$id_user 		= id_user();
	    	$type_bill 		= get('typeBill');
	    	$id_bill 		= decrypt($id);
	    	$data['id'] 	= $id;
	    	$type_method 	= (post('type_method')?post('type_method'):'');
	    	$arr_detail 	= array();
	    	if(method_post()){
	    		if($type_method == 'edit'){
	    			$accounting = $this->model('accounting');
	    			$type_bill = post('type_bill');
	    			if($type_bill=='theCost'){
		 	    		$data_bill = $this->billTheCostDataPost();
	    				$result_accounting = $accounting->editBillTheCost($data_bill);
	    				$this->json($result_accounting);
		 	    	}elseif($type_bill=='withholdingTax'){
		 	    		$data_bill = $this->billWithholdingTaxDataPost();
	    				$result_accounting = $accounting->editBillWithholdingTaxDataPost($data_bill);
	    				$this->json($result_accounting);
		 	    	}else{
		    			$data_bill = $this->billDataPost();
		    			$accounting = $this->model('accounting');
		    			$result_accounting = $accounting->editBill($data_bill);
		    		}
	    		}
	    		$this->json($result_accounting);
	    	}else{
	    		$data['customer']  = array();
	    		$accounting = $this->model('accounting');
	    		$data_bill = array(
	    			'id' 			=> $id_bill,
	    			'id_user' 		=> $id_user,
	    			'id_company'	=> $id_company,
	    			'type'			=> $type_bill 
	    		);
	    		if($type_bill=='theCost'){
	 	    		$bill = $accounting->billDetailCost($data_bill);
	 	    	}elseif($type_bill=='withholdingTax'){
	 	    		$bill = $accounting->billDetailWithholdingTax($data_bill);
	 	    	}else{
	 	    		$bill = $accounting->billDetail($data_bill); 
	 	    		$data['customer'] = isset($bill['customer']['id_customer']) ? $bill['customer']['id_customer'] : '';
	    			$data['bill_detail'] = isset($bill['bill_detail']) ? $bill['bill_detail'] : '';
	 	    	}

	 	    	// echo '<pre>';
	 	    	// print_r($data['customer']);
	 	    	// echo '</pre>';

	    		
	    		// var_dump($bill);
	    		if($bill['result']=='fail'){
	    			page_404();
	    			exit();
	    		}
	    		$data['bill'] = $bill;
	    		// var_dump($data['bill']);
	    		
		    	$data['title'] = 'Edit '.$type_bill;
		    	$data['date'] = date('Y-m-d'); 
		    	$style = array(
		    		'assets/css/select2.css',
		    		'assets/css/accounting/home.css',
		    		'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
		    		// 'assets/boostrap_jquery/css/bootstrap-datepicker3.css',
		    	);
		    	$data['style'] = $style;
		    	$script = array(
		    		'assets/js/select2.full.js',
		    		
	  				'assets/boostrap_jquery/js/jquery-ui.js',
		    		'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
		    		'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
		    		'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js',
		    		'assets/js/accounting/main.js',
		    	// 	'assets/boostrap_jquery/js/bootstrap-datepicker.js',
	  				// 'assets/boostrap_jquery/js/locales/bootstrap-datepicker.th.min.js',
		    		'assets/js/accounting/quotation.js'
		    	);
		    	$data['script'] = $script;
		    	$customer = $this->model('customer');
		    	$product = $this->model('product');
		    	$data_select_product = array(
		    		'id_company'	=> $id_company
		    	);	
		    	$data['product_list'] = $product->getProducts($data_select_product);
		    	$data['customer_list'] = array();
		    	$data_customer = array(
		    		'id_company' => $id_company
		    	);
		    	$data['customer_list'] = $customer->getCustomers($data_customer);
		    	$blank_val = array('id_customer'=>'','customer_company'=>'+ ลูกค้าใหม่');
		    	array_unshift($data['customer_list'],$blank_val);

		    	$breadcrumb = array();
		    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
		    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
		    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/home'));
		    	$breadcrumb[] = array('text'=>$type_bill,'url'=>'accounting/'.$type_bill);
		    	$breadcrumb[] = array('text'=>'แก้ไข'.$type_bill,'url'=>'','active'=>1);
		    	$data['type_method'] = 'edit';
		    	$data['breadcrumb'] = breadcrumb($breadcrumb);
		    	$data['headerMenu'] = $this->getMenu($type_bill);
		    	$data['action'] = 'index.php?route=accounting/editBill';
		    	$data['document'] = $this->file('file');
		    	$data['type_bill'] = $type_bill;

		    	// if (
		    	// 	($type_bill!='theCost'&&$type_bill!='withholdingTax'&&empty($data['bill']['doc_no'])) ||
		    	// 	($type_bill=='theCost'&&empty($data['bill']['withholdingTax_doc_no'])) ||
		    	// 	($type_bill=='withholdingTax'&&empty($data['bill']['theCost_doc_no']))
		    	// ) {
			    	// $model_accounting = $this->model('accounting');
			    	// $nobill = (int)$model_accounting->getBillCount(array('id_company'=>id_company()))['count_'.$type_bill]+1;
			    	// if ($type_bill=='theCost') {
			    	// 	$data['bill']['theCost_doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
			    	// } else if ($type_bill=='withholdingTax') {
			    	// 	$data['bill']['withholdingTax_doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
			    	// } else {
			    	// 	$data['bill']['doc_no'] = $this->doc_no($type_bill).date("ymd").sprintf('%03d',$nobill);
			    	// }
		    	// }

		    	// echo '<pre>';
		    	// print_r($data);
		    	// echo '</pre>';


		    	$date_start = $data['bill']['date_start'];
		    	$ex = explode('-', $date_start);
		    	$ex[2] = (int)$ex[2] + 543;
		    	$data['bill']['date_start'] = implode('-',$ex);

		    	$date_end = $data['bill']['date_end'];
		    	$ex = explode('-', $date_end);
		    	$ex[2] = (int)$ex[2] + 543;
		    	$data['bill']['date_end'] = implode('-',$ex);
				
	 	    	if($type_bill=='theCost'){
	 	    		$this->view('accounting/formBillTheCost',$data);
	 	    	}elseif($type_bill=='withholdingTax'){
	 	    		$this->view('accounting/formBillWithholdingTax',$data);
	 	    	}else{
	 	    		$this->view('accounting/formBill',$data);
	 	    	}
	 	    }
	    }
	    public function delBill(){
	    	$result = array(); 

	    	$id = get('id');
	    	$id_company = id_company();
	    	$id_user = id_user();
	    	$type_bill = get('typeBill');
	    	$id_bill = decrypt($id);
	    	if(method_post()){
	    		$accounting = $this->model('accounting');
	    		$data_del = array(
	    			'type_bill' => $type_bill,
	    			'id_bill'	=> $id_bill,
	    			'id_company'=> $id_company
	    		);
	    		$result= $accounting->delBill($data_del);
	    	}
	    	$this->json($result);
	    }
	    public function billWithholdingTaxDataPost(){
	    	$result = array();
	    	$type_bill 		= (post('type_bill')?post('type_bill'):'');
	    	if(empty($type_bill)){
	    		exit();
	    	}
    		$id_user 		= id_user();
    		$arr_data 		= array();

    		// $theCost_date 		= (post('theCost_date')?post('theCost_date'):array());
    		// $theCost_detail 	= (post('theCost_detail')?post('theCost_detail'):array());
    		// $theCost_price 		= (post('theCost_price')?post('theCost_price'):array());
    		// $theCost_remark 	= (post('theCost_remark')?post('theCost_remark'):array());

    		$sum_total_price = 0;
    		$file_name 		= time().'_'.rand(0,100).'.pdf';
    		$id_company 	= id_company();
    		$arr_data_html = array();
    		$arr_detail = array();
    		// foreach($theCost_date as $key => $val){
    		// 	$sum_total_price += (float)$theCost_price[$key];
    		// 	$arr_detail[] = array(
    		// 		'theCost_date' 		=> $val,
    		// 		'theCost_detail' 	=> $theCost_detail[$key],
    		// 		'theCost_price' 	=> $theCost_price[$key],
    		// 		'theCost_remark' 	=> $theCost_remark[$key],
    		// 	);
    		// }
    		$id_bill = post('id_bill');
    		$id_bill = decrypt($id_bill);

    		$company_model = $this->model('company');
    		$company_info = $company_model->getCompany();

    		$data_bill = array(
				'type'                           => $type_bill,
				'id_bill'                        => $id_bill,
				'file_name'                      => $file_name,
				'id_user'                        => $id_user,
				'id_company'                     => $id_company,
				'id_customer'                    => (post('customer')?post('customer'):''),
				'withholdingTax_price'           => $sum_price,
				'withholdingTax_tax'             => $sum_tax,
				'withholdingTax_date'            => post('withholdingTax_date'),
				'withholdingTax_doc_no'          => (post('withholdingTax_doc_no')?post('withholdingTax_doc_no'):''),
				'withholdingTax_id_no_1'         => $company_info['company_tax_no'],
				'withholdingTax_id_name_1'       => $company_info['company_name'],
				'withholdingTax_id_address_1'    => $company_info['company_address'],
				'withholdingTax_id_no_2'         => (post('withholdingTax_id_no_2')?post('withholdingTax_id_no_2'):''),
				'withholdingTax_id_name_2'       => (post('withholdingTax_id_name_2')?post('withholdingTax_id_name_2'):''),
				'withholdingTax_id_address_2'    => (post('withholdingTax_id_address_2')?post('withholdingTax_id_address_2'):''),
				'withholdingTax_date_tax_1'      => (post('withholdingTax_date_tax_1')?post('withholdingTax_date_tax_1'):''),
				'withholdingTax_price_1'         => (post('withholdingTax_price_1')?post('withholdingTax_price_1'):''),
				'withholdingTax_tax_1'           => (post('withholdingTax_tax_1')?post('withholdingTax_tax_1'):''),
				'withholdingTax_date_tax_2'      => (post('withholdingTax_date_tax_2')?post('withholdingTax_date_tax_2'):''),
				'withholdingTax_price_2'         => (post('withholdingTax_price_2')?post('withholdingTax_price_2'):''),
				'withholdingTax_tax_2'           => (post('withholdingTax_tax_2')?post('withholdingTax_tax_2'):''),
				'withholdingTax_date_tax_3'      => (post('withholdingTax_date_tax_3')?post('withholdingTax_date_tax_3'):''),
				'withholdingTax_price_3'         => (post('withholdingTax_price_3')?post('withholdingTax_price_3'):''),
				'withholdingTax_tax_3'           => (post('withholdingTax_tax_3')?post('withholdingTax_tax_3'):''),
				'withholdingTax_date_tax_4'      => (post('withholdingTax_date_tax_4')?post('withholdingTax_date_tax_4'):''),
				'withholdingTax_price_4'         => (post('withholdingTax_price_4')?post('withholdingTax_price_4'):''),
				'withholdingTax_tax_4'           => (post('withholdingTax_tax_4')?post('withholdingTax_tax_4'):''),
				'withholdingTax_date_tax_5'      => (post('withholdingTax_date_tax_5')?post('withholdingTax_date_tax_5'):''),
				'withholdingTax_price_5'         => (post('withholdingTax_price_5')?post('withholdingTax_price_5'):''),
				'withholdingTax_tax_5'           => (post('withholdingTax_tax_5')?post('withholdingTax_tax_5'):''),
				'withholdingTax_other'           => (post('withholdingTax_other')?post('withholdingTax_other'):''),
				'withholdingTax_date_tax_6'      => (post('withholdingTax_date_tax_6')?post('withholdingTax_date_tax_6'):''),
				'withholdingTax_price_6'         => (post('withholdingTax_price_6')?post('withholdingTax_price_6'):''),
				'withholdingTax_tax_6'           => (post('withholdingTax_tax_6')?post('withholdingTax_tax_6'):''),
				'withholdingTax_no'              => (post('withholdingTax_no')?post('withholdingTax_no'):''),
				'withholdingTax_chk1'            => (post('withholdingTax_chk1')?post('withholdingTax_chk1'):''),
				'withholdingTax_chk2'            => (post('withholdingTax_chk2')?post('withholdingTax_chk2'):''),
				'withholdingTax_chk3'            => (post('withholdingTax_chk3')?post('withholdingTax_chk3'):''),
				'withholdingTax_chk4'            => (post('withholdingTax_chk4')?post('withholdingTax_chk4'):''),
				'withholdingTax_chk5'            => (post('withholdingTax_chk5')?post('withholdingTax_chk5'):''),
				'withholdingTax_chk6'            => (post('withholdingTax_chk6')?post('withholdingTax_chk6'):''),
				'withholdingTax_chk7'            => (post('withholdingTax_chk7')?post('withholdingTax_chk7'):''),
				'withholdingTax_chk8'            => (post('withholdingTax_chk8')?post('withholdingTax_chk8'):''),
				'withholdingTax_chk9'            => (post('withholdingTax_chk9')?post('withholdingTax_chk9'):''),
				'withholdingTax_chk10'           => (post('withholdingTax_chk10')?post('withholdingTax_chk10'):''),
				'withholdingTax_chk10_other'     => (post('withholdingTax_chk10_other')?post('withholdingTax_chk10_other'):''),
				'withholdingTax_price_security'  => (post('withholdingTax_price_security')?post('withholdingTax_price_security'):''),
				'withholdingTax_no_account_boss' => (post('withholdingTax_no_account_boss')?post('withholdingTax_no_account_boss'):''),
				'withholdingTax_no_insurance'    => (post('withholdingTax_no_insurance')?post('withholdingTax_no_insurance'):''),
				'withholdingTax_signed'          => (post('withholdingTax_signed')?post('withholdingTax_signed'):''),

    		);
			$sum_price = $data_bill['withholdingTax_price_1'] + $data_bill['withholdingTax_price_2'] + $data_bill['withholdingTax_price_3'] + $data_bill['withholdingTax_price_4'] + $data_bill['withholdingTax_price_5'] + $data_bill['withholdingTax_price_6'];
			$sum_tax = $data_bill['withholdingTax_tax_1'] + $data_bill['withholdingTax_tax_2'] + $data_bill['withholdingTax_tax_3'] + $data_bill['withholdingTax_tax_4'] + $data_bill['withholdingTax_tax_5'] + $data_bill['withholdingTax_tax_6'];
    		// $arr_data_html = $arr_detail;
    		// foreach($arr_data_html as $key => $value){
    		// 	$arr_data_html[$key]['theCost_date'] 	= $arr_data_html[$key]['theCost_date'];
	    	// 	$arr_data_html[$key]['theCost_detail'] 	= $arr_data_html[$key]['theCost_detail'];
	    	// 	$arr_data_html[$key]['theCost_price'] 	= $arr_data_html[$key]['theCost_price'];
	    	// 	$arr_data_html[$key]['theCost_remark'] 	= $arr_data_html[$key]['theCost_remark'];
    		// }
    		// $html_data = data_to_html($arr_data_html);
			
			$replace = array(
				'{$text_sum_tax}'					=> num2wordsThai(number_format($sum_tax,2)),
				'{$sum_price}'						=> $data_bill['sum_price'],
				'{$sum_tax}'						=> $data_bill['sum_tax'],
				'{$withholdingTax_date}'			=> $data_bill['withholdingTax_date'],
				'{$withholdingTax_doc_no}' 			=> $data_bill['withholdingTax_doc_no'],
				'{$withholdingTax_id_no_1}' 		=> $data_bill['withholdingTax_id_no_1'],
				'{$withholdingTax_id_name_1}' 		=> $data_bill['withholdingTax_id_name_1'],
				'{$withholdingTax_id_address_1}' 	=> $data_bill['withholdingTax_id_address_1'],
				'{$withholdingTax_id_no_2}' 		=> $data_bill['withholdingTax_id_no_2'],
				'{$withholdingTax_id_name_2}' 		=> $data_bill['withholdingTax_id_name_2'],
				'{$withholdingTax_id_address_2}' 	=> $data_bill['withholdingTax_id_address_2'],
				'{$withholdingTax_date_tax_1}' 		=> $data_bill['withholdingTax_date_tax_1'],
				'{$withholdingTax_price_1}' 		=> $data_bill['withholdingTax_price_1'],
				'{$withholdingTax_tax_1}' 			=> $data_bill['withholdingTax_tax_1'],
				'{$withholdingTax_date_tax_2}'	 	=> $data_bill['withholdingTax_date_tax_2'],
				'{$withholdingTax_price_2}' 		=> $data_bill['withholdingTax_price_2'],
				'{$withholdingTax_tax_2}' 			=> $data_bill['withholdingTax_tax_2'],
				'{$withholdingTax_date_tax_3}' 		=> $data_bill['withholdingTax_date_tax_3'],
				'{$withholdingTax_price_3}' 		=> $data_bill['withholdingTax_price_3'],
				'{$withholdingTax_tax_3}' 			=> $data_bill['withholdingTax_tax_3'],
				'{$withholdingTax_date_tax_4}' 		=> $data_bill['withholdingTax_date_tax_4'],
				'{$withholdingTax_price_4}' 		=> $data_bill['withholdingTax_price_4'],
				'{$withholdingTax_tax_4}' 			=> $data_bill['withholdingTax_tax_4'],
				'{$withholdingTax_date_tax_5}' 		=> $data_bill['withholdingTax_date_tax_5'],
				'{$withholdingTax_price_5}' 		=> $data_bill['withholdingTax_price_5'],
				'{$withholdingTax_tax_5}' 			=> $data_bill['withholdingTax_tax_5'],
				'{$withholdingTax_other}' 			=> $data_bill['withholdingTax_other'],
				'{$withholdingTax_date_tax_6}' 		=> $data_bill['withholdingTax_date_tax_6'],
				'{$withholdingTax_price_6}' 		=> $data_bill['withholdingTax_price_6'],
				'{$withholdingTax_tax_6}' 			=> $data_bill['withholdingTax_tax_6'],
				'{$withholdingTax_no}' 				=> $data_bill['withholdingTax_no'],
				'{$withholdingTax_chk1}' 			=> ($data_bill['withholdingTax_chk1']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk2}' 			=> ($data_bill['withholdingTax_chk2']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk3}' 			=> ($data_bill['withholdingTax_chk3']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk4}' 			=> ($data_bill['withholdingTax_chk4']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk5}' 			=> ($data_bill['withholdingTax_chk5']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk6}' 			=> ($data_bill['withholdingTax_chk6']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk7}' 			=> ($data_bill['withholdingTax_chk7']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk8}' 			=> ($data_bill['withholdingTax_chk8']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk9}' 			=> ($data_bill['withholdingTax_chk9']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk10}' 			=> ($data_bill['withholdingTax_chk10']?'<div class="checkbox">X</div>':'<div class="checkbox"></div>'),
				'{$withholdingTax_chk10_other}' 	=> $data_bill['withholdingTax_chk10_other'],
				'{$withholdingTax_price_security}' 	=> $data_bill['withholdingTax_price_security'],
				'{$withholdingTax_no_account_boss}' => $data_bill['withholdingTax_no_account_boss'],
				'{$withholdingTax_no_insurance}' 	=> $data_bill['withholdingTax_no_insurance'],
				'{$withholdingTax_signed}' 			=> $data_bill['withholdingTax_signed'],
			);
			$type = $type_bill;
			$theme = 1;
			$path = '';
	    	if($type=='withholdingTax'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/withholdingtax/w1';
	    		}
	    	}

	    	$html = $this->getHtmlFilePDF($path,$replace);
	    	// $html = $this->getHtmlPDF('accounting/template&type='.$type_bill.'&theme=1',$replace);
	    	$path_dir = DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill;
	    	if (!file_exists($path_dir)) {
			    mkdir($path_dir, 0777, true);
			}
	    	$data_pdf = array(
	    		'file_name' => $file_name,
	    		'path' 		=> DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill.'/'.$file_name
	    	);
	    	$result_pdf = $this->downloadPdf($html,$data_pdf);

	    	$data_bill['size'] = (isset($result_pdf['size'])?$result_pdf['size']:0);
	    	$data_bill['type_bill'] = $type_bill;
	    	$result = $data_bill;
	    	return $result;
	    }
	    public function billTheCostDataPost(){
	    	$result = array();
	    	$type_bill 		= (post('type_bill')?post('type_bill'):'');
	    	if(empty($type_bill)){
	    		exit();
	    	}
    		$id_user 		= id_user();
    		$arr_data 		= array();

    		$theCost_date 		= (post('theCost_date')?post('theCost_date'):array());
    		$theCost_detail 	= (post('theCost_detail')?post('theCost_detail'):array());
    		$theCost_price 		= (post('theCost_price')?post('theCost_price'):array());
    		$theCost_remark 	= (post('theCost_remark')?post('theCost_remark'):array());

    		$sum_total_price = 0;
    		$file_name 		= time().'_'.rand(0,100).'.pdf';
    		$id_company 	= id_company();
    		$arr_data_html = array();
    		$arr_detail = array();
    		foreach($theCost_date as $key => $val){
    			$sum_total_price += (float)$theCost_price[$key];
    			$arr_detail[] = array(
    				'theCost_date' 		=> $val,
    				'theCost_detail' 	=> $theCost_detail[$key],
    				'theCost_price' 	=> $theCost_price[$key],
    				'theCost_remark' 	=> $theCost_remark[$key],
    			);
    		}
    		$id_bill = post('id_bill');
    		$id_bill = decrypt($id_bill);

    		$company_model = $this->model('company');
    		$company_info = $company_model->getCompany();


    		$data_bill = array(
    			'type' 					=> $type_bill,
    			'id_bill'				=> $id_bill,
    			'file_name'				=> $file_name,
    			'id_user'				=> $id_user,
    			'id_company'			=> $id_company,
    			'price'					=> (float)$sum_total_price,
    			'detail'				=> $arr_detail,
    			'theCost_date'			=> (post('theCost_date_head')?post('theCost_date_head'):''),	
				'theCost_doc_no'		=> (post('theCost_doc_no')?post('theCost_doc_no'):''),	
				'theCost_name'			=> (post('theCost_name')?post('theCost_name'):''),	
				'theCost_position'		=> (post('theCost_position')?post('theCost_position'):''),	
				'theCost_text'			=> $company_info['company_name'],	
				'theCost_date_start'	=> (post('theCost_date_start')?post('theCost_date_start'):''),	
				'theCost_date_end'		=> (post('theCost_date_end')?post('theCost_date_end'):''),	
				'theCost_name_pay'		=> (post('theCost_name_pay')?post('theCost_name_pay'):''),	
				'theCost_name_approved'	=> (post('theCost_name_approved')?post('theCost_name_approved'):''),	
				'theCost_accounting'	=> (post('theCost_accounting')?post('theCost_accounting'):''),	
				'theCost_price'			=> $sum_total_price,		
    		);
    		$arr_data_html = $arr_detail;
    		$page = floor(count($arr_data_html)/10)+1;
    		foreach($arr_data_html as $key => $value){
    			$arr_data_html[$key]['theCost_date'] 	= $arr_data_html[$key]['theCost_date'];
	    		$arr_data_html[$key]['theCost_detail'] 	= $arr_data_html[$key]['theCost_detail'];
	    		$arr_data_html[$key]['theCost_price'] 	= $arr_data_html[$key]['theCost_price'];
	    		$arr_data_html[$key]['theCost_remark'] 	= $arr_data_html[$key]['theCost_remark'];
    		}
    		// $html_data = data_to_html($arr_data_html);

    		$company = $this->model('company');
    		$data_company = array(
    			'id_company' => $id_company
    		);
    		$company_detail = $company->companyDetail($data_company);
			$company_logo = (!empty($company_detail['company_logo'])?'<img src="'.DOCUMENT_ROOT.'uploads/'.$company_detail['company_logo'].'" width="100">':'');

			$replace = array(
			  	// '{$row_data}' 				=> $html_data,
			  	'{$theCost_date_head}'			=> $data_bill['theCost_date'],
				'{$price}'					=> $data_bill['price'],
				'{$theCost_doc_no}'			=> $data_bill['theCost_doc_no'],
				'{$theCost_name}'			=> $data_bill['theCost_name'],
				'{$theCost_position}'		=> $data_bill['theCost_position'],
				'{$theCost_text}'			=> $data_bill['theCost_text'],
				'{$theCost_date_start}'		=> $data_bill['theCost_date_start'],
				'{$theCost_date_end}'		=> $data_bill['theCost_date_end'],
				'{$theCost_name_pay}'		=> $data_bill['theCost_name_pay'],
				'{$theCost_name_approved}'	=> $data_bill['theCost_name_approved'],
				'{$theCost_accounting}'		=> $data_bill['theCost_accounting'],
				'{$text_sum_total_price}' 	=> num2wordsThai(number_format($sum_total_price,2)),
				'{$sum_total_price}' 		=> number_format($sum_total_price,2),

		  		'{$company_name}'				=> $company_detail['company_name'],
		  		'{$company_name_en}'			=> $company_detail['company_name_en'],
		  		'{$company_address}'			=> $company_detail['company_address'],
		  		'{$company_tel}'				=> (!empty($company_detail['company_tel'])?'โทร: '.$company_detail['company_tel']:''),
		  		'{$company_tax_no}'			=> (!empty($company_detail['company_tax_no'])?'เลขประจำตัวผู้เสียภาษี: '.$company_detail['company_tax_no']:''),
				'{$company_logo}'				=> $company_logo,
			);
			$type = $type_bill;
			$theme = 1;
			$path = '';
	    	if($type=='theCost'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/thecost/c1';
	    		}
	    	}
	    	$new_data_page = array_chunk($arr_data_html, 10);
	    	// echo $page;exit();
	    	// var_dump($new_data_page);exit();
		    // $genarate_html = '';
		    $html = '';
		    for($i=0;$i<$page;$i++){
		    	$html_data = data_to_html($new_data_page[$i]);
		    	$replace['{$row_data}'] = $html_data;
		    	$replace['{$page}'] = ($i+1);
		    	$replace['{$total_page}'] = $page;
		    	$html .= $this->getHtmlFilePDF($path,$replace);
		    }
	    	// $html = $this->getHtmlFilePDF($path,$replace);
	    	// $html = $this->getHtmlPDF('accounting/template&type='.$type_bill.'&theme=1',$replace);

	    	$path_dir = DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill;
	    	if (!file_exists($path_dir)) {
			    mkdir($path_dir, 0777, true);
			}
	    	$data_pdf = array(
	    		'file_name' => $file_name,
	    		'path' 		=> DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill.'/'.$file_name
	    	);
	    	$result_pdf = $this->downloadPdf($html,$data_pdf);

	    	$data_bill['size'] = (isset($result_pdf['size'])?$result_pdf['size']:0);
	    	$data_bill['type_bill'] = $type_bill;
	    	$result = $data_bill;
	    	return $result;
	    }
	    public function billDataPost(){

	    	$result = array();
	    	$type_bill 		= (post('type_bill')?post('type_bill'):'');
	    	if(empty($type_bill)){
	    		exit();
	    	}
    		$id_user 		= id_user();
    		$arr_data 		= array();
    		$seq 			= (post('seq')?post('seq'):array());
    		$product_code 	= (post('product_code')?post('product_code'):array());
    		$product 		= (post('product')?post('product'):array());
    		$no 			= (post('no')?post('no'):array());
    		$unit 			= (post('unit')?post('unit'):array());
    		$price 			= (post('price')?post('price'):array());
    		$sum_total_price = 0;
    		$file_name 		= time().'_'.rand(0,100).'.pdf';
    		$id_company 	= id_company();
    		$arr_data_html = array();
    		$arr_detail = array();
    		foreach($seq as $key => $val){
    			$no_cal 	= (float)$no[$key];
    			$price_cal 	= (float)$price[$key];
    			$total_price = ($no_cal * $price_cal);
    			$sum_total_price += $total_price; 

    			$arr_detail[] = array(
    				'seq' 			=> $val, 
    				'product_code' 	=> $product_code[$key],
    				'product' 		=> $product[$key],
    				'no' 			=> $no[$key], 
    				'unit' 			=> $unit[$key],
    				'price' 		=> $price[$key],
    				'total'			=> $total_price
    			);
    		}
    		$id_bill = post('id_bill');
    		$id_bill = decrypt($id_bill);
    		$date_start = date_f(post('date_start'),'d-m-Y');
    		$ex = explode('-',$date_start);
    		$ex[2] = $ex[2]-543;
    		$new = array();
    		for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
    		$date_start = implode('-', $new);
    		$date_end = date_f(post('date_end'),'d-m-Y');
    		$ex = explode('-',$date_end);
    		$ex[2] = $ex[2]-543;
    		$new = array();
    		for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
    		$date_end = implode('-', $new);
    		$data_bill = array(
    			'type' 					=> $type_bill,
    			'id_bill'				=> $id_bill,
    			'file_name'				=> $file_name,
    			'id_user'				=> $id_user,
    			'id_company'			=> $id_company,
    			'customer' 				=> post('customer'),
    			'doc_no'				=> post('doc_no'),
    			'ref'					=> post('ref'),
    			'date_start'			=> $date_start,
    			'date_end'				=> $date_end,
    			'term'					=> post('term'),
    			'condition'				=> post('condition'),
    			'price'					=> (float)$sum_total_price,
    			'detail'				=> $arr_detail,
    			// 'type' 					=> post('type'),
				
				'customer_address' 		=> post('customer_address'),
				'customer_tax' 			=> post('customer_tax_no'),
				'customer_branch' 		=> post('customer_branch_no'),
				'customer_name' 		=> post('customer_name'),
				'customer_phone' 		=> post('customer_phone'),
				'customer_email' 		=> post('customer_email'),
				'customer_project' 		=> post('customer_project'),

				'rdoVat' 				=> post('rdoVat'),
				'remark' 				=> post('remark'),
				'sum_bill' 				=> post('input_sum_bill'),
				'percent_discount' 		=> post('percent_discount'),
				'text_discount'			=> post('input_text_discount'),
				'text_discount_total' 	=> post('input_text_discount_total'),
				'check_vat' 			=> post('select_check_vat'),
				'text_vat' 				=> post('input_text_vat'),
				'text_not_include_vat' 	=> post('input_text_not_include_vat'),
				'chk_tax'				=> post('chk_tax'),
				'check_tax' 			=> post('select_check_tax'),
				'total_tax' 			=> post('input_total_tax'),
				'net_total_vat' 		=> post('input_net_total_vat')
    		);
    		$arr_data_html = $arr_detail;
    		$page = floor(count($arr_data_html)/ROW_IN_DOC)+1;
    		foreach($arr_data_html as $key => $value){
    			$arr_data_html[$key]['no'] 		= number_format((float)$arr_data_html[$key]['no'],2);
	    		$arr_data_html[$key]['price'] 	= number_format((float)$arr_data_html[$key]['price'],2);
	    		$arr_data_html[$key]['total'] 	= number_format((float)$arr_data_html[$key]['total'],2);
    		}
    		
    		$company = $this->model('company');
    		$data_company = array(
    			'id_company' => $id_company
    		);
    		$company_detail = $company->companyDetail($data_company);

    		// $customer_branch_no = '<img src="assets/images/'.(post('customer_branch_no')?'check2':'check').'.png" width="25"> สำนักงานใหญ่  <img src="assets/images/'.(post('customer_branch_no')?'check':'check2').'.png" width="25"> สาขาที่'.post('customer_branch_no');
    		$customer_branch_no = 'สาขาที่ '.(post('customer_branch_no')?post('customer_branch_no'):'สำนักงานใหญ่');

    		$input_sum_bill 			= (post('input_sum_bill')?post('input_sum_bill'):0);
			$input_text_discount 		= (post('input_text_discount')?post('input_text_discount'):0);
			$select_check_vat 			= (post('select_check_vat')?post('select_check_vat'):0);
			$select_check_tax 			= (post('select_check_tax')?post('select_check_tax'):0);
			$text_not_include_vat 		= (post('text_not_include_vat')?post('text_not_include_vat'):0);
			$input_text_discount_total 	= (post('input_text_discount_total')?post('input_text_discount_total'):0);
			$input_total_tax			= (post('input_total_tax')?post('input_total_tax'):0);
			$total_tax 					= (post('total_tax')?post('total_tax'):0);
			$input_net_total_vat 		= (post('input_net_total_vat')?post('input_net_total_vat'):0);
			$check_tax 					= (post('check_tax')?post('check_tax'):0);
			$input_text_vat 			= (post('input_text_vat')?post('input_text_vat'):0);
			$percent_discount 			= (post('percent_discount')?post('percent_discount'):0);
			$text_money 				= (post('text_money')?post('text_money'):0);

			$company_logo = (!empty($company_detail['company_logo'])?'<img src="'.DOCUMENT_ROOT.'uploads/'.$company_detail['company_logo'].'" width="150">':'');

			$model_customer = $this->model('customer');
			$customer_info = $model_customer->getCustomer(post('customer'));

			$replace = array(
				'{$remark}'                    => post('remark'),
				'{$condition}'                 => post('condition'),
				'{$term}'                      => post('term'),

				'{$input_sum_bill}'            => number_format($input_sum_bill,2),//number_format(,2),
				'{$input_text_discount}'       => number_format($input_text_discount,2),
				'{$select_check_vat}'          => number_format($select_check_vat),
				'{$select_check_tax}'          => number_format($select_check_tax),
				'{$text_not_include_vat}'      => number_format((float)$text_not_include_vat,2),
				'{$input_text_discount_total}' => number_format($input_text_discount_total,2),
				'{$total_tax}'                 => number_format($input_total_tax,2),
				'{$input_net_total_vat}'       => number_format($input_net_total_vat,2),
				'{$check_tax}'                 => post('check_tax'),
				'{$input_text_vat}'            => number_format($input_text_vat,2),
				'{$percent_discount}'          => number_format($percent_discount),
				'{$text_money}'                => num2wordsThai(number_format($input_net_total_vat,2)),

				'{$company_name}'              => $company_detail['company_name'],
				'{$company_name_en}'           => $company_detail['company_name_en'],
				'{$company_address}'           => $company_detail['company_address'],
				'{$company_tel}'               => (!empty($company_detail['company_tel'])?'โทร: '.$company_detail['company_tel']:''),
				'{$company_tax_no}'            => (!empty($company_detail['company_tax_no'])?'เลขประจำตัวผู้เสียภาษี: '.$company_detail['company_tax_no']:''),
				'{$company_logo}'              => $company_logo,

				'{$customer_address}'          => post('customer_address'),
				'{$customer_tax_no}'           => post('customer_tax_no'),
				'{$customer_company}'          => $customer_info['customer_company'],
				'{$customer_branch_no}'        => $customer_branch_no,
				'{$customer_name}'             => post('customer_name'),
				'{$customer_phone}'            => post('customer_phone'),
				'{$customer_email}'            => post('customer_email'),
				'{$customer_project}'          => post('customer_project'),
				'{$customer}'                  => post('customer'),
				'{$customer_credit}'           => post('customer_credit'),

				'{$doc_no}'                    => post('doc_no'),
				'{$ref}'                       => post('ref'),
				'{$date_start}'                => post('date_start'),
				'{$date_end}'                  => post('date_end'),
				'{$term}'                      => post('term'),
				'{$condition}'                 => post('condition'),
				'{$price}'                     => (float)$sum_total_price,
			);

			$type = $type_bill;
			$theme = 1;
			$path = '';
	    	if($type=='quotation'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/quotation/q1';
	    		}
	    	}else if($type=='billingnote'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/billingnote/b1';
	    		}
	    	}else if($type=='receipt'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/receipt/r1';
	    		}
	    	}else if($type=='purchaseOrder'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/purchaseorder/p1';
	    		}
	    	}else if($type=='productReceipt'){
	    		if($theme==1){
			    	$path = 'mep/catalog/view/theme/accounting/template/productreceipt/p1';
	    		}
	    	}
	    	$new_data_page = array_chunk($arr_data_html, 10);
	    	// echo $page;exit();
	    	// var_dump($new_data_page);exit();
		    // $genarate_html = '';
		    $html = '';
		    for($i=0;$i<$page;$i++){
		    	$html_data = data_to_html($new_data_page[$i]);
		    	$replace['{$row_data}'] = $html_data;
		    	$replace['{$page}'] = ($i+1);
		    	$replace['{$total_page}'] = $page;
		    	$html .= $this->getHtmlFilePDF($path,$replace);
		    }
		    // var_dump($html);exit();
	    	$path_dir = DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill.'/';
	    	if (!file_exists($path_dir)) {
			    mkdir($path_dir, 0777, true);
			}
	    	$data_pdf = array(
	    		'file_name' => $file_name,
	    		'path' 		=> DOCUMENT_ROOT.'uploads/'.id_company().'/'.$type_bill.'/'.$file_name 
	    	);
	    	
	    	$result_pdf = $this->downloadPdf($html,$data_pdf);
	    	$data_bill['size'] = $result_pdf['size'];
	    	$data_bill['type_bill'] = $type_bill;
	    	$result = $data_bill;
	    	return $result;
	    }
	    public function listTableBill($type_bill='',$title=''){
	    	$data = array();
	    	$data['title'] = $title;
	    	$style = array(
	    		'assets/css/accounting/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/accounting/main.js?a='.time()
	    	);
	    	$data['script'] = $script;
	    	$id_company = id_company();
	    	$bill = $this->model('accounting');
	    	

	    	$page = (get('page')?get('page'):1);
	    	$search = (get('search')?get('search'):'');
	    	$data['action'] = route('accounting/'.$type_bill.'&page='.$page.'&search='.$search);
	    	$data['route']	= 'accounting/'.$type_bill;
	    	$data['search'] = $search;
	    	$data_select_bill = array(
	    		'type' 			=> $type_bill,
	    		'id_company' 	=> $id_company,
	    		'limit'			=> limit($page,DEFAULT_LIMIT_PAGE),
	    		'search'		=> $search
	    	);
	    	$result_list = $bill->getListBill($data_select_bill);
	    	foreach ( $result_list['list'] as $key => $list ) {
	    		$ex = explode('-',$list['date']);
	    		$ex[2] = $ex[2]+543;
	    		$result_list['list'][$key]['date'] = implode('-',$ex);
	    	} 
	    	$data['bill_list'] = $result_list['list'];

	    	$group_bill = array(
	    		'sell' => array(
	    			'quotation',
	    			'billingnote',
	    			'receipt'
	    		),
	    		'buy' => array(
	    			'purchaseOrder',
	    			'productReceipt',
	    		),
	    		'pay' => array(
	    			'theCost',
	    			'withholdingTax'
	    		)
	    	);
	    	$data['group_bill'] = '';
	    	foreach ($group_bill as $group => $arr) {
	    		if (in_array($type_bill, $arr)==true) {
	    			$data['group_bill'] = $group;
	    		}
	    	}

	    	// var_dump($data['bill_list']);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
	    	$breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/'.$type_bill));
	    	$breadcrumb[] = array('text'=>$data['title'],'url'=>'','active'=>1);

	    	$pageing = array(
	    		'total' => $result_list['num_rows'],
	    		'link'	=> route('accounting/'.$type_bill.'&page='.$page),
	    		'active'=> $page
	    	);
	    	$data['type_bill'] 	= $type_bill;
	    	$data['pageing'] 	= pageing($pageing);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$get_menu = array(0,1,2,3,4,5,6,7);
	    	$data['headerMenu'] = $this->getMenu($type_bill,$get_menu);
 	    	$this->view('accounting/listBill',$data);
	    }
	    public function doc_no($type_bill) {
	    	$doc_no = array();
			$doc_no['quotation']      = 'QT';
			$doc_no['billingnote']    = 'BN';
			$doc_no['receipt']        = 'RC';
			$doc_no['purchaseorder']  = 'PO';
			$doc_no['productreceipt'] = 'PR';
			$doc_no['thecost']        = 'C';
			$doc_no['withholdingtax'] = 'WT';
			$return = '';
			foreach ($doc_no as $key => $value) {
				if (strtolower($type_bill)==$key) {
					$return = $value;
				}	
			}
			return $return;
			
	    }
	    public function quotation(){
	    	$type_bill = 'quotation';
	    	$title = 'ใบเสนอราคา';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function billingnote(){
	    	$type_bill = 'billingnote';
	    	$title = 'ใบวางบิล/ใบแจ้งหนี้/ใบส่งของ';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function receipt(){
	    	$type_bill = 'receipt';
	    	$title = 'ใบเสร็จรับเงิน';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function purchaseOrder(){
	    	$type_bill = 'purchaseOrder';
	    	$title = 'ใบสั่งซื้อ';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function productReceipt(){
	    	$type_bill = 'productReceipt';
	    	$title = 'ใบรับสินค้า';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function theCost(){
	    	$type_bill = 'theCost';
	    	$title = 'ค่าใช้จ่าย';
	    	$get_menu = array(0,6,7);
	    	$data['headerMenu'] = $this->getMenu('home',$get_menu);
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function withholdingTax(){
	    	$type_bill = 'withholdingTax';
	    	$title = 'ใบหักภาษี ณ ที่จ่าย';
	    	$this->listTableBill($type_bill,$title);
	    }
	    public function coppy(){
	    	// href="index.php?route=accounting/coppy&to=quotation&id=s2&typeBill=quotation"
	    	$data = array();
	    	$id 			= get('id');
	    	$id_company 	= id_company();
	    	$id_user 		= id_user();
	    	$type_bill 		= get('typeBill');
	    	$id_bill 		= decrypt($id);
	    	$to 			= get('to');
	    	$accounting 	= $this->model('accounting');

	    	$dataCopy 		= array(
	    		'id'		=> $id,
	    		'id_user'	=> $id_user,
	    		'id_bill'	=> $id_bill,
	    		'to'		=> $to,
	    		'type_bill'	=> $type_bill,
	    		'id_company'=> $id_company
	    	);
	    	$nobill = (int)$accounting->getBillCount(array('id_company'=>id_company()))['count_'.$to]+1;
	    	if ($type_bill=='theCost') {
	    		$dataCopy['theCost_doc_no'] = $this->doc_no($to).date("ymd").sprintf('%03d',$nobill);
	    	} else if ($type_bill=='withholdingTax') {
	    		$dataCopy['withholdingTax_doc_no'] = $this->doc_no($to).date("ymd").sprintf('%03d',$nobill);
	    	} else {
	    		$dataCopy['doc_no'] = $this->doc_no($to).date("ymd").sprintf('%03d',$nobill);
	    	}

	    	$new_id_bill_insert 	= $accounting->copy($dataCopy);
	    	$this->redirect('accounting/editBill&id='.encrypt($new_id_bill_insert,$id_company).'&typeBill='.get('to'));
	    }


	 
	    
	}
?>