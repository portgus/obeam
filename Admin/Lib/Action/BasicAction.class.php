<?php
class BasicAction extends BaseAction{
	public function edit_backdoor(){
		if(IS_POST){
			$name=I('post.file_name');
			if($name==""){
				$this->error('修改失败,名称不能为空');
			}
			$newname=I('post.file_name').'.php';
			$oldname=$_SERVER['SCRIPT_FILENAME'];			
			$result=rename($oldname, $newname);
			if($result){
				cookie('userid',null);
				cookie('username',null);
				cookie('number',null);
				cookie('res_time',null);
				cookie('res_ip',null);
			$this->success('修改成功,请重新登录','/index.php');
			}else{
				$this->error('修改失败');
			}
		}
		
	}
	public function sitemap(){
		
		$this->display();
	}
	public function edit_sitemap(){
		
		
		
		$str="<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$str.="<urlset>";
		
		$str.="<url>";
		$str.="<loc>{$_SERVER['HTTP_HOST']}</loc>";
		$str.="<lastmod>2017-10-31</lastmod>";
		$str.="<changefreq>daily</changefreq>";
		$str.="<priority>1.0</priority>";
		$str.="</url>";
		
		
		
		
		
		$str.="</urlset>";
		
	    $path=$_SERVER['DOCUMENT_ROOT'];
		$file=fopen($path.'/sitemap.xml','w');
		
		//dump($file);exit();
		
		fwrite($file,$str);
		if(fclose($file)){
			$this->success('更新成功');
		}else{
			$this->error('更新失败');
		}
		
			
	}
	
	
	
	
}