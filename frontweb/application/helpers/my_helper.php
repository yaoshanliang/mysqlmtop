<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function substring($str, $start, $len) {
     $tmpstr = "";
     $strlen = $start + $len;
     for($i = 0; $i < $strlen; $i++) {
         if(ord(substr($str, $i, 1)) > 0xa0) {
             $tmpstr .= substr($str, $i, 2);
             $i++;
         } else
             $tmpstr .= substr($str, $i, 1);
     }
     return $tmpstr;
} 

function get_replication_tree($array,$host='---',$port='---',$level=0){
    $repeat='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	$str_repeat = '';
    if($level) {
		for($j = 0; $j < $level; $j ++) {
			$str_repeat .= $repeat;
		}
	}
    if($level==0){
        $icon="<i class='icon-list'></i>";
    }
    else{
        $icon="<i class='icon-refresh'></i>";
    }
    $str_repeat = $str_repeat.$icon;
	$newarray = array ();
	$temparray = array ();

    foreach ( ( array ) $array as $v ) {
        if($v['master_server']==$host and $v['master_port']==$port)
        {
            $host_v=$v['host'];
            $port_v=$v['port'];
            $v['host']=$str_repeat.$v['host'];
            $v['level']=$level;
            $newarray[] = $v;
            $temparray = get_replication_tree($array,$host_v,$port_v,$level+1);
   
            if ($temparray) {
				$newarray = array_merge ( $newarray, $temparray );
			}
        }
    }
    return $newarray;
}

function check_role($master,$slave){
    if($master == 1 && $slave==0){
        $data="master";
    }
    else if($master == 1 && $slave ==1){
        $data="master/slave";
    }
    else{
        $data="slave";
    }
    //$data = '<strong>'.$data.'</strong>';
    return $data;
}

function check_status($data){
    if($data == 1){
        return "<span class='badge badge-info'>是</span>";
    }
    else if($data == 0){
        return "<span class='badge'>否</span>";
    }
    else{
        return $data;
    }
}

function check_on_off($data){
    if($data == 1){
        return "<span class='badge badge-info'>ON</span>";
    }
    else if($data == 0){
        return "<span class='badge'>OFF</span>";
    }
    else{
        return $data;
    }
}

function set_selected($data,$value){
    if($data == $value){
        return "selected";
    }
}
  
function check_value($data){
    if($data=='---' || $data == null ){
        return "---";
    }
    else if($data=='master'){
        return "<span class='label label-info'>Master</span>";
    }
    else if($data=='slave'){
        return "<span class='label label-warning'>Slave</span>";
    }
    else if($data=='alone'){
        return "<span class='label label-info'>Alone</span>";
    }
    else if($data=='Yes'){
        return "<span class='label label-success'>Run</span>";
    }
    else if($data=='No'){
        return "<span class='label label-important'>No</span>";
    }
    else if($data=='ON'){
        return "<span class='label label-info'>ON</span>";
    }
    else if($data=='OFF'){
        return "<span class='label '>OFF</span>";
    }
    else{
        return $data;
    }
    
}



function check_uptime($data){

    if($data ==0){
        return "---";
    }
    else if($data < 60){
        return $data." 秒";
    }
    else if($data>=60 and $data <3600){
        return number_format(($data/60))." 分钟";
    }
    else if($data>=3600 and $data <86400){
        return number_format(($data/3600))." 小时";
    }
    else if($data>=86400 and $data <86400*365){
       // $day = $data%86400
        $data=number_format(($data/86400),0)." 天";
        return $data;
    }
}

function check_connections($data){
    if($data > 1000){
        return "<span class='label label-warning'>".$data."</span>";
    }
    else{
        return $data;
    }
}

function check_active($data){
    if($data > 10){
        return "<span class='label label-warning'>".$data."</span>";
    }
    else{
        return $data;
    }
}

function check_10($data){
    if($data<10){
            $s='0'.$data;
        }
    else{
            $s=$data;
    }
    
    return $s;
    
}

function check_delay($data){
    
    $H='';
    $i='';
    $s='';
    if($data=='---' || $data == null ){
         $data= "---";
    }
    else if($data<60){
        $H='00';
        $i='00';
        $s=check_10($data);
        $data=$H.':'.$i.':'.$s;
        
    }
    else if($data>=60 and $data<3600){
        $H='00';
        $i=check_10(floor($data/60));
        $s=check_10($data%60);
        $data=$H.':'.$i.':'.$s;
        //return $data;exit;
    }
    else if($data>=3600 && $data<86400){
        $H=check_10(floor($data/3600));
        $i=check_10(floor($data%3600/60));
        $s=check_10($data%3600%60);
        $data=$H.':'.$i.':'.$s;
    }
    else{
        $data='1天以上'; 
    }
    
    if($data =="00:00:00"){
        return "<span class='label label-info'>".$data."</span>";
    }
    else if($data=='---' || $data == null ){
        return $data;   
    }
    else{
        return "<span class='label label-important'>".$data."</span>";
    }  
    
}


function check_alarm_level($data){  
    if($data =="warning"){
        return "<span class='label label-warning'>警告</span>";
    }
    else if($data =="error"){
        return "<span class='label label-important'>紧急</span>";
    }
    else{
        return "<span class='label label-success'>".$data."</span>";
    }   
}

function check_send_mail_status($data){  
    if($data =="1"){
        return "<span class='label label-success'>成功</span>";
    }
    else{
        return "<span class='label'>失败</span>";
    }
    
}  

function check_hits($data){
    if($data){
        $result=$data*100;
        $result=$result."%";
    }
    return $result;
}

