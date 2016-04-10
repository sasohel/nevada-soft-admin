<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newmatch extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('login');
		$this->load->helper('URL');
		$this->load->model('league_mod');
		date_default_timezone_set("Asia/Dhaka");
	}
	
	public function index(){	
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'New match';
			$data['login_box_header'] = 'New match';
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 
			
			if($this->input->post('match-submit')){
				if(count($_POST)>0){
					/* echo '<pre>'; print_r($_POST); echo '</pre>';  */ 
					$f = $this->league_mod->add_new_match($_POST);
					if($f){
						redirect('matches/'.$_POST['league']);
					}
					
				}
			}
			
			$data['leagues'] = $this->league_mod->get_all_league();
			$data['teams'] = $this->league_mod->get_all_teams();
			$data['mstatus'] = $this->league_mod->get_match_statuses();
			
			
			$data['heading_title'] = 'Add New Match';
			$this->load->view('header',$data);
			
			$this->load->view('newmatch', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
}