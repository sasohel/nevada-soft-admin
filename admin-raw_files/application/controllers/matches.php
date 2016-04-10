<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('login');
		$this->load->helper('URL');
		$this->load->model('league_mod');
		$this->load->helper('date');
		date_default_timezone_set("Asia/Dhaka");
	}
	
	public function index($lid='',$action='', $id=''){	
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Matches';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 
			$data['timediff'] = $this->league_mod->get_league_lcl_time_diff($lid);
			
			if($this->input->post('match-submit')){
				if(count($_POST)>0){
					$f = $this->league_mod->update_match($_POST);
					if($f){
						redirect('matches/'.$lid);
					}
				}
			}
			if(isset($action) && $action=='edit' && is_numeric($id) && $id > 0){
				$data['action'] = 'edit';
				$data['mdata'] = $this->league_mod->get_match_info($id);
				$data['mstatus'] = $this->league_mod->get_match_statuses();
				$data['leagues'] = $this->league_mod->get_all_league();
				$data['teams'] = $this->league_mod->get_all_teams_by_league($lid);
				$data['tweek'] = $this->league_mod->get_total_week($lid);
			}
			
			if(isset($action) && $action=='delete' && is_numeric($id) && $id > 0){
				$f = $this->league_mod->delete_match($id);
				if($f){
					redirect('matches/'.$lid);
				}
			}
						
			if(isset($lid) && is_numeric($lid)){
				$data['cmatches'] = $this->league_mod->get_league_matches($lid, TRUE);				
				$data['smatches'] = $this->league_mod->get_league_matches($lid, FALSE);				
				$data['league'] = $this->league_mod->get_league_name_by_id($lid);				
				$data['lid'] = $lid;				
			}
			
			
			$this->load->view('header',$data);			
			$this->load->view('matches', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}		
	}
	
}