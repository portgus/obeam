<?php
class ProductAction extends BaseAction {
	// 分类处理
	public function product_cate() {
		$optionStr = get_product_category_option ();
		$listStr = get_product_category_list ();
		$this->assign ( 'optionStr', $optionStr );
		$this->assign ( 'listStr', $listStr );
		$this->display ();
	}
	public function product_cate_add() {
		$data = array ();
		$data ['cate_name'] = $_POST ['cate_name'];
		$data ['pid'] = $_POST ['cateid'];
		$data ['sort'] = $_POST ['sort'];
		$data ['web_title'] = $_POST ['web_title'];
		$data ['web_desc'] = $_POST ['web_desc'];
		$data ['web_keywords'] = $_POST ['web_keywords'];
		$data['message'] = $_POST['message'];
		$data['url_param'] = $_POST['url_param'];
		$m = M ( 'product_cate' );
		if ($_POST ['id']) {
			$id = $_POST ['id'];
			$re = $m->where ( 'id=' . $id )->save ( $data );
			if ($re) {
				$this->success ( '编辑成功', U ( 'Admin/Product/product_cate' ) );
			} else {
				$this->error ( '编辑失败', U ( 'Admin/Product/product_cate' ), 2 );
			}
		} else {
			$re = $m->data ( $data )->add ();
			if ($re) {
				$this->success ( '添加成功', U ( 'Admin/Product/product_cate' ) );
			} else {
				$this->error ( '添加失败', U ( 'Admin/Product/product_cate' ), 2 );
			}
		}
	}
	public function cate_editor() {
		$id = $_GET ['id'];
		$m = M ( 'product_cate' );
		$optionStr = get_product_category_option ();
		$cate_arr = $m->where ( 'id=' . $id )->find ();
		$this->assign ( 'cate_arr', $cate_arr );
		$this->assign ( 'optionStr', $optionStr );
		$this->display ();
	}
	public function cate_del() {
		$id = $_GET ['id'];
		$m = M ( 'product_cate' );
		$re = $m->where ( 'id=' . $id )->delete ();
		if ($re) {
			$this->success ( '删除成功', U ( 'Admin/Product/product_cate' ) );
		} else {
			$this->error ( '删除失败', U ( 'Admin/Product/product_cate' ), 2 );
		}
	}
	
	// 产品处理
	public function add_product() {
		$optionStr = get_product_category_option ();
		$this->assign ( 'optionStr', $optionStr );
		$this->display ();
	}
	
	// 产品列表
	public function product_list() {
		$product = new Model ();		
		$pagesize = 10;
		
		if($_GET['cateid']){
			$cateid=I('get.cateid');
			$num = $product->table ( 'admin_product' )->where('cateid='.$cateid)->count ();
		}else{
			$num = $product->table ( 'admin_product' )->count ();
		}
		
		
		import ( 'ORG.Util.Page' );
		$page = new Page ( $num, $pagesize );
		$page_str = $page->show ();
		$offset = $page->firstRow;
		
		if($_GET['cateid']){
			$cateid=I('get.cateid');
			$pro_arr=$product->table ('admin_product' )->where('cateid='.$cateid)->order ( 'id DESC' )->limit ($offset,$pagesize )->select ();
		}else{
			$pro_arr = $product->table ('admin_product' )->order ( 'id DESC' )->limit ( $offset, $pagesize )->select ();
		}
				
		$optionStr = get_product_category_option ();
		$this->assign('optionStr',$optionStr);
		$this->assign ( 'page_str', $page_str );
		$this->assign ( 'pro_arr', $pro_arr );
		$this->display ();
	}
	public function product_delete() {
		$id = $_POST ['id'];
		$product = new Model ();
			
		   $result_pro = $product->table ( 'admin_product' )->where ( 'id=' . $id )->delete ();
		   $filename=ROOT.'Html/product/product_'.$id.'.html';
           @unlink($filename);
		if ($result_pro) {
			
			echo 1;
		} else {
			echo 2;
		}
	}
	public function editor_product() {
		if ($_GET ['id']) {
			$id = $_GET ['id'];
			$pro = new Model ();
			$editor_arr = $pro->table ( 'admin_product' )->where ( 'id=' . $id )->find ();				
			$this->assign ( 'editor_arr', $editor_arr );
			//dump($pro_arr);
		}
		$optionStr = get_product_category_option ();
		$this->assign ( 'optionStr', $optionStr );
		$this->display ();
	}
	
	
	public function editor_save() {
	    import('ORG.Net.UploadFile');
	    $upload = new UploadFile();
	    $upload->maxSize=3145728;
	    $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
	    $upload->savePath='Public/Uploads/product_thumb/';
	    
	    $id=I('post.id');
	    $obj=M('product');
	    $data=$obj->create();
	    $data['pub_person']=$_COOKIE['username'];
	    $data['pub_time']=time();
	    if($upload->upload()){
	        $info=$upload->getUploadFileInfo();
	        $data['imgurl']=$info[0]['savepath'].$info[0]['savename'];
	    }
	    if(!$obj->create()){
	        echo $obj->getError();
	    }else{
	        $obj->where('id='.$id)->save($data);
	        $filename=ROOT."Html/product/product_".$id.'.html';
	        @unlink($filename);
	        $data=$obj->where('id='.$id)->find();
	        $this->assign('productDetail',$data);
	        $re=$this->buildHtml('product_'.$id,'Html/product/', 'Static/productdetail');
	        $this->success('编辑成功');
	    }
	}
	
	
	
	
	
	public function product_save() {
		
	    import('ORG.Net.UploadFile');
	    $upload = new UploadFile();
	    $upload->maxSize=3145728;
	    $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
	    $upload->savePath='Public/Uploads/product_thumb/'; //保存路径
	    if(!$upload->upload()){
	        $this->error($upload->getErrorMsg());
	    }else{
	        $obj=M('product');
	        $info=$upload->getUploadFileInfo();
	        $data=$obj->create();
	        $data['imgurl']=$info[0]['savepath'].$info[0]['savename'];
	        $data['pub_person']=$_COOKIE['username'];
	        $data['pub_time']=time();
	        if(!$obj->create()){
	            echo $obj->getError();
	        }else{
	            
	            $id=$obj->add($data);
	            $data=$obj->where('id='.$id)->find();
	            $this->assign('productDetail',$data);
	            $re=$this->buildHtml('product_'.$id,'Html/news/', 'Static/productdetail');
	            
	            $this->success('添加成功');
	        }
	    }
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	}
	
	
	//编辑器上传图片
	public function uploadImg(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize=3145728;
		$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
		$upload->savePath='Public/Uploads/product_editor/'; //保存路径
		if(!$upload->upload()){
			$upload->getErrorMsg();
		}else{
			$info=$upload->getUploadFileInfo();
			$data['imgurl']=$info[0]['savepath'].$info[0]['savename'];
			echo '/'.$info[0]['savepath'].$info[0]['savename'];
		}
	
	}
	
	public function updateAllFiles(){
		$obj=M('product');
		$productArr=$obj->select();
		
		foreach ($productArr as $k=>$v){
			$productDetail=$v;
			$this->assign('productDetail',$productDetail);
			$this->buildHtml('product_'.$v['id'],'Html/product/', 'Static/productdetail');
		}
		 
		echo '200|success';
		 
	}
	
	
}