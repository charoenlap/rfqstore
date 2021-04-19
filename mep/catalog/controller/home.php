<?php 
	class HomeController extends Controller {
		public function __construct() {
			// $this->checkPermission();
		}
	    public function index() {


	    	$data = array();
	    	$data['title'] = 'Home';
	    	$company  = $this->model('company');
	    	$id_user = id_user();
	    	$data['headerMenu'] = '';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'บริษัท','url'=>route('home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);

	    	$data_company = array(
	    		'id_user'	=> $id_user
	    	);
	    	$data['id_user'] = $id_user;
	    	$data['list_company'] = $company->listCompany($data_company);

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

	    	$this->rmSession('id_company');
	    	$this->rmSession('company_name'); 

 	    	$this->view('home',$data);
	    }

	}
?>