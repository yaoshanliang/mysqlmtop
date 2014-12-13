<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>全局配置<small></small></h2>
</div>
  
<?php if ($success_code!==0) { ?>
<div class="alert alert-success">
配置信息保存成功。
</div>
<?php } ?>                


<form name="form" class="form-horizontal" method="post" action="<?php echo site_url('option/save') ?>" >
<input type="hidden" name="submit" value="save"/> 

   <div class="control-group success">
    <label class="control-label" for="">*MySQL全局监控</label>
    <div class="controls">
        <select name="monitor" id="monitor" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['monitor']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['monitor']) ?> >关闭</option>
        </select>
        <span class="help-inline">此项如果关闭则所有项目都不会被监控，下面监控选项都失效</span>
    </div>
   </div>
   <div class="control-group success">
    <label class="control-label" for="">*MySQL状态监控</label>
    <div class="controls">
        <select name="monitor_status" id="monitor_status" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['monitor_status']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['monitor_status']) ?> >关闭</option>
        </select>
        <span class="help-inline"></span>
    </div>
   </div>
   
   <div class="control-group success">
    <label class="control-label" for="">*MySQL进程监控</label>
    <div class="controls">
        <select name="monitor_process" id="monitor_process" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['monitor_process']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['monitor_process']) ?> >关闭</option>
        </select>
        <span class="help-inline"></span>
    </div>
   </div>
   
   <div class="control-group success">
    <label class="control-label" for="">*MySQL复制监控</label>
    <div class="controls">
        <select name="monitor_replication" id="monitor_replication" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['monitor_replication']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['monitor_replication']) ?> >关闭</option>
        </select>
        <span class="help-inline"></span>
    </div>
   </div>
   
   <div class="control-group success">
    <label class="control-label" for="">*MySQL进程管理</label>
    <div class="controls">
        <select name="kill_process" id="kill_process" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['kill_process']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['kill_process']) ?> >关闭</option>
        </select>
        <span class="help-inline">开启后可以在进程监控页面执行结束进程操作</span>
    </div>
   </div>
   
  
   
   <!--
   <div class="control-group success">
    <label class="control-label" for="">*慢查询记录时间</label>
    <div class="controls">
        <select name="slow_query_time" id="slow_query_time" class="input-small">
 
         <option value="1" <?php echo set_selected(1,$option['slow_query_time']) ?>> >1s</option>
         <option value="2" <?php echo set_selected(2,$option['slow_query_time']) ?>> >2s</option>
         <option value="3" <?php echo set_selected(3,$option['slow_query_time']) ?>> >3s</option>
         <option value="5" <?php echo set_selected(5,$option['slow_query_time']) ?>> >5s</option>
         <option value="10" <?php echo set_selected(10,$option['slow_query_time']) ?>> >10s</option>
         <option value="30" <?php echo set_selected(30,$option['slow_query_time']) ?>> >30s</option>
         <option value="60" <?php echo set_selected(60,$option['slow_query_time']) ?>> >60s</option>
         <option value="180" <?php echo set_selected(180,$option['slow_query_time']) ?>> >180s</option>
         <option value="600" <?php echo set_selected(600,$option['slow_query_time']) ?>> >600s</option>
         <option value="1800" <?php echo set_selected(1800,$option['slow_query_time']) ?>> >1800s</option>
         <option value="3600" <?php echo set_selected(3600,$option['slow_query_time']) ?>> >3600s</option>
        </select>
        <span class="help-inline">记录查询大于多少秒的SQL语句</span>
    </div>
   </div>
   -->
   
   <div class="control-group success">
    <label class="control-label" for="">*大表检索阀值</label>
    <div class="controls">
        <select name="big_table_size" id="big_table_size" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['big_table_size']) ?>> >1GB</option>
         <option value="2" <?php echo set_selected(2,$option['big_table_size']) ?>> >2GB</option>
         <option value="3" <?php echo set_selected(3,$option['big_table_size']) ?>> >3GB</option>
         <option value="5" <?php echo set_selected(5,$option['big_table_size']) ?>> >5GB</option>
         <option value="10" <?php echo set_selected(10,$option['big_table_size']) ?>> >10GB</option>
         <option value="20" <?php echo set_selected(20,$option['big_table_size']) ?>> >20GB</option>
         <option value="30" <?php echo set_selected(30,$option['big_table_size']) ?>> >30GB</option>
         <option value="50" <?php echo set_selected(50,$option['big_table_size']) ?>> >50GB</option>
         <option value="100" <?php echo set_selected(100,$option['big_table_size']) ?>> >100GB</option>
        </select>
        <span class="help-inline">查找数据库中大于多少GB的表</span>
    </div>
   </div>
   
   <div class="control-group error">
    <label class="control-label" for="">*开启告警</label>
    <div class="controls">
        <select name="alarm" id="alarm" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['alarm']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['alarm']) ?> >关闭</option>
        </select>
        <span class="help-inline">此项如果关闭则不会记录报警事件(也不会发送报警邮件)</span>
    </div>
   </div>
    <div class="control-group error">
    <label class="control-label" for="">*发送报警邮件</label>
    <div class="controls">
        <select name="send_alarm_mail" id="send_alarm_mail" class="input-small">
         <option value="1" <?php echo set_selected(1,$option['send_alarm_mail']) ?> >开启</option>
         <option value="0" <?php echo set_selected(0,$option['send_alarm_mail']) ?> >关闭</option>
        </select>
        <span class="help-inline">此项如果关闭则不会发送报警邮件</span>
    </div>
   </div>
   
   <div class="control-group error">
    <label class="control-label" for="">*邮件接收者</label>
    <div class="controls">
      <input type="text" id="mail_to_list"  name="mail_to_list" value="<?php echo $option['mail_to_list'] ?>" class="input-xxlarge">
      <span class="help-inline">多人请用 ; 分割</span>
    </div>
   </div>
   
   <div class="control-group info">
    <label class="control-label" for="">*监控频率</label>
    <div class="controls">
        <select name="frequency_monitor" id="frequency_monitor" class="input-small">
         <option value="5" <?php echo set_selected(5,$option['frequency_monitor']) ?>>5s</option>
         <option value="10" <?php echo set_selected(10,$option['frequency_monitor']) ?>>10s</option>
         <option value="20" <?php echo set_selected(20,$option['frequency_monitor']) ?>>20s</option>
         <option value="30" <?php echo set_selected(30,$option['frequency_monitor']) ?>>30s</option>
         <option value="60" <?php echo set_selected(60,$option['frequency_monitor']) ?>>60s</option>
        </select>
        <span class="help-inline"></span>
    </div>
   </div>
   
    <div class="control-group info">
    <label class="control-label" for="">*报警频率</label>
    <div class="controls">
        <select name="frequency_alarm" id="frequency_alarm" class="input-small">
 
         <option value="30" <?php echo set_selected(30,$option['frequency_alarm']) ?>>30s</option>
         <option value="60" <?php echo set_selected(60,$option['frequency_alarm']) ?>>60s</option>
         <option value="120" <?php echo set_selected(120,$option['frequency_alarm']) ?>>120s</option>
         <option value="180" <?php echo set_selected(180,$option['frequency_alarm']) ?>>180s</option>
         <option value="300" <?php echo set_selected(300,$option['frequency_alarm']) ?>>300s</option>
         <option value="600" <?php echo set_selected(600,$option['frequency_alarm']) ?>>600s</option>
         <option value="1200" <?php echo set_selected(1200,$option['frequency_alarm']) ?>>1200s</option>
        </select>
        <span class="help-inline">报警频率设置时间请大于监控频率</span>
    </div>
   </div>
   
  
    

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-success">保 存</button> 
    </div>
  </div>
                                    
</form>

