<?php 
class CaseAction extends BaseAction{
	private $caseObj;
	public function _initialize(){
		parent::_initialize();
		$this->caseObj=M('case');
	}
	public function addcase(){
		$this->display();
	}
	public function addcase_save(){
		if(IS_POST){
			import('ORG.Net.UploadFile');
			$upload=new UploadFile();
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  'Public/Uploads/case/';// 设置附件上传目录
			
			if(!$upload->upload()) {
				$this->error($upload->getErrorMsg());
			}else{
				$info=$upload->getUploadFileInfo();
			}
			
			$this->caseObj->create();
			$this->caseObj->imgurl=$info[0]['savepath'].$info[0]['savename'];
			$this->caseObj->pub_time=time();
			$this->caseObj->pub_person=$_COOKIE['username'];
			if($this->caseObj->add()){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
			
		}else{
			header('Forbidden','','403');
		}
	}
	public function caselist(){
		$arr=$this->caseObj->select();
		$this->assign('arr',$arr);
		$this->display();
	}
	public function case_editor(){
		$id=I('get.id');
		$caseArr=$this->caseObj->where('id='.$id)->find();
		$this->assign('caseArr',$caseArr);
		$this->display();
	}
	public function editor_save(){
		if(IS_POST){
			$this->caseObj->create();
			if($_FILES){
				import('ORG.Net.UploadFile');
				$upload=new UploadFile();
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  'Public/Uploads/case/';// 设置附件上传目录
				
				if(!$upload->upload()){
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();
					$this->caseObj->imgurl=$info[0]['savepath'].$info[0]['savename'];
				}
			}
			$this->caseObj->pub_time=time();
			$this->caseObj->pub_person=$_COOKIE['username'];
			$this->caseObj->save();
			$this->success('编辑成功');
			
		}else{
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
	}
	public function case_delete(){
		$id=I('post.id');
		$result=$this->caseObj->where('id='.$id)->delete();
		if($result){
			echo 1;
		}else{
			echo $this->caseObj->getLastSql();
		}
	}
}