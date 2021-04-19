<?php 
	class UserController extends Controller {
	    public function logout() {
	    	$this->rmSession('id_user');
			$this->rmSession('user_key');
			$this->rmSession('token');
			$this->rmSession('user_name');
			$this->rmSession('user_lname');
			$this->destroySession();
	    	$this->redirect('user/login','..');
	    }

	    public function notfound_permission() {
	    	$data = array();
 	    	$this->view('user/permission',$data);
	    }
	}
?>