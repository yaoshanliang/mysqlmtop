<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
abstract class Front_Controller extends CI_Controller
{
	
	
	/**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
	public function __construct()
	{
		parent::__construct();
        self::check_login();
              
	}
	
	/*
	 * 检查用户是否登录
	 */
	public function check_login(){
		if( ($this->session->userdata('logged_in') != 1) ){
			$return_url   =  current_url();
			redirect(site_url('/login').'?return_url='.$return_url);
		}
	}
	
		
}	