<?php
class AboutAction extends BaseAction{
	public function about_list(){
		$about=M('about');
		$aboutArr=$about->where('id=1')->find();
		$this->assign('aboutArr',$aboutArr);
		$this->display();
		
	}
	public function about_save(){
	
			if(IS_POST){
				$about=M('about');
				
			  $result=$about->where('id=1')->save($_POST);
			  if($result){
			  	$this->success('修改成功');
			  }else{
			  	$this->error('修改失败');
			  }
			
			}
	}
	public function intro_list(){
		$introArr=M('intro')->where('id=1')->find();
		$this->assign('introArr',$introArr);
		$this->display();
	}
	
	public function intro_save(){
		if(IS_POST){
			M('intro')->create();
			if($_FILES['imgurl']['error']==0){
				import('ORG.Net.UploadFile');
				$upload=new UploadFile();
				$upload->maxSize  = 3145728 ;// 设置附件上传大小
				$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->savePath =  'Public/Uploads/intro/';//
				if(!$upload->upload()){
					$this->error($upload->getErrorMsg());
				}else{
					$info=$upload->getUploadFileInfo();
					M('intro')->imageurl=$info[0]['savepath'].$info[0]['savename'];
				}
			}
			M('intro')->save();
			$this->success('修改成功');
		}else{
			$this->error('滚粗');
		}
		
	}
}