<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL检查工具组件</h2>
</div>

<p>
<a href="<?php echo site_url('widget/bigtable') ?>" class="btn btn-info  btn-large" >MySQL大表查询</a>
<a href="<?php echo site_url('widget/hit_rate') ?>" class="btn btn-info  btn-large" >MySQL命中率查询</a>
<a href="<?php echo site_url('widget/connect') ?>" class="btn btn-info  btn-large" >MySQL连接源查询</a>
</p>

<div class="page-header">
  <h4>查询数据库的连接来源和连接次数等信息<small> &nbsp;&nbsp;请手动执行程序./check_mysql_widget_connect.py启动一次检查，然后刷新该页面。</h4>
</div>


<table class="table table-hover table-striped  table-bordered table-condensed"  >
	<tr class="success">
		<th ><center>来源机器</center></th>
		<th ><center>来源用户</center></th>
		<th ><center>连接次数</center></th>
		<th ><center>目标主机</center></th>
        <th ><center>目标库</center></th>
        <th ><center>检查时间</center></th>

	</tr>
  	
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;" >
        <td><?php echo $item['connect_server'] ?></td>
        <td><?php echo $item['connect_user'] ?></td>
        <td><?php echo $item['connect_count'] ?></td>
        <td><?php  echo $item['host'].':'. $item['port'] ?></td>
        <td><?php echo $item['connect_db'] ?></td>
        <td><?php echo $item['create_time'] ?></td>
	</tr>
 <?php endforeach;?>
<?php }else{  ?>
<tr>
<td colspan="12">
<font color="red">对不起,没有查询到相关数据！ 1.请确认是否添加主机信息; 2.请确认是否启动监控进程或执行检测程序。</font>
</td>
</tr>
<?php } ?>
	 
</table>

