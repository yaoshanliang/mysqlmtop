<?php 
class User_model extends CI_Model{


	protected $table='admin_user';
	
	/*
	 * 保存用户信息
	 */
	public function insert($data){		
		$this->db->insert($this->table, $data);
	}
	
	/*
	 * 更新用户信息
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
	
	/*
	 * 更新用户登录信息
	 */
	public function update_login($id){
		$data = array(
				'last_login_time'=>date('Y-m-d H:i:s'),
				'last_login_ip'=>$this->input->ip_address(),
		);
		$this->db->set('login_count', 'login_count+1',FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->table,$data);
	}
	
	/*
	 * 检查用户是否合法
	 */
	public function check_user(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->where('status',1);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	/*
	 * 检查当前用户的原密码是否正确
	*/
	public function check_old_password($uid,$password){
		$this->db->where('id', $uid);
		$this->db->where('password', md5($password));
		$this->db->where('status',1);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	/*
	 * 根据uid获取用户信息
	 */
	function get_user_by_id($id){
		$query = $this->db->get_where($this->table, array('id' =>$id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	/*
	 * 根据用户名查询用户
	*/
	function get_user_by_username($username=''){
		$query = $this->db->get_where($this->table, array('username' =>$username));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
    
	
	/*
	 * 通过用户名更新用户密码
	*/
	public function update_password_by_username($data,$username){
		$this->db->where('username', $username);
		$this->db->update($this->table, $data);
	}
    
	
    function get_total_user(){
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0)
		{
			$result['datalist']=$query->result_array();
            $result['datacount']=$query->num_rows();
            return $result;
		}
    }


}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */