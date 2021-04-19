<?php 
	class PackageController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'listPackage';
	    	$style = array(
	    		// 'assets/css/package/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		// 'assets/js/package/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$id_user = id_user();

	    	$data_package = array(
	    		'id_company' 	=> $id_company,
	    		'id_user'		=> $id_user
	    	);
	    	$package 				= $this->model('package');
	    	$data['listPackage'] 	= $package->listPackage();
	    	$getPackage 			= $package->getPackage($data_package);
	    	$getDetailCompany 		= $package->getDetailCompany($data_package);
	    	$data['detail_package'] = array();

	    	if($getPackage['result']=='success'){
	    		$data['detail_package'] = array(
	    			'name'				=> $getPackage['detail']['package_name'],
	    			'total_bill'		=> $getPackage['detail']['package_total_bill'],
	    			'total_space_mb'	=> number_format($getPackage['detail']['package_total_space_mb'],0),
	    			'total_employee'	=> $getPackage['detail']['package_total_employee'],
	    			'total_product'		=> $getPackage['detail']['package_total_product'],
	    			'total_customer'	=> $getPackage['detail']['package_total_customer']
	    		);
	    	}
	    	$data['script'] = $script;
	    	$data['headerMenu'] =$this->getMenu('home');
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'แพคเกจ','url'=>route('package/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
 	    	$this->view('package/listPackage',$data);
	    }
	    public function history(){
	    	$data = array();
	    	$data['title'] = 'listPackage';
	    	$style = array(
	    		// 'assets/css/package/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		// 'assets/js/package/main.js'
	    	);
	    	$id_company = id_company(); 
	    	$data['script'] = $script;
	    	$data['headerMenu'] = $this->getMenu('history');
	    	$package = $this->model('package');
	    	$data_history = array(
	    		'id_user' => id_user()
	    	);
	    	$data['listHistory'] = $package->listHistoryPackage($data_history);

	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ประวัติการใช้งาน','url'=>route('package/history'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
 	    	$this->view('package/history',$data);
	    }
	    public function payment(){
	    	$data = array();
	    	$id_package = get('id_package');
	    	$id_company = id_company(); 
	    	$id_user = id_user();
	    	$package 				= $this->model('package');
	    	if(method_post()){ 
	    		$payment_date = post('payment_date').' '.post('payment_time_hour').':'.post('payment_time_min');
	    		$payment_file = date('Y_m_d_H_i_s')."_".$id_user."_".rand(1000,9999).$_FILES['payment_file']['name'];

	    		$path_dir = DOCUMENT_ROOT.'uploads_payment';
		    	if (!file_exists($path_dir)) {
				    mkdir($path_dir, 0777, true);
				}
	    		$path_dir = DOCUMENT_ROOT.'uploads_payment/'.date('Y_m_d');
		    	if (!file_exists($path_dir)) {
				    mkdir($path_dir, 0777, true);
				}
				upload($_FILES['payment_file'],$path_dir.'/',$payment_file);

	    		$package_data = array(
	    			'id_package'		=> post('id_package'),
	    			'id_user'			=> $id_user,
	    			'payment_customer'	=> post('payment_customer'),
	    			'payment_bank'		=> post('payment_bank'),
	    			'payment_month'		=> post('payment_month'),
	    			'payment_price'		=> post('payment_price'),
	    			'payment_date'		=> $payment_date,
	    			'payment_file'		=> $payment_file,
	    			'id_company'		=> $id_company
	    		);
	    		$package->insertPayment($package_data);
	    		redirect('package/payment&result=success');
	    	}
	    	$data['result'] = get('result');
	    	$data['action'] = route('package/payment');
	    	$data['title'] = 'listPackage';
	    	$style = array(
		    	'assets/css/select2.css',
	    		'assets/css/accounting/home.css',
	    		'assets/boostrap_jquery/css/bootstrap-datepicker3.css',
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/js/select2.full.js',
	    		'assets/boostrap_jquery/js/bootstrap-datepicker.js',
  				'assets/boostrap_jquery/js/locales/bootstrap-datepicker.en-AU.min.js',
  				'assets/boostrap_jquery/js/jquery-ui.js'
	    	);
	    	$data['user_detail'] 	= $package->getUserDetail($id_user);
	    	$data['id_package'] 	= $id_package;
	    	
	    	$data['listPackage'] 	= $package->listPackage();
	    	
	    	$data_get_package_detail = array( 'id_package' => $id_package);
	    	$data['pricePackage']	= $package->getPackageDetail();
	    	$data['script'] = $script;
	    	$data['headerMenu'] = $this->getMenu('payment');
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'แจ้งการชำระเงินแพคเกจ','url'=>route('package/payment'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
 	    	$this->view('package/payment',$data);
	    }
	    public function getMenu($active=''){
	    	$result = '';
	    	$data = array();

	    	$id_company = id_company();
	    	$accounting = $this->model('accounting');
	    	$data_bill = array(
	    		'id_company' => $id_company
	    	);

			$link[] = 	array( 'text'		=> 	'แพคเกจ',
							 'url'		=>	route('package/home'),
							 'active'	=>	'home'
						);
			$link[] = 	array( 'text'		=> 	'ประวัติการใช้งาน',
							 'url'		=>	route('package/history'),
							 'active'	=>	'history'
						);
			$link[] = 	array( 'text'		=> 	'แจ้งการชำระเงินแพคเกจ',
							 'url'		=>	route('package/payment'),
							 'active'	=>	'payment'
						);

			$result = 	'<div class="nav-scroller bg-white shadow-sm">
							<nav class="nav nav-underline">';
				foreach($link as $key => $val){
					$result .=	'<a class="nav-link '.($val['active']==$active?'active':'').'"	href="'.$val['url'].'">'.$val['text'];
					if(!empty($val['no'])){
						$result .=	'<span class="badge badge-pill bg-light align-text-bottom">'.$val['no'].'</span>';
					}
					$result .=	'</a>';
				}
			$result .=	'	</nav>';
			$result .=	'</div>';
			return $result;


	    	// $data = array();
	    	// $data['active'] = get('active');
	    	// $this->render('package/inc/headerMenu',$data);
	    }
	    public function getpackage(){
	    	$data['title'] = 'Package Detail'; 
	    	$id_package = (int)get('id_package');

	    	$style = array(
	    		// 'assets/css/package/home.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		// 'assets/js/package/main.js'
	    	);
	    	$id_company = id_company(); 

	    	$package = $this->model('package');
	    	$data_package = array(
	    		'id_package' => $id_package
	    	);
	    	$package_detail = $package->getPackageDetail($data_package);
	    	$data['script'] = $script;
	    	$data['headerMenu'] = $this->getMenu('home');
	    	$data['package_detail'] = $package_detail;
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('package/home'));
	    	$breadcrumb[] = array('text'=>'แพคเกจ','url'=>route('package/home'));
	    	$breadcrumb[] = array('text'=>'รายละเอียดแพคเกจ','url'=>route('package/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$this->view('package/packageDetail',$data);
	    }
	}
?>