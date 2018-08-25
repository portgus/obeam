<?php
class BannerAction extends  BaseAction{
	public function banner_img(){
		$this->display();
	}
	
    public function add_banner(){
        $obj=new Model();
        $bannerArr=$obj->table('admin_banner')->order('id DESC')->select();
        $this->assign('bannerArr',$bannerArr);
        
        $this->display();
    }
    
    public function banner_save(){
             $config = array(
                
                'autoSub' => true, // 自动子目录保存文件
                'subType' => 'date',
                'savePath' => 'Public/Uploads/banner/'
            ) ;// 保存路径
          import('ORG.Net.UploadFile');
        $upload = new UploadFile($config);
           
           
        if(!$upload->upload()){
            
            $this->error($upload->getErrorMsg());
        }else{
        	
          
            $info =  $upload->getUploadFileInfo();           
            $data=array();
            $m=M('banner');
            $imageurl = $info[0]['savepath'].$info[0]['savename'];
            $data['imageurl']=$imageurl;
            
            $id=$_POST['id'];
            
            if($id){
            	$re=$m->where('id='.$id)->save($data);
            	if($re){
            		$this->success("更换成功", U("Admin/Banner/add_banner"));
            	}else{
            		$this->error('更换失败');
            	}
            }else{
            	
            	$re=$m->data($data)->add();
            	if($re){
            		$this->success("添加成功", U("Admin/Banner/add_banner"));
            	}else{
            		$this->error('添加失败');
            	}
            	
            }
           
            
        }
    }
    
    public function seo_manage(){
        $obj=new Model();
        $keywordsArr=$obj->table('admin_keywords')->order('id ASC')->select();
        $this->assign('keywordsArr',$keywordsArr);   
       // dump($keywordsArr);
        $this->display();
    }
    
    public function keywords_save(){
        $id=$_POST['id'];
        $data=array();
        $data['keywords']=$_POST['keywords'];
        $data['description']=$_POST['description'];
        $data['title']=$_POST['title'];
        $obj=new Model();
        $result=$obj->table('admin_keywords')->where('id='.$id)->save($data);
        if($result){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
        
    }
    
    
    
}