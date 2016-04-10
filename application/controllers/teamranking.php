<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teamranking extends CI_Controller {
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
			
			$data['title'] = 'Team Ranking';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 			
			$data['lid'] = $lid;
			$data['ranking_teams'] = $this->league_mod->get_team_ranking($lid);
			$data['heading_title'] = 'Team Ranking for '.$this->league_mod->get_league_name_by_id($lid);
			
			$this->load->view('header',$data);
			$this->load->view('teamranking', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
	public function edit($lid,$action, $team_id){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Edit Team Ranking';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['dclass'] = 'matches'; 
			$data['lid'] = $lid;
			
			$data['heading_title'] = 'Edit Team Ranking for '.$this->league_mod->get_league_name_by_id($lid);
			
			
			if($action=='edit'){
				if($this->input->post('edit_ranking')){
					if(count($_POST)>0){
						$f = $this->league_mod->edit_ranking($_POST);
						if($f){
							redirect('teamranking/'.$lid);
						}
					}
				}			
				$data['team_info'] = $this->league_mod->get_team_info_by_id($team_id);
			}
			
			
			$this->load->view('header',$data);
			$this->load->view('edit_teamranking', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
}