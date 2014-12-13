<?php 
class Linux_model extends CI_Model{

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
    
    function get_linux_info($host,$time){
        $query=$this->db->query("select * from linux_resource_history where ip='$host' and DATE_FORMAT(create_time,'%Y-%m-%d %H:%i')='$time' limit 1; ");
        if ($query->num_rows() > 0)
        {
           return $query->row_array(); 
        }
    }


}

/* End of file mysql_model.php */
/* Location: ./application/models/mysql_model.php */