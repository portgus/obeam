<?php
class MessageAction extends BaseAction{
    public function message_check(){
        $m=M('message');
        $num=$m->field("count(*) as num")->count();
        $pagesize=10;
        import('ORG.Util.Page');// 导入分页类
        $page=new Page($num,$pagesize);
        $pageStr = $page->show();
        $offset=$page->firstRow;
        $arr=$m->order('id DESC')->limit($offset,$pagesize)->select();
        $this->assign('arr',$arr);
        $this->display();
    }
    
    public function delete(){
        $id=$_POST['id'];
        $m=M('message');
        $re=$m->where('id='.$id)->delete();
        if($re){
           echo 1;
        }else{
            echo $m->getLastSql();
        }
    }
    public function message_show(){
        $id=$_GET['id'];
        $m=M('message');
        $arr=$m->where('id='.$id)->find();
        $this->assign('arr',$arr);
        $this->display();
    }
    public function delete_all(){
        $data=$_POST['str'];
        $m=new Model();
        $re=$m->table('admin_message')->delete("$data");
        if($re){
            echo 1;
        }else{
            echo $m->getLastSql();
        }
    }
}