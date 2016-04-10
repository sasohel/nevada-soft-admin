<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topscorer extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('login');
		$this->load->helper('URL');
		$this->load->model('league_mod');
	}
	
	public function index($lid){	
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Player Ranking';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 			
			$data['heading_title'] = 'Player Ranking for '.$this->league_mod->get_league_name_by_id($lid);
			
			$data['scorers'] = $this->league_mod->get_top_scorer($lid);
			$data['lid'] = $lid;
			
			$this->load->view('header',$data);
			$this->load->view('topscorers', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
	public function operation($lid,$action,$scr_id=''){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Player Ranking';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 
			$data['heading_title'] = 'Player Ranking for '.$this->league_mod->get_league_name_by_id($lid);
			$data['leagues'] = $this->league_mod->get_all_league();
			$data['teams'] = $this->league_mod->get_all_teams_by_league($lid);
			$data['lid'] = $lid;
			
			$this->load->view('header',$data);
			
			if($action=='add'){
				if($this->input->post('add_new_scorer')){
					if(count($_POST)>0){
						$f = $this->league_mod->add_new_scorer($_POST);
						if($f){
							redirect('topscorer/'.$lid);
						}
					}
				}
				$this->load->view('add_topscorer', $data);
			}
			
			if($action=='edit'){
				$data['scr_info'] = $this->league_mod->get_scorer_info($scr_id);
				if($this->input->post('edit_scorer')){
					if(count($_POST)>0){
						$f = $this->league_mod->edit_scorer($_POST);
						if($f){
							redirect('topscorer/'.$lid);
						}
					}
				}
				$this->load->view('edit_topscorer', $data);	
			}
			
			if($action=='delete'){
				if(is_numeric($scr_id) && $scr_id > 0){
					$f = $this->league_mod->delete_scorer($scr_id);
					if($f){
						redirect('topscorer/'.$lid);
					}
				}
			}
			
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
}