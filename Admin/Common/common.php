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


function get_product_category_option_limit3(){
	$obj = M('product_cate');
	$arr = $obj->where("pid=0 and status=0")->order('sort ASC')->limit(8)->select();

	$optionStr = "";
	
	foreach ($arr as $v) {
		$optionStr .= "<option value='{$v['id']}'>{$v['cate_name']}</option>";
		
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
        <td><input type=\"checkbox\" /></td>
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

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path='file',$format='empty',$maxSize='52428800'){
	ini_set('max_execution_time', '0');
	// 去除两边的/
	$path=trim($path,'/');
	// 添加Upload根目录
	$path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
	// 上传文件类型控制
	$ext_arr= array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'photo' => array('jpg', 'jpeg', 'png'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
	);
	if(!empty($_FILES)){
		// 上传文件配置
		$config=array(
				'maxSize'   =>  $maxSize,               // 上传文件最大为50M
				'savePath'  =>  './'.$path.'/',         // 文件上传的保存路径（相对于根路径）				
				'allowExts'      =>    isset($ext_arr[$format])?$ext_arr[$format]:'',
		);
		// 实例化上传
		import('ORG.Net.UploadFile');
		$upload=new UploadFile($config);
		// 调用上传方法
	    $result=$upload->upload();
		$data=array();
		if(!$result){
			// 返回错误信息
			$error=$upload->getErrorMsg();
			$data['error_info']=$error;
			echo json_encode($data);
		}else{
			$info =  $upload->getUploadFileInfo();
				
			// 返回成功信息
			foreach($info as $file){
				$data['name']=trim($file['savepath'].$file['savename'],'.');
				echo json_encode($data);
			}
			return $data;
		}
	}
}



