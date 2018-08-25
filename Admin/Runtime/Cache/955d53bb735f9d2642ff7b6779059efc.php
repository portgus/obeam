<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($newsDetail['web_title']); ?></title>

<meta name="keywords" content="<?php echo ($newsDetail['web_keywords']); ?>"/>
<meta name="description" content="<?php echo ($newsDetail['web_desc']); ?>"/> 
</head>
<body>
<h3><?php echo ($newsDetail['pro_name']); ?></h3>

<h4><?php echo ($newsDetail['pub_time']); ?></h4><h4><?php echo ($newsDetail['pub_person']); ?></h4>
<img src="/<?php echo ($newsDetail['imgurl']); ?>" alt=""/>
<p>
<?php echo ($productDetail['intro']); ?>
<?php echo ($newsDetail['content']); ?>
</p>
</body>
</html>