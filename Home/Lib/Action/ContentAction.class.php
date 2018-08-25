<?php
class ContentAction extends BaseAction{
    
    Public function project_case(){
        $pro=M('product');
        
        import('ORG.Util.Page');
        
        
        if(I('get.cateid')){
            $cateid=I('get.cateid');
            $map['cateid']=array('eq',$cateid);
        }else{
            $map['cateid']=array('eq','5');
        }
        
        
        $cate=M('product_cate');
        $cap['pid']=array('eq','5');
        $cateArr=$cate->where($cap)->select();
       $this->assign('cateArr',$cateArr);
        
        $num=$pro->where($map)->count();
        $pageSize=12;
        $page=new Page($num,$pageSize);
        $offset=$page->firstRow;
        $pageStr=$page->show();
        $caseArr=$pro->where($map)->order('id DESC')->limit($offset,$pageSize)->select();
        
        $this->assign('caseArr',$caseArr);
        $this->assign('pageStr',$pageStr);
        $this->display();
    }
    Public function case_detail(){
        $id=I('get.id');
        $casedetailArr=$this->obj->where('id='.$id)->find();
        $this->assign('casedetailArr',$casedetailArr);
        
        $nextNews=$this->obj->where('id>'.$id)->order('id ASC')->find();
        $lastNews=$this->obj->where('id<'.$id)->order('id DESC')->find();
        
        
        $this->assign('nextNews',$nextNews);
        $this->assign('lastNews',$lastNews);
        
        $this->display();
        $this->display();
    }
    Public function decoration_knowledge(){
        $this->display();
    }
    Public function knowledge_detail(){
        $this->display();
    }
    Public function project_image(){
        $this->display();
    }
    Public function image_detail(){
        $this->display();
    }
    
    
    
    
    
    
    
    
    
    
    //公司介绍
    Public function company_introduce(){
        $where['cateid']='4';
        $where['ishot']='1';
        $content=$this->obj->table('admin_product')->where($where)->order('id DESC')->find();
        $this->assign('content',$content);
      //  echo $this->obj->getLastSql();
        
        $this->display();
    }
    //联系我们
    Public function contact_us(){
        $where['cateid']='6';
        $where['ishot']='1';
        $content=$this->obj->table('admin_product')->where($where)->order('id DESC')->find();
        $this->assign('content',$content);
        //  echo $this->obj->getLastSql();
        
        $this->display();
       
    }
    //服务流程
    Public function service_process(){
        $this->display();
    }
    //报价
    Public function quote(){
        
    }
}