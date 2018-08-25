<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<link rel="stylesheet" href="__PUBLIC__/admin/css/style.default.css" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.validate.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/charCount.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/plugins/ui.spinner.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/custom/general.js"></script>
<script type="text/javascript" src="__PUBLIC__/admin/js/custom/forms.js"></script>

<!--[if IE 9]>
    <link rel="stylesheet" media="screen" href="css/style.ie9.css"/>
<![endif]-->
<!--[if IE 8]>
    <link rel="stylesheet" media="screen" href="css/style.ie8.css"/>
<![endif]-->
<!--[if lt IE 9]>
	<script src="__PUBLIC__/adminjs/plugins/css3-mediaqueries.js"></script>
<![endif]-->
</head>
<body class="withvernav">
<div class="bodywrapper">
    <div class="topheader">
        <div class="left">
            <h1 class="logo"><span>后台</span></h1>
            <span class="slogan"></span>
            
            <div class="search">
            	<form action="" method="post">
                	<input type="text" name="keyword" id="keyword" value="" />
                    <button class="submitbutton"></button>
                </form>
            </div><!--search-->
            
            <br clear="all" />
            
        </div><!--left-->
        
        <div class="right">
        	<!--<div class="notification">
                <a class="count" href="ajax/notifications.html"><span>9</span></a>
        	</div>-->
            <div class="userinfo">
            
                <span><?php echo (cookie('username')); ?></span>
            </div><!--userinfo-->
  <div class="userinfodrop">
            	<div class="avatar">
                	<a href=""><img src="__PUBLIC__/admin/images/thumbs/avatarbig.png" alt="" /></a>
                    <div class="changetheme">
           <br />
                    	<a class="default"></a>
                        <a class="blueline"></a>
                        <a class="greenline"></a>
                        <a class="contrast"></a>
                        <a class="custombg"></a>
                    </div>
                </div><!--avatar-->
                <div class="userdata">
                	<h4><?php echo (cookie('username')); ?></h4>
                
                    <ul>
                    	<li><a href="editprofile.html">编号:<?php echo (cookie('number')); ?></a></li>
                        <li><a href="accountsettings.html">注册时间:<?php echo (cookie('res_time')); ?></a></li>
                        <li><a href="help.html">IP:<?php echo (cookie('res_ip')); ?></a></li>
                        <li><a href="<?php echo U('Admin/Login/exit_login');?>">退出</a></li>
                    </ul>
                </div><!--userdata-->
            </div><!--userinfodrop-->
        </div><!--right-->
    </div><!--topheader-->
<div class="header">
    	<ul class="headermenu">
        	<li class="current"><a href="<?php echo U('Admin/Index/index');?>"><span class="icon icon-flatscreen"></span></a></li>
            <li><a href="#"><span class="icon icon-pencil"></span></a></li>
            <li><a href="#"><span class="icon icon-message"></span></a></li>
            <li><a href="#"><span class="icon icon-chart"></span></a></li>
        </ul>
        
       <div class="headerwidget">
        
        </div><!--headerwidget-->
        
    </div><!--header-->
<script type="text/javascript"> 

document.onkeypress=banBackSpace;

