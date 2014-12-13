<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="page-header">
  <h2>MySQL检查工具组件</h2>
</div>

<div class="ui-widget">
<div class="ui-state-highlight      ui-corner-all">
<p><span class="ui-icon ui-icon-volume-on" style="float: left; margin-right: .3em;"></span>
MySQLMTOP温馨提示：以下查询进程为非实时采集，默认进程为关闭状态。请手动点击需要查询的按钮启动一次数据采集进程。</p>
</div>
</div>
  
<p>
<a href="<?php echo site_url('widget/bigtable') ?>" class="btn btn-info  btn-large" >MySQL大表查询</a>
<a href="<?php echo site_url('widget/hit_rate') ?>" class="btn btn-info  btn-large" >MySQL命中率查询</a>
<a href="<?php echo site_url('widget/connect') ?>" class="btn btn-info  btn-large" >MySQL连接源查询</a>
</p>




