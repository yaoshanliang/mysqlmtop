<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script src="./bootstrap/js/bootstrap-switch.js"></script>
<link href="./bootstrap/css/bootstrap-switch.css" rel="stylesheet"/>

<div class="page-header">
  <h2>MySQL 进程监控平台<small> &nbsp;&nbsp;最新检测时间：<?php if(!empty($datalist)){ echo $datalist[0]['create_time'];} ?> </small></h2>
</div>

<div class="ui-widget">
<div class="ui-state-highlight      ui-corner-all">
<p><span class="ui-icon ui-icon-volume-on" style="float: left; margin-right: .3em;"></span>
MySQLMTOP温馨提示：1.启动自动刷新后每5秒刷新一次; 2.执行进程管理操作需要在全局配置里开启进程管理选项，开启后请双击结束进程按钮来关闭进程。 </p>
</div>
</div>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  
	//hide message_body after the first one
	//$(".table .message_body:gt(0)").hide();
    $(".table .message_body").hide();
	$(".collpase_all_message").hide();
	
	//toggle message_body
	$(".message_head").click(function(){
		$(this).next(".message_body").slideToggle(200)
		return false;
	});

    //collapse all messages
	$(".collpase_all_message").click(function(){
	   		$(this).hide()
		$(".show_all_message").show()
		$(".message_body").slideUp(200)
		return false;
	});

	//show all messages
	$(".show_all_message").click(function(){
		$(this).hide()
		$(".collpase_all_message").show()
		$(".message_body").slideDown()
		return false;
	});
 
   $(".pinned").pin();

});

</script>
<style type="text/css">

/* message display page */

.message_head {
	padding: 2px 5px;
	cursor: pointer;
	position: relative;
}

.message_head cite {
	font-size: 100%;
	font-weight: bold;
	font-style: normal;
}

</style>

<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span class="ui-icon ui-icon-search" style="float: left; margin-right: .3em;"></span>
                    
<form name="form" class="form-inline" method="get" action="<?php site_url('monitor/replication') ?>" >
  <input type="hidden" name="search" value="submit" />
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
 
  <button type="submit" class="btn btn-success">检索</button>
  <a href="<?php echo site_url('monitor/replication') ?>" class="btn btn-warning">重置</a>
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
	setInterval("reflesh()",5*1000);//每10秒钟刷新一次 
    </script>

</form>
                    
</div>

           
        <table class="table table-hover table-striped  table-bordered table-condensed">	
        <tr>
        <th>ID</th>
        <th>User</th>
        <th>Host</th>
        <th>DB</th>
        <th>Command</th>
        <th>Time</th>
        <th>Status</th>
        <th >SQL Info <span class="collapse_buttons" ><a href="#" class="show_all_message">展开所有SQL</a> <a href="#" class="collpase_all_message">合并所有SQL</a></span></th>         
        <th>主机</th>
        <th>进程管理</th>
</tr>
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 12px;">
        <td><?php echo $item['pid'] ?></td>
        <td><?php echo $item['user'] ?></td>
        <td><?php echo substring($item['host'],0,30) ?></td>
        <td><?php echo $item['db'] ?></td>
        <td><?php echo $item['command'] ?></td>
        <td><?php echo $item['time'] ?>&nbsp;</td>
        <td><?php echo $item['status'] ?>&nbsp;</td>
        <td>
		<div class="message_head"><span class="message_icon"><i class="icon-plus"></i></span><cite><?php echo substring($item['info'],0,40); ?>:</cite></div>
		<div class="message_body" style="width: 300px;">
			<pre><span style="color: blue;"><?php echo $item['info']; ?></span></pre>
		</div>
        </td>
        <td><?php echo $item['host'] ?>:<?php echo $item['port'] ?></td>
        <td>
        <?php if($option_kill_process==1){ ?>
            <?php  if(($this->session->userdata('logged_in')==1) and ($this->session->userdata('username')=='admin')) {?>
            <div class="<?php echo $item['pid'] ?>"><a href="javascript::(0)" ondblclick="kill_process(<?php echo $item['server_id'] ?>,<?php echo $item['pid'] ?>)" class="btn-danger btn-mini  btn">结束进程</a></div>
            <?php }else{ ?>
            <button class='btn btn-mini btn-info disabled' type='button'>无权限</button>
            <?php } ?>
        <?php }else{ ?>
        <button class='btn btn-mini btn-info disabled' type='button'>未开启</button>
        <?php } ?>
        </td>
	</tr>

 <?php endforeach;?>
<?php }else{  ?>
<tr>
<td colspan="12">
<font color="red">没有查询到相关数据！</font>
</td>
</tr>
<?php } ?>	 
</table>

<script type="text/javascript">
function kill_process(server_id,pid){
    if(server_id=='' || pid==''){
        alert("进程异常，请重试！");
    }
    else{
        $.ajax({   
		  type:"GET",   
			  url:"<?php echo site_url('monitor/ajax_kill_process') ?>",
			  data:{
				  server_id: server_id, pid: pid
				  },   
			  beforeSend:function(){
				  	$("."+pid).html("<button class='btn btn-mini btn-info' type='button'>正在结束</button>");
				  },                
			  success:function(data){
				//alert(data);
				switch(data)
				{
					case 'empty':
						alert("进程号或服务器号丢失,请重试");
						break
					case 'success':
						//alert('info');
                        $("."+pid).html("<button class='btn btn-mini btn-success disabled' type='button'>正在结束</button>");
                        setInterval("reflesh_mtop()",5*1000);
						return true;
						break
					default:
						alert ('发生未知异常，请联系管理员');
				}
				return false;			
			}               
         });   
		return false;

    }

}


function reflesh_mtop(){
    document.location.reload();    
}


</script>

