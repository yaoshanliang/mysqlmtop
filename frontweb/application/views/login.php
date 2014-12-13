<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>系统登录<small></small></h2>
</div>
  
<?php if ($error_code!==0) { ?>
	<div class="alert alert-error">
	<?php echo validation_errors(); ?>
	<?php if ($error_code=='user_check_fail') { ?>
			<p>账号密码错误或账号被禁用！</p>
	<?php } ?>
	</div>
<?php } ?>

<form class="form-horizontal" method='post' action="<?php echo site_url('login')?>">
<input type='hidden'  name='login' value='doing' />
<input type='hidden'  name='return_url' value='<?php  echo $return_url ?>' />

  <div class="control-group ">
    <label class="control-label" for="inputEmail">账  号</label>
    <div class="controls">
      <input type="text" id="username" name="username" class='span3' value="<?php echo set_value('username'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">密  码</label>
    <div class="controls">
      <input type="password" id="" name="password" class='span3' value="<?php echo set_value('password'); ?>">
      
    </div>
  </div>

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">登录</button>&nbsp;&nbsp;
    </div>
  </div>

</form>

<div class="ds-login"></div>
