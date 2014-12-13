<?php 
class Application_model extends CI_Model{

    protected $table='application';
    
	function get_total_rows(){
		$this->db->from($this->table);
        return $this->db->count_all_results();
	}
    
    function get_total_record(){
        $this->db->order_by('name','asc');
        $query = $this->db->get($this->table);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
    
    function get_total_record_paging($limit,$offset){
        $query = $this->db->get($this->table,$limit,$offset);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
    
    function get_total_record_usage(){
        $this->db->order_by('name','asc');
        $this->db->where('is_delete',0);
        $query = $this->db->get($this->table);
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}
    
   	/*
	 * 根据id获取单条记录
	 */
	function get_record_by_id($id){
		$query = $this->db->get_where($this->table, array('id' =>$id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
    
    /*
    * 插入数据
    */
   	public function insert($data){		
		$this->db->insert($this->table, $data);
	}
    
    /*
	 * 更新信息
	*/
	public function update($data,$id){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
    
    /*
	 * 删除信息
	*/
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	
    
}

/* End of file application_model.php */
/* Location: ./application/models/application_model.php */