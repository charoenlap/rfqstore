<?php 
	class ProductController extends Controller {
	    public function index() {
	    	$data = array(); 
	    	$this->view('product/product_detail');
	    }

	}
?>