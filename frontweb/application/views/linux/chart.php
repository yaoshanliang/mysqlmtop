<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>Linux 资源性能图表<small> &nbsp;&nbsp;当前主机：<?php echo $cur_host; ?> </small></h2>
</div>
  
<div id="cpuload1" style="margin-top:5px; margin-left:0px; width:1200px; height:350px;"></div>
<div id="cpuload5" style="margin-top:5px; margin-left:0px; width:1200px; height:350px;"></div>
<div id="cpuload15" style="margin-top:5px; margin-left:0px; width:1200px; height:350px;"></div>

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
    <?php if(!empty($reslut_linux)) { foreach($reslut_linux as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['load1']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  
  var plot1 = $.jqplot('cpuload1', [data1], {

    seriesDefaults: {
          rendererOptions: {
              smooth: true,
              showDataLabels: true
          },
    },
    title:{
         text:"主机<?php echo $cur_host; ?> 平均负载(1分钟)",
         show:true,
         fontSize:'14px',
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
    <?php if(!empty($reslut_linux)) { foreach($reslut_linux as $item){ ?>
    ["<?php echo $item['time']?>", <?php echo $item['load5']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  
  var plot1 = $.jqplot('cpuload5', [data1], {

    seriesDefaults: {
          rendererOptions: {
              smooth: true,
              showDataLabels: true
          },
    },
    title:{
         text:"主机<?php echo $cur_host; ?> 平均负载(5分钟)",
         show:true,
         fontSize:'14px',
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




</script>
