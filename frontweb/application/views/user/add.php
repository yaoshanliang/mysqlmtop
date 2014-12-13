<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>添加用户<small></small></h2>
</div>
  

<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default active" href="<?php echo site_url('user/add') ?>"><i class="fui-new-16"></i>&nbsp;新增</a>
                  <a class="btn btn-default 
                  " href="<?php echo site_url('user/index') ?>"><i class="fui-menu-16"></i>&nbsp;列表</a>
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

<form name="form" class="form-horizontal" method="post" action="<?php echo site_url('user/add') ?>" >
<input type="hidden" name="submit" value="add"/> 
   <div class="control-group">
    <label class="control-label" for="">*用户名</label>
    <div class="controls">
      <input type="text" id="username"  name="username" value="<?php echo set_value('username'); ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">*登录密码</label>
    <div class="controls">
      <input type="password" id="password"  name="password" value="<?php echo set_value('password'); ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">*重复密码</label>
    <div class="controls">
      <input type="password" id="password_conf"  name="password_conf" value="<?php echo set_value('password_conf'); ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">*真实姓名</label>
    <div class="controls">
      <input type="text" id=""  name="realname" value="<?php echo set_value('realname'); ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">电子邮箱</label>
    <div class="controls">
      <input type="text" id=""  name="email" value="<?php echo set_value('email'); ?>" >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="">手机号码</label>
    <div class="controls">
      <input type="text" id=""  name="mobile" value="<?php echo set_value('mobile'); ?>" >
    </div>
   </div>
    <div class="control-group">
    <label class="control-label" for="">*是否启用</label>
    <div class="controls">
        <select name="status" id="status" class="input-small">
         <option value="1"  >是</option>
         <option value="0"  >否</option>
        </select>
    </div>
   </div>

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">提 交</button> &nbsp;我想放弃提交，<a href='<?php echo site_url('user/index')?>'>点此返回</a>    
    </div>
  </div>
                                    
</form>

