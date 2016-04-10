<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class League extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('login');
		$this->load->helper('URL');
		$this->load->model('login_mod');
	}
	
	public function index(){	
			
		$data['ccss'] = $this->config->config['ccss'];
		$data['cjs'] = $this->config->config['cjs'];
		
		$data['title'] = $this->lang->line('login_title');
		$data['login_box_header'] = $this->lang->line('login_box_header');
		
		$data['base_url'] = $this->config->config['base_url'];
		
		
		$data['dclass'] = 'login'; 
		$logged = FALSE; 
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){			
			$logged = TRUE; 
			$data['dclass'] = 'league'; 
		}
		else{
			/* 			
			if(isset($_COOKIE['logged_user']) && $_COOKIE['logged_user']!=''){
				redirect('admin');
			} */
			
			
			if(($this->input->server('REQUEST_METHOD')==='POST') && ($this->input->post('username')) && ($this->input->post('password'))){
				
				$f = $this->login_mod->login_user($this->input->post());				
				/* echo '<pre>'; print_r($f); echo '</pre>';   */
				
				if(count($f)>0 && !empty($f[0]->username) && is_numeric($f[0]->id)){				
					$this->session->set_userdata(array('uid'=>$f[0]->id,'rid'=>$f[0]->type));				
					
					if($this->input->post('remember')=='on'){
						setcookie("logged_user",'userid_'.$f[0]->id, time()+3600*24*30);
					}
					$logged = TRUE;
					$data['dclass'] = 'league'; 
				}				
				else{
					$data['error']['login_error'] = 'Login information invalid';
				}
			}	
		}
		if($logged){
			$data['title'] = 'Leagues';			
			$data['login_box_header'] = $this->lang->line('login_box_header');
		}
		else{
			$data['title'] = $this->lang->line('login_title');
			$data['login_box_header'] = $this->lang->line('login_box_header');
		}
		$this->load->view('header',$data);
		if($logged){
			
			$data['leagues'] = $this->login_mod->get_leagues();
			$this->load->view('leagues', $data);
		}
		else{			
			$this->load->view('login', $data);
		}
		$this->load->view('footer'); 
	}
	
	public function fuck(){
		echo 'fuck'; 
	}
	
}