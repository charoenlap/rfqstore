<?php 
	class HomeController extends Controller {
		public function __construct() {
			// $this->checkPermission();
		}
	    public function index() {
	    	$data = array();
	    	$id_user = (int)id_user();
	    	// echo $id_user;exit();
	    	if($id_user){
		    	$data['title'] = 'Home';
		    	$company  = $this->model('company');
		    	
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

		    	// $count_company = count($data['list_company']);
		    	// if($count_company==1){
		    		// $this->redirect('company&id_company='.encrypt($data['list_company'][0]['id_company']));
		    	// }else{
		    	$this->view('home',$data);
		    	// }
	    	}else{
	    		redirect('user/logout');
	    	}
 	    	
	    }

	}
?>