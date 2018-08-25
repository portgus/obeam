<?php
class BaseAction extends Action{
	protected $obj;
	protected $proCate;
	protected $comInfo;
	protected $newsCate;
	protected $banner;
	protected $keywords;
	protected $friendLink;
	protected $recommendNews;
	public function _initialize(){	
		$this->obj=M();	
		$this->banner=$this->obj->table('admin_banner')->select();
	    $this->comInfo=$this->obj->table('admin_about')->find();
	    $this->keywords=$this->obj->table('admin_keywords')->select();
		$this->friendLink=$this->obj->table('admin_friendlink')->order('id DESC')->select();
		
		$this->recommendNews=$this->obj->table('admin_product')->where('cateid=5 and ishot=1')->order('id DESC')->limit(5)->select();
		
		$this->assign('recommendNews',$this->recommendNews);
		$this->assign('friendLink',$this->friendLink);
	    $this->assign('keywords',$this->keywords);
	    $this->assign('banner',$this->banner);
	    $this->assign('newsCate',$this->newsCate);
	    $this->assign('comInfo',$this->comInfo);
	    $this->assign('proCate',$this->proCate);	 
	}
}