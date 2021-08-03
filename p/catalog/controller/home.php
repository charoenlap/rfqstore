<?php 
	class HomeController extends Controller {
	    public function index() {
	    	$data = array();
	    	$data_select = array(
	    		'shop' => trim(get('shop'))
	    	);
	    	$data['shop'] = $this->model('shop')->findShop($data_select);
	    	$this->view('home',$data);
	    }

	}
?>