<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aprocessor extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('matchdetail');
		$this->load->helper('URL');
		$this->load->model('matchdetail_mod');
	}
	
	public function index(){
		
	}		
	
	public function getTeamPlayers(){	
		$players = $this->matchdetail_mod->get_team_players($_POST);		echo json_encode($players);
		die();
	}
	
	public function updatestatus(){		
		$this->matchdetail_mod->updatestatus($_POST);	
		die();
	}
	
	public function update_week_teams(){
		$this->matchdetail_mod->update_week_teams($_POST);
		die();
	}
	public function updateleagueweek(){
		$this->matchdetail_mod->updateleagueweek($_POST);
		die();
	}
}