<?php
//include("connection.php");
//error_reporting(E_ERROR | E_PARSE);

class Matchdetail_mod extends CI_Model{

	function __construct(){

		parent:: __construct();

	}

	
	public function get_player_name_by_id($player_id){
		$name = '';
		if(!empty($player_id) && is_numeric($player_id)){

			$sql = "SELECT `name` FROM `players` WHERE `playerid`='$player_id'";

			$f = $this->db->query($sql);
			if($f->num_rows() > 0){
				$temp = $f->result();
				$name = $temp[0]->name;
			}	
		}
		return $name;
	}
	
	public function get_player_jersey_by_id($player_id){
		$jersey = '';
		if(!empty($player_id) && is_numeric($player_id)){

			$sql = "SELECT `jersey` FROM `players` WHERE `playerid`='$player_id'";

			$f = $this->db->query($sql);
			if($f->num_rows() > 0){
				$temp = $f->result();
				$jersey = $temp[0]->jersey;
			}	
		}		
		return $jersey;
	}
	

	

	public function get_matchdetail_by_id($mid){

		$res = array();

		$sql = "SELECT * FROM `match_details` WHERE `matchid`='$mid' ORDER BY `time` ASC";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			if(count($res)>0){

				foreach($res AS $k=>$v){
					$v->actionfor = $this->get_team_name_by_id($v->actionfor);
					$res[$k]->player_name = $this->get_player_name_by_id($v->player);
					$res[$k]->assist_player_name = $this->get_player_name_by_id($v->assist_player);
				}

			}

		}	

