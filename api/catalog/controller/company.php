<?php 
	class CompanyController extends Controller {
	    public function choose() {
			$data = array();
			if(method_post()){
				$result = array();
				$token_user = post('token_user');
				$user_key = post('user_key');
				$id_company = decrypt(post('id_company'));
				//check match company
				$user = $this->model('company',PATH_MODEL_CATALOG);
				$id_user = decrypt($token_user,$user_key);
				$data_select = array(
					'id_user'=> $id_user,
					'id_company'=> $id_company
				);
				$check_company = $user->checkCompany($data_select);
				if($check_company){
					$result['status'] = 'success';
					$result['token_company'] = encrypt($id_user.'_'.$id_company);
				}else{
					$result['status'] = 'fail';
				}
				$this->json($result);
			}
	    }
	    public function listCompany() {
	    	$data = array();
	    	$result = array();
			if(method_post()){
				$token_user = post('token_user');
				$user_key 	= post('user_key');
				$id_user 	= decrypt($token_user,$user_key);
				$company = $this->model('company',PATH_MODEL_CATALOG);
		    	$data_company = array(
		    		'id_user'	=> $id_user
		    	);
		    	$list_company = $company->listCompany($data_company);
		    	foreach($list_company as $key => $value){
		    		$result[] = array(
		    			'id_company'	=> encrypt($value['id_company']),
		    			'company_name' 	=> $value['company_name']
		    		);
		    	}
		    	$this->json($result);
		    }
	    }
	    public function addCompany() {
	    	$data = array();
	    	if(method_post()){
	    		$token_user = post('token_user');
				$user_key 	= post('user_key');
				$id_user 	= decrypt($token_user,$user_key);
				$id_company = decrypt(post('id_company'));


	    		$company = $this->model('company',PATH_MODEL_CATALOG);
	    		$company_logo = post('company_logo');
	    		$data_insert = array(
					'id_user_create'      => $id_user,
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

	    		api(route('upload/mkdir'), 'POST', array('path'=>'/', 'name'=>$id_company));

	    		$result = $company->addCompany($data_insert);

	    		$model_user = $this->model('user',PATH_MODEL_CATALOG);
				$insert_permis = array();
				$insert_permis['id_company'] = (int)$result;
				$insert_permis['id_user'] = $id_user;
				$permissions = $this->getPermissions();
				foreach ($permissions as $class => $array) {
					foreach ($array as $key => $value) {
						$insert_permis['permission'][] = $value;	
					}
				}
				$insert_permis['permission'] = json_encode($insert_permis['permission'], JSON_UNESCAPED_UNICODE, 512);
				$model_user->addPermission($insert_permis);

				$this->makedir($result);

				// $this->addDefaultData($result);
	    		
	    		// if ($result>0) {
	    		// 	$this->setSession('success','????????????????????????????????????????????????????????????????????????');
	    		// } else {
	    		// 	$this->setSession('error','??????????????????????????????????????????????????????????????????????????????????????????');
	    		// }
	    		$return = array();
	    		if ($result>0) {
	    			$return = array(
	    				'status' => '00',
	    				'desc' => 'success'
	    			);
	    		}else{
	    			$return = array(
	    				'status' => '01',
	    				'desc' => 'fail'
	    			);
	    		}
	    		$this->json($return);
	    		// redirect('home');
	    	}
	    }
	    public function editCompany(){
			$data = array();
			$token_user = post('token_user');
			$user_key 	= post('user_key');
			$id_user 	= decrypt($token_user,$user_key);
			$id_company = decrypt(post('id_company'));

	    	$company = $this->model('company',PATH_MODEL_CATALOG);
    		$data_permission = array(
    			'id_company'	=> $id_company,
    			'id_user'		=> $id_user
    		);
    		$result_permission = $company->permission($data_permission);
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
						$data_result['result_text'] 	= '??????????????????????????????????????????';
						$this->json($data_result);
					}else{
						$dataCheck 	= array(
							'id_company'	=> $id_company,
							'company_url'	=> post('company_url')
						);
						$urlCheck 	= $company->checkUrl($dataCheck);
						if($urlCheck == "success"){
							$data_result['result'] 			= 'failed';
							$data_result['result_text'] 	= '???????????? Url ????????????????????????????????????????????????';
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
							$data_result['result_text'] 	= '??????????????????????????????????????????';
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
    			$data['result'] = '??????????????????????????????????????????????????????????????????????????????';
    		}
    		$this->json($data);
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
		// public function addDefaultData($id_company) {
		// 	$image = DOCUMENT_ROOT.'assets/image/logo.png';
		// 	copy($image, DOCUMENT_ROOT.'uploads/'.$id_company.'/logo.png');

		// 	$insert = array(
		// 		'id_company'         => $id_company,
		// 		'id_user'            => 0,
		// 		'employee_code'      => '000',
		// 		'employee_email'     => 'test@test.com',
		// 		'employee_firstname' => '???????????????',
		// 		'employee_lastname'  => '????????????????????????',
		// 		'employee_salary'    => 15000,
		// 		'employee_startwork' => date('Y-m-d', time()),
		// 		'date_added'         => date('Y-m-d H:i:s', time())
  //   		);
		// 	$model_employee = $this->model('employee');
		// 	$model_employee->addEmp($insert);


		// 	$model_customer = $this->model('customer');
		// 	$insert = array(
		// 		'id_company'     => $id_company,
		// 		'category_code'  => '000',
		// 		'category_name'  => '????????????????????????????????????????????????',
		// 		'category_image' => '/'.$id_company.'/logo.png',
		// 		'date_added'     => date('Y-m-d H:i:s', time())
		// 	);
		// 	$model_customer->addCategory($insert);
		// 	$insert = array(
		// 		'id_company'               => $id_company,
		// 		'customer_type'            => '?????????????????????????????????',
		// 		'customer_contacttype'     => 1,
		// 		'customer_credit'          => 90,
		// 		'customer_code'            => '000',
		// 		'customer_company'         => '??????????????????????????????????????????',
		// 		'customer_tax'             => '110101010101',
		// 		'customer_branch'          => '????????????????????????????????????',
		// 		'customer_address'         => '11/11 bangrak bangrak bangkok 10150',
		// 		'customer_shippingaddress' => '11/11 bangrak bangrak bangkok 10150',
		// 		'customer_phone'           => '0222222222',
		// 		'customer_fax'             => '0222222222',
		// 		'customer_name'            => '????????????????????????',
		// 		'customer_email'           => 'test@test.com',
		// 		'customer_telephone'       => '08222222222',
		// 		'customer_bank'            => '???.?????????????????????',
		// 		'customer_bankaccount'     => '???????????????????????????????????????',
		// 		'customer_bankbranch'      => '??????????????????2',
		// 		'customer_banktype'        => '??????????????????????????????????????????',
		// 		'date_added'               => date('Y-m-d H:i:s', time()),
		// 		'date_modify'              => date('Y-m-d H:i:s', time())
		// 	);
		// 	$customer_id = $model_customer->addCustomer($insert);


		// 	$model_product = $this->model('product');
		// 	$insert = array(
		// 		'id_company'    => $id_company,
		// 		'category_code' => '000',
		// 		'category_name' => '????????????????????????????????????????????????',
		// 		'date_created'  => date('Y-m-d H:i:s', time()),
		// 		'date_updated'  => date('Y-m-d H:i:s', time()),
		// 	);
  //   		$category_id = $model_product->addCategory($insert);

  //   		$insert = array(
		// 		'id_company'    => $id_company,
		// 		'werehouse_code' => '000',
		// 		'werehouse_name' => '??????????????????????????????????????????????????????',
		// 		'date_created'  => date('Y-m-d H:i:s', time()),
		// 		'date_updated'  => date('Y-m-d H:i:s', time()),
		// 	);
  //   		$werehouse_id = $model_product->addWerehouse($insert);

			
  //   		$insert = array(
		// 		'id_company'       => $id_company,
		// 		'id_category'      => $category_id,
		// 		'id_werehouse'     => $werehouse_id,
		// 		'product_name'     => '??????????????????????????????????????????',
		// 		'product_quantity' => 100,
		// 		'product_unit'     => '?????????',
		// 		'product_special'  => 99,
		// 		'product_price'    => 120,
		// 		'product_detail'   => '????????????????????????????????????????????????',
		// 		'product_code'     => '000',
		// 		'product_image'    => '/'.$id_company.'/logo.png',
		// 		'product_status'   => 1,
		// 		'date_created'     => date('Y-m-d H:i:s', time()),
		// 		'date_updated'     => date('Y-m-d H:i:s', time()),
		// 	);
  //   		$product_id = $model_product->addProduct($insert);

  //   		$model_company = $this->model('company');
  //   		$editCompany = array(
		// 		'id_company'   => $id_company,
		// 		'company_logo' => '/'.$id_company.'/logo.png'
  //   		);
  //   		$model_company->editCompany($editCompany);

  //   		$model_setting = $this->model('setting');
  //   		$insert = array(
		// 		'id_company'                        => id_company(),
		// 		'setting_bill_prefix'               => 0,
		// 		'setting_bill_count_quotation'      => 0,
		// 		'setting_bill_count_billingnote'    => 0,
		// 		'setting_bill_count_receipt'        => 0,
		// 		'setting_bill_count_purchaseOrder'  => 0,
		// 		'setting_bill_count_productReceipt' => 0,
		// 		'setting_bill_count_theCost'        => 0,
		// 		'setting_bill_count_withholdingTax' => 0
  //   		);
  //   		$model_setting->addSetting($insert);

  //   		$insert = array(
		// 		'id_company' => $id_company,
		// 		'pos_name'   => '????????????????????????????????????',
		// 		'pos_no'     => '0000000',
		// 		'pos_status' => 1
  //   		);
  //   		$model_setting->addPos($insert);
    		
		// }
	}
?>