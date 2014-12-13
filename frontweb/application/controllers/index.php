<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Index extends Front_Controller {
    function __construct(){
		parent::__construct();
	
	}
    
    public function index(){
        
        $mysql_statistics = array();
        $mysql_statistics["all_mysql_server"] = $this->db->query("select count(distinct(host)) as num from servers")->row()->num;
        $mysql_statistics["all_mysql_instance"] = $this->db->query("select count(*) as num from servers")->row()->num;
        $mysql_statistics["normal_mysql_instance"] = $this->db->query("select count(*) as num from mysql_status where connect='success'")->row()->num;
        $mysql_statistics["exception_mysql_instance"] = $this->db->query("select count(*) as num from mysql_status  where connect!='success'")->row()->num;
        $mysql_statistics["master_mysql_instance"] = $this->db->query("select count(*) as num from mysql_replication where is_master='1'")->row()->num;
        $mysql_statistics["slave_mysql_instance"] = $this->db->query("select count(*) as num from mysql_replication where is_slave='1'")->row()->num;
        
        $mysql_statistics["mysql_connections_100"] = $this->db->query("select count(*) as num from mysql_status where connections > 100 ")->row()->num;
        $mysql_statistics["mysql_connections_300"] = $this->db->query("select count(*) as num from mysql_status where connections > 300 ")->row()->num;
        $mysql_statistics["mysql_connections_500"] = $this->db->query("select count(*) as num from mysql_status where connections > 500 ")->row()->num;
        $mysql_statistics["mysql_connections_1000"] = $this->db->query("select count(*) as num from mysql_status where connections > 1000 ")->row()->num;
        $mysql_statistics["mysql_connections_2000"] = $this->db->query("select count(*) as num from mysql_status where connections > 2000 ")->row()->num;
        $mysql_statistics["mysql_connections_3000"] = $this->db->query("select count(*) as num from mysql_status where connections > 3000 ")->row()->num;
        
        $mysql_statistics["mysql_active_5"] = $this->db->query("select count(*) as num from mysql_status where active > 5 ")->row()->num;
        $mysql_statistics["mysql_active_10"] = $this->db->query("select count(*) as num from mysql_status where active > 10 ")->row()->num;
        $mysql_statistics["mysql_active_20"] = $this->db->query("select count(*) as num from mysql_status where active > 20 ")->row()->num;
        $mysql_statistics["mysql_active_30"] = $this->db->query("select count(*) as num from mysql_status where active > 30 ")->row()->num;
        $mysql_statistics["mysql_active_50"] = $this->db->query("select count(*) as num from mysql_status where active > 50 ")->row()->num;
        $mysql_statistics["mysql_active_100"] = $this->db->query("select count(*) as num from mysql_status where active > 100 ")->row()->num;
        
        $mysql_statistics["mysql_qps_50"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 50 ")->row()->num;
        $mysql_statistics["mysql_qps_100"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 100 ")->row()->num;
        $mysql_statistics["mysql_qps_500"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 500 ")->row()->num;
        $mysql_statistics["mysql_qps_2000"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 2000 ")->row()->num;
        $mysql_statistics["mysql_qps_3000"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 3000 ")->row()->num;
        $mysql_statistics["mysql_qps_5000"] = $this->db->query("select count(*) as num from mysql_status_ext where QPS > 5000 ")->row()->num;
        
        $mysql_statistics["mysql_tps_50"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 50 ")->row()->num;
        $mysql_statistics["mysql_tps_100"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 100 ")->row()->num;
        $mysql_statistics["mysql_tps_500"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 500 ")->row()->num;
        $mysql_statistics["mysql_tps_2000"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 2000 ")->row()->num;
        $mysql_statistics["mysql_tps_3000"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 3000 ")->row()->num;
        $mysql_statistics["mysql_tps_5000"] = $this->db->query("select count(*) as num from mysql_status_ext where TPS > 5000 ")->row()->num;
        
        $mysql_statistics["normal_mysql_replication"] = $this->db->query("select count(*) as num from mysql_replication where is_slave=1 and (slave_io_run='Yes' and slave_sql_run='Yes') ")->row()->num;
        $mysql_statistics["exception_mysql_replication"] = $this->db->query("select count(*) as num from mysql_replication where is_slave=1 and  (slave_io_run!='Yes' or slave_sql_run!='Yes') ")->row()->num;
        $mysql_statistics["mysql_delay_30"] = $this->db->query("select count(*) as num from mysql_replication where delay > 30 ")->row()->num;
        $mysql_statistics["mysql_delay_60"] = $this->db->query("select count(*) as num from mysql_replication where delay > 60 ")->row()->num;
        $mysql_statistics["mysql_delay_600"] = $this->db->query("select count(*) as num from mysql_replication where delay > 600 ")->row()->num;
        $mysql_statistics["mysql_delay_1800"] = $this->db->query("select count(*) as num from mysql_replication where delay > 1800 ")->row()->num;
        $mysql_statistics["mysql_delay_3600"] = $this->db->query("select count(*) as num from mysql_replication where delay > 3600 ")->row()->num;
        $mysql_statistics["mysql_delay_86400"] = $this->db->query("select count(*) as num from mysql_replication where delay > 86400 ")->row()->num;
        
        
        $data["mysql_statistics"] = $mysql_statistics;
        $data["mysql_versions"] = $this->db->query("select SUBSTRING_INDEX(version,'-',1) as versions, count(*) as num from mysql_status where version !='---' GROUP BY versions")->result_array();
        $data['last_alarm'] = $this->db->query("select alarm.*,servers.host,servers.port from alarm_history alarm left join servers  on alarm.server_id=servers.id  order by alarm.id desc limit 7 ")->result_array();
        $data["cur_nav"]="index_index";
        $this->layout->view("index/index",$data);
    }
    
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */