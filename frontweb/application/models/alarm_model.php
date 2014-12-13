<?php 
class Alarm_model extends CI_Model{

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
    

    function get_total_record_paging($limit,$offset){
        $this->db->select('alarm.create_time,alarm.db_type,alarm.alarm_type,alarm.alarm_value,alarm.level,alarm.message,alarm.send_mail,alarm.send_mail_status,alarm.send_mail_time,servers.host,servers.port,application.display_name application');
        $this->db->from('alarm_history alarm');
        $this->db->join('servers', 'alarm.server_id=servers.id', 'left');
        $this->db->join('application', 'servers.application_id=application.id', 'left');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
	
    
}

/* End of file alarm_model.php */
/* Location: ./application/models/alarm_model.php */