		return $res;

	}

	

	public function get_team_name_by_id($tid){

		$res = array();

		$sql = "SELECT `sname` FROM `teams` WHERE `teamid`='$tid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			return $res[0]->sname;

		}		

		

	}

	

	public function get_league_id_by_match_id($mid){

		$sql = "SELECT `leagueid` FROM `schedule` WHERE `matchid`='$mid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res[0]->leagueid;

	}

	public function get_match_statuses(){

		$sql = "SELECT * FROM `match_status` ORDER BY `weight` ASC";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	public function get_sttus_title_by_id($sid){

		$sql = "SELECT `title` FROM `match_status` WHERE `status_id`='$sid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res[0]->title;

	}

	public function get_match_score($home_side, $away_side){
		$score = array();
		$sql = "SELECT `ftscore` FROM `schedule` WHERE `status`='3' AND `hside`='$home_side' AND `aside`='$away_side'";
		$f = $this->db->query($sql);
		if($f->num_rows() > 0){
			$temp = $f->result();			
			if(!empty($temp[0]->ftscore)){
				$score = explode('-',$temp[0]->ftscore);
			}
		}
		return $score;
	}

	public function get_match_info($id){

		$res = array();

		$sql = "SELECT * FROM `schedule` WHERE `matchid`='$id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			$res[0]->hside_id = $res[0]->hside;	

			$res[0]->hside = $this->get_team_name_by_id($res[0]->hside);	

			$res[0]->aside_id = $res[0]->aside;	

			$res[0]->aside = $this->get_team_name_by_id($res[0]->aside);				

			$res[0]->status_title = $this->get_sttus_title_by_id($res[0]->status);
			
			$res[0]->second_leg = FALSE;
			$temp = $this->get_match_score($res[0]->aside_id,$res[0]->hside_id);
			if(!empty($temp) && is_array($temp)){
				$res[0]->second_leg = TRUE;
				$res[0]->hside_goal = isset($temp[0])?$temp[0]:'0';			
				$res[0]->aside_goal = isset($temp[1])?$temp[1]:'0';
			}
		}		

		return $res;

	}

	

	public function get_team_players($info){
		$all_players = array();
		if(!empty($info['team_id']) && is_numeric($info['team_id'])){			
			$sql = "SELECT hside, aside FROM `schedule` WHERE `matchid`='".$info['match_id']."'";
			$sc = $this->db->query($sql);			
			if($sc->num_rows() > 0){
				$scres = $sc->result();				
				if($scres[0]->hside == $info['team_id']){
					$all_players['side'] = 'home';
				}
				else if($scres[0]->aside == $info['team_id']){
					$all_players['side'] = 'away';
				}
				else{
					$all_players['side'] = 'invalid';
				}
			}
			
			$sql = "SELECT * FROM `lineup` WHERE `matchid` = '".$info['match_id']."'";
			$ff = $this->db->query($sql);			
			if($ff->num_rows() > 0){
				$res = $ff->result();
				$r = $res[0];
				$f = (array)$r;
				/* echo '<pre>'; print_R($f); echo '</pre>';  */
				$players = '<option value="">Choose Player</option>';
				for($i=1; $i < 12; $i++){					
					if(!empty($f['hp'.$i]) && !in_array($f['hp'.$i],array($f['hout1'],$f['hout2'],$f['hout3']))){
						$players .= '<option value="'.$f['hp'.$i].'">'.$this->get_player_name_by_id($f['hp'.$i]).' ('.$this->get_player_jersey_by_id($f['hp'.$i]).')</option>';
					}
				}
				if($f['hin1'])
					$players .= '<option value="'.$f['hin1'].'">'.$this->get_player_name_by_id($f['hin1']).' ('.$this->get_player_jersey_by_id($f['hin1']).')</option>';
				if($f['hin2'])
					$players .= '<option value="'.$f['hin2'].'">'.$this->get_player_name_by_id($f['hin2']).' ('.$this->get_player_jersey_by_id($f['hin2']).')</option>';
				if($f['hin3'])
					$players .= '<option value="'.$f['hin3'].'">'.$this->get_player_name_by_id($f['hin3']).' ('.$this->get_player_jersey_by_id($f['hin3']).')</option>';
				
				$players .= '<option value="---">-------Substitutes-------</option>';				
				
				for($i=1; $i<8; $i++){
					if(!empty($f['hs'.$i]) && !in_array($f['hs'.$i],array($f['hin1'],$f['hin2'],$f['hin3']))){
						$players .= '<option value="'.$f['hs'.$i].'">'.$this->get_player_name_by_id($f['hs'.$i]).' ('.$this->get_player_jersey_by_id($f['hs'.$i]).')</option>';
					}
				}
				$all_players['home_players'] = $players;
				$all_players['hsub_count'] = $f['hsub_count'];
				
				$aplayers = '<option value="">Choose Player</option>';
				for($i=1; $i < 12; $i++){					
					if(!empty($f['ap'.$i]) && !in_array($f['ap'.$i],array($f['aout1'],$f['aout2'],$f['aout3']))){
						$aplayers .= '<option value="'.$f['ap'.$i].'">'.$this->get_player_name_by_id($f['ap'.$i]).' ('.$this->get_player_jersey_by_id($f['ap'.$i]).')</option>';
					}
				}
				if($f['ain1'])
					$aplayers .= '<option value="'.$f['ain1'].'">'.$this->get_player_name_by_id($f['ain1']).' ('.$this->get_player_jersey_by_id($f['ain1']).')</option>';
				if($f['ain2'])
					$aplayers .= '<option value="'.$f['ain2'].'">'.$this->get_player_name_by_id($f['ain2']).' ('.$this->get_player_jersey_by_id($f['ain2']).')</option>';
				if($f['ain3'])
					$aplayers .= '<option value="'.$f['ain3'].'">'.$this->get_player_name_by_id($f['ain3']).' ('.$this->get_player_jersey_by_id($f['ain3']).')</option>';
				
				$aplayers .= '<option value="---">-------Substitutes-------</option>';				
				
				for($i=1; $i<8; $i++){
					if(!empty($f['as'.$i]) && !in_array($f['as'.$i],array($f['ain1'],$f['ain2'],$f['ain3']))){
						$aplayers .= '<option value="'.$f['as'.$i].'">'.$this->get_player_name_by_id($f['as'.$i]).' ('.$this->get_player_jersey_by_id($f['as'.$i]).')</option>';
					}
				}
				$all_players['away_players'] = $aplayers;
				$all_players['asub_count'] = $f['asub_count'];
				
				
			}
		}
		return $all_players;
	}

	public function updatestatus($info){		
		date_default_timezone_set("UTC");
		
		$sql = "UPDATE `schedule` SET ";
		
		$chalf_time = '';
		
		$ctime = $info['custom_time'];
		if(isset($info['custom_time2']) && $info['custom_time2'] >0 && is_numeric($info['custom_time2']) && $ctime=='custom'){
			$ctime = $info['custom_time2'];
		}
		
		if($ctime >=0) { 			
			$chalf_time = @date("Y-m-d H:i:s", time());			
			if($info['status']==21){
				$sql .= " `first_half`='".$chalf_time."',"; 
				$sql .= " `second_half`='0',"; 
			}
			else if($info['status']==22){
				$sql .= " `second_half`='".$chalf_time."',"; 
			}
		}

		$sql .=" `status`='".$info['status']."' WHERE `matchid`='".$info['matchid']."'"; 
		
		$flag = $this->db->query($sql);
		
		if($flag){
			$hsteam = $info['hsteam'];
			$asteam = $info['asteam'];
			$hsid = $info['hteam_id'];
			$asid = $info['ateam_id'];
			$fulltscore = $info['fulltscore'];
			
			switch($info['status']){
				case '21':
					$info['action_message'] = 'kick-off. '.$hsteam.' VS '.$asteam;
                    //$this->push_notification($info);
				break;
				case '3':
					$info['action_message'] = 'Completed.'.$hsteam.' ('.$fulltscore.') '.$asteam;
					//$this->push_notification($info);
				break;
				case '20':
					$info['action_message'] = 'First half break.'.$hsteam.' ('.$fulltscore.') '.$asteam;
					$info['action'] ='fhb';
					//$this->push_notification($info);
				
				break;
				case '22':
					$info['action_message'] = 'Second half kick-off.'.$hsteam.' vs '.$asteam;
					$info['action'] ='shk';
					//$this->push_notification($info);
					
					
				break;
				
				
				default:
					return '';
			}
		}

	}

	
	
	public function match_teams($match_id){

		$res = array();

		$sql = "SELECT `hside`,`aside` FROM `schedule` WHERE `matchid`='$match_id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			$res[0]->hside_title = $this->get_team_name_by_id($res[0]->hside);
			$res[0]->hside = $res[0]->hside;

			$res[0]->aside_title = $this->get_team_name_by_id($res[0]->aside);
			$res[0]->aside = $res[0]->aside;

		}				

		return $res;

	}
	
	public function update_lineup($l_info){
		$matchid = $l_info['matchid'];
		$info = array();	
		$cnt=1;
		foreach($l_info['hp'] AS $k=>$x){
			$info['hp'.$cnt] = $x;
			$cnt++;
		}
		$cnt=1;
		foreach($l_info['hs'] AS $k=>$x){
			$info['hs'.$cnt] = $x;
			$cnt++;
		}
		$cnt=1;
		foreach($l_info['ap'] AS $k=>$x){
			$info['ap'.$cnt] = $x;
			$cnt++;
		}
		$cnt=1;
		foreach($l_info['as'] AS $k=>$x){
			$info['as'.$cnt] = $x;
			$cnt++;
		}
		
		$sql = "UPDATE `lineup` SET ";
		$k = "";
		$c = 1; 
		foreach($info AS $k=>$v){
			$sql .= "`".trim($k)."`='".trim($v)."'";
			if($c < count($info)){
				$sql .= ', '; 
			}
			$c++;
		}
		$sql .= " WHERE `matchid`='".$matchid."'";
		
		$f = $this->db->query($sql);
		return $f;
	}
	
	
	public function get_team_players_by_team_id($team_id){

		$result = array();

		$sql = "SELECT `playerid`,`jersey`,`name`,`teamid` FROM `players` WHERE `teamid`='$team_id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();
			foreach($res AS $v){
				$result[$v->playerid] = $v->name.' ('.$v->jersey.')';
			}

		}	
		return $result;

	}

	

	public function get_match_action_by_id($maid){

		$res = array();

		$sql = "SELECT * FROM `match_details` WHERE `id`='$maid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			$res[0]->team_name = $this->get_team_name_by_id($res[0]->actionfor);

		}		

		return $res;

	}

	

	public function update_match_action($info){

		$sql = "UPDATE `match_details` SET `time`='".$info['time_munite']."',`action`='".$info['action']."',`player`='".$info['player']."',`actionfor`='".$info['action_for']."',`htscore`='".$info['halftime_score']."',`scorecard`='".$info['fulltime_score']."' WHERE `id`='".$info['mactionid']."'";		

		$f = $this->db->query($sql);

		

		$k = $this->db->query("SELECT MAX(time) AS `mtime` FROM `match_details` WHERE `matchid`='".$info['cmatchid']."'");		

		$mtime = 0;

		if($k->num_rows() > 0){ $foo = $k->result(); $mtime = $foo[0]->mtime;  }

		if($mtime == $info['time_munite']){

			$sql2 = "UPDATE `schedule` SET `htscore`='".$info['halftime_score']."', `ftscore`='".$info['fulltime_score']."' WHERE `matchid`='".$info['cmatchid']."'";

			$f2 = $f = $this->db->query($sql2);

		}

		

		if($f) return TRUE;

	}

	public function get_lineup($mid){
		$result = array();
		$sql = "SELECT * FROM `lineup` WHERE `matchid`='$mid'";
		$f = $this->db->query($sql);
		if($f->num_rows() > 0){
			$res = $f->result();
			$result = $res[0]; 
		}	
		return $result;
	}

	public function add_match_action($info){
		switch($info['action']){
			case 'g':
				
				$this->db->where('playerid', $info['player']);
				$this->db->set('goals', 'goals+1', FALSE);
				$this->db->update('players');
				
				
				$this->db->where('playerid', $info['assist_by']);
				$this->db->set('assists', 'assists+1', FALSE);
				$this->db->update('players');
				
				$sql = "SELECT hside, aside FROM `schedule` WHERE `matchid`='".$info['cmatchid']."'";
				$sc = $this->db->query($sql);			
				if($sc->num_rows() > 0){
					$scres = $sc->result();				
					if($scres[0]->hside == $info['action_for']){
						$this->db->where('playerid', $info['player']);
						$this->db->set('hgoals', 'hgoals+1', FALSE);
						$this->db->update('players');
						
					}
					else if($scres[0]->aside == $info['action_for']){
						$this->db->where('playerid', $info['player']);
						$this->db->set('agoals', 'agoals+1', FALSE);
						$this->db->update('players');
					}					
				}				
			break; 
			case 'p':
				$this->db->where('playerid', $info['player']);
				$this->db->set('goals', 'goals+1', FALSE);
				$this->db->update('players');
				
				$this->db->where('playerid', $info['player']);
				$this->db->set('pgoals', 'pgoals+1', FALSE);
				$this->db->update('players');
				
				$sql = "SELECT hside, aside FROM `schedule` WHERE `matchid`='".$info['cmatchid']."'";
				$sc = $this->db->query($sql);			
				if($sc->num_rows() > 0){
					$scres = $sc->result();				
					if($scres[0]->hside == $info['action_for']){
						
						$this->db->where('playerid', $info['player']);
						$this->db->set('hgoals', 'hgoals+1', FALSE);
						$this->db->update('players');
					}
					else if($scres[0]->aside == $info['action_for']){
						
						$this->db->where('playerid', $info['player']);
						$this->db->set('agoals', 'agoals+1', FALSE);
						$this->db->update('players');
					}					
				}
			break; 
			case 'yc':
				$this->db->where('playerid', $info['player']);
				$this->db->set('ycard', 'ycard+1', FALSE);
				$this->db->update('players');
			break; 
			case 'rc':
				
				$this->db->where('playerid', $info['player']);
				$this->db->set('rcard', 'rcard+1', FALSE);
				$this->db->update('players');
			break; 
			case '2yr':
				
				$this->db->where('playerid', $info['player']);
				$this->db->set('rcard', 'rcard+1', FALSE);
				$this->db->update('players');
			break; 
			
			case 'st':				
				$side = '';
				$sql = "SELECT hside, aside FROM `schedule` WHERE `matchid`='".$info['cmatchid']."'";
				
				$sc = $this->db->query($sql);			
				if($sc->num_rows() > 0){
					$scres = $sc->result();				
					if($scres[0]->hside == $info['action_for']){
						$side = 'home';
					}
					else if($scres[0]->aside == $info['action_for']){
						$side = 'away';
					}					
				}
				
				$sql = "SELECT * FROM `lineup` WHERE `matchid`='".$info['cmatchid']."'";				
				$lineupdata = $this->db->query($sql);			
				if($lineupdata->num_rows() > 0){
					$lnres = $lineupdata->result();				
					
					if($side == 'home'){
						if($lnres[0]->hsub_count < 3){
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set('hsub_count', 'hsub_count+1', FALSE);
							$this->db->update('lineup');
							
							$temp = 'hout'.($lnres[0]->hsub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['player'], FALSE);
							$this->db->update('lineup');
							
							$temp = 'hin'.($lnres[0]->hsub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['assist_by'], FALSE);
							$this->db->update('lineup');
							
							$temp = 'htime'.( $lnres[0]->hsub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['time_munite'], FALSE);
							$this->db->update('lineup');
							
							
						}
					}
					else if($side == 'away'){						
						if($lnres[0]->asub_count < 3){
							
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set('asub_count', 'asub_count+1', FALSE);
							$this->db->update('lineup');
							
							$temp = 'aout'.($lnres[0]->asub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['player'], FALSE);
							$this->db->update('lineup');
							
							$temp = 'ain'.($lnres[0]->asub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['assist_by'], FALSE);
							$this->db->update('lineup');
							
							$temp = 'atime'.($lnres[0]->asub_count + 1);
							$this->db->where('matchid', $info['cmatchid']);
							$this->db->set($temp, $info['time_munite'], FALSE);
							$this->db->update('lineup'); 
							
						}
					}				
				}
				
			break; 
			
			default:
				break;
		}
	
		if($info['action']=='g' || $info['action']=='p'){

			$match_sch = $this->get_match_info($info['cmatchid']);		

			$info['league_id'] = $this->get_league_id_by_match_id($info['cmatchid']);

			$info['hteam_id'] = $match_sch[0]->hside_id;

			$info['hteam_name'] = $this->get_team_name_by_id($match_sch[0]->hside_id);

			

			$info['ateam_id'] = $match_sch[0]->aside_id;

			$info['ateam_name'] = $this->get_team_name_by_id($match_sch[0]->aside_id);

			

			if($info['action_for'] == $match_sch[0]->hside_id){

				if($info['time_munite'] <= 45){

					$temp = explode("-",$info['halftime_score']);

					$info['halftime_score'] = ($temp[0]+1).'-'.$temp[1];

					$info['fulltime_score'] = ($temp[0]+1).'-'.$temp[1];

					$info['ft_hteam_goal'] = ($temp[0]+1);

					$info['ft_ateam_goal'] = ($temp[1]);

				}

				elseif($info['time_munite'] > 45){

					$temp = explode("-",$info['fulltime_score']);					

					$info['fulltime_score'] = ($temp[0]+1).'-'.$temp[1];

					$info['ft_hteam_goal'] = ($temp[0]+1);

					$info['ft_ateam_goal'] = ($temp[1]);

				}

			}

			elseif($info['action_for'] == $match_sch[0]->aside_id){				

				if($info['time_munite'] <= 45){

					$temp = explode("-", $info['halftime_score']);

					$info['halftime_score'] = $temp[0].'-'.($temp[1]+1);

					$info['fulltime_score'] = $temp[0].'-'.($temp[1]+1);

					$info['ft_hteam_goal'] = ($temp[0]);

					$info['ft_ateam_goal'] = ($temp[1]+1);

				}

				elseif($info['time_munite'] > 45){

					$temp = explode("-",$info['fulltime_score']);

					$info['fulltime_score'] = $temp[0].'-'.($temp[1]+1);

					$info['ft_ateam_goal'] = ($temp[1]+1);

					$info['ft_hteam_goal'] = ($temp[0]);

					$info['ft_ateam_goal'] = ($temp[1]+1);

				}

			}

			

			/* a formatted array for push notification vai. The array formation shown below */

			/* 

			$info = Array(

				[cmatchid] => 2

				[mactionid] => 2

				[timediff] => 14400

				[time_munite] => 56

				[action] => g

				[action_for] => 2

				[player] => Saiful

				[halftime_score] => 1-0  

				[fulltime_score] => 3-1

				[match_action_add] => Add

			);

			

			// from here you will get 
			//edit 1
			*/
			
			$home_team_name = $info['hteam_name'];
			$away_team_name = $info['ateam_name'];		
			$player = $info['player'];
			$assist_by = $info['assist_by'];
			$home_goal = $info['ft_hteam_goal'];
			$away_goal = $info['ft_ateam_goal'];
			$info['action_message'] = 'Goal of '.$player.' !! '.$home_team_name.' ('.$home_goal.' - '.$away_goal.') '.$away_team_name;
			$info['leagueid'] = $info['league_id'];
            //$this->push_notification($info);

			

		}

		/* echo '<pre>'; print_r($info); echo '</pre>';  exit; */

			

		$sql = "INSERT INTO `match_details` SET `matchid`='".$info['mactionid']."',`time`='".$info['time_munite']."',`action`='".$info['action']."',`player`='".$info['player']."',`assist_player`='".$info['assist_by']."',`actionfor`='".$info['action_for']."',`htscore`='".$info['halftime_score']."',`scorecard`='".$info['fulltime_score']."'";		

		$f = $this->db->query($sql);

		$sql2 = "UPDATE `schedule` SET `htscore`='".$info['halftime_score']."', `ftscore`='".$info['fulltime_score']."' WHERE `matchid`='".$info['cmatchid']."'";

		$f2 = $f = $this->db->query($sql2);

		if($f && $f2) return TRUE;

	}
    
    function push_notification($info){
    
    	
		$home_team_id = $info['hteam_id'];
		
		$away_team_id = $info['ateam_id'];
		
		$message = $info['action_message'];
		
		$leagueid = $info['leagueid'];

		//&& $leagueid != 6

		if($info['action']=='g' || $info['action']=='p' || $info['action']=='fhb' || $info['action']=='shk'){		
			//if($leagueid == 6){
				//$sql_select = mysql_query("SELECT * FROM `users` WHERE `leagueid`= '$leagueid' and `token` !=''");
			//}else {				
				$sql_select = mysql_query("SELECT * FROM `users` WHERE `token` !='' and `fan` IN('$home_team_id','$away_team_id')");
			//}
			//exit('coming here');
		}else {
			$sql_select = mysql_query("SELECT * FROM `users` WHERE `leagueid`= '$leagueid' and `token` !=''");
		}

		if(mysql_num_rows($sql_select)>0) {
			$AndroidDeviceToken = ARRAY();
			$iOSDeviceToken = ARRAY();
			while ($row = mysql_fetch_array($sql_select)) {
				$os = $row['os'];
				$token = $row['token'];
					if($os == 1) {
						$iOSDeviceToken[] = $token;
					}else {
						$AndroidDeviceToken[] = $token;
					}				
			}

			$passphrase = 'Kab125852@';
			$certificate = '';
			$key = '';
			if($leagueid == 1) {
				$key = 'AIzaSyALLxnrhdo7QLsGg9UNbWwoaXqluFxNLRs';
				$certificate = 'push/combineLaliga_dist.pem';
			}elseif ($leagueid == 2) {
				$key = 'AIzaSyCQyo3M8EZRE8prHujc5HWCbU0Os266SMY';
				$certificate = 'push/combineEPL_dist.pem';
			}elseif ($leagueid == 3) {
				$key = 'AIzaSyDv0NGEJMOsHzYi7wFmfgMOSuflZFkTK-c';
				$certificate = 'push/combineSerieA_dist.pem';
			}elseif ($leagueid == 4) {
				$key = 'AIzaSyCUtI4GrEv1KHQPg8ceHW-js2ux5MlS1yA';
				$certificate = 'push/combineLigue1_dist.pem';
			}elseif ($leagueid == 5) {
				$key = 'AIzaSyAAbE5WC-MK3tPktOBx51KcMNWcOp_0Ch8';
				$certificate = 'push/combineBund_dist.pem';
			}elseif ($leagueid == 6) {
				$key = 'AIzaSyD745sgKSGzl405ux5wjafl-rzgQ1dQMDQ';
				$certificate = 'push/combineISL.pem';
				//exit('coming here');
			}else {

			}
			//echo '<pre>'; print_r($AndroidDeviceToken); echo '</pre>'; 
			//echo '<pre>'; print_r($key); echo '</pre>';
			// Android push notification section
			if(count($AndroidDeviceToken)>0) {
				//exit('coming here with count='.count($AndroidDeviceToken));
				$regIdChunk=array_chunk($AndroidDeviceToken,1000);
    			foreach($regIdChunk as $RegId){
					$url = 'https://android.googleapis.com/gcm/send';
					$fields = array(
				                'registration_ids'  => $RegId,
				                'data'              => array( "message" => $message ),
				                );
				 
					$headers = array( 
				                    'Authorization: key=' . $key,
				                    'Content-Type: application/json'
				                );

					//echo $message.'----'.$registrationIDs[0].'----------'.$headers[0];
					 
					// Open connection
					$ch = curl_init();
					 
					// Set the url, number of POST vars, POST data
					curl_setopt( $ch, CURLOPT_URL, $url );
					 
					curl_setopt( $ch, CURLOPT_POST, true );
					curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					 
					curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
					 
					// Execute post
					$result = curl_exec($ch);
					/*if($result) {
						echo '<pre>'; print_r($result); echo '</pre>';
					}*/
					 
					// Close connection
					//edit 2
					
					curl_close($ch);
				}
			}
			 //iOS push notification section
			if(count($iOSDeviceToken)>0 && $leagueid !=6) {
				//exit("count=".count($iOSDeviceToken));
				//exit('certificate='.$certificate.' passphrase='.$passphrase);
				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', $certificate);
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

				// Open a connection to the APNS server
				$fp = stream_socket_client(
					'ssl://gateway.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);

				//echo 'Connected to APNS' . PHP_EOL;

				// Create the payload body
				$body['aps'] = array(
					'alert' => $message,
					'sound' => 'default',
					'badge' => '+1'
					);

				// Encode the payload as JSON
				$payload = json_encode($body);

				foreach($iOSDeviceToken as $token){
					$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
					$result = fwrite($fp, $msg, strlen($msg));
				}
				/*if (!$result)
					echo 'Message not delivered' . PHP_EOL;
					echo '<pre>'; print_r($info); echo '</pre>';  exit;
				else
					echo 'Message successfully delivered' . PHP_EOL;*/

				// Close the connection to the server
				//edit 3
				
				fclose($fp);
			}
		//end edit
		}
    }
	

	public function delete_match_action($act_id){

		$sql = "DELETE FROM `match_details` WHERE `id`='$act_id'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function update_week_teams($info){

		$data = array();

		$sql = "SELECT `tweek` FROM `leagues` WHERE `leagueid`='".$info['lid']."'";

		$f = $this->db->query($sql);

		$temp = '';

		if($f->num_rows() > 0){

			$res = $f->result();			

			

			

			$tweek = $res[0]->tweek;

			if(is_numeric($tweek)){

				$temp .='<option value="">Choose a week</option>';

				for($i =1; $i <= $tweek; $i++ ){

					$temp .='<option value="'.$i.'">Week '.$i.'</option>';

				}

			}

		}	

		

		$res = array();

		$stm = '';

		$sql = "SELECT * FROM `teams` WHERE `leagueid`='".$info['lid']."'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			if(count($res) > 0){

				$stm .='<option value="">Choose a Team</option>';

				foreach($res AS $v){

					$stm .='<option value="'.$v->teamid.'">'.$v->sname.'</option>';

				}

			}	

		}

		echo json_encode(array($temp,$stm));

	}



	public function updateleagueweek($info){

		$sql = "UPDATE `leagues` SET `cweek`='".$info['cweek']."' WHERE `leagueid`='".$info['lid']."'";

		$f = $this->db->query($sql);

		if($f) echo 'done'; 

	}	

	public function sendpush($info) {
		$home_team_name = $info['hteam_name'];
		$home_team_id = $info['hteam_id'];
		$away_team_name = $info['ateam_name'];
		$away_team_id = $info['ateam_id'];
		$leagueid = $info['league_id'];
		$player = $info['player'];
		$home_goal = $info['ft_hteam_goal'];
		$away_goal = $info['ft_ateam_goal'];

		$message = $player.' goal!! '.$home_team_name.' '.$home_goal.' - '.$away_goal.' '.$away_team_name;
		  
		$sql_select = mysql_query("SELECT * FROM `users` WHERE `fan` IN('$home_team_id','$away_team_id') AND `leagueid`='$leagueid'");
		if(mysql_num_rows($sql_select)>0) {
			$AndroidDeviceToken = ARRAY();
			$iOSDeviceToken = ARRAY();
			while ($row = mysql_fetch_array($sql_select)) {
				$os = $row['os'];
				$token = $row['token'];
				if($token != '') {
					if($os == 1) {
						$iOSDeviceToken[] = $token;
					}else {
						$AndroidDeviceToken[] = $token;
					}
				}
				
			}
			$passphrase = 'Kab125852@';
			$certificate = '';
			if($leagueid === 1) {
				$key = 'AIzaSyALLxnrhdo7QLsGg9UNbWwoaXqluFxNLRs';
				$certificate = 'push/combineLaliga_dev.pem';
			}elseif ($leagueid === 2) {
				$key = 'AIzaSyCQyo3M8EZRE8prHujc5HWCbU0Os266SMY';
				$certificate = 'push/combineEPL_dev.pem';
			}elseif ($leagueid === 3) {
				$key = 'AIzaSyDv0NGEJMOsHzYi7wFmfgMOSuflZFkTK-c';
				$certificate = 'push/combineSerieA_dev.pem';
			}elseif ($leagueid === 4) {
				$key = 'AIzaSyCUtI4GrEv1KHQPg8ceHW-js2ux5MlS1yA';
				$certificate = 'push/combineLigue1_dev.pem';
			}elseif ($leagueid === 5) {
				$key = 'AIzaSyAAbE5WC-MK3tPktOBx51KcMNWcOp_0Ch8';
				$certificate = 'push/combineBund_dev.pem';
			}else {

			}
			// Android push notification section
			if(count($AndroidDeviceToken)>0) {

				$url = 'https://android.googleapis.com/gcm/send';
				$fields = array(
			                'registration_ids'  => $AndroidDeviceToken,
			                'data'              => array( "message" => $message ),
			                );
			 
				$headers = array( 
			                    'Authorization: key=' . $key,
			                    'Content-Type: application/json'
			                );

				//echo $message.'----'.$registrationIDs[0].'----------'.$headers[0];
				 
				// Open connection
				$ch = curl_init();
				 
				// Set the url, number of POST vars, POST data
				curl_setopt( $ch, CURLOPT_URL, $url );
				 
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				 
				curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
				 
				// Execute post
				$result = curl_exec($ch);
				 
				// Close connection
				curl_close($ch);
			}
			// iOS push notification section
			if(count($iOSDeviceToken)>0) {

				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', $certificate);
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

				// Open a connection to the APNS server
				$fp = stream_socket_client(
					'ssl://gateway.sandbox.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);

				//echo 'Connected to APNS' . PHP_EOL;

				// Create the payload body
				$body['aps'] = array(
					'alert' => $message,
					'sound' => 'default',
					'badge' => '+1'
					);

				// Encode the payload as JSON
				$payload = json_encode($body);

				foreach($iOSDeviceToken as $token){
					$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
					$result = fwrite($fp, $msg, strlen($msg));
				}
				/*if (!$result)
					echo 'Message not delivered' . PHP_EOL;
				else
					echo 'Message successfully delivered' . PHP_EOL;*/

				// Close the connection to the server
				fclose($fp);
			}

		}
	}

}