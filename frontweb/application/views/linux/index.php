<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>Linux 资源监控平台<small> &nbsp;&nbsp;最新检测时间：<?php echo $datalist[0]['create_time'] ?> </small></h2>
</div>
  

<table class="table table-hover table-striped  table-bordered table-condensed" style="font-size: 13px;">
	<tr>
		<th colspan="3"><center>主机信息</center></th>
		<th colspan="3"><center>CPU Load</center></th>
		<th colspan="3"><center>磁盘使用率</center></th>
        <th colspan="2"><center>内存</center></th>
        <th ><center></center></th>
	</tr>
    <tr>
		<th>主机IP</th>
	
        <th>主机名</th>
        <th>系统内核</th>
		<th>load1</th>
		<th>load5</th>
        <th>load15</th>
		<th>(/)</th>
		<th>(/home)</th>
        <th>(/data)</th>
        <th>总内存</th>
        <th>使用内存</th>
        <th>图表</th>
	</tr>
	
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 13px;">
		<td><?php echo $item['ip'] ?></td>
        <td><?php echo $item['hostname'] ?></td>
		<td><?php echo $item['kernel'] ?></td>
		<td><?php echo $item['load1'] ?></td>
        <td><?php echo $item['load5'] ?></td>
        <td><?php echo $item['load15'] ?></td>
        <td><?php echo $item['disk_use_root'] ?></td>
        <td><?php echo $item['disk_use_data'] ?></td>
        <td><?php echo $item['disk_use_data'] ?></td>
        <td><?php echo substring($item['mem_total']/1024/1024,0,5) ?>G</td>
        <td><?php echo substring($item['mem_use']/1024/1024,0,5) ?>G</td>
        <td><a href="<?php echo site_url('linux/chart/'.$item['ip']) ?>">图表</a></td>
	</tr>
 <?php endforeach;?>
<?php }else{  ?>
<tr>
<td colspan="12">
<font color="red">对不起，没有查询到相关数据！</font>
</td>
</tr>
<?php } ?>
	 
</table>


