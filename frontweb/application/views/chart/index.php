
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL性能状态图表<small> (通过选择左侧的主机可以进行主机切换)</small></h2>
</div>

<!--
<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span class="ui-icon ui-icon-search" style="float: left; margin-right: .3em;"></span>
<form name="form" class="form-inline" method="get" action="<?php echo  site_url('chart/detail') ?>" >

  <select name="server_id" class="input-medium" style="" >
  <option value="">选择主机</option>
  <?php if(!empty($server)) {?>
  <?php foreach ($server as $item):?>
  <option value="<?php echo $item['id'];?>"  ><?php echo $item['host'];?>:<?php echo $item['port'];?></option>
   <?php endforeach;?>
   <?php } ?>
  </select>

 <select name="time" class="input-small" style="width: 120px;">
  <option value="">时间范围</option>
  <option value="3600" >1小时</option>
  <option value="10800" >3小时</option>
  <option value="21600" >6小时</option>
  <option value="43200" >12小时</option>
  <option value="86400" >1天</option>
  <option value="172800" >2天</option>
  <option value="259200" >3天</option>
  <option value="864800" >1周</option>
  </select>
 
  <button type="submit" class="btn btn-success">检索</button>
  </form>
</div>
-->

<div class="mainleft">
<div id="navcontainer">
<div class="title">主机列表</div>
<ul id="navlist">
  <?php if(!empty($server)) {?>
  <?php foreach ($server as $item):?>
<li <?php if($cur_server_id==$item['id']){ ?> class='active' <?php } ?> ><a href="<?php echo  site_url('chart/index/'.$item['id']) ?>"><?php echo $item['host'];?>:<?php echo $item['port'];?></a></li>
  <?php endforeach;?> 
   <?php } ?>             	
</ul>
</div>
</div>
<div class="mainright span3">
<table class="table  table-striped  table-bordered table-condensed"  >
	<tr class="info">
        <th><center>Active(当前活动连接)</center></th>
        <th><center>Connections(当前总连接数)</center></th>
	</tr>
    <tr style="font-size: 12px;" class="">
       <td><div id="active" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
       <td><div id="connections" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
	</tr>
    <tr class="info">
        <th><center>QPS(每秒查询数)</center></th>
        <th><center>TPS(每秒事务数)</center></th>
	</tr>
    <tr style="font-size: 12px;" class="">
       <td><div id="qps" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
       <td><div id="tps" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
	</tr>
    <tr class="info">
        <th><center>Bytes_received(每秒数据库接收流量)</center></th>
        <th><center>Bytes_sent(每秒数据库发送流量)</center></th>
	</tr>
    <tr style="font-size: 12px;" class="">
       <td><div id="Bytes_received" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
       <td><div id="Bytes_sent" style="margin-top:5px; margin-left:0px; width:500px; height:280px;"></div></td>
	</tr>     
</table>
</div>


<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="./js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.cursor.min.js"></script>
<link href="./js/jqplot/jquery.jqplot.min.css"  rel="stylesheet">



<script>

$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status)) { foreach($reslut_status as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['active']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('active', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
        },
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status)) { foreach($reslut_status as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['connections']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('connections', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
            
        },
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false,lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});





$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status_ext)) { foreach($reslut_status_ext as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['qps']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('qps', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
            
        },
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false,lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});

$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status_ext)) { foreach($reslut_status_ext as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['tps']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('tps', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
            
        },
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false,lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status_ext)) { foreach($reslut_status_ext as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['Bytes_received']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('Bytes_received', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
            
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: 'KB' } 
        } 
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false,lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});

$(document).ready(function(){
  var data1=[
    <?php if(!empty($reslut_status_ext)) { foreach($reslut_status_ext as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['Bytes_sent']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('Bytes_sent', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'10px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:'%H:%M'},
            tickInterval:'300 second',
            label: "Time",
            
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: 'KB' } 
        } 
    },
    highlighter: {
            show: true, 
            showLabel: true, 
            tooltipAxes: '',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
    },
    cursor:{
            show: true, 
            zoom: true
    },
    series:[{showMarker:false,lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});

</script>



