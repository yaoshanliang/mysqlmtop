<?php 
class Slowquery_model extends CI_Model{



	function get_total_rows($server_id){
	    if($server_id && $server_id!=0){
            $ext = '_'.$server_id;
        }
        else{
            $ext='';
        }
        
		$this->db->select('s.*,sh.*');
        $this->db->from("mysql_slow_query_review$ext s");
        $this->db->join("mysql_slow_query_review_history$ext sh", 's.checksum=sh.checksum','left');
		return $this->db->count_all_results();
	}
    
 
	
    function get_total_record_slowquery($limit,$offset,$server_id){
        if($server_id && $server_id!=0){
            $ext = '_'.$server_id;
        }
        else{
            $ext='';
        }
        
        $this->db->select('s.*,sh.*');
        $this->db->from("mysql_slow_query_review$ext s");
        $this->db->join("mysql_slow_query_review_history$ext sh", 's.checksum=sh.checksum','left');
        
        $this->db->limit($limit,$offset);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
    }
    
   

	function get_record_by_checksum($server_id,$checksum){
	    if($server_id && $server_id!=0){
            $ext = '_'.$server_id;
        }
        else{
            $ext='';
        }
	    $this->db->select('s.*,sh.*');
        $this->db->from("mysql_slow_query_review$ext s");
        $this->db->join("mysql_slow_query_review_history$ext sh", 's.checksum=sh.checksum');
		$this->db->where('s.checksum',$checksum);
        $query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
    
    function get_analyze_day($server_id){
        if($server_id && $server_id!=0){
            $ext = '_'.$server_id;
        }
        else{
            $ext='';
        }
        $query=$this->db->query("select * from (select DATE_FORMAT(last_seen,'%Y-%m-%d') as days,count(*) as count from mysql_slow_query_review$ext  group by days order by days desc limit 10) as total order by days asc ;");
        if ($query->num_rows() > 0)
        {
           return $query->result_array(); 
        }
    }
	


}

/* End of file slowquery_model.php */
/* Location: ./application/models/slowquery_model.php */