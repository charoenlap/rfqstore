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
	}
?>