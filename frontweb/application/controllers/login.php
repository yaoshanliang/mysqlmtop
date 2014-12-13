<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Login extends CI_Controller  {
    function __construct(){
	    parent::__construct();
        $this->load->model("user_model","user");
        $this->load->library('form_validation');
        
	}
    
    
    /*
	 * 用户登录
	 */
	public function index(){
		//检查是否已经登录，如果已登录直接跳转首页
		if( ($this->session->userdata('logged_in') == 1) ){
			redirect(base_url());
		}
		
		/*
		 * 提交登录后处理
		*/
		$data['error_code']=0;
		//判断是否是登录提交
		if(isset($_POST['login']) && $_POST['login']=='doing'){
			$this->form_validation->set_rules('username',  'lang:username', 'trim|required');
			$this->form_validation->set_rules('password',  'lang:password', 'trim|required|min_length[5]|max_length[18]');
	
			if ($this->form_validation->run() == FALSE)
			{
				$data['error_code']='validation_error';
			}
			else
			{
				
					$user_data=$this->user->check_user();
					if(!$user_data){
						$data['error_code']='user_check_fail';
					}
					else{
						$data['error_code']=0;
						//更新登录信息
						$uid=$user_data['id'];
						$this->user->update_login($uid);
						//记录session
						$newdata = array(
								'uid'=>$user_data['id'],
                                'username'=>$user_data['username'],
								'login_count'     => $user_data['login_count'],
								'last_login_ip'     => $user_data['last_login_ip'],
								'last_login_time'     => $user_data['last_login_time'],
								'logged_in' => TRUE
						);
						$this->session->set_userdata($newdata);
						//登录成功,跳转至登录前页面
						redirect($this->input->post('return_url'));
					}	
				
			}
		}
		
		/*
		 * 页面展示和输出部分
		*/
		
		$data['cur_nav']='user';
		$data['site_title']='用户登录';
	 	$data['return_url'] = isset($_GET['return_url']) ? $_GET['return_url'] : base_url();	 //登录后返回url
		$this->layout->view('login',$data);
		
	}
    
   	public function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */