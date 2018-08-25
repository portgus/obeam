<?php
class LoginAction extends Action{
    function login(){
        $this->display();
    }
    function check(){
        $m=M('user');
        $username=$_POST['username']?$_POST['username']:"";
        $password=$_POST['password']?($_POST['password']):"";
        $userArr=$m->where("name='%s' and password='%s'",array($username,$password))->find();
        if($userArr){
             setcookie("userid",$userArr['id'],0,'/');
             setcookie("username",$userArr['name'],0,'/');
             setcookie("number",$userArr['number'],0,'/');
             setcookie("res_time",$userArr['res_time'],0,'/');
             setcookie("res_ip",$userArr['res_ip'],0,'/');
             header("location:".U("Admin/Index/index"));
        }else{
            $this->error('登录失败',U("Admin/Login/login"),3);
        }
    }
    function exit_login(){
            cookie('userid',null);
            cookie('username',null);
            cookie('number',null);
            cookie('res_time',null);
            cookie('res_ip',null);
            $this->redirect('Admin/Login/login');
    }
    
}