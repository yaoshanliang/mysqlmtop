
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL性能状态统计图表<small></small></h2>
</div>


<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default <?php if($begin_time=='60') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/60/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;1小时</a>
                  <a class="btn btn-default <?php if($begin_time=='360') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/360/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;6小时</a>
                  <a class="btn btn-default <?php if($begin_time=='720') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/720/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;12小时</a>
                  <a class="btn btn-default <?php if($begin_time=='1440') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/1440/day') ?>"><i class="fui-calendar-16"></i>&nbsp;1天</a>
                  <a class="btn btn-default <?php if($begin_time=='4320') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/4320/day') ?>"><i class="fui-calendar-16"></i>&nbsp;3天</a>
                  <a class="btn btn-default <?php if($begin_time=='10080') echo 'active'; ?>" href="<?php echo site_url('chart/status/'.$cur_server_id.'/10080/day') ?>"><i class="fui-calendar-16"></i>&nbsp;1周</a>
                </div>
</div> <!-- /toolbar -->  
            
<hr/>

<div id="active" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>
<div id="connections" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>
<div id="QPS" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>
<div id="TPS" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>
<div id="Bytes_received" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>
<div id="Bytes_sent" style="margin-top:5px; margin-left:0px; width:1200px; height:320px;"></div>


<script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="./js/jqplot/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="./js/jqplot/plugins/jqplot.cursor.min.js"></script>
<link href="./js/jqplot/jquery.jqplot.min.css"  rel="stylesheet">

<?php //print_r($chart_reslut);?>

<script>

$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
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
         text:"活动进程图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
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
         text:"总连接数图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['QPS']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('QPS', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"QPS图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['TPS']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('TPS', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"TPS图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
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
         text:"接收流量图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


$(document).ready(function(){
  var data1=[
    <?php if(!empty($chart_reslut)) { foreach($chart_reslut as $item){ ?>
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
         text:"发送流量图表 当前主机:<?php echo $cur_server; ?>",
         show:true,
         fontSize:'13px',
         textColor:'#666',
    },
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            tickOptions:{formatString:"<?php echo $chart_option['formatString']; ?>"},
            tickInterval:"",
            label: "",
        },
        yaxis: {  
                renderer: $.jqplot.LogAxisRenderer,
                tickOptions:{ suffix: '' } 
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
    series:[{showMarker:false, lineWidth:2, markerOptions:{style:'filledCircle'}}]
  });
});


</script>



