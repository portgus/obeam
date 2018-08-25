<?php
class IndexAction extends BaseAction{
	protected $obj;
	public function _initialize(){
		parent::_initialize();
		$this->obj=M();
	}
	public function index(){
		

	$newsarr=$this->obj->table('admin_product')->where('cateid=7')->limit(3)->select();
	$this->assign('newsarr',$newsarr);
	
	$casearr=$this->obj->table('admin_product')->where('cateid=5')->limit(16)->select();
	$this->assign('casearr',$casearr);

		$this->display();
	}
	

	
	
	public function checkMessage(){
		if(IS_POST){			
			/*  if($_SESSION['verify'] != md5($_POST['verify'])) {
				$this->error('验证码错误！');
			   }  */
		    $mes=D('Message');
		    $mes->create();		
		    $mes->clint_ip=$_SERVER['REMOTE_ADDR'];	
		    $mes->email='cliff@sun.com';
		    $mes->add();
			 $this->success('留言成功,我们将会电话回复您');
			 
		}
	}
	
	public function vCode(){
		import('ORG.Util.Image');
		Image::buildImageVerify();
		
	}
	


}