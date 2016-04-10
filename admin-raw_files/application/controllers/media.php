<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {
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
			
			$data['title'] = 'All Media';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			$data['heading_title'] = 'All Media';
			$data['base_url'] = $this->config->config['base_url'];
			
			
			$data['dclass'] = 'media'; 
			
			if(isset($action) && $action=='delete' && is_numeric($id) && $id > 0){
				$f = $this->league_mod->delete_match($id);
				if($f){
					redirect('media/');
				}
			}
			
			$data['media'] = $this->league_mod->get_all_media_links();			
			
			
			
			$this->load->view('header',$data);
			
			$this->load->view('media', $data);
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
			
			$data['title'] = 'Add New Link';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			$data['heading_title'] = 'Add New Link';
			$data['base_url'] = $this->config->config['base_url'];
			$data['leagues'] = $this->league_mod->get_all_league();
			$data['heading_title'] = 'Add New Link';
			$data['dclass'] = 'media'; 
			if($this->input->post('add_new_media')){
				if(count($_POST)>0){
					$f = $this->league_mod->add_new_media_link($_POST);
					if($f){
						redirect('media');
					}
				}
			}
			
			$this->load->view('header',$data);
			$this->load->view('media_add', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}

	}
	
	public function edit($media_id){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){	
			$data['ccss'] = $this->config->config['ccss'];
			$data['cjs'] = $this->config->config['cjs'];
			
			$data['title'] = 'Edit Link';
			$data['login_box_header'] = $this->lang->line('login_box_header');
			
			$data['base_url'] = $this->config->config['base_url'];
			
			$data['heading_title'] = 'Edit Link';
			$data['dclass'] = 'media'; 
			$data['media_info'] = $this->league_mod->get_media_info_by_id($media_id);
			
			$data['media_id'] = $media_id;
			
			if($this->input->post('update_link')){
				if(count($_POST)>0){
					$f = $this->league_mod->update_media_link($_POST);
					if($f){
						redirect('media');
					}
				}
			}
			
			$this->load->view('header',$data);
			$this->load->view('media_edit', $data);
			$this->load->view('footer'); 
		}
		else{
			redirect('');
		}

	}
	
	public function delete($media_id){
		if($this->session->userdata('uid')!='' && $this->session->userdata('uid') > 0){
			
			if(is_numeric($media_id) && $media_id > 0){
				$f = $this->league_mod->delete_media($media_id);
				if($f){
					redirect('media');
				}

			}

		}
		else{
			redirect('');
		}	

	}
	
}