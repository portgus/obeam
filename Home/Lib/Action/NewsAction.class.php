<?php
class NewsAction extends BaseAction{
	protected  $obj;
	public function _initialize(){
		parent::_initialize();
		$this->obj=M('product');
	}

	public function news(){

        $pro=M('product');
        import('ORG.Util.Page');
        $map['cateid']=array('eq','3');
        $num=$pro->where($map)->count();
        $pageSize=8;
        $page=new Page($num,$pageSize);
        $offset=$page->firstRow;
        $pageStr=$page->show();
        $proArr=$pro->where($map)->order('id DESC')->limit($offset,$pageSize)->select();

        $this->assign('newsArr',$proArr);
        $this->assign('pageStr',$pageStr);
        $this->display();
	}
	public function newsDetail(){
		$id=I('get.id');
		$newsdetailArr=$this->obj->where('id='.$id)->find();
		$this->assign('newsdetailArr',$newsdetailArr);
		
	    $nextNews=$this->obj->where('id>'.$id)->order('id ASC')->find();
		$lastNews=$this->obj->where('id<'.$id)->order('id DESC')->find();
		
		
		$this->assign('nextNews',$nextNews);		
		$this->assign('lastNews',$lastNews);			
		
		$this->display();
	}
	
}