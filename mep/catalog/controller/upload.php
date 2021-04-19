<?php
class UploadController extends Controller {

	public function __construct() {
		// $this->checkPermission();
	}
	public function index() { 
		$data = array();
		$data['id_company'] = id_company();
		// $this->render('upload/filemanager',$data);
		// echo 'ok';
		
		// $this->view('upload/filemanager',$data);
	} 


	public function home() {
		$data = array(); 
    	$data['title'] = 'File Manager';
		$breadcrumb = array();
    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
    	$breadcrumb[] = array('text'=>'จัดการไฟล์','url'=>route('upload/home'));
    	$data['breadcrumb'] = breadcrumb($breadcrumb);
    	$data['search'] = '';
		$this->view('upload/index',$data);
	}

	public function load() {
		$json = array();
		$result = '<div class="row">';

		$dir = DOCUMENT_ROOT."/uploads/".id_company()."/";
		$path = '';
		$newpath = array();
		$ex = array();
		if (isset($_POST['path'])&&!empty($_POST['path'])) {

			$newpath = array();
			$ex = explode('/', $_POST['path']);
			foreach ($ex as $v) {
				if ($v=='..') {
					array_pop($newpath);
				} else {
					if (!empty($v)) {
						$newpath[] = $v;
					}
				}
			}
			$path = implode('/',$newpath);
			$dir .= trim($path);
		}

		$download = false;
		if (isset($_POST['download'])) {
			$download = (bool)post('download');
		}

		$model_upload = $this->model('upload');

		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
		  	$i=1;
		    while (($file = readdir($dh)) !== false){
		    	if (!in_array($file, array('.','..','...'))) {
		    		if (empty($_POST['search']) || (isset($_POST['search'])&&!empty($_POST['search'])&&strpos($file, $_POST['search'])!==false)) {
		    			$imageFileType = pathinfo($file,PATHINFO_EXTENSION); 
						$result .= '<div class="col-6 col-md-3">';
						
						if (empty($imageFileType)) {
					      	$result .=  '<button type="button" class="btn-light folder selectfolder" data-path="'.$file.'">
					      					<img src="'.MURL.'assets/image/folder.png" class="img-fluid" style="width:100%;" />
					      					<br> 
				      					</button>
				      					<div class="form-check">
										  <input class="form-check-input" type="checkbox" value="" id="defaultCheckFolder'.$i.'" data-path="'.$file.'">
										  <label class="form-check-label" for="defaultCheckFolder'.$i.'">'.$file.'</label>
										</div> ';
						} else if ($imageFileType=='pdf') {
					      	$result .=  '<button type="button" class="btn-light" data-path="'.$file.'">
					      					<img src="'.MURL.'assets/image/pdf.png" class="img-fluid" style="width:100%;" />
					      					<br> 
				      					</button>
				      					<div class="form-check">
										  <input class="form-check-input" type="checkbox" value="" id="defaultCheckFolder'.$i.'" data-path="'.$file.'">
										  <label class="form-check-label" for="defaultCheckFolder'.$i.'">'.$file.'</label>
										</div> ';
						} else {
							$imagepath = MURL.'uploads/'.id_company().'/'.$path.'/'.$file;
							if ($download) 
							$result .= '<a href="'.route('upload/download').'&image=uploads/'.id_company().'/'.$path.'/'.$file.'" target="new">';

					      	$result .=  '<img src="'.$imagepath.'" class="img-fluid selectimg" data-company="'.id_company().'" data-path="/'.$file.'" alt="'.$file.'" /><br>
				      					<div class="form-check">
										  <input class="form-check-input" type="checkbox" value="" id="defaultCheckFile'.$i.'" data-path="/'.$file.'">
										  <label class="form-check-label" style="word-break: break-all;" for="defaultCheckFile'.$i.'">'.$file.'</label>
										</div>';
							if ($download) 
							$result .= "</a>";

						}
						$result .= '</div>';
						$i++;
		    		}
		    	}
		    }
		    closedir($dh);
		  }
		}

		$result .= '</div>';


		$json['html'] = $result;
		$json['path'] = '/'.$path;

		echo json_encode($json);
	}

	public function download() {
		$file = DOCUMENT_ROOT.get('image');
		$imageFileType = pathinfo($file,PATHINFO_EXTENSION); 
		if( !file_exists($file) ) die("File not found");
        header('Content-Disposition: attachment; filename=img_'.time().'.'.$imageFileType);
        header('Content-Type: application/octet-stream'); // Downloading on Android might fail without this
        ob_clean();

        readfile($file);

		exit();
	}

	public function uploadfile() {
		$result = 0;
		if ($_SERVER['REQUEST_METHOD']=='POST') {

			/* Getting file name */
			$filename = $_FILES['file']['name'];
			$size = $_FILES['file']['size'];

			$path = isset($_POST['path']) ? post('path') : '';

			/* Location */
			$uploadOk = 1; 
			$imageFileType = pathinfo($filename,PATHINFO_EXTENSION);
			$newfilename = md5(id_company().$filename).'.'.$imageFileType;
			$location = DOCUMENT_ROOT."/uploads/".id_company()."/".$path.'/'.$newfilename;


			/* Valid Extensions */
			$valid_extensions = array("jpg","jpeg","png","pdf","docx","doc","ppt","ppt","xls","xlsx");
			/* Check file extension */
			if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
			   $uploadOk = 0;
			}
 
			if($uploadOk == 0){
			   $result = 0;
			}else{
			   /* Upload file */
			   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
			   		$insert = array(
						'id_company' => id_company(),
						'id_user'    => id_user(),
						'name'       => $filename,
						'image'      => $path.($path=='/'?'':'/').$newfilename,
						'type'       => $imageFileType,
						'size'       => $size,
						'date_added' => date('Y-m-d H:i:s',time())
			   		);
			   		$model_upload = $this->model('upload');
			   		$model_upload->addFile($insert);
					$result = $location;
			   }else{
			      $result = 0;
			   }
			}
		}
		echo $result;
	}

	public function makedir() {
		$dir = DOCUMENT_ROOT."/uploads/".id_company()."/";
		$path = $_POST['path'];
		if( is_dir($dir.$path.'/'.$_POST['name'].'/') === false )
		{
			$old = umask(0);
		    echo mkdir($dir.$path.'/'.$_POST['name'].'/', 0777);
		    umask($old);
		} else {
			echo false;
		}
	}

	public function removedir($path='') {
		$dir = DOCUMENT_ROOT."/uploads/".id_company()."";
		if (isset($_POST['path'])&&empty($path)) {
			$path = $_POST['path'];	
		}
		if (is_file($dir.$path)) {
			if (!unlink($dir.$path)) {
				return false;
			} else {
				return true;
			}
		} else {
			if ($handle = opendir($dir.$path)) {
				while ($sub = readdir($handle)) {
					if ($sub!='.'&&$sub!='..') { 
						if (is_dir($dir.$path.'/'.$sub)) {
							
							if (!$this->removedir($path.'/'.$sub)) {
								return false;
							}
						} else if (is_file($dir.$path.'/'.$sub)) { 
							if (!unlink($dir.$path.'/'.$sub)) {
								return false;
							}
						}
					}
				}

				if (!rmdir($dir.$path)) {
					return false;
				} else {
					return true;
				}
			}
		}
		
		
	}


}