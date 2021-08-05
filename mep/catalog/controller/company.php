<?php 
	class CompanyController extends Controller {
		public function __construct() {
			// $this->checkPermission();
		}
	    public function index() {
	    	$data = array();
	    	$data['title'] = 'Company';
	    	if (!isset($_GET['id_company'])) {
	    		$this->rmSession('id_company'); 
	    	}
	    	$id_company = get('id_company');
	    	$id_user = id_user(); 
	    	$id_company = decrypt($id_company);

	    	$company = $this->model('company');
	    	$data_company = array(
	    		'id_company' => $id_company,
	    		'id_user'	 => $id_user
	    	);
	    	$company_detail = $company->companyDetail($data_company);
	    	
	    	if($company_detail){
	    		$this->setSession('encode_id_company',encode($company_detail['id_company'],$id_user));
		    	// $this->setSession('id_company',$company_detail['id_company']);
		    	$this->setSession('company_name',$company_detail['company_name']);
		    	$this->redirect('dashboard/home');
	    	}else{
		    	$this->rmSession('id_company');
		    	$this->rmSession('company_name');
	    		$this->redirect('home&result=fail');
	    	}
	    }
	    public function addCompany(){
			$data = array();
			$script = array(
	    		'assets/js/company/main.js'
	    	);
	    	$data['script'] = $script;
		    $data['title'] = 'Company';
		    $data['text_title'] = 'เพิ่มบริษัท';
		    $data['headerMenu'] = '';//$this->getHtml('accounting/getMenu&active=home');
		    $data['id_company'] 			= '';
			$data['id_user'] 				= '';
			$data['company_verify'] 		= '';
			$data['company_name'] 			= '';
			$data['company_tax_no'] 		= '';
			$data['company_logo'] 			= '';
			$data['company_tel'] 			= '';
			$data['company_address'] 		= '';
			$data['company_province'] 		= '';
			$data['company_head_office'] 	= '';
			$data['company_date_create'] 	= '';
			$data['company_url']			= '';
			$data['province'] = province();
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'บริษัท','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'เพิ่มบริษัท','url'=>'','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['result'] = '';
	    	$data['action'] = route('company/addCompany');
	    	$data['form_id'] = 'add';

	    	$data_upload = array(
	    		'name' => 'company_logo'
	    	);
	    	if(method_post()){
	    		$company = $this->model('company');
	    		$company_logo = post('company_logo');


	    		$data_insert = array(
					'id_user_create'      => id_user(),
					'company_verify'      => 0,
					'company_name'        => post('company_name'),
					'company_url'         => (empty(post('company_url'))?post('company_url'):time()),
					'company_tax_no'      => post('company_tax_no'),
					'company_tel'         => post('company_tel'),
					'company_address'     => post('company_address'),
					'company_province'    => post('company_province'),
					'company_head_office' => post('company_head_office'),
					'company_date_create' => post('company_date_create'),
					'sellstock'           => 'billingnote',
					'buystock'            => 'productReceipt',
					'shopstock'           => 1,
					'company_date_create' => date('Y-m-d H:i:s')
	    		);

	    		api(route('upload/mkdir'), 'POST', array('path'=>'/', 'name'=>id_company()));

	    		$result = $company->addCompany($data_insert);

	    		$model_user = $this->model('user');
				$insert_permis = array();
				$insert_permis['id_company'] = (int)$result;
				$insert_permis['id_user'] = id_user();
				$permissions = $this->getPermissions();
				foreach ($permissions as $class => $array) {
					foreach ($array as $key => $value) {
						$insert_permis['permission'][] = $value;	
					}
				}
				$insert_permis['permission'] = json_encode($insert_permis['permission'], JSON_UNESCAPED_UNICODE, 512);
				$model_user->addPermission($insert_permis);

				$this->makedir($result);

				$this->addDefaultData($result);
	    		
	    		if ($result>0) {
	    			$this->setSession('success','เพิ่มบริษัทเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการเพิ่มบริษัท');
	    		}
	    		redirect('home');
	    	}else{
				$this->view('company/formCompany',$data);
			}
		}
		public function addDefaultData($id_company) {
			$image = DOCUMENT_ROOT.'assets/image/logo.png';
			copy($image, DOCUMENT_ROOT.'uploads/'.$id_company.'/logo.png');

			$insert = array(
				'id_company'         => $id_company,
				'id_user'            => 0,
				'employee_code'      => '000',
				'employee_email'     => 'test@test.com',
				'employee_firstname' => 'ทดสอบ',
				'employee_lastname'  => 'ตัวอย่าง',
				'employee_salary'    => 15000,
				'employee_startwork' => date('Y-m-d', time()),
				'date_added'         => date('Y-m-d H:i:s', time())
    		);
			$model_employee = $this->model('employee');
			$model_employee->addEmp($insert);


			$model_customer = $this->model('customer');
			$insert = array(
				'id_company'     => $id_company,
				'category_code'  => '000',
				'category_name'  => 'หมวดหมู่ตัวอย่าง',
				'category_image' => '/'.$id_company.'/logo.png',
				'date_added'     => date('Y-m-d H:i:s', time())
			);
			$model_customer->addCategory($insert);
			$insert = array(
				'id_company'               => $id_company,
				'customer_type'            => 'บุคคลธรรมดา',
				'customer_contacttype'     => 1,
				'customer_credit'          => 90,
				'customer_code'            => '000',
				'customer_company'         => 'บริษัทตัวอย่าง',
				'customer_tax'             => '110101010101',
				'customer_branch'          => 'สำนักงานใหญ่',
				'customer_address'         => '11/11 bangrak bangrak bangkok 10150',
				'customer_shippingaddress' => '11/11 bangrak bangrak bangkok 10150',
				'customer_phone'           => '0222222222',
				'customer_fax'             => '0222222222',
				'customer_name'            => 'ตัวอย่าง',
				'customer_email'           => 'test@test.com',
				'customer_telephone'       => '08222222222',
				'customer_bank'            => 'ธ.กรุงเทพ',
				'customer_bankaccount'     => 'บัญชีตัวอย่าง',
				'customer_bankbranch'      => 'พระราม2',
				'customer_banktype'        => 'บัญชีออมทรัพย์',
				'date_added'               => date('Y-m-d H:i:s', time()),
				'date_modify'              => date('Y-m-d H:i:s', time())
			);
			$customer_id = $model_customer->addCustomer($insert);


			$model_product = $this->model('product');
			$insert = array(
				'id_company'    => $id_company,
				'category_code' => '000',
				'category_name' => 'ตัวอย่างหมวดหมู่',
				'date_created'  => date('Y-m-d H:i:s', time()),
				'date_updated'  => date('Y-m-d H:i:s', time()),
			);
    		$category_id = $model_product->addCategory($insert);

    		$insert = array(
				'id_company'    => $id_company,
				'werehouse_code' => '000',
				'werehouse_name' => 'ตัวอย่างคลังสินค้า',
				'date_created'  => date('Y-m-d H:i:s', time()),
				'date_updated'  => date('Y-m-d H:i:s', time()),
			);
    		$werehouse_id = $model_product->addWerehouse($insert);

			
    		$insert = array(
				'id_company'       => $id_company,
				'id_category'      => $category_id,
				'id_werehouse'     => $werehouse_id,
				'product_name'     => 'สินค้าตัวอย่าง',
				'product_quantity' => 100,
				'product_unit'     => 'อัน',
				'product_special'  => 99,
				'product_price'    => 120,
				'product_detail'   => 'รายละเอียดสินค้า',
				'product_code'     => '000',
				'product_image'    => '/'.$id_company.'/logo.png',
				'product_status'   => 1,
				'date_created'     => date('Y-m-d H:i:s', time()),
				'date_updated'     => date('Y-m-d H:i:s', time()),
			);
    		$product_id = $model_product->addProduct($insert);

    		$model_company = $this->model('company');
    		$editCompany = array(
				'id_company'   => $id_company,
				'company_logo' => '/'.$id_company.'/logo.png'
    		);
    		$model_company->editCompany($editCompany);

    		$model_setting = $this->model('setting');
    		$insert = array(
				'id_company'                        => id_company(),
				'setting_bill_prefix'               => 0,
				'setting_bill_count_quotation'      => 0,
				'setting_bill_count_billingnote'    => 0,
				'setting_bill_count_receipt'        => 0,
				'setting_bill_count_purchaseOrder'  => 0,
				'setting_bill_count_productReceipt' => 0,
				'setting_bill_count_theCost'        => 0,
				'setting_bill_count_withholdingTax' => 0
    		);
    		$model_setting->addSetting($insert);

    		$insert = array(
				'id_company' => $id_company,
				'pos_name'   => 'ร้านตัวอย่าง',
				'pos_no'     => '0000000',
				'pos_status' => 1
    		);
    		$model_setting->addPos($insert);
    		
		}
		public function editCompany(){
			$data = array();
			$script = array(
	    		'assets/js/company/main.js'
	    	);
	    	$data['script'] = $script;
	    	$breadcrumb = array();
	    	$data['province'] = province();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'บริษัท','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'แก้ไขบริษัท','url'=>'','active'=>1);
	    	$data['text_title'] = 'แก้ไขบริษัท';
	    	$id_company = get('id_company');
	    	$id_user = id_user();
	    	$id_company = (int)decrypt($id_company,$id_user);
	    	// echo $id_company;exit();
	    	// echo $id_company.' '.$id_user;
	    	$data['form_id'] = 'edit';
	    	$data['result'] 				= '';
			$data['id_company'] 			= '';
			$data['id_user'] 				= '';
			$data['company_verify'] 		= '';
			$data['company_url'] 			= '';
			$data['company_name'] 			= '';
			$data['company_tax_no'] 		= '';
			$data['company_logo'] 			= '';
			$data['company_tel'] 			= '';
			$data['company_address'] 		= '';
			$data['company_province'] 		= '';
			$data['company_head_office'] 	= '';
			$data['company_date_create'] 	= '';
			$data['company_layout']		 	= '';
	    	$company = $this->model('company');
    		$data_permission = array(
    			'id_company'	=> $id_company,
    			'id_user'		=> $id_user
    		);
    		$result_permission = $company->permission($data_permission);
    		$data['action'] = route('company/editCompany&id_company='.encrypt($id_company,$id_user));
    		if($result_permission){
	    		if(method_post()){
					if(empty(post('company_url'))){
						$company_logo = post('company_logo');
						$data_edit = array(
							'id_company'          => $id_company,
							'id_user'             => id_user(),
							'company_name'        => post('company_name'),
							'company_url'         => post('company_url'),
							'company_tax_no'      => post('company_tax_no'),
							'company_logo'        => $company_logo,
							'company_tel'         => post('company_tel'),
							'company_address'     => post('company_address'),
							'company_province'    => post('company_province'),
							'company_head_office' => post('company_head_office'),
							'company_date_create' => post('company_date_create'),
							'company_layout'      => post('company_layout'),
						);
						$result = $company->editCompany($data_edit);
						$data_result['result'] 			= 'success';
						$data_result['result_text'] 	= 'แก้ไขเรียบร้อย';
						$this->json($data_result);
					}else{
						$dataCheck 	= array(
							'id_company'	=> $id_company,
							'company_url'	=> post('company_url')
						);
						$urlCheck 	= $company->checkUrl($dataCheck);
						if($urlCheck == "success"){
							$data_result['result'] 			= 'failed';
							$data_result['result_text'] 	= 'ชื่อ Url นี้ถูกใช้งานแล้ว';
							$this->json($data_result);
						}else{
							$company_logo = post('company_logo');
							$data_edit = array(
								'id_company'          => $id_company,
								'id_user'             => id_user(),
								'company_name'        => post('company_name'),
								'company_url'         => post('company_url'),
								'company_tax_no'      => post('company_tax_no'),
								'company_logo'        => $company_logo,
								'company_tel'         => post('company_tel'),
								'company_address'     => post('company_address'),
								'company_province'    => post('company_province'),
								'company_head_office' => post('company_head_office'),
								'company_date_create' => post('company_date_create'),
								'company_layout'      => post('company_layout'),
							);
							$result = $company->editCompany($data_edit);
							$data_result['result'] 			= 'success';
							$data_result['result_text'] 	= 'แก้ไขเรียบร้อย';
							$this->json($data_result);
						}
					}
	    		}
	    		$data_company = array(
	    			'id_company' => $id_company
	    		);
	    		$result_company = $company->companyDetail($data_company);
	    		foreach($result_company as $key => $val){
	    			$data[$key] = $val;
	    		}
	    	}else{
    			$data['result'] = 'คุณไม่มีสิทธิ์ในการเข้าถึง';
    		}
	    	$data['title'] = 'Edit Company';
		    $data['headerMenu'] = '';//$this->getHtml('accounting/getMenu&active=home');
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['id_company'] = $id_company;
			$this->view('company/formCompany',$data);
		}
		public function getPermissions() {
	    	$data = array();
	    	$dir = DOCUMENT_ROOT."mep/catalog/controller/"; 
			if (is_dir($dir)){
			  if ($dh = opendir($dir)){
			  	$files = scandir($dir);
				sort($files);
			    foreach ($files as $file) {
			    	if (!in_array($file, array('.','..','...'))) {

			    		$fh = fopen($dir.$file, 'r');
			    		
		    			$nameclass = '';
			    		while( $read = fgets($fh) ) {
			    			$namefunction = '';
			    			if ( strpos($read, 'class') === 1 || strpos($read, 'class') === 0) {
			    				$temp = explode(' ', $read);
			    				if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $temp[1])==false) {
				    				$nameclass = trim(substr($temp[1],0,-10)).'/';
				    			}
			    			}
			    			if ( strpos($read, 'function') !== false ) {
			    				$temp0 = explode('function', $read);
			    				if (strlen(trim($temp0[0]))===6) {
	 			    				$temp = explode('(',trim($temp0[1]));
				    					$namefunction = trim($temp[0]);		
			    				}
			    			}
			    			
			    			if (!empty($nameclass)&&!empty($namefunction)) {
				    			$data['route'][substr($nameclass,0,-1)][] = strtolower($nameclass.$namefunction); 
			    			}
			    			
			    		}
			    		fclose($fh);
			    	}
			    }
			    closedir($dh);
			  }
			}
			return $data['route'];
	    }

	    public function makedir($path) {
			$dir = DOCUMENT_ROOT."/uploads/";
			if( is_dir($dir.$path) === false )
			{
				$old = umask(0);
			    echo mkdir($dir.$path, 0777);
			    umask($old);
			} else {
				echo false;
			}
		}
		
	}
?>