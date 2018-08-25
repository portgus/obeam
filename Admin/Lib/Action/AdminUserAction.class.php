<?php
class AdminUserAction extends BaseAction{
    public function adminuser(){
        $m=M('user');
       $arr= $m->order('id DESC')->select();
       $this->assign('arr',$arr);
        $this->display();
    }
    public function adminuser_save(){
        if($_POST){
            $_POST['res_ip']=$_SERVER['REMOTE_ADDR'];
            $_POST['password']=$_POST['password'];
            $m=M('user');
            $re=$m->data($_POST)->add();
            if($re){
                $this->success('添加成功', U('Admin/AdminUser/adminuser'));
            }else{
                $this->error('添加失败', U('Admin/AdminUser/adminuser'), 2);
            }           
        }
    }    
     public function user_delete(){
         $id=$_GET['id'];
         $m=M('user');
        $re=$m->where('id='.$id)->delete();
        if($re){
            $this->success('删除成功', U('Admin/AdminUser/adminuser'));
        }else{
            $this->error('删除失败', U('Admin/AdminUser/adminuser'), 2);
        }
         
     }
    
     public function user_editor(){
         $id=$_GET['id'];
         $m=M('user');
         $userinfo=$m->where('id='.$id)->find();
         $this->assign('userinfo',$userinfo);
         $this->display();     
     }
    public function user_editor_save(){
        if($_POST){
            $id=$_POST['id'];
            unset($_POST['id']);
            $m=M('user');
            $re=$m->where('id='.$id)->save($_POST);
            if($re){
                $this->success('修改成功', U('Admin/AdminUser/adminuser'));
            }else{
                $this->error('修改失败', U('Admin/AdminUser/adminuser'), 2);
            }
        }
    }
     
     
}
