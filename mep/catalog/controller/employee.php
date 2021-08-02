<?php 
	class EmployeeController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
		public function index() {
			$this->listEmployee();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'Employee';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'พนักงาน','url'=>route('employee/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('home');

	    	$data['chart'] = array();
	    	$data['chart'][] = array('Year', 'Number of employees applied');
	    	$model_employee = $this->model('employee');
	    	$results = $model_employee->countEmployeePerMonth();
	    	if (count($results)>0) {
	    		foreach ($results as $key => $value) {
		    		$data['chart'][] = array($value['month'], (int)$value['count']);
		    	}
	    	} else {
	    		$data['chart'][] = array(date('Y'), 0);
	    	}
	    	
	    	$data['chart'] = json_encode($data['chart']);

 	    	$this->view('employee/home',$data);
	    }
	    public function listEmployee() {
	    	$data = array();
	    	$data['title'] = 'List Employee';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'พนักงาน','url'=>route('employee/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('list');
	    	$data['link_edit'] = route('employee/editEmployee');
	    	$data['link_salary'] = route('employee/EmployeeSalary');
	    	$data['link_search'] = route('employee');

	    	$data['search'] = ''; 

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

	    	$filter = array('id_company'=>id_company());

	    	if (!empty(post('search'))) {
	    		$filter['employee_name'] = post('search');
	    		$data['search'] = post('search');
	    	}

	    	$model_employee = $this->model('employee');
	    	$data['employees'] = $model_employee->listEmp($filter);

	    	$page = (get('page')?get('page'):1);
	    	$pageing = array(
	    		'total' => count($data['employees']),
	    		'link'	=> route('employee/listEmployee&page='.$page),
	    		'active'=> $page
	    	);

 	    	$this->view('employee/listEmployee',$data);
	    }
		public function EmployeeSalary(){
			$data = array();
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
			$data['action'] = route('employee/EmployeeSalary');
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
			$data['date_start'] = '01-'.date('m').'-'.(date('Y')+543);
			$id = decrypt(get('id'));
			$model_employee = $this->model('employee');
			$model_company = $this->model('company');
			$employee_info = $model_employee->getEmpById($id);
			$data['company_info'] = $model_company->getCompany();
			$data['id_user']            = $employee_info['id_user'];
			$data['employee_code']      = $employee_info['employee_code'];
			$data['employee_email']     = $employee_info['employee_email'];
			$data['employee_firstname'] = $employee_info['employee_firstname'];
			$data['employee_lastname']  = $employee_info['employee_lastname'];
			$data['employee_salary']    = $employee_info['employee_salary'];
			$data['employee_startwork'] = $employee_info['employee_startwork'];
			$month = array(
				"1"		=> "มกราคม",
				"2"		=> "กุมภาพันธ์",
				"3"		=> "มีนาคม",
				"4"		=> "เมษายน",
				"5"		=> "พฤษภาคม",
				"6"		=> "มิถุนายน",
				"7"		=> "กรกฎาคม",
				"8"		=> "สิงหาคม",
				"9"		=> "กันยายน",
				"10"	=> "ตุลาคม",
				"11"	=> "พฤศจิกายน",
				"12"	=> "ธันวาคม",
			);
			foreach($month as $key => $value){
				$month_en = date('m');
				if($month_en == $key){
					$data['month_th'] = $value;
				}
			}
			$data['total_amount'] = "";
			$data['total_deduc'] = "";
			$data['total_decrease'] = "";
			if(method_post()){

				$input = $_POST;
				$salary = $employee_info['employee_salary'];
				$data['total_amount'] = $salary + $input['income'];
				$total_decrease  = $input['tax'] + $input['social'] + $input['tax_social'];
				$data['total_decrease']  = $input['tax'] + $input['social'] + $input['tax_social'];
				$data['total_deduc'] = $data['total_amount'] - $total_decrease;
				// echo "<pre>";
				// print_r($_POST);
				// echo "</pre>";			

			}
			$this->view('employee/EmployeeSalary',$data,false);
		}
	    public function addEmployee() {
			$breadcrumb            = array();
			$breadcrumb[]          = array('text'=>'หน้าหลัก','url'=>route('employee/home'));
			$breadcrumb[]          = array('text'=>'พนักงาน','url'=>'#','active'=>1);
	    	$data['title'] = 'Add Employee';
	    	$data['headerMenu'] = $this->getMenu('list');
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
			$data['action']        = route('employee/addEmployee');
			$data['ajax_finduser'] = route('employee/ajaxFindUser');
			$data['ajax_checkcode'] = route('employee/ajaxCheckCodeEmp');

			$data['id_user']            = 0;
			$data['employee_code']      = '';
			$data['employee_email']     = '';
			$data['employee_firstname'] = '';
			$data['employee_lastname']  = '';
			$data['employee_salary']    = '';
			$data['employee_startwork'] = '';


			$style = array(
	    		// 'assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
	    		'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js',
	    		'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
	    		'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
	    		// 'assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
	    		// 'assets/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js'
	    	);
	    	$data['script'] = $script;

	    	if ($_SERVER['REQUEST_METHOD']=='POST') {

				$model_employee = $this->model('employee');
				$model_user     = $this->model('user');

	    		// ตรวจสอบ code และ อีเมลว่ามีอยู่ในระบบ ของบริษัทนี้ อยู่แล้วหรือเปล่า
	    		$check = $model_employee->checkEmpByCodeAndEmail(post('code'),post('employee_email'),id_company());
	    		if ($check==0) {
	    			$id_user = post('id_user');
	    			// ตรวจสอบ user ในระบบ
	    			// ไม่เคยมี user นี้อยู่ในระบบ
	    			if (empty(post('id_user'))) {
	    				if (post('password')==post('confirm_password')) {

	    					$insert = array(
								'user_email'       => post('employee_email'),
								'user_password'    => md5(post('password')),
								'user_name'        => post('employee_firstname'),
								'user_lastname'    => post('employee_lastname'),
								'user_key'         => rand(00000,99999),
								'user_date_create' => date('Y-m-d H:i:s', time())
		    				);
		    				$id_user = $model_user->addUser($insert);

		    				$insert_u2c = array(
								'id_company' => id_company(),
								'id_user'    => $id_user,
		    				);
		    				$model_user->addUserTakeCompany($insert_u2c);
		    				
		    				$insert_permis = array();
		    				$insert_permis['id_company'] = id_company();
		    				$insert_permis['id_user'] = $id_user;
		    				$permissions = $this->getPermissions();
		    				foreach ($permissions as $class => $array) {
		    					foreach ($array as $key => $value) {
		    						$insert_permis['permission'][] = $value;	
		    					}
		    				}
		    				$insert_permis['permission'] = json_encode($insert_permis['permission'], JSON_UNESCAPED_UNICODE);
		    				$model_user->addPermission($insert_permis);
	    				} else {
							$data['employee_code']      = post('employee_code');
							$data['employee_email']     = post('employee_email');
							$data['employee_firstname'] = post('employee_firstname');
							$data['employee_lastname']  = post('employee_lastname');
							$data['employee_salary']    = post('employee_salary');
							$data['employee_startwork'] = date('Y-m-d', strtotime(post('employee_startwork')));
							$this->setSession('error','รหัสผ่านไม่ตรงกัน');
		    				$this->redirect('employee/addEmployee');
	    				}
	    			}

		    		$insert = array(
						'id_company'         => id_company(),
						'id_user'            => $id_user,
						'employee_code'      => post('employee_code'),
						'employee_email'     => post('employee_email'),
						'employee_firstname' => post('employee_firstname'),
						'employee_lastname'  => post('employee_lastname'),
						'employee_salary'    => post('employee_salary'),
						'employee_startwork' => date('Y-m-d', strtotime(post('employee_startwork'))),
						'date_added'         => date('Y-m-d H:i:s', time())
		    		);
		    		$lastid = $model_employee->addEmp($insert);
		    		if ($lastid>0) {
		    			$this->setSession('success','เพิ่มพนักงานเรียบร้อยแล้ว');
		    		} else {
		    			$this->setSession('error','ผิดพลาดไม่สามารถเพิ่มพนักงานได้');
		    		}
	    		} else {
		    		$this->setSession('error','มีอีเมลอยู่ในบริษัท หรือ รหัสพนักงานซ้ำกับพนักงานในบริษัท');
	    		}
	    		$this->redirect('employee');
	    	}
 	    	$this->view('employee/formEmployee',$data);
	    }
	    public function editEmployee() {
	    	$data = array();
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('employee/home'));
	    	$breadcrumb[] = array('text'=>'พนักงาน','url'=>'#','active'=>1);
	    	$data['title'] = 'Edit Employee';
	    	$data['headerMenu'] = $this->getMenu('list');
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['action'] = route('employee/editEmployee').'&id='.get('id');
	    	
			$data['ajax_finduser'] = route('employee/ajaxFindUser');
	    	$data['ajax_checkcode'] = route('employee/ajaxCheckCodeEmp');

	    	$id = decrypt(get('id'));
	    	$model_employee = $this->model('employee');
	    	$model_user = $this->model('user');
	    	$employee_info = $model_employee->getEmpById($id);

			$data['id_user']            = $employee_info['id_user'];
			$data['employee_code']      = $employee_info['employee_code'];
			$data['employee_email']     = $employee_info['employee_email'];
			$data['employee_firstname'] = $employee_info['employee_firstname'];
			$data['employee_lastname']  = $employee_info['employee_lastname'];
			$data['employee_salary']    = $employee_info['employee_salary'];
			$data['employee_startwork'] = $employee_info['employee_startwork'];

			$style = array(
	    		// 'assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'
	    		'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
	    		'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
	    		'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js'
	    		// 'assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
	    		// 'assets/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js'
	    	);
	    	$data['script'] = $script;

			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$update = array(
					'employee_code'      => post('employee_code'),
					'employee_firstname' => post('employee_firstname'),
					'employee_lastname'  => post('employee_lastname'),
					'employee_salary'    => post('employee_salary'),
					'employee_startwork' => date('Y-m-d', strtotime(post('employee_startwork'))),
					'date_modify'        => date('Y-m-d H:i:s', time())
	    		);
	    		$result = $model_employee->editEmp($update, $id);
	    		if (!empty(post('password'))&&post('password')==post('confirm_password')) {
	    			$update = array(
	    				'user_password' => md5(post('password'))
	    			);
	    			$model_user->editUser($update,$id);
	    		}
	    		if ($result==1) {
	    			$this->setSession('success','แก้ไขพนักงานเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','ผิดพลาดไม่สามารถแก้ไขพนักงานได้');
	    		}
	    		$this->redirect('employee');

	    	}

 	    	$this->view('employee/formEmployee',$data);
	    }
	    public function delEmployee() {
	    	$id = decrypt(get('id'));
	    	$model_employee = $this->model('employee');
	    	$employee_info = $model_employee->getEmpById($id);
	    	$result = $model_employee->delEmp($id);
	    	$model_user = $this->model('user');
	    	$model_user->delUserTakeCompnay(id_company(), $employee_info['id_user']); 
	    	if ($result==1) {
    			$this->setSession('success','ลบพนักงานเรียบร้อยแล้ว');
	    	} else {
    			$this->setSession('error','ผิดพลาดไม่สามารถลบพนักงานได้');
	    	}
	    	$this->redirect('employee');
	    }
	    public function permission() {
	    	$data = array();
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'พนักงาน','url'=>route('employee/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('list');
	    	$data['title'] = 'Permission';
	    	$data['action'] = route('employee/permission').'&id='.get('id');
	    	$id = decrypt(get('id'));



	    	$data['count_class'] = array();
	    	$data['permission'] = array();
	    	$model_user = $this->model('user');
	    	$permission = $model_user->getPermission(id_company(), $id);
	    	if (isset($permission['permission'])) {
	    		$permissions = json_decode($permission['permission'], true);
		    	foreach ($permissions as $permission) {
		    		$temp = explode('/', $permission);
		    		$class = $temp[0];
		    		if (strpos($permission, $temp[0])>=0) { 
		    			if (isset($data['count_class'][$class])) {
		    				$data['count_class'][$class]++;
		    			} else {
		    				$data['count_class'][$class] = 1;
		    			}
		    		}
		    	}
		    	$data['permission'] = $permissions;	
	    	}

			$model_employee = $this->model('employee');
			$employee_info  = $model_employee->getEmpById($id);
			$id_user        = $employee_info['id_user'];
	    	

			if (method_post()) {
				$insert = array();
				$insert['permission'] = json_encode(post('function'), JSON_UNESCAPED_UNICODE);
				$insert['id_company'] = id_company();
				$insert['id_user']    = $id_user;

				$check = $model_user->getPermission(id_company(), $id_user);
				if ((int)$check['id_user_permission']>0) {
					$result = $model_user->editPermission($insert, $check['id_user_permission']);
					if ($result>0) {
						$this->setSession('success', 'แก้ไขสิทธิ์การเข้าใช้งาน');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ แก้ไขสิทธิ์การเข้าใช้งาน');
					}
				} else {
					$result = $model_user->addPermission($insert);
					if ($result==1) {
						$this->setSession('success', 'เพิ่มสิทธิ์การเข้าใช้งาน');
					} else {
						$this->setSession('error', 'เกิดข้อผิดพลาดในการ เพิ่มสิทธิ์การเข้าใช้งาน');
					}
				}
				redirect('employee/listEmployee');
				exit();
			}	    	


			$data['route'] = $this->getPermissions();
	    	
	    	$this->view('employee/permission', $data);
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

	    public function getMenu($active=''){
	    	$model_employee = $this->model('employee');

	    	$result = '<div class="nav-scroller bg-white shadow-sm">
					  <nav class="nav nav-underline">
					    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('employee/home').'">พนักงาน</a>
					    <a class="nav-link '.($active=='list'?'active':'').'" href="'.route('employee/listEmployee').'">
					      รายการพนักงาน
					      <span class="badge badge-pill bg-light align-text-bottom">'.$model_employee->countEmployee().'</span>
					    </a>
					  </nav>
					</div>';
			return $result;
	    }
	    public function ajaxFindUser() {
	    	$data = array();
	    	if ($_SERVER['REQUEST_METHOD']=='POST') {
		    	$modal_user = $this->model('user');
		    	$data = $modal_user->getUserByEmail(post('email'));
		    	
				$data['employee_email']     = $data['user_email'];
				$data['employee_firstname'] = $data['user_name'];
				$data['employee_lastname']  = $data['user_lastname'];
	    	}
	    	echo $this->json($data);
	    }
	    public function ajaxCheckCodeEmp() {
	    	$data = array();
	    	if ($_SERVER['REQUEST_METHOD']=='POST') {
	    		$data = false;
		    	$model_employee = $this->model('employee');
		    	$data = $model_employee->countEmpByCode(post('employee_code'));
	    	}
	    	echo $this->json($data);
	    }

	    

	}
?>