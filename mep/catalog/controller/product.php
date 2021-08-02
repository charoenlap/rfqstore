<?php 
	class ProductController extends Controller {
		public function __construct() {
			$this->checkPermission();
		}
	    public function home() {
	    	$data = array();
	    	$data['title'] = 'Product';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('home');

	    	$data['chart'] = array();
	    	$data['chart'][] = array('Year', 'Number of products');
	    	$model_product = $this->model('product');
	    	$results = $model_product->countProductPerMonth();
	    	if (count($results)>0) {
		    	foreach ($results as $key => $value) {
		    		$data['chart'][] = array($value['month'], (int)$value['count']);
		    	}	
	    	} else {
	    		$data['chart'][] = array(date('Y', time()), 0);
	    	}
	    	$data['chart'] = json_encode($data['chart']);

	    	$data['chart2'] = array();
	    	$data['chart2'][] = array('Year', 'Number of categories');
	    	$model_product = $this->model('product');
	    	$results = $model_product->countCategoryPerMonth();
	    	if (count($results)>0) {
		    	foreach ($results as $key => $value) {
		    		$data['chart2'][] = array($value['month'], (int)$value['count']);
		    	}	
	    	} else {
	    		$data['chart2'][] = array(date('Y', time()), 0);
	    	}
	    	$data['chart2'] = json_encode($data['chart2']);

 	    	$this->view('product/home',$data);
	    }
	    public function getMenu($active=''){
	    	$model_product = $this->model('product');
	    	$count_product =  (int)$model_product->countProduct(id_company());
	    	$count_category = (int)$model_product->countCategories(id_company());
	    	$count_werehouse = (int)$model_product->countWerehouse(id_company());
	    	$result = '<div class="nav-scroller bg-white shadow-sm">
					  <nav class="nav nav-underline">
					    <a class="nav-link '.($active=='home'?'active':'').'" href="'.route('product/home').'">ภาพรวมสินค้า</a>
					    <a class="nav-link '.($active=='product'?'active':'').'" href="'.route('product/listProduct').'">
					      รายการสินค้า
					      <span class="badge badge-pill bg-light align-text-bottom">'.$count_product.'</span>
					    </a>
					    <a class="nav-link '.($active=='category'?'active':'').'" href="'.route('product/listCategory').'">
					      หมวดหมู่
						  <span class="badge badge-pill bg-light align-text-bottom">'.$count_category.'</span>
					    </a>
					    <a class="nav-link '.($active=='werehouse'?'active':'').'" href="'.route('product/listWerehouse').'">
					      คลังสินค้า
					      <span class="badge badge-pill bg-light align-text-bottom">'.$count_werehouse.'</span>
					    </a>
					  </nav>
					</div>';
			return $result;
	    }
	    public function addRowImage() {
	    	$html = '';
	    	if (method_post()) {
	    		if (isset($_POST['name'])&&!empty($_POST['name'])) {
	    			$name = $_POST['name'];
	    			$id = $_POST['id'];
		    		$html = '<img src="'.MURL.'assets/image/noimg.png'.'" alt="preview" id="preview_'.$id.'" class="img-thumbnail mb-2 img-fluid"><br>';
					$html .= '<input type="hidden" name="'.$name.'" id="input_'.$id.'" value=""> ';
					$html .= '<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#modal_filemanager" data-result="#input_'.$id.'" data-preview="#preview_'.$id.'">';
						$html .= '<i class="far fa-image"></i>';
						$html .= '</button>';
					$html .= '<button type="button" class="btn btn-outline-danger upload_removeimg" data-result="#input_'.$id.'" data-preview="#preview_'.$id.'">
						<i class="far fa-trash-alt"></i>';
					$html .= '</button>';		
	    		}
	    	
	    	
	    		// echo $data['upload'] = $this->getHtml('upload/index');
	    		// echo $this->file(post('name'), post('multiple'));
	    	}
	    	echo $html;
	    }

		public function addRowOption() {
	    	$html = '';
	    	if (method_post()) {
	    		if (isset($_POST['name'])&&!empty($_POST['name'])) {
	    			$name = $_POST['name'];
	    			$id = $_POST['id'];
					$html = '<div class="form-row">';
					$html .= '<div class="form-group col-md-3">';
					$html .= '<label for="">ชื่อรายการ</label>';
					$html .= '<input type="text" class="form-control" id="name_'.$id.'" name="'.$name.'['.$id.'][product_option_name]" placeholder="รายการ" value="">';
					$html .= '</div>';
					$html .= '<div class="form-group col-md-3">';
					$html .= '<label for="">ราคาขาย</label>';
					$html .= '<input type="number" class="form-control" id="price_'.$id.'" name="'.$name.'['.$id.'][product_option_price]" min="0" placeholder="ราคาขาย" value="">';
					$html .= '</div>';
					$html .= '<div class="form-group col-md-3">';
					$html .= '<label for="">ราคาลดพิเศษ</label>';
					$html .= '<input type="number" class="form-control" id="special_'.$id.'" name="'.$name.'['.$id.'][product_option_special]" min="0" placeholder="ราคาลดพิเศษ" value="">';
					$html .= '</div>';
					$html .= '<div class="form-group col-md-3">';
					$html .= '<label for="">จำนวนสินค้า</label>';
					$html .= '<input type="number" class="form-control" id="quantity_'.$id.'" name="'.$name.'['.$id.'][product_option_quantity]" min="0" placeholder="จำนวนสินค้า" value="">';
					$html .= '</div>';
					$html .= '</div>';	
	    		}
	    		// echo $data['upload'] = $this->getHtml('upload/index');
	    		// echo $this->file(post('name'), post('multiple'));
	    	}
	    	echo $html;
	    }

	// ================= Product ======================
	    public function listProduct() {
	    	$data = array();
	    	$data['title'] = 'List Product';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'รายการสินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('product');
	    	$data['user_key'] = $this->getSession('user_key');  
	    	$data['link_search'] = route('product/listProduct');

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	$filter = array();
	    	if (method_post()) {
	    		$filter['search'] = post('search');
	    	}
	    	$model_product = $this->model('product');
	    	$data['products'] = $model_product->getProducts($filter);
			$data['categories'] = $model_product->getCategories();

 	    	$this->view('product/listProduct',$data);
	    }
	    public function addProduct() {
	    	$data = array();
	    	$data['title'] = 'Add Product';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'รายการสินค้า','url'=>route('product/listProduct'));
	    	$breadcrumb[] = array('text'=>'เพิ่มสินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('product');
	    	$data['action'] = route('product/addProduct');
	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;

	    	$model_product = $this->model('product');
	    	$data['categories'] = $model_product->getCategories();
	    	$data['werehouses'] = $model_product->getWerehouses();



	    	$data['filemanager'] = $this->getHtmlUpload();
	    	

	    	// $upload = $this->call('upload');

	    	// $data['upload'] = $this->getHtml('upload/index&name=product_image');
	    	
	    	// $data['upload'] = $upload->index();

			$data['id_category']        = '';
			$data['id_werehouse']       = '';
			$data['product_name']       = '';
			$data['product_quantity']   = '';
			$data['product_unit']       = '';
			$data['product_price']      = '';
			$data['product_detail']     = '';
			$data['product_code']       = '';
			$data['product_image']      = '';
			$data['product_thumb']      = array();
			$data['product_status']     = 1;
			$data['product_isstock']    = 0;
			
			$data['date_created']       = '';
			$data['date_updated']       = '';

	    	if (method_post()) {

	    		$model_product = $this->model('product');

	    		$insert = $_POST;
	    		$insert['product_detail'] = htmlspecialchars($insert['product_detail'], ENT_QUOTES, 'UTF-8');

	    		$insert['id_company'] = id_company();
	    		$insert['date_created'] = date('Y-m-d H:i:s',time());
				$insert['date_updated'] = NULL;

	    		$result = $model_product->addProduct($insert);


	    		if ($result>0) {
	    			$this->setSession('success','เพิ่มสินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการเพิ่มสินค้า');
	    		}
	    		redirect('product/listProduct');
	    	}

 	    	$this->view('product/formProduct',$data);
	    }
	    public function editProduct() {
	    	$data = array();
	    	$data['title'] = 'Edit Product';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'รายการสินค้า','url'=>route('product/listProduct'));
	    	$breadcrumb[] = array('text'=>'แก้ไขสินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('product');

	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));
	    	$data['action'] = route('product/editProduct').'&id='.get('id');

	    	$style = array(
	    		'assets/bootstrap-select/dist/css/bootstrap-select.css'
	    	);
	    	$data['style'] = $style;
	    	$script = array(
	    		'assets/bootstrap-select/dist/js/bootstrap-select.js'
	    	);
	    	$data['script'] = $script;

	    	// $data['filemanager'] = $this->getHtml('upload/index');
	    	
	    	$data['filemanager'] = $this->getHtmlUpload();

	    	$model_product = $this->model('product');
	    	$data['categories'] = $model_product->getCategories();
	    	$data['werehouses'] = $model_product->getWerehouses();

	    	$product_info = $model_product->getProduct($id);

			$data['id_category']      	  = $product_info['id_category'];
			$data['id_werehouse']     	  = $product_info['id_werehouse'];
			$data['product_name']     	  = $product_info['product_name'];
			$data['product_quantity'] 	  = $product_info['product_quantity'];
			$data['product_unit']     	  = $product_info['product_unit'];
			$data['product_price']    	  = $product_info['product_price'];
			$data['product_special']  	  = $product_info['product_special'];
			$data['product_detail']   	  = html_entity_decode($product_info['product_detail'], ENT_QUOTES, 'UTF-8');
			$data['product_code']     	  = $product_info['product_code'];
			$data['product_image']    	  = $product_info['product_image'];
			$data['product_thumb']    	  = $product_info['product_thumb'];
			$data['product_option_price'] = $product_info['product_option_price'];
			$data['product_status']       = $product_info['product_status'];
			$data['product_isstock']      = $product_info['product_isstock'];
			$data['date_created']         = $product_info['date_created'];
			$data['date_updated']         = $product_info['date_updated'];

	    	// $data['upload'] = $this->file('product_image',false,IMAGE.'product/'.$product_info['product_image']);

	    	if (method_post()) {

	    		$model_product = $this->model('product');
	    		// bug
	    		// unset($_POST['product']);

	    		$insert = $_POST;
	    		// print_r($_POST);
	    		// print_r($_FILES);


	    		$insert['product_detail'] = htmlspecialchars($insert['product_detail'], ENT_QUOTES, 'UTF-8');
	    		$insert['id_company'] = id_company();
	    		$insert['date_updated'] = date('Y-m-d H:i:s',time());


	    		// echo '<pre>';
	    		// print_r($insert);
	    		// echo '</pre>';
	    		// exit();


	    		$result = $model_product->editProduct($insert, $id);

	    		if ($result>0) {
	    			$this->setSession('success','เพิ่มสินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการเพิ่มสินค้า');
	    		}
	    		redirect('product/listProduct');
	    	}

 	    	$this->view('product/formProduct',$data);
	    }
	    public function deleteProduct() {
	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));
	    	if ($this->model('product')->deleteProduct($id)>0) {
    			$this->setSession('success','ลบสินค้าเรียบร้อยแล้ว');
	    	} else {
    			$this->setSession('error','เกิดข้อผิดพลาดในการลบสินค้า');
	    	}

    		redirect('product/listProduct');
	    }

	    public function deleteProductThumb() {
	    	// $id = decode(post('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));
	    	$model_product = $this->model('product');
	    	$model_product->deleteProductThumb($id);
	    }
	    public function getProductByCode(){
	    	$data = array();
	    	$product_code = get('product_code');
	    	$id_company = id_company();
	    	if(!empty($id_company)){
	    		$data_select = array(
	    			'product_code' 	=> $product_code,
	    			'id_company'	=> $id_company
	    		);
		    	$product = $this->model('product');
		    	$result_product = $product->getProductByProductCode($data_select);
		    	$this->json($result_product);
		    }
	    }
	     public function getProductByName(){
	    	$data = array();
	    	$product_name = get('product_name');
	    	$id_company = id_company();
	    	if(!empty($id_company)){
	    		$data_select = array(
	    			'product_name' 	=> $product_name,
	    			'id_company'	=> $id_company
	    		);
		    	$product = $this->model('product');
		    	$result_product = $product->getProductByName($data_select);
		    	$this->json($result_product);
		    } 
	    }
    // ================= Product ======================



	// ================= Category ======================
	    public function listCategory() {
	    	$data = array();
	    	$data['title'] = 'List Category';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'หมวดหมู่สินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['action_search'] = route('product/listCategory');
	    	$data['user_key'] = $this->getSession('user_key');  
	    	$data['search'] = '';

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

			$filter = array();
			$filter['id_company'] = id_company();
	    	if (!empty(post('search'))) {
	    		$filter['category_code'] = post('search');
	    		$filter['category_name'] = post('search');
	    		$data['search'] = post('search');
	    	}
    		$model_product = $this->model('product');
    		$data['categories'] = $model_product->getCategories($filter);

 	    	$this->view('product/listCategory',$data);
	    }
	    public function addCategory() {
	    	$data = array();
	    	$data['title'] = 'Add Category';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'หมวดหมู่สินค้า','url'=>route('product/listCategory'));
	    	$breadcrumb[] = array('text'=>'เพิ่มหมวดหมู่สินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['action'] = route('product/addCategory');

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	$data['category_code'] = '';
	    	$data['category_name'] = NULL;

	    	if (method_post()) {

	    		if (!empty(post('category_code'))) {
	    			$data['category_code'] = post('category_code');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/addCategory');
	    		}

	    		if (!empty(post('category_name'))) {
	    			$data['category_name'] = post('category_name');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/addCategory');
	    		}

	    		$model_product = $this->model('product');
	    		$insert = array(
	    			'id_company' => id_company(),
					'category_name' => post('category_name'), 
					'category_code' => post('category_code'),
					'date_created'  => date('Y-m-d H:i:s',time()),
					'date_updated'  => NULL
	    		);
	    		$result = $model_product->addCategory($insert);
	    		if ($result>0) {
	    			$this->setSession('success','เพิ่มหมวดหมู่สินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่สินค้า');
	    		}
	    		redirect('product/listCategory');
	    	}
	    	// var_dump($data);
 	    	$this->view('product/formCategory',$data);
	    }
	    public function editCategory() {
	    	$data = array();
	    	$data['title'] = 'Edit Category';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'หมวดหมู่สินค้า','url'=>route('product/listCategory'));
	    	$breadcrumb[] = array('text'=>'แก้ไขหมวดหมู่สินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('category');
	    	$data['action'] = route('product/editCategory').'&id='.get('id');

	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	$model_product = $this->model('product');
	    	$category_info = $model_product->getCategory($id);

	    	$data['category_code'] = $category_info['category_code'];
	    	$data['category_name'] = $category_info['category_name'];

	    	if (method_post()) {

	    		if (!empty(post('category_code'))) {
	    			$data['category_code'] = post('category_code');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/editCategory');
	    		}

	    		if (!empty(post('category_name'))) {
	    			$data['category_name'] = post('category_name');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/editCategory');
	    		}

    			$update = array(
					'id_company'   => id_company(),
					'category_name' => post('category_name'), 
					'category_code' => post('category_code'),
					'date_updated'  => date('Y-m-d H:i:s',time())
	    		);
	    		$result = $model_product->editCategory($update,$id);
	    		if ($result>0) {
	    			$this->setSession('success','แก้ไขหมวดหมู่สินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการแก้ไขหมวดหมู่สินค้า');
	    		}	
	    		
	    		redirect('product/listCategory');
	    	}

 	    	$this->view('product/formCategory',$data);
	    }
	    public function deleteCategory() {
	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));
	    	if ($this->model('product')->deleteCategory($id)>0) {
    			$this->setSession('success','ลบหมวดหมู่สินค้าเรียบร้อยแล้ว');
	    	} else {
    			$this->setSession('error','เกิดข้อผิดพลาดในการลบหมวดหมู่สินค้า');
	    	}

    		redirect('product/listCategory');
	    }
    // ================= Category ======================



    // ================= Werehouse ======================
	    public function listWerehouse() {
	    	$data = array();
	    	$data['title'] = 'List Werehouse';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'คลังสินค้า','url'=>route('product/listWerehouse'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('werehouse');
	    	$data['action_search'] = route('product/listWerehouse');
	    	$data['user_key'] = $this->getSession('user_key');  
	    	$data['search'] = '';

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

			$filter = array();
	    	if (!empty(post('search'))) {
	    		$filter['werehouse_code'] = post('search');
	    		$filter['werehouse_name'] = post('search');
	    		$data['search'] = post('search');
	    	}
    		$model_product = $this->model('product');
    		$data['werehouses'] = $model_product->getWerehouses($filter);

 	    	$this->view('product/listWerehouse',$data);
	    }
	    public function viewWerehouse() {

	    	$data = array();
	    	$data['title'] = 'List Werehouse';
	    	$pageing = array(
	    		'total' => 10,
	    		'link'	=> route('#'),
	    		'active'=> 1
	    	);
	    	$data['pageing'] = pageing($pageing);
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'คลังสินค้า','url'=>route('product/listWerehouse'),'active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('werehouse');
	    	$data['action_search'] = route('product/listWerehouse');
	    	$data['user_key'] = $this->getSession('user_key');  
	    	$data['search'] = '';

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

			$filter = array();
	    	if (!empty(post('search'))) {
	    		$filter['werehouse_code'] = post('search');
	    		$filter['werehouse_name'] = post('search');
	    		$data['search'] = post('search');
	    	}
    		$model_product = $this->model('product');
    		$data['werehouses'] = array();
    		$werehouses = $model_product->getWerehouses($filter);
    		foreach ($werehouses as $werehouse) {
    			$product = $model_product->getProductsByWerehouseid($werehouse['id_werehouse']);
    			$werehouse['products'] = $product;
    			$data['werehouses'][] = $werehouse;
    		}

    		// echo '<pre>';
    		// print_r($data['werehouses']);
    		// echo '</pre>';
    		

 	    	$this->view('product/viewWerehouse',$data);
	    }
	    public function addWerehouse() {
	    	$data = array();
	    	$data['title'] = 'Add Category';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'คลังสินค้า','url'=>route('product/listWerehouse'));
	    	$breadcrumb[] = array('text'=>'เพิ่มคลังสินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('werehouse');
	    	$data['action'] = route('product/addWerehouse');

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	$data['werehouse_code'] = '';
	    	$data['werehouse_name'] = '';

	    	if (method_post()) {

	    		if (!empty(post('werehouse_code'))) {
	    			$data['werehouse_code'] = post('werehouse_code');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/addWerehouse');
	    		}

	    		if (!empty(post('werehouse_name'))) {
	    			$data['werehouse_name'] = post('werehouse_name');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/addWerehouse');
	    		}

	    		$model_product = $this->model('product');
	    		$insert = array(
	    			'id_company' => id_company(),
					'werehouse_name' => post('werehouse_name'), 
					'werehouse_code' => post('werehouse_code'),
					'date_created'  => date('Y-m-d H:i:s',time()),
					'date_updated'  => NULL
	    		);
	    		$result = $model_product->addWerehouse($insert);
	    		if ($result>0) {
	    			$this->setSession('success','เพิ่มคลังสินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการเพิ่มคลังสินค้า');
	    		}
	    		redirect('product/listWerehouse');
	    	}
 	    	$this->view('product/formWerehouse',$data);
	    }
	    public function editWerehouse() {
	    	$data = array();
	    	$data['title'] = 'Edit Werehouse';
	    	$breadcrumb = array();
	    	$breadcrumb[] = array('text'=>'หน้าหลัก','url'=>route('shop/home'));
	    	$breadcrumb[] = array('text'=>'ภาพรวมสินค้า','url'=>route('product/home'));
	    	$breadcrumb[] = array('text'=>'คลังสินค้า','url'=>route('product/listWerehouse'));
	    	$breadcrumb[] = array('text'=>'แก้ไขคลังสินค้า','url'=>'#','active'=>1);
	    	$data['breadcrumb'] = breadcrumb($breadcrumb);
	    	$data['headerMenu'] = $this->getMenu('werehouse');
	    	$data['action'] = route('product/editWerehouse').'&id='.get('id');

	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));

	    	$data['success'] = ''; 
	    	if ($this->hasSession('success')) {
	    		$data['success'] = $this->getSession('success');
	    		$this->rmSession('success');
	    	} 
	    	$data['error'] = ''; 
	    	if ($this->hasSession('error')) {
	    		$data['error'] = $this->getSession('error');
	    		$this->rmSession('error');
	    	} 

	    	$model_product = $this->model('product');
	    	$werehouse_info = $model_product->getwerehouse($id);

	    	$data['werehouse_code'] = $werehouse_info['werehouse_code'];
	    	$data['werehouse_name'] = $werehouse_info['werehouse_name'];

	    	if (method_post()) {

	    		if (!empty(post('werehouse_code'))) {
	    			$data['werehouse_code'] = post('werehouse_code');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/editWerehouse');
	    		}

	    		if (!empty(post('werehouse_name'))) {
	    			$data['werehouse_name'] = post('werehouse_name');
	    		} else  {
	    			$this->setSession('error','ไม่มีรหัสผ่าน');
	    			redirect('product/editWerehouse');
	    		}

    			$update = array(
					'id_company'   => id_company(),
					'werehouse_name' => post('werehouse_name'), 
					'werehouse_code' => post('werehouse_code'),
					'date_updated'  => date('Y-m-d H:i:s',time())
	    		);
	    		$result = $model_product->editWerehouse($update,$id);
	    		if ($result>0) {
	    			$this->setSession('success','แก้ไขคลังสินค้าเรียบร้อยแล้ว');
	    		} else {
	    			$this->setSession('error','เกิดข้อผิดพลาดในการแก้ไขคลังสินค้า');
	    		}	
	    		
	    		redirect('product/listWerehouse');
	    	}

 	    	$this->view('product/formWerehouse',$data);
	    }
	    public function deleteWerehouse() {
	    	// $id = decode(get('id'), $this->getSession('user_key'));
	    	$id = decrypt(get('id'));
	    	if ($this->model('product')->deleteWerehouse($id)>0) {
    			$this->setSession('success','ลบคลังสินค้าเรียบร้อยแล้ว');
	    	} else {
    			$this->setSession('error','เกิดข้อผิดพลาดในการลบคลังสินค้า');
	    	}

    		redirect('product/listWerehouse');
	    }
    // ================= Werehouse ======================
	   
	}
?>