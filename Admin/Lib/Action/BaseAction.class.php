<?php
class BaseAction extends Action{
    function _initialize(){
        if(!$_COOKIE['userid']){
            $this->redirect("Admin/Login/login",null,1,'Please log in...');
        }
    }
}