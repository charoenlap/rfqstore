<?php 
	class ContactController extends Controller {
	    public function index() {
	    	$data = array();
	    	$data['title'] = "Contact";
	    	$style = array(
	    		'assets/contact.css'
	    	);
	    	$data['style'] = $style;
	    	$data['action'] = 'index.php?route=contact/email';

	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	}
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	}

 	    	$this->view('contact',$data);
	    }
	    public function googleCaptcha() {
	    	$url = 'https://www.google.com/recaptcha/api/siteverify';
	    	$post = array();
	    	$post['secret'] = '6LedVqUZAAAAAMZ_JOKuuTwBYyiOd2W6s3WFUh5-';
	    	$post['response'] = $_POST['g-recaptcha-response'];
	    	$post['remoteip'] = $_SERVER['REMOTE_ADDR'];
	    	
	    	$result = curlPost($url, $post);
	    	if ($result['success'] == 1) {
	    		return true;
	    	} else {
	    		return false;
	    	}
	    	exit();
	    }
	    public function email() {
	    	$data['name']     = '';
			$data['email']    = '';
			$data['subject']  = '';
			$data['priority'] = 1;
			$data['message']  = '';
	    	if (method_post()) {

				$data['name']     = post('name');
				$data['email']    = post('email');
				$data['subject']  = post('subject');
				$data['priority'] = post('priority');
				$data['message']  = post('message');
				
	    		if ($this->googleCaptcha()==false) {
	    			$this->setSession('error', 'เกิดข้อผิดพลาดเกี่ยวกับ Google Captcha');
	    			redirect('contact');
	    			exit();
	    		}

	    		if (empty(post('name'))) {
	    			$this->setSession('error', 'กรุณากรอกชื่อนามสกุล');
	    			redirect('contact');
	    			exit();
	    		}
	    		if (empty(post('email'))) {
	    			$this->setSession('error', 'กรุณาติดต่ออีเมลที่ติดต่อกลับ');
	    			redirect('contact');
	    			exit();
	    		}
	    		if (empty(post('subject'))) {
	    			$this->setSession('error', 'กรุณากรอกชื่อเรื่อง');
	    			redirect('contact');
	    			exit();
	    		}
	    		if (empty(post('message'))) {
	    			$this->setSession('error', 'กรุณากรอกเนื้อหาข้อความ');
	    			redirect('contact');
	    			exit();
	    		}

	    		$newfile = '';
		    	if ($_FILES['document']['error']==0) {
		    		$fileType = strtolower(pathinfo(basename($_FILES["document"]["name"]),PATHINFO_EXTENSION));
		    		$fileAllow = array('jpg','gif','jpeg','png','pdf');
		    		if (in_array($fileType, $fileAllow)) {
		    			$newfile = 'contact'.date('d-m-Y_H:i:s').'.'.$fileType;
		    			upload($_FILES['document'], DOCUMENT_ROOT.'uploads/contact/', $newfile);	
		    		}
		    	}
		    	$priority = array('ต่ำสุด','ปานกลาง','สูงสุด');
		    	$subject = 'ติดต่อจาก rfqstore.com '.$priority[post('priority')].' : '.post('subject');
		    	$msg = 'ติดต่อจาก rfqstore.com<br><br>';
		    	$msg .= 'ระดับความสำคัญ '.$priority[post('priority')].'<br>';
		    	$msg .= 'จาก '.post('name').' ('.post('name').')<br><br>';
		    	$msg .= 'เรื่อง '.post('subject').'<br>';
		    	$msg .= post('message').'<br>';
		    	if (!empty($newfile)) {
		    		sendmailSmtp('friendlysoftpro@gmail.com', $msg, $subject, 'uploads/contact/'.$newfile, 'FILE');		
		    	} else {
		    		sendmailSmtp('friendlysoftpro@gmail.com', $msg, $subject);	
		    	}
		    	

		    	$insert = array(
					'name'       => post('name'),
					'email'      => post('email'),
					'subject'    => post('subject'),
					'priority'   => post('priority'),
					'message'    => post('message'),
					'file'       => !empty($newfile) ? 'uploads/contact/'.$newfile : '',
					'date_added' => date('Y-m-d H:i:s'),
		    	);
		    	$contact = $this->model('contact');
		    	$result = $contact->save($insert);
		    	if ($result>0) {
		    		$this->rmSession('error');
		    		$this->setSession('success', 'ส่งข้อความติดต่อสำเร็จ');
			    	redirect('contact');
			    	exit();
		    	} else {
		    		$this->setSession('error', 'เกิดข้อผิดพลาดในการส่ง');
			    	redirect('contact');
			    	exit(); 
		    	}

		    	// $this->setSession('success','')
	    	}
	    }
	}
?>