<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>修改密码<small></small></h2>
</div>
  
<?php if ($error_code!==0) { ?>
	<div class="alert alert-error">
	<?php echo validation_errors(); ?>
	<?php if ($error_code=='old_password_fail') { ?>
			<p>当前密码错误！</p>
	<?php } ?>
	</div>
<?php } ?>

<?php if ($success_code!==0) { ?>
	<div class="alert alert-success">
			<p>恭喜您，密码修改成功！</p>
	</div>
<?php } ?>


<form class="form-horizontal" method='post' action="<?php echo site_url('user/password')?>" >
<input type='hidden'  name='pwd' value='doing' />
   <div class="control-group">
    <label class="control-label" for="">*账号</label>
    <div class="controls">
      <input type="text" id=""  name="username" value="<?php echo $username; ?>" readonly>
    </div>
  </div>

  <div class="control-group ">
    <label class="control-label" for="inputEmail">*当前密码</label>
    <div class="controls">
      <input type="password" id="old_password" name="old_password"  value=""  > 
      <span class="help-inline"></span>
    </div>
  </div>
  
    <div class="control-group ">
    <label class="control-label" for="inputEmail">*新密码</label>
    <div class="controls">
      <input type="password" id="new_password" name="new_password"  value=""  > 
      <span class="help-inline"></span>
    </div>
  </div>
  
    <div class="control-group ">
    <label class="control-label" for="inputEmail">*重复新密码</label>
    <div class="controls">
      <input type="password" id="new_password_conf" name="new_password_conf"  value=""  > 
      <span class="help-inline"></span>
    </div>
  </div>
     
    
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">提交</button> 
    </div>
  </div>
</form>

