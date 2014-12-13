<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Linux extends Front_Controller {

    function __construct(){
		parent::__construct();
		$this->load->model("linux_model","linux");
        
	}
    
    
    public function index()
	{

        $data["datalist"]=$this->linux->get_total_record('linux_resource');
        $data["cur_nav"]="linux";
        $this->layout->view("linux/index",$data);
	}
    
    public function chart(){
        
        $host = $this->uri->segment(3);
        $host=!empty($host) ? $host : "";
        
        //图表
        $reslut_linux=array();
        for($i=120;$i>=0;$i--){
            $timestamp=time()-60*$i;
            $time= date('Y-m-d H:i',$timestamp);
            $reslut_linux[$i]['time']=date('H:i',$timestamp);
            $dbdata=$this->linux->get_linux_info($host,$time);
            $reslut_linux[$i]['load1'] = $dbdata['load1'];
            $reslut_linux[$i]['load5'] = $dbdata['load5'];
            $reslut_linux[$i]['load15'] = $dbdata['load15'];
            
        }
 
        $data['reslut_linux']=$reslut_linux;
        
        $data['cur_nav']='linux';
        $data['cur_host']=$host;
        $this->layout->view('linux/chart',$data);
    }
    
    
    
}

/* End of file linux.php */
/* Location: ./application/controllers/linux.php */