<?php
class CompanyAction extends BaseAction{
	private $url;
	private $comObj;
	public function _initialize(){
		parent::_initialize();
		$this->comObj=M('company');
		$this->url='companyAdd';
	}
	
	public function companyList(){
		$companyArr=$this->comObj->field('id,page_name,title,pub_time')->select();
		$this->assign('companyArr',$companyArr);
		$this->display();
	}
	public function companyAdd(){
	
		$this->display();
	}
	public function companySave(){
		if(IS_POST){
				$this->comObj->create();
				$this->comObj->pub_time=time();
				$id=$this->comObj->add();
				$pageDetail=$this->comObj->where('id='.$id)->find();
				$this->assign('pageDetail',$pageDetail);
				$this->buildHtml($pageDetail['page_name'],'Html/companyPage/', 'Static/pageDetail');
				$this->success('添加成功');
		}else{
			$this->redirect($this->url);	
		}
		
	}
	public function companyEditor(){
		$id=I('get.id');
		$editorArr=$this->comObj->where('id='.$id)->find();
		$this->assign('editorArr',$editorArr);
		$this->display();
	}
	
	public function editorSave(){
		if(IS_POST){
			$id=I('post.id');
			$page_name=I('post.delete_page');
			//echo $page_name;exit();
			$this->comObj->create();
			$this->comObj->pub_time=time();
			$this->comObj->save();//把数据写到数据表中
			
			
			$filename=ROOT.'Html/companyPage/'.$page_name.'.html';
			@unlink($filename);//删除原来的静态页面
			
			$pageDetail=$this->comObj->where('id='.$id)->find();
			$this->assign('pageDetail',$pageDetail);
			$this->buildHtml($pageDetail['page_name'],'Html/companyPage/', 'Static/pageDetail');//生成新的静态页面
			$this->success('编辑成功');
		}else{
			$this->redirect($_SERVER['HTTP_REFERER']);
		}
		
	}
	public function delete(){
		$id=I('post.id');
		$arr=$this->comObj->where('id='.$id)->find();
		$filename=ROOT.'Html/companyPage/'.$arr['page_name'].'.html';
		@unlink($filename);
		$this->comObj->where('id='.$id)->delete();
		$this->success('删除成功');
	}
	
  public function uploadImg(){
    	 import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize=3145728;
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
       $upload->savePath='Public/Uploads/company_editor/'; //保存路径
        if(!$upload->upload()){
            $upload->getErrorMsg();
        }else{
        	$info=$upload->getUploadFileInfo();
        	$data['imgurl']=$info[0]['savepath'].$info[0]['savename'];
        	echo '/'.$info[0]['savepath'].$info[0]['savename'];
        }
    
    }
    
    public function updateAllFiles(){
    	$obj=M('company');
    	$companyArr=$obj->select();
    	
    	foreach ($companyArr as $k=>$v){
    		$pageDetail=$v;
    		$this->assign('pageDetail',$pageDetail);
    		$this->buildHtml($v['page_name'],'Html/companyPage/', 'Static/pageDetail');
    	}
    	
    	echo '200|success';
    	
    }
}