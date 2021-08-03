<?php 
	class UserController extends Controller {
	    public function login() {
	    	$data = array();
	    	$data['title'] = "Login";
	    	$style = array(
	    		'assets/login.css'
	    	);
	  //   	$fb = new Facebook\Facebook([
			//   'app_id' 					=> app_id,
			//   'app_secret' 				=> app_secret,
			//   'default_graph_version' 	=> default_graph_version,
			//   ]);
			// $helper = $fb->getRedirectLoginHelper();

			// $permissions = ['email'];
			// $loginUrl = $helper->getLoginUrl(MURL.'index.php?route=user/fbCallback', $permissions);
			$loginUrl = '';
			$data['url_login_fb'] = $loginUrl;

			// $client = new Google_Client();
			// $client->setApplicationName('login rfqstore');
			// $client->setClientId(GOOGLE_CLIENT_ID);
			// $client->setClientSecret(GOOGLE_CLIENT_SECRET);
			// $client->setRedirectUri(GOOGLE_REDIRECT_URL);
			// $client->setScopes(array(Google_Service_Plus::PLUS_ME));
			// $plus = new Google_Service_Plus($client);

			// $state = mt_rand();
	  //       $client->setState($state);
	  //       $_SESSION['state'] = $state;

	        // $data['link_gmail'] = $client->createAuthUrl();

			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

	    	$data['style'] 	= $style;
	    	$data['action'] = route('user/submitLogin');
	    	$data['result'] = (get('result')=='Fail'?'Fail':'');
	    	$this->getSession('id_user');
 	    	$this->view('user/login',$data); 
	    }
	    public function submitLogin(){
	    	if(method_post()){
	    		$captcha = true ;
				if(PRODUCTION){
					$captcha = $this->googleCaptcha();
				}
				if ($captcha==true) {
	    			$data_login = array(
						'user_email'    => post('user_email'),
						'user_password' => post('user_password')
		    		);
		    		$this->funcLogin($data_login);	
	    		} else {
	    			$this->setSession('error', 'Google Captcha Fail');
	    			redirect('user/login');
	    		}
	    		
	    	}
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
	    }
	    public function funcLogin($data = array()){
	    	$user = $this->model('user');
    		if ($user->findEamil($data['user_email'])==0) {
				$this->setSession('error', 'ไม่พบอีเมลในระบบ โปรดสมัครเข้าใช้งานหรือติดต่อเรา');
				$this->redirect('user/login');
				exit();
    		} else {
	    		$data_login = array(
					'user_email'    => $data['user_email'],
					'user_password' => $data['user_password']
	    		);
    			$result_login = $user->login($data_login);

	    		if($result_login){
	    			$this->setSession('id_user'		,$result_login['id_user']);
	    			$this->setSession('user_key'	,$result_login['user_key']);
	    			$this->setSession('token'		,$result_login['token']);
	    			$this->setSession('user_name'	,$result_login['user_name']);
	    			$this->setSession('user_lname'	,$result_login['user_lname']);
	    			$this->redirect('home','mep');
	    			exit();
	    		}else{
	    			$this->setSession('error', 'ล็อคอินไม่สำเร็จ อีเมลหรือรหัสผ่านไม่ถูกต้อง');
					$this->redirect('user/login');
					exit();
	    		}
    		}
	    }
	    public function gmailCallback(){
	  //   	$client = new Google_Client();
			// $client->setApplicationName('login rfqstore');
			// $client->setClientId(GOOGLE_CLIENT_ID);
			// $client->setClientSecret(GOOGLE_CLIENT_SECRET);
			// $client->setRedirectUri(GOOGLE_REDIRECT_URL);
			// $client->setScopes(array(Google_Service_Plus::PLUS_ME));
			// $plus = new Google_Service_Plus($client);

			// if (isset($_REQUEST['logout'])) {
			//         unset($_SESSION['access_token']);
			// }

			// if (isset($_GET['code'])) {
		 //        // if (strval($_SESSION['state']) !== strval($_GET['state'])) {
		 //        // 	echo 'The session state did not match.';
		 //        //         // error_log();
		 //        //         exit(1);
		 //        // }

		 //        $client->authenticate($_GET['code']);
		 //        $_SESSION['access_token'] = $client->getAccessToken();
		 //        // header('Location: ' . REDIRECT);
			// }

			// if (isset($_SESSION['access_token'])) {
			//         $client->setAccessToken($_SESSION['access_token']);
			// }
			// $profile = $plus->people->get(
			//   'people/me', 
			//   array('personFields' => 'names,emailAddresses,photos')
			// );
			// var_dump($client->getAccessToken());
			// var_dump($client->isAccessTokenExpired());
			// if ($client->getAccessToken() && !$client->isAccessTokenExpired()) {

			 // $me = $plus->people->get('me');
		        // try {
		        //         $me = $plus->people->get('me');
		        //         $body = '<PRE>' . print_r($me, TRUE) . '</PRE>';
		        // } catch (Google_Exception $e) {
		        //         error_log($e);
		        //         $body = htmlspecialchars($e->getMessage());
		        // }
		        // echo "test";
		        // var_dump($body);
		        # the access token may have been updated lazily
		        // $_SESSION['access_token'] = $client->getAccessToken();
			// }
	    }
	    public function fbCallback(){
	    	$result = array();
	    	$accessToken = '';
	    	$fb = new Facebook\Facebook([
			  'app_id' 					=> app_id,
			  'app_secret' 				=> app_secret,
			  'default_graph_version' 	=> default_graph_version,
			  ]);
			$helper = $fb->getRedirectLoginHelper();
			try {
			  $accessToken = $helper->getAccessToken();
			} catch(Facebook\Exception\ResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exception\SDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
			$_SESSION['facebook_access_token'] = (string) $accessToken;
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			$response = $fb->get('/me?locale=en_US&fields=name,email,first_name,last_name');
			$userNode = $response->getGraphUser();
			
			$email 			= (isset($userNode['email'])?$userNode['email']:'');
			$first_name 	= (isset($userNode['first_name'])?$userNode['first_name']:'');
			$last_name 		= (isset($userNode['last_name'])?$userNode['last_name']:'');
			$id_user_fb 	= (isset($userNode['id'])?$userNode['id']:'');
			$password 		= rand(10000,9999);
			$data_register = array(
    			'user_email'	=> $email,
    			'user_password'	=> $password,
    			'user_name'		=> $first_name,
    			'user_lastname'	=> $last_name,
    			'user_phone'	=> '',
    			'id_user_fb'	=> $id_user_fb
    		);
    		$user = $this->model('user');
    		$result_register = $user->register($data_register);
    		if($result_register['status'] == 'success'){
    			$data_login = array(
	    			'user_email' 	=> $email,
	    			'user_password' => $password,
	    			'id_user_fb'	=> $id_user_fb
	    		);
	    		$this->funcLogin($data_login);
    		}else{
    			$data['status'] = $result_register['status'];
    			$data['desc']	= $result_register['desc'];
    			$this->view('user/register',$data);
    		}

	    	return $result;
	    }
	    public function register() {
	    	$data = array(
	    		'status' 	=> '',
	    		'desc'		=> ''
	    	);
	    	$data['title'] = "Register";
	    	$style = array(
	    		'assets/css/register.css'
	    	);
	    	$data['style'] = $style; 
	    	$script = array(
	    		'assets/js/register.js'
	    	);
	    	$data['script'] = $script; 
	    	$data['action'] = route('user/register');
	    	$loginUrl = '';
	  //   	$fb = new Facebook\Facebook([
			//   'app_id' 					=> app_id,
			//   'app_secret' 				=> app_secret,
			//   'default_graph_version' 	=> default_graph_version,
			//   ]);

			// $helper = $fb->getRedirectLoginHelper();

			// $permissions = ['email'];
			// $loginUrl = $helper->getLoginUrl(MURL.'index.php?route=user/fbCallback', $permissions);
			$data['url_login_fb'] = $loginUrl;
			if ($this->hasSession('success')) {
				$data['success'] = $this->getSession('success');
				$this->rmSession('success');
			}
			if ($this->hasSession('error')) {
				$data['error'] = $this->getSession('error');
				$this->rmSession('error');
			}

	    	if(method_post()){
	    		$captcha = true ;
				if(PRODUCTION){
					$captcha = $this->googleCaptcha();
				}
				if ($captcha==true) { 
	    			$data_register = array(
		    			'user_email'	=> post('user_email'),
		    			'user_password'	=> post('user_password'),
		    			'user_name'		=> post('user_name'),
		    			'user_lastname'	=> post('user_lastname'),
		    			'user_phone'	=> post('user_phone')
		    		);
		    		$user = $this->model('user');
		    		$result_register = $user->register($data_register);
		    		if($result_register['status'] == 'success'){
		    			$data_login = array(
			    			'user_email' => post('user_email'),
			    			'user_password' => post('user_password')
			    		);
			    		$this->funcLogin($data_login);
		    		}else{
		    			$this->setSession('error',$result_register['desc']);
		    			redirect('user/register');
		    		}
	    		} else {
	    			$this->setSession('error', 'Google Captcha Fail');
	    			redirect('user/register');
	    		}
	    		
	    	}else{
	 	    	$this->view('user/register',$data);
	    	}
	    }
	}
?>