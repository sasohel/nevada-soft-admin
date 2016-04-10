<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aprocessor extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->database();
		$this->load->library('session');
		$this->lang->load('matchdetail');
		$this->load->helper('URL');        $this->load->helper('date');
		$this->load->model('matchdetail_mod');
	}
	
	public function index(){
		
	}		
	
	public function getTeamPlayers(){	
		$players = $this->matchdetail_mod->get_team_players($_POST);		echo json_encode($players);
		die();
	}
	
	public function updatestatus(){		
		$this->matchdetail_mod->updatestatus($_POST);                // when match over        if(isset($_POST['status']) && $_POST['status'] == 3){            $this->load->model('league_mod');            $match_info = $this->league_mod->get_match_info($_POST['matchid']);            $tema_hside = array();            $tema_aside = array();            $full_score = explode('-', $match_info[0]->ftscore);                        $tema_hside['id'] = $match_info[0]->hside;            $tema_aside['id'] = $match_info[0]->aside;            $tema_hside['score'] = $full_score[0];            $tema_aside['score'] = $full_score[1];            $tema_hside['gf'] = $tema_hside['score'];            $tema_aside['gf'] = $tema_aside['score'];            $tema_hside['ga'] = $tema_aside['score'];            $tema_aside['ga'] = $tema_hside['score'];            $tema_hside['gd'] = $tema_hside['gf'] - $tema_hside['ga'];            $tema_aside['gd'] = $tema_aside['gf'] - $tema_aside['ga'];                        // get team points & others            if($tema_hside['score'] == $tema_aside['score']){ // match is draw                $tema_hside['points'] = 1;                $tema_aside['points'] = 1;                $tema_hside['win'] = 0;                $tema_aside['win'] = 0;                $tema_hside['draw'] = 1;                $tema_aside['draw'] = 1;                $tema_hside['lost'] = 0;                $tema_aside['lost'] = 0;            } elseif($tema_hside['score'] > $tema_aside['score']) {                $tema_hside['points'] = 3;                $tema_aside['points'] = 0;                $tema_hside['win'] = 1;                $tema_aside['win'] = 0;                $tema_hside['draw'] = 0;                $tema_aside['draw'] = 0;                $tema_hside['lost'] = 0;                $tema_aside['lost'] = 1;            } elseif($tema_hside['score'] < $tema_aside['score']) {                $tema_hside['points'] = 0;                $tema_aside['points'] = 3;                $tema_hside['win'] = 0;                $tema_aside['win'] = 1;                $tema_hside['draw'] = 0;                $tema_aside['draw'] = 0;                $tema_hside['lost'] = 1;                $tema_aside['lost'] = 0;            }                    $teams = array($tema_hside, $tema_aside);            $this->league_mod->update_team_after_match_over($teams);        }		die();	}
	
	public function update_week_teams(){
		$this->matchdetail_mod->update_week_teams($_POST);
		die();
	}
	public function updateleagueweek(){
		$this->matchdetail_mod->updateleagueweek($_POST);
		die();
	}
}