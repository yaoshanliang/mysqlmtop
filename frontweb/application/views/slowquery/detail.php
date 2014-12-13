<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="page-header">
  <h2>MySQL 慢查询分析平台<small> </small></h2>
</div>

  

<table class="table  table-bordered table-condensed" style="font-size: 12px;" >
    
    <tr>
        <th style="width: 120px;">checksum</th>
        <td colspan="2"><?php echo $record['checksum']; ?></td>
        <th>ts_cnt</th>	
        <td colspan="3"><?php echo $record['ts_cnt']; ?></td>
	</tr>
    <tr>
        <th>first_seen</th>
        <td colspan="2"><?php echo $record['first_seen']; ?></td>
        <th>last_seen</th>
        <td colspan="3"><?php echo $record['last_seen']; ?></td>
	</tr>
    <tr>
        <th>fingerprint</th>
        <td colspan="6"><?php echo $record['fingerprint']; ?></td>	
	</tr>
    <tr>
        <th>sample</th>
        <td colspan="6"><?php echo $record['sample']; ?></td>
	</tr>
    <tr>
        <th rowspan="2">Query Time</th>
        <th>Query_time_sum</th>
        <th>Query_time_min</th>
        <th>Query_time_max</th>
        <th>Query_time_pct_95</th>
        <th>Query_time_stddev</th>
        <th>Query_time_median</th>
	</tr>
    <tr>
        <td><?php echo $record['Query_time_sum']; ?></td>
        <td><?php echo $record['Query_time_min']; ?></td>
        <td><?php echo $record['Query_time_max']; ?></td>
        <td><?php echo $record['Query_time_pct_95']; ?></td>
        <td><?php echo $record['Query_time_stddev']; ?></td>
        <td><?php echo $record['Query_time_median']; ?></td>
	</tr>
    <tr>
        <th rowspan="2">Lock Time</th>
        <th>Lock_time_sum</th>
        <th>Lock_time_min</th>
        <th>Lock_time_max</th>
        <th>Lock_time_pct_95</th>
        <th>Lock_time_stddev</th>
        <th>Lock_time_median</th>
	</tr>
    <tr>
        <td><?php echo $record['Lock_time_sum']; ?></td>
        <td><?php echo $record['Lock_time_min']; ?></td>
        <td><?php echo $record['Lock_time_max']; ?></td>
        <td><?php echo $record['Lock_time_pct_95']; ?></td>
        <td><?php echo $record['Lock_time_stddev']; ?></td>
        <td><?php echo $record['Lock_time_median']; ?></td>
	</tr>
    <tr>
        <th rowspan="2">Rows Sent</th>
        <th>Rows_sent_sum</th>
        <th>Rows_sent_min</th>
        <th>Rows_sent_max</th>
        <th>Rows_sent_pct_95</th>
        <th>Rows_sent_stddev</th>
        <th>Rows_sent_median</th>
	</tr>
    <tr>
        <td><?php echo $record['Rows_sent_sum']; ?></td>
        <td><?php echo $record['Rows_sent_min']; ?></td>
        <td><?php echo $record['Rows_sent_max']; ?></td>
        <td><?php echo $record['Rows_sent_pct_95']; ?></td>
        <td><?php echo $record['Rows_sent_stddev']; ?></td>
        <td><?php echo $record['Rows_sent_median']; ?></td>
	</tr>
    <tr>
        <th rowspan="2">Rows Examined</th>
        <th>Rows_examined_sum</th>
        <th>Rows_examined_min</th>
        <th>Rows_examined_max</th>
        <th>Rows_examined_pct_95</th>
        <th>Rows_examined_stddev</th>
        <th>Rows_examined_median</th>
	</tr>
    <tr>
        <td><?php echo $record['Rows_examined_sum']; ?></td>
        <td><?php echo $record['Rows_examined_min']; ?></td>
        <td><?php echo $record['Rows_examined_max']; ?></td>
        <td><?php echo $record['Rows_examined_pct_95']; ?></td>
        <td><?php echo $record['Rows_examined_stddev']; ?></td>
        <td><?php echo $record['Rows_examined_median']; ?></td>
	</tr>
	 
</table>

