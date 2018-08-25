<?php
class ProAction extends BaseAction{

	
	public function product(){
		$pro=M('product');
		import('ORG.Util.Page');
		$map['cateid']=array('eq','2');
		$num=$pro->where($map)->count();
		$pageSize=8;
		$page=new Page($num,$pageSize);		
		$offset=$page->firstRow;
		$pageStr=$page->show();		
		$proArr=$pro->where($map)->order('id DESC')->limit($offset,$pageSize)->select();
		
		$this->assign('proArr',$proArr);
		$this->assign('pageStr',$pageStr);
		$this->hotPro();
		$this->display();
		
	}
	
	public function proDetail(){
		$id=I('get.id');			
		//产品
		$product=M('product')->where("id=".$id)->find();		
		$this->assign('product',$product);
		
		$nextPro=M('product')->where('id>'.$id)->order('id ASC')->find();
		$lastPro=M('product')->where('id<'.$id)->order('id DESC')->find();
		
		
		$this->assign('nextPro',$nextPro);
		$this->assign('lastPro',$lastPro);		
		
		$this->display();
	}

	private function hotPro(){
        $map['cateid']=array('eq','2');
        $map['is_hot']=array('eq','1');
        $hotPro=M('product')->where($map)->order('id DESc')->limit(6)->select();
        $this->assign('hotPro',$hotPro);

    }
	
}