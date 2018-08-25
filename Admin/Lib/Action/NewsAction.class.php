<?php
class NewsAction extends BaseAction{
    //新闻列表
    public  function newslist(){
      	$m=M('news');
      	$num = $m->count();
    	$listRows = 10;
    	import('ORG.Util.Page');// 导入分页类
    	$page = new Page($num, $listRows);
    	$pageStr = $page->show();
    	$start = $page->firstRow;
    	    	
    	$arr = $m->field('n.*,c.name')
    	->alias('n')->join('admin_subject c on n.cateid=c.id')
    	->order('n.id DESC')
    	->limit($start, $listRows)
    	->select();

    	
    	if($_GET['cateid']){
    		$cateid=I('get.cateid');
    		$num=$m->where('cateid='.$cateid)->count();
    	
    	
    		$listRows = 10;
    		import('ORG.Util.Page');// 导入分页类
    		$page = new Page($num, $listRows);
    		$pageStr = $page->show();
    		$start = $page->firstRow;
    	    	
    		$arr = $m->where('cateid='.$cateid)->field('n.*,c.name')
    		->alias('n')->join('admin_subject c on n.cateid=c.id')
    		->order('n.id DESC')
    		->limit($start, $listRows)
    		->select();
    	}	
    	
    		
        $this->getNewsCate();
        $this->assign('pageStr', $pageStr);
        $this->assign('arr', $arr);
        $this->display();
    }
    

    
   private function getNewsCate(){
    	$cate=M('subject');
    	$catearr=$cate->order('rank ASC')->select();
    	 $this->assign('catearr',$catearr);
    	
    }
    
    
    //添加新闻页面
    public function addnews(){
        //获取分类
       $this->getNewsCate();
       
        $this->display();
    }
    
    //编辑新闻页面
    public function news_editor(){
         $this->getNewsCate();
        if($_GET['id']){
            $id=$_GET['id'];
            $m=M('news');
            $editor_arr=$m->where("id=".$id)->find();
            $this->assign('editor_arr',$editor_arr);
        }else{
        	$this->redirect('Admin/News/newslist');
             }
        $this->display();
        
    }
    
    //新闻删除
    
    public function news_delete(){
        $id=$_POST['id'];
        $m=M('news');
        $re=$m->where('id='.$id)->delete();
        $filename=ROOT.'Html/news/news_'.$id.'.html';
        $file_re=@unlink($filename);
        if($re){
           echo 1;
        }else{
            echo $m->getLastSql();
                }
    }
    
    public function delete_all(){
    	$data=$_POST['str'];
    	$news_arr=explode(',', $data);
    	// print_r($news_arr);exit;
    	$m=new Model();
    	foreach ($news_arr as $v){
    		@unlink(ROOT.'/html/news/news_'.$v.'.html');
    	}
    	$re=$m->table('admin_news')->delete("$data");
    
    	if($re){
    		echo 1;
    	}else{
    		echo $m->getLastSql();
    	}
    }
    
    
    public function addnews_save(){
            
        $obj=M('news');     
        $data=$obj->create();     
        $data['pub_person']=$_COOKIE['username'];
        $data['pub_time']=time();
        if(!$obj->create()){
            echo $obj->getError();
        }else{
            
            $id=$obj->add($data);
           /*  $data=$obj->where('id='.$id)->find();
            $this->assign('newsDetail',$data);
            $re=$this->buildHtml('news_'.$id,'Html/news/', 'Static/newsdetail');     */       
            $this->success('添加成功');
        }       
                
    }
    
    
   public  function editor_save(){
      
    
           $id=I('post.id');
           $obj=M('news');
           $data=$obj->create(); 
           $data['pub_time']=time();
           if(!$obj->create()){
               echo $obj->getError();
           }else{
               $obj->where('id='.$id)->save($data);
              /*  $filename=ROOT."Html/news/news_".$id.'.html';
               @unlink($filename);            
               $data=$obj->where('id='.$id)->find();
               $this->assign('newsDetail',$data);
               $re=$this->buildHtml('news_'.$id,'Html/news/', 'Static/newsdetail');       */                    
               $this->success('编辑成功');
           }
       }
       
      
    
    
    
    //新闻分类
    public function newssub(){
        $m=M('subject');
       $arr= $m->order('rank ASC')->select();
       $this->assign('arr',$arr);
        $this->display();
    }
    public function catesave(){
        $data=array();
        $data['name']=$_POST['name'];
        $data['rank']=$_POST['order'];
        $data ['web_title'] = $_POST ['web_title'];
        $data ['web_desc'] = $_POST ['web_desc'];
        $data ['web_keywords'] = $_POST ['web_keywords'];
        $data['url_param']=$_POST['url_param'];
        $m=M('subject');
        if($_POST['id']){
            $id=$_POST['id'];
            $re=$m->where('id='.$id)->save($data);
            if($re){
                $this->success('编辑成功 ',U('Admin/News/newssub'));
            }else{
                $this->error('编辑失败',U('Admin/News/newssub'),2);
            }
        }else{
            $re=$m->data($data)->add();
            if($re){
                $this->success('添加成功 ',U('Admin/News/newssub'));
            }else{
                $this->error('添加失败',U('Admin/News/newssub'),2);
            }
        }
  
    }
    
    public function cate_delete(){
        $id=$_GET['id'];
        $m=M('subject');
        $re=$m->where('id='.$id)->delete();
        if($re){
            $this->success('删除成功 ',U('Admin/News/newssub'));
        }else{
            $this->error('删除失败',U('Admin/News/newssub'),2);
        }
    }
    public  function cate_editor(){
        $id=$_GET['id'];
        $m=M('subject');
        $cate_arr=$m->where('id='.$id)->find();
        $this->assign('cate_arr',$cate_arr);
        $this->display();
    }
    
    
   
  //编辑器上传图片
    public function uploadImg(){
    	 import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize=3145728;
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
       $upload->savePath='Public/Uploads/news_editor/'; //保存路径
        if(!$upload->upload()){
            $upload->getErrorMsg();
        }else{
        	$info=$upload->getUploadFileInfo();
        	$data['imgurl']=$info[0]['savepath'].$info[0]['savename'];
        	echo '/'.$info[0]['savepath'].$info[0]['savename'];
        }
    
    }
    
    public function updateAllFiles(){
    	$obj=M('news');
    	$newsArr=$obj->select();
    	//echo $obj->getLastSql();
    	foreach ($newsArr as $k=>$v){
    		$newsDetail=$v;
    		$this->assign('newsDetail',$newsDetail);
    		$this->buildHtml('news_'.$v['id'],'Html/news/', 'Static/newsdetail');
    	}
    	
    	echo '200|success';
    	
    }
    
    
    
    
}