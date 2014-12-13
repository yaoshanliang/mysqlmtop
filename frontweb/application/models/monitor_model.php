<?php 
class Monitor_model extends CI_Model{

    

	function insert($table,$data){		
		$this->db->insert($table, $data);
	}   

	function get_total_rows($table){
		$this->db->from($table);
		return $this->db->count_all_results();
	}
    
    function get_total_record($table){
        $query = $this->db->get($table);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
    
    function get_total_record_paging($table,$limit,$offset){
        $query = $this->db->get($table,$limit,$offset);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
    
    function get_total_record_sql($sql){
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
		{
			$result['datalist']=$query->result_array();
            $result['datacount']=$query->num_rows();
            return $result;
		}
    }
	
    function get_total_record_status(){
        
        $this->db->select('status.*,ext.QPS,ext.TPS,ext.Bytes_received,ext.Bytes_sent,servers.host,servers.port,application.display_name application');
        $this->db->from('mysql_status status');
        $this->db->join('mysql_status_ext ext', 'status.server_id=ext.server_id', 'left');
        $this->db->join('servers', 'status.server_id=servers.id', 'left');
        $this->db->join('application', 'servers.application_id=application.id', 'left');
        
        !empty($_GET["application_id"]) && $this->db->where("status.application_id", $_GET["application_id"]);
        !empty($_GET["server_id"]) && $this->db->where("status.server_id", $_GET["server_id"]);
        !empty($_GET["connect"]) && $this->db->where("connect", $_GET["connect"]);
        !empty($_GET["connections"]) && $this->db->where("connections >", (int)$_GET["connections"]);
        !empty($_GET["active"]) && $this->db->where("active >", (int)$_GET["active"]);
        if(!empty($_GET["order"]) && !empty($_GET["order_type"])){
            $this->db->order_by($_GET["order"],$_GET["order_type"]);
        }
        else{
            $this->db->order_by('application_id asc');
        }
        
        $query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
    }
    
    function get_total_record_process(){
        
        $this->db->select('process.*,servers.host,servers.port,application.display_name application');
        $this->db->from('mysql_process process');
        $this->db->join('servers', 'process.server_id=servers.id', 'left');
        $this->db->join('application', 'servers.application_id=application.id', 'left');
        
        !empty($_GET["application_id"]) && $this->db->where("process.application_id", $_GET["application_id"]);
        !empty($_GET["server_id"]) && $this->db->where("process.server_id", $_GET["server_id"]);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
    }
    
    function get_total_record_replication(){
        
        $this->db->select('repl.*,servers.host,servers.port,application.display_name application');
        $this->db->from('mysql_replication repl');
        $this->db->join('servers', 'repl.server_id=servers.id', 'left');
        $this->db->join('application', 'servers.application_id=application.id', 'left');
        
        !empty($_GET["application_id"]) && $this->db->where("repl.application_id", $_GET["application_id"]);
        !empty($_GET["server_id"]) && $this->db->where("repl.server_id", $_GET["server_id"]);
        if(!empty($_GET["role"]) ){
            $this->db->where($_GET["role"], 1);
        }
        !empty($_GET["delay"]) && $this->db->where("delay >", (int)$_GET["delay"]);
        if(!empty($_GET["order"]) && !empty($_GET["order_type"])){
            $this->db->order_by($_GET["order"],$_GET["order_type"]);
        }
        
        $query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
    }
    
    function get_total_host(){
        $query=$this->db->query("select host  from mysql_status order by host;");
        if ($query->num_rows() > 0)
        {
           return $query->result_array(); 
        }
    }
    
    function get_total_application(){
        $query=$this->db->query("select application from mysql_status group by application order by application;");
        if ($query->num_rows() > 0)
        {
           return $query->result_array(); 
        }
    }

	function get_data_by_id($id){
		$query = $this->db->get_where($this->table, array('id' =>$id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	function update_view_count($id){
		$this->db->set('view_count', 'view_count+1',FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table);
	}

}

/* End of file mysql_model.php */
/* Location: ./application/models/mysql_model.php */