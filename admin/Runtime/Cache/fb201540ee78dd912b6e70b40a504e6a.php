<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>管理登录</title>

<link href="__PUBLIC__/skin/admin/css/login.css" rel="stylesheet" type="text/css" />

</head>



<body>

<div class="b_w">

   <div class="l_t">

      <div class="left l_title">网站管理系</div>

	  <div class="right"><a href="">

		<img src="__PUBLIC__/skin/admin/images/icon_back.gif" alt="返回" hspace="4" vspace="8" border="0"  /></a><a href="javascript:window.close()"><img src="__PUBLIC__/skin/admin/images/icon_close.gif" alt="关闭" hspace="4" vspace="8" border="0"/></a></div>

   </div>

  <div class="l_bg">

    <ul class="l_user">

<script language="javascript">

function checklogin()

{

  if(document.login.username.value=='')

     {alert('请输入帐户');

      document.login.username.focus();

      return false

    }

  if (document.login.password.value=='')

   {alert('请输入密码');

    document.login.password.focus();

    return false

   }

   if (document.login.veriy.value=='')

   {alert('请输入验证码');

    document.login.veriy.focus();

    return false

   }

}

</script>

<form action="<?php echo U('checkLogin');?>" name="login" method="post" onSubmit="return checklogin();">

	  <li>帐  &nbsp;&nbsp;户：<input name="username" value="" size="14" type="text" class="l_input" style="width:100px; height:20px;"/></li>

	  <li>密  &nbsp;&nbsp;码：<input name="password" value="" size="14" type="password" class="l_input" style="width:100px; height:20px;"/></li>

	  <li>验证码：<input  type="text" name="veriy"  size="14" style="width:50px; height:20px;"/>

	    <img src="<?php echo U('Public/verify');?>"  onclick="show(this);"  id="img" /></li>

		<script>

		  function show(obj){

		     var time = new Date().getTime();

		      obj.src="<?php echo U('Public/verify');?>&time="+time;

		  }

		

		</script>

	  <li><input name="login" type="submit" class="l_bnt" id="login" accesskey="login" value="登 录" />　

	  <input class="l_bnt" value="重 写" type="reset" /></li>

	  </form>

	</ul>

  </div>

  <div class="l_f">

    <div class="left"><img src="__PUBLIC__/skin/admin/images/f_l.gif" /></div>

	<div class="left">

		<img src="__PUBLIC__/skin/admin/images/f_bg.gif" width="378" height="36"/></div>

	<div class="right"><img src="__PUBLIC__/skin/admin/images/f_r.gif" /></div>

  </div>

</div>



</body>

</html>