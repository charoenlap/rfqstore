<?php 
	class SettingController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$setting = $this->model('setting');
	    	$data['result'] = get('result');
	    	if(method_post()){
	    		$data_setting = array(
					'id_company'          => id_company(),
					'company_logo'        => post('company_logo'),
					'company_name'        => post('company_name'),
					'company_tax_no'      => post('company_tax_no'),
					'company_tel'         => post('company_tel'),
					'company_address'     => post('company_address'),
					'company_province'    => post('company_province'),
					'company_head_office' => post('company_head_office'),
	    		);
	    		$setting->saveSetting($data_setting);
	    		redirect('setting/home&result=success');
	    	}
	    	$select_setting = array(
	    		'id_company' 	=> id_company()
	    	);

	    	$setting_data = $setting->getSetting($select_setting);
	    	$data['setting'] 		= $setting_data;
	    	$data['company_logo'] 	= $setting_data['company_logo'];
	    	$data['action'] 		= route('setting/home');
	    	$data['title'] 			= 'Setting';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ข้อมูลบริษัท','url'=>route('setting/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('home');
 	    	$this->view('setting/home',$data);
	    }
	    public function stock() {
	    	$data = array();
	    	$setting = $this->model('setting');
	    	$data['result'] = get('result');
	    	if(method_post()){
	    		$data_setting = array(
					'id_company'          => id_company(),
					'sellstock'           => post('sellstock'),
					'buystock'            => post('buystock'),
					'shopstock'           => post('shopstock'),
	    		);
	    		$setting->saveSetting($data_setting);
	    		redirect('setting/home&result=success');
	    	}
	    	$select_setting = array(
	    		'id_company' 	=> id_company()
	    	);

	    	$setting_data = $setting->getSetting($select_setting);
	    	$data['setting'] 		= $setting_data;
	    	$data['company_logo'] 	= $setting_data['company_logo'];
	    	$data['action'] 		= route('setting/home');
	    	$data['title'] 			= 'Setting';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ข้อมูลบริษัท','url'=>route('setting/home'));
	    	$breadcrumb[] = array('text'=>'เงื่อนไขตัดสต๊อก','url'=>route('setting/stock'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('stock');
 	    	$this->view('setting/stock',$data);
	    }
	    public function pos() {
	    	$data = array();
	    	$data['search'] = '';
	    	$setting = $this->model('setting');
	    	$filter = array();
	    	if (method_post()) {
	    		if (post('search')) {
					$filter['search'] = post('search');
					$data['search']   = post('search');
	    		}
	    	}
	    	$poss = $setting->getSettingPOS($filter);
	    	$setting_data = array();
	    	foreach ($poss as $value) {
	    		$setting_data[] = array(
					'id_company_pos' => encrypt($value['id_company_pos']),
					'pos_name'       => $value['pos_name'],
					'pos_no'         => $value['pos_no'],
					'pos_status'     => $value['pos_status'],
					'count' => $value['count'],
					'sumtotal'       => $value['sumtotal'],
	    		);
	    	}
			$data['pos']           = $setting_data;
			$data['action']        = route('setting/pos');
			$data['title']         = 'Setting';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ข้อมูลบริษัท','url'=>route('setting/home'));
	    	$breadcrumb[] = array('text'=>'เลข pos','url'=>route('setting/pos'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('pos');
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	}
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	}
 	    	$this->view('setting/pos',$data);
	    }
	    public function addpos() {
	    	$data = array();
	    	$setting = $this->model('setting');
	    	if(method_post()){
	    		$update = array(
					'pos_no'     => post('pos_no'),
					'pos_name'   => post('pos_name'),
					'pos_status' => post('pos_status'),
	    		);
	    		$result = $setting->addpos($update);
	    		if ($result) {
	    			$this->setSession('success', 'เพิ่มเลข pos สำเร็จ');
	    		} else {
	    			$this->setSession('error', 'ผิดพลาดในการเพิ่มเลข pos');
	    		}
	    		redirect('setting/pos');
	    		exit();
	    	}

	    	$setting_data = array(
				'pos_name'   => '',
				'pos_no'     => '',
				'pos_status' => 1,
	    	);

	    	$data['setting'] 		= $setting_data;
	    	$data['action'] 		= route('setting/addpos');
	    	$data['title'] 			= 'Setting';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ข้อมูลบริษัท','url'=>route('setting/home'));
	    	$breadcrumb[] = array('text'=>'เลข pos','url'=>route('setting/pos'));
	    	$breadcrumb[] = array('text'=>'เพิ่ม pos','url'=>route('setting/addpos'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('pos');
 	    	$this->view('setting/form_pos',$data);
	    }
	    public function editpos() {
	    	$data = array();
	    	$setting = $this->model('setting');
	    	$id = decrypt(get('id'));
	    	if(method_post()){
	    		$update = array(
					'pos_no'     => post('pos_no'),
					'pos_name'   => post('pos_name'),
					'pos_status' => post('pos_status'),
	    		);
	    		$result = $setting->editpos($update, $id); 
	    		if ($result>0) {
	    			$this->setSession('success', 'แก้ไขเลข pos สำเร็จ');
	    		} else {
	    			$this->setSession('error', 'ผิดพลาดในการแก้ไขเลข pos');
	    		}
	    		redirect('setting/pos');
	    		exit();
	    	}
	    	$setting_data = $setting->getSettingPOSID($id);
	    	$data['setting'] 		= $setting_data;
	    	$data['action'] 		= route('setting/editpos').'&id='.get('id');
	    	$data['title'] 			= 'Setting';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ข้อมูลบริษัท','url'=>route('setting/home'));
	    	$breadcrumb[] = array('text'=>'เลข pos','url'=>route('setting/pos'));
	    	$breadcrumb[] = array('text'=>'แก้ไข pos','url'=>route('setting/editpos'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('pos');
 	    	$this->view('setting/form_pos',$data);
	    }
	    public function delpos() {
	    	$setting = $this->model('setting');
	    	$id = decrypt(get('id'));
	    	$result = $setting->delPos($id);
	    	if ($result>0) {
    			$this->setSession('success', 'ลบเลข pos สำเร็จ');
    		} else {
    			$this->setSession('error', 'ผิดพลาดในการลบเลข pos');
    		}
    		redirect('setting/pos');
    		exit();
	    }
	    public function getMenu($active=''){
	    	$setting = $this->model('setting');
	    	$count_pos = $setting->countPos();
	    	$result = '<div class="nav-scroller bg-white shadow-sm">
					  <nav class="nav nav-underline">
					    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('setting/home').'">ข้อมูลบริษัท</a>
					    <a class="nav-link '.($active=='stock'?'active':'').'" href="'.route('setting/stock').'">เงื่อนไขตัดสต๊อก</a>
					    <a class="nav-link '.($active=='pos'?'active':'').'" href="'.route('setting/pos').'">เลข POS
					    <span class="badge badge-pill bg-light align-text-bottom">'.$count_pos.'</span>
					    </a>
					  </nav>
					</div>';
			return $result;
	    }
	}
?>