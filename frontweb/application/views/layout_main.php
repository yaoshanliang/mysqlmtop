<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
<title>MySQLMTOP 开源的MySQL企业级监控系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<base href="<?php echo base_url().'application/views/static/'; ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="./bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="./bootstrap/css/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
<link href="./bootstrap/css/font-awesome.min.css"  rel="stylesheet">
<link href="./bootstrap/css/prettify.css"  rel="stylesheet">
<link href="./bootstrap/css/flat-ui.css" rel="stylesheet" media="screen">
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="./bootstrap/css/jquery.ui.1.10.0.ie.css"/>
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="./bootstrap/css/font-awesome-ie7.min.css">
<![endif]-->
            
<link rel="stylesheet" href="css/style.css" />

    <style type="text/css">
      body {
        padding-top: 50px;
        padding-bottom: 40px;
        background-color: #f0f2f4;
        font-family:"微软雅黑";
      }
      .nav li a{ font-size:16px; }
      .page-header{ border-color: #627d98; border-width:3px;}
      .btn-mini{font-size:12px;}
      .btn{font-family:"微软雅黑";}
      .input{ padding-top: 0px; padding-bottom: 0px; margin: 0px; height:10px;}
    </style>

</head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo site_url('index/index') ?>">MySQLMTOP</a>
          <div class="nav-collapse collapse">
<?php  if($this->session->userdata('logged_in')!=1) {?>
 <p class="navbar-text pull-right">
 <a href='<?php echo site_url('user/login') ?>' class="btn-success  btn">登录</a>
 </p>
<?php } else{ ?>
 <p class="navbar-text pull-right">
  <a href="<?php echo site_url('login/logout')?>" class="btn-success btn">退出</a>
 </p>
<?php }?>

             <ul class="nav">
                <li <?php if($cur_nav=='index_index') echo "class=active"; ?> ><a href="<?php echo site_url('index/index') ?>"> 仪表盘</a></li>
                <li <?php if($cur_nav=='monitor_status') echo "class=active"; ?> ><a href="<?php echo site_url('monitor/status') ?>">状态监控</a></li>
                <li <?php if($cur_nav=='monitor_process') echo "class=active"; ?> ><a href="<?php echo site_url('monitor/process') ?>">进程监控</a></li>
                <li <?php if($cur_nav=='monitor_replication') echo "class=active"; ?> ><a href="<?php echo site_url('monitor/replication') ?>">复制监控</a></li>
                <li <?php if($cur_nav=='slowquery_index') echo "class=active"; ?> ><a href="<?php echo site_url('slowquery/index') ?>">慢查询分析</a></li>
                <li <?php if($cur_nav=='widget') echo "class=active"; ?> ><a href="<?php echo site_url('widget/index') ?>">工具组件</a></li>
                <li <?php if($cur_nav=='alarm_index') echo "class=active"; ?> ><a href="<?php echo site_url('alarm/index') ?>">告警事件</a></li>
                <li <?php if($cur_nav=='linux') echo "class=active"; ?> ><a href="<?php echo site_url('linux/index') ?>">系统资源</a></li>
                <?php  if(($this->session->userdata('logged_in')==1) and ($this->session->userdata('username')=='admin')) {?>
                <li <?php if($cur_nav=='config') echo "class=active"; ?> ><a href="<?php echo site_url('option/index') ?>">管理中心</a>
                        <ul>
                              <li <?php if($cur_nav=='config') echo "class=active"; ?> ><a href="<?php echo site_url('option/index') ?>">全局配置</a></li>
                              <li <?php if($cur_nav=='application') echo "class=active"; ?> ><a href="<?php echo site_url('application/index') ?>">应用管理</a></li>
                              <li <?php if($cur_nav=='servers') echo "class=active"; ?> ><a href="<?php echo site_url('servers/index') ?>">主机管理</a></li>
                              <li <?php if($cur_nav=='user_index') echo "class=active"; ?> ><a href="<?php echo site_url('user/index') ?>">用户管理</a></li>
                              <li <?php if($cur_nav=='user_password') echo "class=active"; ?> ><a href="<?php echo site_url('user/password') ?>">更改密码</a></li>
                              <li <?php if($cur_nav=='login_logout') echo "class=active"; ?> ><a href="<?php echo site_url('login/logout') ?>">退出系统</a></li>
                       </ul> <!-- /Sub menu -->
                </li>
                <?php } ?>
              </ul>
 
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
<div style="height: 50px;"></div>

<div class="container">
   <?php echo $content_for_layout ; ?>
</div>

<div class="container-fluid">
    <hr>

        <p>&copy; MySQLMTOP V2.1 2013-2014 <a href="http://www.mtop.cc" target="_blank">www.mtop.cc</a> 版权所有 Power By <a href="http://www.ruzuojun.com" target="_blank">Ruzuojun</a>     <a href="http://www.mtop.cc/manual" target="_blank">在线手册</a> <a href="http://www.mtop.cc/forum" target="_blank">交流社区</a></p>

</div>


<script src="./bootstrap/js/bootstrap.min.js"></script>
<script src="./bootstrap/js/jquery-ui-1.10.0.custom.min.js"></script>


<div style="display:none;" class="back-to" id="toolBackTop">
<a title="返回顶部" onclick="window.scrollTo(0,0);return false;" href="#top" class="back-top">
返回顶部</a>
</div>

<style>

.back-to {bottom: 35px;overflow:hidden;position:fixed;right:10px;width:50px;z-index:999;}
.back-to .back-top {background: url("./static/images/back-top.png") no-repeat scroll 0 0 transparent;display: block;float: right;height:50px;margin-left: 10px;outline: 0 none;text-indent: -9999em;width: 50px;}
.back-to .back-top:hover {background-position: -50px 0;}
</style>
<script type="text/javascript">
$(document).ready(function () {
        var bt = $('#toolBackTop');
        var sw = $(document.body)[0].clientWidth;

        var limitsw = (sw - 1200) / 2 - 40;
        if (limitsw > 0){
                limitsw = parseInt(limitsw);
                bt.css("right",limitsw);
        }

        $(window).scroll(function() {
                var st = $(window).scrollTop();
                if(st > 30){
                        bt.show();
                }else{
                        bt.hide();
                }
        });
})
</script>

 
  </body>
</html>
