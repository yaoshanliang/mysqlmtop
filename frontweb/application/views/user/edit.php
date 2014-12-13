<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>编辑用户<small></small></h2>
</div>
  

<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default " href="<?php echo site_url('user/add') ?>"><i class="fui-new-16"></i>&nbsp;新增</a>
                  <a class="btn btn-default " href="<?php echo site_url('user/index') ?>"><i class="fui-menu-16"></i>&nbsp;列表</a>
                </div>
</div> <!-- /toolbar -->               
<hr/>                

<?php if ($error_code!==0) { ?>
<div class="ui-widget">
<div class="ui-state-error   ui-corner-all">
<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
<?php echo validation_errors(); ?></p>
</div>
</div>

<?php } ?>

<form name="form" class="form-horizontal" method="post" action="<?php echo site_url('user/edit') ?>" >
<input type="hidden" name="submit" value="edit"/> 
<input type='hidden'  name='id' value=<?php echo $record['id'] ?> />
   <div class="control-group">
    <label class="control-label" for="">*用户名</label>
    <div class="controls">
      <input type="text" id="username"   name="username" readonly value="<?php echo $record['username']; ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">*用户密码</label>
    <div class="controls">
      <input type="text" id="password"  name="password" value="" >
      <span class="help-inline">密码不需要修改请留空</span>
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">*真实姓名</label>
    <div class="controls">
      <input type="text" id=""  name="realname" value="<?php echo $record['realname']; ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">电子邮箱</label>
    <div class="controls">
      <input type="text" id=""  name="email" value="<?php echo $record['email']; ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">手机号码</label>
    <div class="controls">
      <input type="text" id=""  name="mobile" value="<?php echo $record['mobile']; ?>" >
    </div>
   </div>
   <?php  if($record['username']!="admin"){ ?>
    <div class="control-group">
    <label class="control-label" for="">*是否启用</label>
    <div class="controls">
        <select name="status" id="status" class="input-small">
         <option value="1" <?php echo set_selected(1,$record['status']) ?> >是</option>
         <option value="0" <?php echo set_selected(0,$record['status']) ?> >否</option>
        </select>
    </div>
   </div>
   <?php }else{ ?>
        <input type='hidden'  name='status' value="1" />
   <?php } ?> 

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">提 交</button> &nbsp;我想放弃提交，<a href='<?php echo site_url('user/index')?>'>点此返回</a>
    </div>
  </div>
                                    
</form>

