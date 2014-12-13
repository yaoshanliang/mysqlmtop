<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Alarm extends Front_Controller {
    function __construct(){
		parent::__construct();
	    $this->load->model("alarm_model","alarm");
        $this->load->model("monitor_model","monitor");
        $this->load->model('application_model','app');
        $this->load->model('servers_model','server');
	}
    
    public function index(){
        
        !empty($_GET["application_id"]) && $this->db->where("application_id", $_GET["application_id"]);
        !empty($_GET["server_id"]) && $this->db->where("server_id", $_GET["server_id"]);
        !empty($_GET["level"]) && $this->db->where("level", $_GET["level"]);
        $stime = !empty($_GET["stime"])? $_GET["stime"]: date('Y-m-d H:i',time()-3600*24*30);
        $etime = !empty($_GET["etime"])? $_GET["etime"]: date('Y-m-d H:i',time());
        $this->db->where("create_time >=", $stime);
        $this->db->where("create_time <=", $etime);
        
        if(!empty($_GET["stime"])){
            $current_url= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        else{
            $current_url= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'?noparam=1';
        }
        
        //分页
		$this->load->library('pagination');
		$config['base_url'] = $current_url;
		$config['total_rows'] = $this->alarm->get_total_rows('alarm_history');
		$config['per_page'] = 50;
		$config['num_links'] = 5;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		$offset = !empty($_GET['per_page']) ? $_GET['per_page'] : 1;
        
        !empty($_GET["application_id"]) && $this->db->where("alarm.application_id", $_GET["application_id"]);
        !empty($_GET["server_id"]) && $this->db->where("alarm.server_id", $_GET["server_id"]);
        !empty($_GET["level"]) && $this->db->where("alarm.level", $_GET["level"]);
        $stime = !empty($_GET["stime"])? $_GET["stime"]: date('Y-m-d H:i',time()-3600*24*30);
        $etime = !empty($_GET["etime"])? $_GET["etime"]: date('Y-m-d H:i',time());
        $this->db->where("alarm.create_time >=", $stime);
        $this->db->where("alarm.create_time <=", $etime);
        $this->db->order_by("alarm.id", "desc");

		$data['datalist'] = $this->alarm->get_total_record_paging($config['per_page'],($offset-1)*$config['per_page']);
        
        $setval["application_id"]=isset($_GET["application_id"]) ? $_GET["application_id"] : "";
        $setval["server_id"]=isset($_GET["server_id"]) ? $_GET["server_id"] : "";
        $setval["level"]=isset($_GET["level"]) ? $_GET["level"] : "";
        $setval["stime"]=$stime;
        $setval["etime"]=$etime;
        $data["setval"]=$setval;
        
        $data["server"]=$this->server->get_total_record_usage();
        $data["application"]=$this->app->get_total_record_usage();
        
        $data["cur_nav"]="alarm_index";
        $this->layout->view("alarm/index",$data);
    }
    
}

/* End of file alarm.php */
/* Location: ./application/controllers/alarm.php */