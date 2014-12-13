<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script src="./bootstrap/js/bootstrap-switch.js"></script>
<link href="./bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>
<script language="javascript" src="js/DatePicker/WdatePicker.js"></script>

<div class="page-header">
  <h2>报警事件记录平台<small></small></h2>
</div>


<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-search"></span>                 
<form name="form" class="form-inline" method="get" action="<?php site_url('mysql/status') ?>" >
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
  <select name="level" class="input-small" style="width: 120px;">
  <option value="">告警级别</option>
  <option value="warning" <?php if($setval['level']=='warning') echo "selected"; ?> >警告</option>
  <option value="error" <?php if($setval['level']=='error') echo "selected"; ?> >紧急</option>
  </select>
   <input class="Wdate" style="width:150px;" type="text" name="stime" id="start_time>" value="<?php echo $setval['stime'] ?>" onFocus="WdatePicker({doubleCalendar:false,isShowClear:false,readOnly:false,dateFmt:'yyyy-MM-dd HH:mm'})"/>
  <input class="Wdate" style="width:150px;" type="text" name="etime" id="end_time>" value="<?php echo $setval['etime'] ?>" onFocus="WdatePicker({doubleCalendar:false,isShowClear:false,readOnly:false,startDate:'1980-05-01',dateFmt:'yyyy-MM-dd HH:mm'})"/>

  <button type="submit" class="btn btn-success">检索</button>
  <a href="<?php echo site_url('alarm/index') ?>" class="btn btn-warning">重置</a>
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
	setInterval("reflesh()",10*1000);//每10秒钟刷新一次 
    </script>

</form>
                    
</div>


<table class="table table-hover table-striped  table-bordered table-condensed"  >
	<tr class="info">
        <th>主机</th>
        <th>应用</th>
        <th>告警级别</th>
        <th>告警内容</th>
        <th>监控时间</th>
        <th>告警时间</th>
        <th>邮件通知</th>
        <th>邮件发送成功</th>
	</tr>
	
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 13px;" class="warning">
		<td><?php echo $item['host'].":".$item['port'] ?></td>
        <td><?php echo $item['application'] ?></td>
        <td><?php echo check_alarm_level($item['level']) ?></td>
        <td><?php echo $item['message']." 当前值:".$item['alarm_value']  ?></td>
        <td><?php echo $item['create_time'] ?></td>
        <td><?php echo $item['send_mail_time'] ?></td>
        <td><?php echo check_status($item['send_mail']) ?></td>
        <td><?php echo check_status($item['send_mail_status']) ?></td>
 
	</tr>
 <?php endforeach;?>
<?php }else{  ?>
<tr>
<td colspan="12">
<font color="red">当前没有任何报警信息！</font>
</td>
</tr>
<?php } ?>	 
</table>


<div class="pagination">
  <ul>
	<?php echo $this->pagination->create_links(); ?>
  </ul>
</div>

