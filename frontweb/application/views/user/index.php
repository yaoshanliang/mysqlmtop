<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>用户管理<small></small></h2>
</div>
  
<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default " href="<?php echo site_url('user/add') ?>"><i class="fui-new-16"></i>&nbsp;新增</a>
                  <a class="btn btn-default active" href="<?php echo site_url('user/index') ?>"><i class="fui-menu-16"></i>&nbsp;列表</a>
                </div>
</div> <!-- /toolbar -->               
<hr/> 
               
<table class="table table-hover table-striped  table-bordered table-condensed">
	<tr>
		<th>用户名</th>
        <th>真实姓名</th>
		<th>电子邮件</th>
        <th>手机号码</th>
        <th>登录次数</th>
        <th>最近登录时间</th>
        <th>最近登录IP</th>
        <th>正常启用</th>
        <th>管理</th>
	</tr>
	
 <?php if(!empty($datalist)) {?>
 <?php foreach ($datalist  as $item):?>
    <tr style="font-size: 13px;">
		<td><strong><?php echo $item['username'] ?></strong></td>
        <td><?php echo $item['realname'] ?></td>
        <td><?php echo $item['email'] ?></td>
        <td><?php echo $item['mobile'] ?></td>
        <td><?php echo $item['login_count'] ?></td>
        <td><?php echo $item['last_login_time'] ?></td>
        <td><?php echo $item['last_login_ip'] ?></td>
        <td><?php echo check_status($item['status']) ?></td>
        <td><a href="<?php echo site_url('user/edit/'.$item['id']) ?>"  title="编辑"><i class="icon-pencil"></i></a>&nbsp;
        <?php  if($item['username']!="admin"){ ?>
        <a href="<?php echo site_url('user/forever_delete/'.$item['id']) ?>" class="confirm_delete" title="删除" ><i class="icon-remove"></i></a>
        <?php } ?>
        </td>
	</tr>
 <?php endforeach;?>
   <tr>
  <td colspan="12">
  共查询到<font color="red" size="+1"><?php echo $datacount ?></font>条记录.
  </td>
  </tr>
<?php }else{  ?>
<tr>
<td colspan="12">
<font color="red">对不起，没有查询到相关数据！</font>
</td>
</tr>
<?php } ?>
	 
</table>

<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
	$(' .confirm_delete').click(function(){
		return confirm('确定要删除该用户？');	
	});
</script>
