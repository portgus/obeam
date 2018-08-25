<?php
class FriendLinkAction extends BaseAction{
     public function add_link(){
         $link_data=new Model('friendlink');       
            if($_GET['id']){
                $id=$_GET['id'];
                $linkArr=$link_data->find($id);
                $this->assign('linkArr',$linkArr);
                
            }
        $this->display();
 }       

     public function linksave(){
         $link_data=M('friendlink');
         if($_POST){
             $id=$_POST['space'];
             unset($_POST['space']);
             if($id){
                
                 $re=$link_data
                 ->where("id=".$id)
                 ->data($_POST)
                 ->save();
         
                 if ($re) {
                     $this->success('链接修改成功', U('Admin/FriendLink/manage_link'));
                 } else {
                     $this->error('链接修改失败', U('Admin/FriendLink/add_link'), 2);
                 }
         
             }else{
         
                 $re=$link_data->data($_POST)->add();
                 if ($re) {
                     $this->success('链接添加成功', U('Admin/FriendLink/manage_link'));
                 } else {
                     $this->error('链接添加失败', U('Admin/FriendLink/add_link'), 2);
                 }
         
                  
             }
         }
         
            
        }
        
        public function manage_link(){
            $m=M('friendlink');
            $num = $m->field('count(*) as num')->count();
            $pagesize=10;
            import('ORG.Util.Page');// 导入分页类
            $page=new Page($num,$pagesize);
         
            $pageStr = $page->show();
            $offset=$page->firstRow;
            $linkArr=$m->order('id DESC')->limit($offset,$pagesize)->select();
           // dump($m->getLastSql());
            $this->assign('pageStr',$pageStr);
            $this->assign('linkArr',$linkArr);
            $this->display();
        }
        public function delete(){
            $id=$_POST['id'];
            $m=M('friendlink');
            $deleteRe=$m->where("id=".$id)->delete();
            if($deleteRe){
               echo 1;
            }else{
               echo $m->getLastSql();
            }
        }
        public function delete_all(){
            $data=$_POST['str'];
            $m=new Model();
            $re=$m->table('admin_friendlink')->delete("$data");
               if($re){
                   echo 1;
               }else{
                   echo 2;
               }
        }
}