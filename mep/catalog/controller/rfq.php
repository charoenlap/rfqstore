<?php 
	class RFQController extends Controller {
		public function __construct() {
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'RFQ';
	    	$data['headerMenu'] = '';
	    	$breadcrumb = array(); 
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	// $breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
	    	// $breadcrumb[] = array('text'=>'บัญชี','url'=>route('accounting/quotation'),'active'=>1);
	    	$this->rmSession('id_company');
	    	$this->rmSession('company_name'); 
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$this->view('rfq/home',$data);
	    }
	}
?>