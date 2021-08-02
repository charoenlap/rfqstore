<?php 
class ReportController extends Controller {
   	public function index() {
    	$data = array(); 
    	$data['title'] = 'ยอดรวมรายงานทั้งปี '.date('Y');
    	$style = array(
    		'assets/css/accounting/home.css'
    	);
    	$data['style'] = $style;
    	$script = array(
    		'assets/js/accounting/main.js'
    	);
    	$id_company = id_company(); 
    	$data['script'] = $script;
    	$data['headerMenu'] = $this->getMenu('home');
    	
    	$breadcrumb = array();
    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
    	$breadcrumb[] = array('text'=>'ภาพรามรายงาน','url'=>route('report'),'active'=>1);
    	$data['breadcrumb'] = breadcrumb($breadcrumb);

        $data['chart'] = array();
        $type_bill = array(
                'quotation',
                'billingnote',
                'receipt',
                'purchaseOrder',
                'productReceipt'
            );
        $head = array('Year');
        foreach ($type_bill as $bill) {
            $head[] = $bill;
        }
        $data['chart'][] = $head;
        $company = $this->model('company');
        $report = $this->model('report');
        $company_info = $company->getCompany();
        $date_company_start_month = date('m', strtotime($company_info['company_date_create']));
        $date_company_start_year = date('Y', strtotime($company_info['company_date_create']));
        for ($i=$date_company_start_month;  $i<=date('n'); $i++) {
            $temp = array(date('M', strtotime($date_company_start_year.'-'.sprintf('%02d', $i).'-01')).'-'.date('y',strtotime($date_company_start_year.'-'.$date_company_start_month.'-01')));
            foreach ($type_bill as $bill) {
                $date_start = $date_company_start_year.'-'.sprintf('%02d', $i).'-01';
                $date_end = $date_company_start_year.'-'.sprintf('%02d', $i).'-'.date('t', strtotime($date_company_start_year.'-'.sprintf('%02d', $i).'-01 00:00:00'));
                $total = $report->totalReport($bill, $date_start, $date_end);
                $temp[] = (double)$total;
                
            }
            $data['chart'][] = $temp;
        }
        $data['chart'] = json_encode($data['chart']);

    	$this->view('report/index',$data);
    }
    public function getMenu($active=''){
    	$result = '<div class="nav-scroller bg-white shadow-sm">
				  <nav class="nav nav-underline">
				    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('report').'">ภาพรามรายงาน</a>
                    <a class="nav-link '.($active=='report'?'active':'').'" href="'.route('report/report').'">รายงาน</a>
				  </nav>
				</div>';
		return $result;
    }
    public function report() {
    	$data = array(); 
    	$data['title'] = 'รายงานขาย';
    	$data['headerMenu'] = $this->getMenu('report');
    	
    	$breadcrumb = array();
    	$breadcrumb[] = array('text'=>'รวมบัญชี','url'=>route('accounting/home'));
    	$breadcrumb[] = array('text'=>'ภาพรามรายงาน','url'=>route('report'));
    	$breadcrumb[] = array('text'=>'รายงาน','url'=>route('report/report'),'active'=>1);
    	$data['breadcrumb'] = breadcrumb($breadcrumb);
    	$style = array(
            'assets/css/select2.css',
            'assets/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.css'
        );
        $data['style'] = $style;
        $script = array(
            'assets/js/select2.full.js',
            'assets/boostrap_jquery/js/jquery-ui.js',
            'assets/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js',
            'assets/bootstrap-datepicker-master/dist/locales/bootstrap-datepicker.th.min.js',
            'assets/boostrap_jquery/js/bootstrap-datepicker-BE.js',
        );
        $data['script'] = $script;

        $data['action'] = route('report/report');
        $data['action_export'] = route('report/export_report');
        
        $data['reports']    = array();
        $data['type_bill']  = '';
        $data['date_start'] = '01-'.date('m').'-'.(date('Y')+543);
        $data['date_end']   = sprintf('%02d', date('t')).'-'.date('m').'-'.(date('Y')+543);
        if (method_post()) {
            $data['type_bill']  = post('type_bill');
            $data['date_start'] = post('date_start');
            $data['date_end']   = post('date_end');

            $date_start = $data['date_start'];
            $ex = explode('-', $date_start);
            $ex[2] -= 543;
            $new = array();
            for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
            $date_start = implode('-', $new);

            $date_end = $data['date_end'];
            $ex = explode('-', $date_end);
            $ex[2] -= 543;
            $new = array();
            for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
            $date_end = implode('-', $new);

            $report = $this->model('report');

            $data['reports'] = $report->getReport(post('type_bill'), $date_start, $date_end);    
        }
        

        $pageing = array(
            'total' => count($data['reports']),
            'link'  => route('report/report'),
            'active'=> 1
        );
        $data['pageing'] = pageing($pageing);

        $this->view('report/report',$data);
    }
    public function export_report(){
        $data = array();
        $data['reports']    = array();
        $data['type_bill']  = '';
        $data['date_start'] = '01-'.date('m').'-'.(date('Y')+543);
        $data['date_end']   = sprintf('%02d', date('t')).'-'.date('m').'-'.(date('Y')+543);
        if (method_post()) {
            $data['type_bill']  = post('type_bill');
            $data['date_start'] = post('date_start');
            $data['date_end']   = post('date_end');

            $date_start = $data['date_start'];
            $ex = explode('-', $date_start);
            $ex[2] -= 543;
            $new = array();
            for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
            $date_start = implode('-', $new);

            $date_end = $data['date_end'];
            $ex = explode('-', $date_end);
            $ex[2] -= 543;
            $new = array();
            for ($i=2; $i>=0; $i--) { $new[] = $ex[$i]; }
            $date_end = implode('-', $new);

            $report = $this->model('report');

            $data['reports'] = $report->getReport(post('type_bill'), $date_start, $date_end);    
        }
        $this->view('report/export_report',$data,false);
    }
   
}