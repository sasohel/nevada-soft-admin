<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('login');
		$this->load->helper('URL');
		$this->load->model('league_mod');
	}
	
	public function index($team_id='',$action=''){	
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){	
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'All Teams';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			$data['heading_title'] = 'All Teams';
			$data['base_url'] = $this->config->config['base_url'];
			
			
			$data['dclass'] = 'teams'; 
			
			if(isset($action) && $action=='delete' && is_numeric($id) && $id > 0){
				$f = $this->league_mod->delete_match($id);
				if($f){
					redirect('matches/'.$lid);
				}
			}
			
			$data['teams'] = $this->league_mod->get_all_teams();			
			
			
			
			$this->load->view('header',$data);
			
			$this->load->view('teams', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
	public function add($action='',$id=''){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){	
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Add New Team';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			$data['heading_title'] = 'Add New Team';
			$data['base_url'] = $this->config->config['base_url'];
			$data['leagues'] = $this->league_mod->get_all_league();
			$data['heading_title'] = 'Add New Team';
			$data['dclass'] = 'teams'; 
			if($this->input->post('add_new_team')){
				if(count($_POST)>0){
					$f = $this->league_mod->add_new_team($_POST);
					if($f){
						redirect('teams');
					}
				}
			}
			
			$this->load->view('header',$data);
			$this->load->view('team_add', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
	public function edit($team_id){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){	
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Edit Team';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			$data['leagues'] = $this->league_mod->get_all_league();
			$data['heading_title'] = 'Edit Team';
			$data['dclass'] = 'teams'; 
			$data['team_info'] = $this->league_mod->get_team_info_by_id($team_id);
			$data['team_id'] = $team_id;
			
			if($this->input->post('update_team')){
				if(count($_POST)>0){
					$f = $this->league_mod->update_team($_POST);
					if($f){
						redirect('teams');
					}
				}
			}
			
			$this->load->view('header',$data);
			$this->load->view('team_edit', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}
	}
	
	public function delete($team_id){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			
			if(is_numeric($team_id) && $team_id > 0){
				$f = $this->league_mod->delete_team($team_id);
				if($f){
					redirect('teams');
				}
			}
		}
		else{
			redirect('');
		}	
	}
	
}