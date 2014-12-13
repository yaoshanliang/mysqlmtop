
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL状态图表分析<small></small></h2>
</div>

<div class="ui-state-default ui-corner-all" style="height: 45px;" >
<p><span class="ui-icon ui-icon-search" style="float: left; margin-right: .3em;"></span>
<form name="form" class="form-inline" method="get" action="<?php echo  site_url('chart/detail') ?>" >

  <select name="server_id" class="input-medium" style="" >
  <option value="">所有主机</option>
  <?php foreach ($server as $item):?>
  <option value="<?php echo $item['id'];?>" <?php if($server_id==$item['id']) echo "selected"; ?> ><?php echo $item['host'];?>:<?php echo $item['port'];?></option>
   <?php endforeach;?>
  </select>

  <select name="time" class="input-small" style="width: 120px;">
  <option value="">时间范围</option>
  <option value="3600"  <?php if($time=='3600') echo "selected"; ?> >1小时</option>
  <option value="10800" <?php if($time=='10800') echo "selected"; ?>>3小时</option>
  <option value="21600" <?php if($time=='21600') echo "selected"; ?>>6小时</option>
  <option value="43200" <?php if($time=='43200') echo "selected"; ?>>12小时</option>
  <option value="86400" <?php if($time=='86400') echo "selected"; ?>>1天</option>
  <option value="172800" <?php if($time=='172800') echo "selected"; ?>>2天</option>
  <option value="259200" <?php if($time=='259200') echo "selected"; ?>>3天</option>
  <option value="864800" <?php if($time=='864800') echo "selected"; ?>>1周</option>
  </select>
  
  <button type="submit" class="btn btn-success">检索</button>
  </form>
</div>

<p></p>
<div id="chart2" style="height:300px; width:500px;"></div>


  <script src="./bootstrap/js/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="./js/jqplot/jquery.jqplot.min.js"></script>
  <script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
  <script type="text/javascript" src="./js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
  <script type="text/javascript" src="./js/jqplot/jqplot.dateAxisRenderer.min.js"></script>
  <link href="./js/jqplot/jquery.jqplot.min.css"  rel="stylesheet">
  
<script>

$(document).ready(function(){
  var line1=[['2008-06-30 8:00AM',4], ['2008-7-14 8:00AM',6.5], ['2008-7-28 8:00AM',5.7], ['2008-8-11 8:00AM',9], ['2008-8-25 8:00AM',8.2]];
  var plot2 = $.jqplot('chart2', [line1], {
      title:'Customized Date Axis', 
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer, 
          tickOptions:{formatString:'%b %#d, %#I %p'},
          min:'June 16, 2008 8:00AM', 
          tickInterval:'2 weeks'
        }
      },
      series:[{lineWidth:4, markerOptions:{style:'square'}}]
  });
});

/*
$(document).ready(function(){
  var plot2 = $.jqplot ('chart2', [[3,7,9,1,5,3,8,2,5]], {
      // Give the plot a title.
      title: 'Active connections',
      // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
      axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
      // Likewise, seriesDefaults specifies default options for all
      // series in a plot.  Options specified in seriesDefaults or
      // axesDefaults can be overridden by individual series or
      // axes options.
      // Here we turn on smoothing for the line.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "Time",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Number"
        }
      }
    });
});
*/

</script>




