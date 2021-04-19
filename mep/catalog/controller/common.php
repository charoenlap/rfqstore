<?php 
	class CommonController extends Controller {
	    public function header($data=array()) {
	    	$data['id_company'] = id_company();
	    	$data['encode_id_company'] = $this->getSession('encode_id_company');
	    	$data['company_name'] = $this->getSession('company_name');
	    	$company  = $this->model('company');
	    	$id_user = id_user();
	    	$data_company = array(
	    		'id_user'	=> $id_user
	    	);
	    	$data['list_company'] = $company->listCompany($data_company);

	    	if (id_company()!=null) {
	    		$model_user = $this->model('user');
		    	$permission = $model_user->getPermission(id_company(), id_user());
          if (isset($permission['permission'])) {
		    		$data['permission'] = json_decode($permission['permission'], true, 512, JSON_UNESCAPED_UNICODE);		
		    	} else {
		    		$data['permission'] = array();
		    	}
	    	}
	    	

	    	$this->render('common/header',$data);
	    }
	    public function footer($data=array()){
	    	$data['filemanager'] = $this->getHtml('upload/index');
	    	$this->render('common/footer',$data);
	    }
	    public function logout($data=array()){
	    	session_destroy();
	    	$this->redirect('home',$data);
	    }
	}
?>