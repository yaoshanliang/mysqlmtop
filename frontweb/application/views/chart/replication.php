
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL复制延时统计图表<small></small></h2>
</div>


<div class="btn-toolbar">
                <div class="btn-group">
                  <a class="btn btn-default <?php if($begin_time=='60') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/60/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;1小时</a>
                  <a class="btn btn-default <?php if($begin_time=='360') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/360/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;6小时</a>
                  <a class="btn btn-default <?php if($begin_time=='720') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/720/hour') ?>"><i class="fui-calendar-16"></i>&nbsp;12小时</a>
                  <a class="btn btn-default <?php if($begin_time=='1440') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/1440/day') ?>"><i class="fui-calendar-16"></i>&nbsp;1天</a>
                  <a class="btn btn-default <?php if($begin_time=='4320') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/4320/day') ?>"><i class="fui-calendar-16"></i>&nbsp;3天</a>
                  <a class="btn btn-default <?php if($begin_time=='10080') echo 'active'; ?>" href="<?php echo site_url('chart/replication/'.$cur_server_id.'/10080/day') ?>"><i class="fui-calendar-16"></i>&nbsp;1周</a>
                </div>
</div> <!-- /toolbar -->  
            
<hr/>

<div id="delay" style="margin-top:5px; margin-left:0px; width:1250px; height:380px;"></div>



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
    ["<?php echo $item['time']?>", <?php echo $item['delay']?> ],
    <?php }}else{ ?>
    []    
    <?php } ?>
  ];
  var plot1 = $.jqplot('delay', [data1], {
    seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
    },
    title:{
         text:"复制延时图表 当前主机:<?php echo $cur_server; ?>",
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
                tickOptions:{ suffix: ' 秒' } 
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



