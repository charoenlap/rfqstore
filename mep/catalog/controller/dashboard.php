<?php 
	class DashboardController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'Dashboards';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$data['company_name'] = $this->getSession('company_name');
	    	// $breadcrumb[] = array('text'=>'ร้านค้า','url'=>route('shop/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	// $data['headerMenu'] = $this->getHtml('shop/getMenu&active=home');
	    	$package = $this->model('package');
	    	$data_select = array(
	    		'id_user' => id_user(),
	    		'id_company' => id_company()
	    	);
	    	$result_package = $package->getPackage($data_select);
	    	$sum_bill = 0;
	    	$accounting = $this->model('accounting');
	    	$data_bill = array(
	    		'id_company' => id_company()
	    	);
	    	$result_accounting = $accounting->getBillCount($data_bill);
	    	$sum_bill 		+= isset($result_accounting['count_quotation']) ? (float)$result_accounting['count_quotation'] : 0;
			$sum_bill 		+= isset($result_accounting['count_billingnote']) ? (float)$result_accounting['count_billingnote'] : 0;
			$sum_bill 		+= isset($result_accounting['count_receipt']) ? (float)$result_accounting['count_receipt'] : 0;
			$sum_bill		+= isset($result_accounting['count_purchaseOrder']) ? (float)$result_accounting['count_purchaseOrder'] : 0;
			$sum_bill 		+= isset($result_accounting['count_productReceipt']) ? (float)$result_accounting['count_productReceipt'] : 0;
			$sum_bill 		+= isset($result_accounting['count_theCost']) ? (float)$result_accounting['count_theCost'] : 0;
			$sum_bill 		+= isset($result_accounting['count_withholdingTax']) ? (float)$result_accounting['count_withholdingTax'] : 0;

	    	$data['size'] = $package->getDiskspace($data_select)['size'];
	    	$getDiskspaceDetail = $package->getDiskspaceDetail($data_bill);
	    	$data['count_employee'] = $getDiskspaceDetail['employee'];
	    	$data['count_product'] = $getDiskspaceDetail['product'];
	    	$data['count_customer'] = $getDiskspaceDetail['customer'];

	    	$data['total_size'] = ($data['size']/pow(BYTE_PER_KB, 2));
	    	$data['total_space'] = $result_package['detail']['package_total_space_mb'];
	    	$data['percent_space'] = ($data['total_size']/$data['total_space'])*100;
	    	$data['sum_bill'] = $sum_bill;
	    	$data['package'] = $result_package;
	    	$data['package_detail'] = $result_package['detail'];
	    	// var_dump($result_package);
 	    	$this->view('dashboard/home',$data);
	    }
	    public function expireSession(){
	    	$data = array();
	    	$data['title'] = 'Dashboards';
	  //   	echo '<div class="container">
			//   <div class="row mt-4">
			//     <div class="col-md">
			// 		<p>กรุณา เข้าสู่ระบบใหม่อีกครั้ง</p>
			// 		<a href="../index.php?route=home">กดเพื่อดำเนินการต่อ</a>
			//     </div>
			//   </div>
			// </div>
			// ';
	  //   	exit();
	    	$this->render('dashboard/expireSession',$data);
	    }
	}
?>