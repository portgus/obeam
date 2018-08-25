<?php
class UploadProAction extends  BaseAction{
	protected $proObj;
	protected $imgCate;
	public function _initialize(){
		parent::_initialize();
		$this->proObj=M('image');
		$this->imgCate=M('product_cate')->where('pid=11')->order('sort ASC')->select();
	}
	public function proImgList(){
		$num=$this->proObj->count();
		$pageSize=10;
		import('ORG.Util.Page');
		$page=new Page($num,$pageSize);
		$offset=$page->firstRow;
		$pageStr=$page->show();
		$proImgArr=$this->proObj->field('i.*,c.cate_name')->alias('i')->join('admin_product_cate c on i.cateid=c.id')->order('i.id DESC')->limit($offset,$pageSize)->select();
		$this->assign('pageStr',$pageStr);
		$this->assign('proImgArr',$proImgArr);
		
		
		$this->display();
	}
	public function addProImg(){
		$this->assign('imgCate',$this->imgCate);
		$this->display();
	}
	public function editor_img(){
		$id=I('get.id');
		$proImg=$this->proObj->where('id='.$id)->find();
		$this->assign('proImg',$proImg);
		$this->assign('imgCate',$this->imgCate);
		$this->display();
	}
	
	public function image_save(){
		if($_FILES){
			import('ORG.Net.UploadFile');
			$upload=new UploadFile();
			$upload->maxSize=3145728;
			$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
			$upload->savePath='Public/Uploads/pro_img/'; //保存路径
			if(!$upload->upload()){
				$this->error($upload->getErrorMsg());
			}else{
				$obj=M('image');
				$info=$upload->getUploadFileInfo();
				$imgdata=array();
				foreach ( $info as $v ) {
					$imgdata [] = $v ['savepath'] . $v ['savename'];
				}
				$data=$obj->create();
				
				$data['imgurl']=json_encode($imgdata);
				$data['pub_person']=$_COOKIE['username'];
				$data['pub_time']=time();
				if(!$obj->create()){
					echo $obj->getError();
				}else{
					
					//print_r($data);die();
					$obj->add($data);
					$this->success('添加成功');
				}
			}
		}
	}
	public function editor_save(){
		if(IS_POST){
			if($this->proObj->create()){
				$this->proObj->pub_time=time();
				$this->proObj->pub_person=$_COOKIE['username'];
				if($_FILES['upload']['error'][0]==0){
				
					import('ORG.Net.UploadFile');
					$upload=new UploadFile();
					$upload->maxSize=3145728;
					$upload->exts=array('jpg', 'gif', 'png', 'jpeg');
					$upload->savePath='Public/Uploads/pro_img/'; //保存路径
					if(!$upload->upload()){
						$this->error($upload->getErrorMsg());
					}else{
						$info=$upload->getUploadFileInfo();
						$imgdata=array();
						foreach ( $info as $v ) {
							$imgdata [] = $v ['savepath'] . $v ['savename'];
						}
						$this->proObj->imgurl=json_encode($imgdata);
					}
				}
				$this->proObj->save();
				$this->success('编辑成功');
			}else{
				$this->error($this->proObj->getError());
			}
			
			
			
		}
		
	}
	public function image_delete(){
		$id=$_POST['id'];
		$m=M('image');
		$re=$m->where('id='.$id)->delete();
	
		if($re){
			echo 1;
		}else{
			echo $m->getLastSql();
		}
	}
	
	
	
	
	
	
	
	
}