document.onkeydown=banBackSpace;
</script>   
             
 <div class="vernav2 iconmenu">
    	<ul>
    	<li><a href="#formsub1" class="editor">基本信息管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub1">
               		<li><a href="<?php echo U('Admin/AdminUser/adminuser');?>">用户管理</a></li>
             
                    <li><a href="<?php echo U('Admin/About/about_list');?>">联系我们管理</a></li>
                     
                   
                   <li><a href="<?php echo U('Admin/Banner/seo_manage');?>">关键词管理</a></li>
                   
                   <li><a href="<?php echo U('Admin/Basic/editor_backdoor');?>">修改后台入口</a></li>   
                                    
                   <!-- <li><a href="<?php echo U('Admin/Basic/sitemap');?>">自动生成Sitemap.xml</a></li> -->
                    
                </ul>
            </li> 
          
          
           	<li><a href="#formsub2" class="editor">轮播图片管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub2">
               		 <li><a href="<?php echo U('Admin/Banner/banner_img');?>">添加轮播图片</a></li>
                    <li><a href="<?php echo U('Admin/Banner/add_banner');?>">轮换图片更换</a></li>
                </ul>
            </li> 
            
             	<!--<li><a href="#formsub3" class="editor">客户案例管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub3">
               	 <li><a href="<?php echo U('Admin/Case/addcase');?>">添加客户案例</a></li>
                    <li><a href="<?php echo U('Admin/Case/caselist');?>">客户案例列表</a></li>
                </ul>
            </li> --> 
            
            	<li><a href="#formsub4" class="editor">友情链接管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub4">
               	 <li><a href="<?php echo U('Admin/FriendLink/add_link');?>">添加友情链接</a></li>
                    <li><a href="<?php echo U('Admin/FriendLink/manage_link');?>">友情链接列表</a></li>
                </ul>
            </li>  
          
          
          
          
    	<!--<li><a href="#formsub5" class="editor">单页管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub5">
            	
               		
                    <li><a href="<?php echo U('Admin/Firm/contact');?>">联系我们</a></li>
                    <li><a href="<?php echo U('Admin/Firm/about');?>">关于我们</a></li>
                    <li><a href="<?php echo U('Admin/Firm/customise');?>">产品定制</a></li>
                    
                     <li><a href="<?php echo U('Admin/Company/companyAdd');?>">添加公司单页</a></li>
                      <li><a href="<?php echo U('Admin/Company/companyList');?>">公司单页列表</a></li>
                </ul>
            </li>
            <li><a href="#formsub6" class="editor">新闻资讯管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub6">
               		<li><a href="<?php echo U('Admin/News/newslist');?>">新闻列表</a></li>
                    <li><a href="<?php echo U('Admin/News/addnews');?>">添加新闻</a></li>
                    <li><a href="<?php echo U('Admin/News/newssub');?>">新闻分类管理</a></li>
                  
                </ul>
            </li> -->
            
            
      
            
            
               <li><a href="#formsub7" class="editor">文章管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub7">
               		<li><a href="<?php echo U('Admin/Product/product_list');?>">文章列表</a></li>
                    <li><a href="<?php echo U('Admin/Product/add_product');?>">添加文章</a></li>
            		<li><a href="<?php echo U('Admin/Product/product_cate');?>">文章分类管理</a></li>
                  
                  
                </ul>
            </li> 
            
            
       <!--         <li><a href="#formsub8" class="editor">近期项目管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub8">
            	 
               	  
               	  
                    <li><a href="<?php echo U('Admin/UploadPro/proImgList');?>">近期项目列表</a></li>
                    <li><a href="<?php echo U('Admin/UploadPro/addProImg');?>">添加近期项目</a></li>
                  
                   
                  
                </ul>
            </li> 
            
               <li><a href="#formsub9" class="editor">策划运营管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub9">
            	
               	   
               		
                    <li><a href="<?php echo U('Admin/Video/videoList');?>">策划运营列表</a></li>
                    <li><a href="<?php echo U('Admin/Video/addvideo');?>">添加产品策划运营</a></li>
                    
                   
                  
                </ul>
            </li>  -->
            
            
            
   
             <li><a href="#formsub10" class="editor">网站管理</a>
            	<span class="arrow"></span>
            	<ul id="formsub10">          	 		 
               		 <!-- <li><a href="<?php echo U('Admin/Video/uploadVideo');?>">上传文件</a></li> -->
               		 
               		
               		 <li><a href="<?php echo U('Admin/Message/message_check');?>">留言列表</a></li>                            
                </ul>
            </li>       
        </ul>
        <a class="togglemenu"></a>
        <br /><br />
    </div><!--leftmenu-->
        
 
 <div class="centercontent tables">
 
  <div class="pageheader">
            <h1 class="pagetitle">更换轮播图片</h1>
            <span class="pagedesc">Change Banner</span>  
        </div><!--pageheader--> 
        
     <div id="contentwrapper" class="contentwrapper">
 		 <div id="validation" class="subcontent" >
 				
		
                <?php if(is_array($bannerArr)): foreach($bannerArr as $k=>$v): ?><form class="stdform stdform2" method="post"  enctype="multipart/form-data" action="<?php echo U('Admin/Banner/banner_save');?>">   	
                        <p>
                        	<label>图片</label>
                              <span class="field"><img width="300px" height="150px" src="/<?php echo ($v['imageurl']); ?>" alt="" />
                              
                            	<input type="hidden" name="id" value="<?php echo ($v['id']); ?>"/>
                                <input type="file"  name="imageurl"  required/>
                              <button>确定</button>
                              
                             
                            
                              </span>
                        </p>
			 </form><?php endforeach; endif; ?>
             
          
					

            </div><!--subcontent-->
 		 
 		
     
          
        </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
 
  </div>
</body>
</html>