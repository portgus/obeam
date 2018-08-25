<?php
class ServiceAction extends Action{
	public function serviceList(){
		$sObj=M('service');
		$service=$sObj->order('id DESC')->find();
		$this->assign('service',$service);
		
		$this->display();
	}
	public function service_editor(){
		if(IS_POST){
			$sObj=M('service');
			$sObj->create();
			if($_FILES['imageurl']['error']==0){
				import('ORG.Net.UploadFile');
				$upload=new UploadFile();
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  'Public/Uploads/service/';//
				if(!$upload->upload()){
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();
					$sObj->vcode_imgurl=$info[0]['savepath'].$info[0]['savename'];
				}
			}
			$sObj->save();
			$this->success('修改成功');
		}else{
			$this->error('滚粗');
		}	
	}
}