<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script src="./bootstrap/js/bootstrap-switch.js"></script>
<link href="./bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>

<div class="page-header">
  <h2>MySQL 状态监控平台<small> &nbsp;&nbsp;最新检测时间：<?php if(!empty($datalist)){ echo $datalist[0]['create_time'];} else {echo "监控进程未启动或异常";} ?> </small></h2>
</div>

<div class="ui-widget">
<div class="ui-state-highlight      ui-corner-all">
<p><span class="ui-icon ui-icon-volume-on" style="float: left; margin-right: .3em;"></span>
MySQLMTOP温馨提示：1.监控频率请在系统管理里面进行配置; 2.启动自动刷新后每30秒刷新一次; 3.偶尔有无数据情况，是监控进程正在采集数据，为正常状态。</p>
</div>
</div>
  
<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="<?php site_url('monitor/status') ?>" >
 <select name="application_id" class="input-medium" style="">
  <option value="">选择应用</option>
  <?php foreach ($application  as $item):?>
  <option value="<?php echo $item['id'];?>" <?php if($setval['application_id']==$item['id']) echo "selected"; ?> ><?php echo $item['display_name'] ?>(<?php echo $item['name'] ?>)</option>
   <?php endforeach;?>
  </select>
  <select name="server_id" class="input-medium" style="" >
  <option value="">选择主机</option>
  <?php foreach ($server as $item):?>
  <option value="<?php echo $item['id'];?>" <?php if($setval['server_id']==$item['id']) echo "selected"; ?> ><?php echo $item['host'];?>:<?php echo $item['port'];?></option>
   <?php endforeach;?>
  </select>
  <select name="connect" class="input-small" style="width: 110px;">
  <option value="">连接状态</option>
  <option value="success" <?php if($setval['connect']=='success') echo "selected"; ?> >连接成功</option>
  <option value="fail" <?php if($setval['connect']=='fail') echo "selected"; ?> >连接失败</option>
  </select>
  <select name="connections" class="input-small" style="width: 110px;">
  <option value="">总连接数</option>
  <option value="50" <?php if($setval['connections']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['connections']=='100') echo "selected"; ?> >> 100</option>
  <option value="300" <?php if($setval['connections']=='300') echo "selected"; ?> >> 300</option>
  <option value="500" <?php if($setval['connections']=='500') echo "selected"; ?> >> 500</option>
  <option value="1000" <?php if($setval['connections']=='1000') echo "selected"; ?> >> 1000</option>
  <option value="2000" <?php if($setval['connections']=='2000') echo "selected"; ?> >> 2000</option>
  <option value="3000" <?php if($setval['connections']=='3000') echo "selected"; ?> >> 3000</option>
  <option value="5000" <?php if($setval['connections']=='5000') echo "selected"; ?> >> 5000</option>
  </select>
  <select name="active" class="input-small" style="width: 110px;">
  <option value="">活动连接</option>
  <option value="5" <?php if($setval['active']=='5') echo "selected"; ?> >> 5</option>
  <option value="10" <?php if($setval['active']=='10') echo "selected"; ?> >> 10</option>
  <option value="20" <?php if($setval['active']=='20') echo "selected"; ?> >> 20</option>
  <option value="30" <?php if($setval['active']=='30') echo "selected"; ?> >> 30</option>
  <option value="50" <?php if($setval['active']=='50') echo "selected"; ?> >> 50</option>
  <option value="100" <?php if($setval['active']=='100') echo "selected"; ?> >> 100</option>
  </select>
  
  <select name="order" class="input-small" style="width: 110px;">
  <option value="">排序字段</option>
  <option value="id" <?php if($setval['order']=='id') echo "selected"; ?> >默认排序</option>
  <option value="host" <?php if($setval['order']=='host') echo "selected"; ?> >主机名</option>
  <option value="uptime" <?php if($setval['order']=='uptime') echo "selected"; ?> >运行时间</option>
  <option value="active" <?php if($setval['order']=='active') echo "selected"; ?> >活动连接</option>
  <option value="connections" <?php if($setval['order']=='connections') echo "selected"; ?> >总连接数</option>
  <option value="Bytes_received" <?php if($setval['order']=='Bytes_received') echo "selected"; ?> >接收流量</option>
  <option value="Bytes_sent" <?php if($setval['order']=='Bytes_sent') echo "selected"; ?> >发送流量</option>
  <option value="QPS" <?php if($setval['order']=='QPS') echo "selected"; ?> >QPS</option>
  <option value="TPS" <?php if($setval['order']=='TPS') echo "selected"; ?> >TPS</option>

  </select>
  <select name="order_type" class="input-small" style="width: 110px;">
  <option value="asc" <?php if($setval['order_type']=='asc') echo "selected"; ?> >默认升序</option>
  <option value="desc" <?php if($setval['order_type']=='desc') echo "selected"; ?> >降序排序</option>
  </select>

  <button type="submit" class="btn btn-success">检索</button>
  <a href="<?php echo site_url('monitor/status') ?>" class="btn btn-warning">重置</a>
  &nbsp;
  <label class="checkbox">自动刷新
    <div class="make-switch" data-on="primary" data-off="danger" data-on-label="ON" data-text-label="">
    <input type="checkbox" name="reflesh" id="reflesh" value="" checked="checked" >
    </div>
  </label>
  <script type="text/javascript">
    function reflesh(){
        //var check_status=$("#reflesh").attr("checked");
        //alert(check_status);
        var arrays = new Array();   //创建一个数组对象
        var items = document.getElementsByName("reflesh");  //获取name为check的一组元素(checkbox)
        for(i=0; i < items.length; i++){  //循环这组数据
	       if(items[i].checked){      //判断是否选中
		    arrays.push(items[i].value);  //把符合条件的 添加到数组中. push()是javascript数组中的方法.
	       }
        }
        //alert( "选中的个数为："+arrays.length  );
        check_count=arrays.length;

        if (check_count==1){ //判断选择框是否选中
                document.location.reload();    
        }
	}
	setInterval("reflesh()",30*1000);//每30秒钟刷新一次 
    </script>

</form>
                    
</div>


<table class="table table-hover table-striped  table-bordered table-condensed"  >
	<tr>
        <th>应用</th>
        <th>主机</th>  
		<th>状态</th>
        <th>运行时间</th>
		<th>版本</th>
		<th>总连接数</th>
        <th>活动连接</th>
        <th>QPS</th>
        <th>TPS</th>
        <th>接收流量/秒</th>
        <th>发送流量/秒</th>
        <th>图表</th>
	</tr>
	
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
		<td><?php echo $item['application'] ?></td>
        <td><?php echo $item['host'] ?>:<?php echo $item['port'] ?></td>
       
		<td><?php if($item['connect']=='success'){ ?> <span class="label label-success">连接成功</span> <?php }else{  ?><span class="label label-important">连接失败</span> <?php } ?></td>
        <td><?php echo check_uptime($item['uptime']) ?></td>
        <td><?php echo check_value($item['version']) ?></td>
        <td><?php echo check_connections(check_value($item['connections'])) ?></td>
        <td><?php echo check_active(check_value($item['active'])) ?></td>
        <td><?php echo check_value($item['QPS']) ?></td>
        <td><?php echo check_value($item['TPS']) ?></td>
        <td><?php echo check_value($item['Bytes_received']) ?>KB</td>
        <td><?php echo check_value($item['Bytes_sent']) ?>KB</td>
        <td><a href="<?php echo site_url('chart/status/'.$item['server_id']) ?>"><img src="./img/chart.gif"/></a></a></td>
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

