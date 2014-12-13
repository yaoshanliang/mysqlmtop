<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Option extends Front_Controller {
    function __construct(){
		parent::__construct();
        if($this->session->userdata('username')!='admin') {
            redirect(site_url());  
        }
        $this->load->model("option_model","option");
		$this->load->library('form_validation');
	
	}
    
    /**
     * 首页
     */
    public function index(){
        $data['success_code']=0;
        $save=$this->uri->segment(3);
        if($save){
            $data['success_code']=1;
        }
        $option=$this->option->get_option();
        $data['option']=$option;
        $data["cur_nav"]="option_index";
        $this->layout->view("option/index",$data);
    }
    
     /**
     * 保存选项
     */
    public function save(){
        if(isset($_POST['submit']) && $_POST['submit']=='save')
        {
	        $post=$_POST;
            foreach($post as $key=>$val){
                $data['value']=$val;
                $this->option->update($data,$key);
            }
 
            redirect(site_url('option/index/save'));
            
        }
        
    }
    
}

/* End of file option.php */
/* Location: ./application/controllers/option.php */