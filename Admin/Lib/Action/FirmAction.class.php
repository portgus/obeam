<?php
class FirmAction extends BaseAction{
	protected $obj;
	public function _initialize(){
		parent::_initialize();
		$this->obj=M();
	}
	public function contact(){
		$aboutArr=$this->obj->table('admin_contact')->where('id=1')->find();
		$this->assign('aboutArr',$aboutArr);
		$this->display();
	}
	public function contact_save(){
		if(IS_POST){
			$this->obj->table('admin_contact')->create();			
			if($_FILES['imgurl']['error']==0){
				import('ORG.Net.UploadFile');
				$upload=new UploadFile();
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  'Public/Uploads/contact/';//
				if(!$upload->upload()){
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();
					$this->obj->table('admin_contact')->contact_imgurl=$info[0]['savepath'].$info[0]['savename'];
				}
			}
			$this->obj->table('admin_contact')->save();
			$this->success('修改成功');
		}else{
			$this->error('滚粗');
		}
		
	}
	
	

	public function about(){
		$comArr=$this->obj->table('admin_cominfo')->order('id ASC')->limit(4)->select();
		$this->assign('comArr',$comArr);
		$this->display();
	}
	

	public function customise(){
		$comArr=$this->obj->table('admin_cominfo')->order('id DESC')->limit(5)->select();
	//	echo $this->obj->table('admin_cominfo')->getLastSql();
		$this->assign('comArr',$comArr);
		$this->display();
	}
	
	
	public function about_save(){
		if(IS_POST){
			$this->obj->table('admin_cominfo')->create();
			if($_FILES['imageurl']['error']==0){
				import('ORG.Net.UploadFile');
				$upload=new UploadFile();
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  'Public/Uploads/cominfo/';//
				if(!$upload->upload()){
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();
					$this->obj->table('admin_cominfo')->imageurl=$info[0]['savepath'].$info[0]['savename'];
				}
			}
			$this->obj->table('admin_cominfo')->save();
			$this->success('修改成功');
		}else{
			$this->error('滚粗');
		}
	}
	

	
	
}