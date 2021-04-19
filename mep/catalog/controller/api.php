<?php 
	class ApiController extends Controller {
	    public function getCustomer(){
	    	$data = array();
	    	$id_customer = get('id_customer');
	    	$id_company  = id_company();
	    	$customer = $this->model('customer');
	    	$data_customer = array(
	    		'id_customer' 	=> $id_customer,
	    		'id_company'	=> $id_company
	    	);
	    	$result_customer = $customer->getCustomerByIdCompany($data_customer);
	    	$this->json($result_customer);
	    }
	    public function sendEmail(){
	    	$data = array();
	    	if(method_post()){
		    	$accounting = $this->model('accounting');
		    	$data_select = array(
		    		'doc_no' 	=> 	post('doc_no'),
		    		'id_user'	=>	id_user(),
		    		'id_company'=>	id_company(),
		    		'type_bill'	=>	post('type_bill')
		    	);
		    	
		    	$result_email = $accounting->getBill($data_select);
		    	$email = post('email');
		    	$email_file_name = post('type_bill').'_'.post('doc_no');

		    	$to_email 	= $email;
		    	$subject	= $email_file_name;
		    	$msg 		= post('type_bill').' NO. '.post('doc_no').' <br><a href="'.MURL.'file/'.$result_email['file_name'].'" target="_blank" class="btn btn-success" download="'.$email_file_name.'.pdf"></a>';
		    	$attch_file = 'file/'.$result_email['file_name'];
		    	sendmailSmtp($to_email,$msg,$subject,$attch_file,$email_file_name.'.pdf');
		    	$result = array(
		    		'result' => 'success',
		    		'send_to_email' => $to_email,
		    		'msg'	=> $msg,
		    		'subject'	=> $subject
		    	);
		    	$this->json($result);
		    }
	    }
	}
?>