<?php
function get_product_category_option($fid=0,$num=0){
    $obj = M('product_cate');
    $arr = $obj->where("pid=$fid and status=0")->select();
    $optionStr = "";
    $gangStr = str_repeat('--', $num);
    $num++;
    foreach ($arr as $v) {
        $optionStr .= "<option value='{$v['id']}'>$gangStr{$v['cate_name']}</option>";
        $sunStr = get_product_category_option($fid = $v['id'], $num);
        $optionStr .= $sunStr;
    }
    return $optionStr;
    
}

function get_product_category_list($fid=0,$num=0){
    $obj = new Model('product_cate');
    $arr = $obj->where("status=0 and pid=$fid")->select();
    $gangStr = str_repeat('---', $num);
    $num++;
    $tableStr = "";
    foreach ($arr as $v) {

        $tableStr .= "<tr>
        <td align=\"center\"><input type=\"checkbox\" /></td>
        <td>{$v['sort']}</td>
        <td>$gangStr{$v['cate_name']}</td>
        <td>
        <a href='" . U('Admin/Product/cate_editor', array('id' => $v['id'])) . "' class='btn btn_mail'><span>修改</span></a>
        <a href='" . U('Admin/Product/cate_del', array('id' => $v['id'])) . "' class='btn btn_trash'><span>删除</span></a>
        </td>
		</tr>";
        $sunStr = get_product_category_list($v['id'], $num);
        $tableStr .= $sunStr;
    }
    return $tableStr;
    
}



function truncate_cn($string,$length=0,$ellipsis='…',$start=0){
    $string=strip_tags($string);
    $string=preg_replace('/\n/is','',$string);
    //$string=preg_replace('/ |　/is','',$string);//清除字符串中的空格
    $string=preg_replace('/&nbsp;/is','',$string);
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
    if(is_array($string)&&!empty($string[0])){
        $string=implode('',$string[0]);
        if(strlen($string)<$start+1){
            return '';
        }
        preg_match_all("/./su",$string,$ar);
        $string2='';
        $tstr='';
        //www.111cn.net
        for($i=0;isset($ar[0][$i]);$i++){
            if(strlen($tstr)<$start){
                $tstr.=$ar[0][$i];
            }else{
                if(strlen($string2)<$length+strlen($ar[0][$i])){
                    $string2.=$ar[0][$i];
                }else{
                    break;
                }
            }
        }
        return $string==$string2?$string2:$string2.$ellipsis;
    }else{
        $string='';
    }
    return $string;
}


//联系我们
function getContact(){
	$obj=M('about');
	$contactArr=$obj->where("id=1")->find();
	$contactStr="
		<div class=\"lxfs\">
					<p>联系我们</p>
					<div class=\"lx_box\">
						<div class=\"lx\">
							<p>地址：{$contactArr['address']}</p>
							<p>电话：{$contactArr['phone']}</p>
							<p>邮箱：{$contactArr['email']}</p>
							<p>传真：{$contactArr['fax']}</p>
						</div>
					</div>
				</div>			
";

	
return 	$contactStr;
	
}

//产品分类
function getProCate(){
	$obj=M('product_cate');
	$contactArr=$obj->order('sort ASC')->select();
	

	$cateStr="
		<div class=\"cpfl\">
			<p>产品列表</p>
				<div class=\"lb\">
						<ul>";
		
			
			foreach($contactArr as $v){
		      $cateStr.="  <li><a href=\"/index.php/Product/ProductList/op/pro/cateid/{$v['id']}.html\">&nbsp;|&nbsp;{$v['cate_name']}</a></li>  ";
	                       };
						
								
	$cateStr.="	
			        </ul>
				</div>
		</div>
";


return 	$cateStr;

}




function getBanner(){
	$obj=M('banner');
	$bannerArr=$obj->order('id DESC')->limit(3)->select();	
	$bannerStr="<div class=\"carousel-inner\" role=\"listbox\">";
	
	foreach($bannerArr as $k=>$v){
		if($k==0){
			$bannerStr.="
			<div class=\"item active\">
			<img src=\"/{$v['imageurl']}\" alt=\"\">
			<div class=\"carousel-caption\">
			</div>
			</div>";
		}else{
			$bannerStr.="
			<div class=\"item \">
			<img src=\"/{$v['imageurl']}\" alt=\"\">
			<div class=\"carousel-caption\">
			</div>
			</div>";
		}
		
		
	}
	
			  
		$bannerStr.="</div>";

	return $bannerStr;		
}

