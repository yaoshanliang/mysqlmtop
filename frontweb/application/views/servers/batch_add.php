<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>批量添加主机<small></small></h2>
</div>
  
<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default " href="<?php echo site_url('servers/add') ?>"><i class="fui-new-16"></i>&nbsp;新增</a>
                  <a class="btn btn-default active" href="<?php echo site_url('servers/batch_add') ?>"><i class="fui-new-16"></i>&nbsp;批量新增</a>
                  <a class="btn btn-default " href="<?php echo site_url('servers/index') ?>"><i class="fui-menu-16"></i>&nbsp;列表</a>
                  <a class="btn btn-default " href="<?php echo site_url('servers/trash') ?>"><i class="fui-calendar-16"></i>&nbsp;回收站</a>
                </div>
</div> <!-- /toolbar -->               
<hr/>

<div class="ui-state-highlight   ui-corner-all">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
<strong>Help:</strong>1.主机,端口,应用同时填写时该行记录才会被提交。2.属于同一节点的Master/Slave服务器请选择为相同的应用。</p>
</div>

<?php if ($error_code!==0) { ?>
<div class="ui-widget">
<div class="ui-state-error   ui-corner-all">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
<?php echo validation_errors(); ?></p>
</div>
</div>
<?php } ?>
 
<table class="table table-hover table-striped  table-bordered table-condensed">
	<tr>
		<th colspan="4"><center>服务器</center></th>
		<th colspan="5"><center>告警开关</center></th>
		<th colspan="3"><center>告警阀值</center></th>
	</tr>
    <tr>
        <th>主机</th>
        <th>端口</th>
        <th>应用</th>
		<th>监控</th>
		<th>邮件通知</th>
        <th>总连接数</th>
		<th>活动进程</th>
        <th>复制状态</th>
        <th>复制延时</th>
        <th>总连接数</th>
        <th>活动进程</th>
        <th>复制延时</th>
	</tr>

<form name="form" class="form-horizontal" method="post" action="<?php echo site_url('servers/batch_add') ?>" >
	
<?php for($n=1;$n<=10;$n++){ ?>
<input type="hidden" name="submit" value="batch_add"/>                             
<input type="hidden" name="ids[]" value="<?php echo $n ?>" /> 
    <tr style="font-size: 13px;">
		<td><input type="text" name="host_<?php echo $n ?>" class="input-small" placeholder="IP或域名"></td>
        <td><input type="text" name="port_<?php echo $n ?>" class="input-mini" placeholder="端口" value="3306"></td>
        <td><select name="application_id_<?php echo $n ?>" id="application_id_<?php echo $n ?>" class="input-medium">
        <option value=""  >选择应用</option>
        <?php if(!empty($application)) {?>
        <?php foreach ($application  as $item):?>
         <option value="<?php echo $item['id']?>"  ><?php echo $item['name']?>(<?php echo $item['display_name']?>)</option>
        <?php endforeach;?>
        <?php } ?>
        </select></td>
        <td><select name="status_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td> <select name="send_mail_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td><select name="alarm_connections_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td><select name="alarm_active_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td><select name="alarm_repl_status_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td><select name="alarm_repl_delay_<?php echo $n ?>"  class="input-small">
         <option value="1"  >开启</option>
         <option value="0"  >关闭</option>
        </select></td>
        <td><input type="text"  class="input-mini" placeholder="告警阀值" name="threshold_connections_<?php echo $n ?>" value="1000" ></td>
        <td><input type="text"  class="input-mini" placeholder="告警阀值" name="threshold_active_<?php echo $n ?>" value="10" ></td>
		<td><input type="text"  class="input-mini" placeholder="告警阀值" name="threshold_repl_delay_<?php echo $n ?>" value="60" ></td>
        </td>
	</tr>
<?php } ?> 

<tr>                                                                                                         
  <td colspan="12">                                                                                           
  <button class="btn btn-large btn-block btn-success confirm_add" type="submit">批量提交</button>   
</tr>                                                                                                        

</table>

</form>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
	$(' .confirm_add').click(function(){
		return confirm('确定要批量提交所有服务器？');	
	});
</script>
