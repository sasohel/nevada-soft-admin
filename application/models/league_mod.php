<?php

class League_mod extends CI_Model{

	function __construct(){

		parent:: __construct();

	}

	

	public function get_league_name_by_id($lid){

		$res = array();

		$sql = "SELECT `name` FROM `leagues` WHERE `leagueid`='$lid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res[0]->name;

	}

	

	

	public function get_all_league(){

		$res = array();

		$sql = "SELECT * FROM `leagues`";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	public function get_all_teams(){

		$res = array();

		$sql = "SELECT * FROM `teams`";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	
	public function get_all_media_links(){

		$res = array();

		$sql = "SELECT * FROM `media_link`";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	

	public function get_all_teams_by_league($lid){

		$res = array();

		$sql = "SELECT * FROM `teams` WHERE `leagueid`='$lid'";


		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	
	public function get_team_info_by_id($team_id){

		$sql = "SELECT * FROM `teams` WHERE `teamid`='$team_id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	public function get_media_info_by_id($media_id){

		$sql = "SELECT * FROM `media_link` WHERE `id`='$media_id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	public function get_team_name_by_id($tid){

		$sql = "SELECT `sname` FROM `teams` WHERE `teamid`='$tid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res[0]->sname;

	}

	

	public function get_team_short_name_by_id($tid){

		$sql = "SELECT `key` FROM `teams` WHERE `teamid`='$tid'";
		$res = array();

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		
		//echo '<pre>'; print_r($res); echo '</pre>';exit;
		return $res[0]->key;

	}

	

	public function get_match_status_by_id($sid){
		$title = '';
		$sql = "SELECT `title` FROM `match_status` WHERE `status_id`='$sid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			
			$title = $res[0]->title;
		}		

		return $title;

	}

	

	public function get_match_statuses(){

		$sql = "SELECT * FROM `match_status`";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	

	public function get_league_matches($lid, $flag){

		$res = array();

		if($flag===TRUE){
			$sql = "SELECT * FROM `schedule` WHERE `leagueid`='$lid' AND `status`='3' ORDER BY `matchid` ";	
		}

		else{
			$sql = "SELECT * FROM `schedule` WHERE `leagueid`='$lid' AND `status` != '3' ORDER BY `matchid` ";
		}

		

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			$hsc = $fsc = array();

			if(count($res)>0){

				foreach($res AS $k=> $v){

					$ht = $this->get_team_short_name_by_id($v->hside);

					$at = $this->get_team_short_name_by_id($v->aside);

					

					$hsc = explode("-", $v->htscore);

					$fsc = explode("-", $v->ftscore);

					

					

					if(count($hsc) > 0){

						$v->hscore = $ht.' <strong>('.$hsc["0"].' - '.@$hsc["1"].')</strong> '.$at;

					}

					else{

						$v->hscore = $ht.' <strong>(0 - 0)</strong> '.$at;

					}

					

					if(count($fsc) > 0){

						$v->fscore = $ht.' <strong>('.$fsc["0"].' - '.@$fsc["1"].')</strong> '.$at;	

					}

					else{

						$v->fscore = $ht.' <strong>(0 - 0)</strong> '.$at;

					}

					

					

					$v->hside = $this->get_team_name_by_id($v->hside);

					$v->aside = $this->get_team_name_by_id($v->aside);

					

					$v->status = $this->get_match_status_by_id($v->status);

				}

			}

			/* echo '<pre>'; print_R($res); echo '</pre>'; 

			exit;  */

			

		}		

		return $res;

	}

	

	public function delete_match($id){

		$sql = "DELETE FROM `schedule` WHERE `matchid`='$id'";	
		$f = $this->db->query($sql);
		
		$sql = "DELETE FROM `lineup` WHERE `matchid`='$id'";	
		$f = $this->db->query($sql);
		
		if($f) return TRUE;

	}

	

	public function get_match_info($id){

		$res = array();

		$sql = "SELECT * FROM `schedule` WHERE `matchid`='$id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}

	

	public function update_match($info){
		$bangla_date = @date("Y-m-d",@strtotime($info['match_started']));
		$ltime = @date("Y-m-d H:i:s",(@strtotime($info['match_started']) - $info['timediff']));
		$utc = @date("Y-m-d H:i:s",@strtotime($info['match_started']) - (6*3600));
		$shalf = @date("Y-m-d H:i:s",(@strtotime($info['second_half_started']) - (6*3600)));

		$sql = "UPDATE `schedule` SET "
                        . "`leagueid`='".$info['league']
                        ."',`season`='".$info['season']
                        ."',`week`='".$info['week']
                        ."',`hside`='".$info['home']
                        ."',`aside`='".$info['away']
                        ."',`date`='".$bangla_date
                        ."',`ldate`='".$ltime
                        ."',`utc`='".$utc
                        ."',`second_half`='".$shalf
                        ."',`htscore`='".$info['halftime_score']
//                        ."',`media_link`='".$info['media_link']
                        ."',`highlights`='".$info['highlights']
                        ."',`ftscore`='".$info['fulltime_score']
                        ."',`status`='".$info['status']
                        ."' WHERE `matchid`='".$info['matchid']."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

		

	}

	

	public function add_new_match($info){
		
		$timediff = $this->get_league_lcl_time_diff($info['league']);
		if(isset($info['entry_type']) && $info['entry_type']=='batch'){
			foreach($info['home'] AS $kk => $vals){
				if($vals){
					$bangla_date = @date("Y-m-d",@strtotime($info['match_started'][$kk]));
					$ltime = @date("Y-m-d H:i:s",(@strtotime($info['match_started'][$kk]) - $timediff));
					$utc = @date("Y-m-d H:i:s",@strtotime($info['match_started'][$kk]) - (6*3600));
					$shalf = @date("Y-m-d H:i:s",(@strtotime($info['second_half_started'][$kk]) - (6*3600)));
					
					$sql = "INSERT INTO `schedule` SET `leagueid`='".$info['league']."',`season`='".$info['season']."',`week`='".$info['week'][$kk]."',`hside`='".$info['home'][$kk]."',`aside`='".$info['away'][$kk]."',`date`='".$bangla_date."',`ldate`='".$ltime."',`utc`='".$utc."',`second_half`='".$shalf."',`htscore`='".$info['halftime_score'][$kk]."',`ftscore`='".$info['fulltime_score'][$kk]."',`status`='".$info['status'][$kk]."',`stadium`='".$info['stadium']."'";
					$this->db->query($sql);
					
					$insert_id = $this->db->insert_id();
					 
					$sql = "INSERT INTO `lineup` SET `matchid`='".$insert_id."',`stadium`='".$info['stadium']."'";
					$this->db->query($sql);
					
					
				}
			}
		}
		else if(isset($info['entry_type']) && $info['entry_type']=='single'){ 
			$bangla_date = @date("Y-m-d",@strtotime($info['match_started']));
			$ltime = @date("Y-m-d H:i:s",(@strtotime($info['match_started']) - $timediff));
			$utc = @date("Y-m-d H:i:s",@strtotime($info['match_started']) - (6*3600));
			$shalf = @date("Y-m-d H:i:s",(@strtotime($info['second_half_started']) - (6*3600)));
					
			$sql = "INSERT INTO `schedule` SET `leagueid`='".$info['league']."',`season`='".$info['season']."',`week`='".$info['week']."',`hside`='".$info['home']."',`aside`='".$info['away']."',`date`='".$bangla_date."',`ldate`='".$ltime."',`utc`='".$utc."',`second_half`='".$shalf."',`htscore`='".$info['halftime_score']."',`ftscore`='".$info['fulltime_score']."',`status`='".$info['status']."',`stadium`='".$info['stadium']."'";
			$this->db->query($sql);
			
			$insert_id = $this->db->insert_id();					 
			$sql = "INSERT INTO `lineup` SET `matchid`='".$insert_id."',`stadium`='".$info['stadium']."'";
			$this->db->query($sql);
			
		}
		
		$last_id = $this->db->insert_id();

		if($last_id) return $last_id;

		

	}

	

	public function add_new_team($info){

		$sql = "INSERT INTO `teams` SET `leagueid`='".$info['league']."',`name`='".$info['team_name']."',`sname`='".$info['short_name']."',`key`='".$info['key']."',`stadium`='".$info['home_ground']."'";

		$f = $this->db->query($sql);

		$last_id = $this->db->insert_id();

		if($f) return $last_id;

	}

	
	public function add_new_media_link($info){

		$sql = "INSERT INTO `media_link` SET `leagueid`='".$info['leagueid']."',`match_id`='".$info['match_id']."',`link`='".$info['link']."'";

		$f = $this->db->query($sql);

		$last_id = $this->db->insert_id();

		if($f) return $last_id;

	}
    
    public function update_team_after_match_over($team_info){
        foreach($team_info as $tema){
            $this->db->set('gp', 'gp+1', FALSE);
            $this->db->set('points', "points+".$tema['points'], FALSE);
            $this->db->set('win', "win+".$tema['win'], FALSE);
            $this->db->set('draw', "draw+".$tema['draw'], FALSE);
            $this->db->set('lost', "lost+".$tema['lost'], FALSE);
            $this->db->set('gf', "gf+".$tema['gf'], FALSE);
            $this->db->set('ga', "ga+".$tema['ga'], FALSE);
            $this->db->set('gd', "gd+".$tema['gd'], FALSE);
            
            $this->db->where('teamid', $tema['id']);
            $this->db->update('teams');
        }
    }

	

	public function update_team($info){

		$sql = "UPDATE `teams` SET `leagueid`='".$info['league']."',`name`='".$info['team_name']."',`sname`='".$info['short_name']."',`key`='".$info['key']."',`stadium`='".$info['home_ground']."' WHERE `teamid`='".$info['team_id']."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	
	public function update_media_link($info){

		$sql = "UPDATE `media_link` SET `link`='".$info['link']."' ,`match_id`='".$info['match_id']."' WHERE `id`='".$info['media_id']."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function delete_team($team_id){

		$sql = "DELETE FROM `teams` WHERE `teamid`='".$team_id."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	
	public function delete_media($media_id){

		$sql = "DELETE FROM `media_link` WHERE `id`='".$media_id."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function get_team_ranking($lid){

		$res = array();

		$sql = "SELECT * FROM `teams` WHERE `leagueid`='$lid' order BY points DESC, gd DESC, `gf` DESC ";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

		}		

		return $res;

	}	

	

	public function edit_ranking($info){

		$sql = "UPDATE `teams` SET `gp`='".$info['gp']."',`points`='".$info['points']."',`win`='".$info['win']."',`draw`='".$info['draw']."',`lost`='".$info['lost']."',`gf`='".$info['gf']."',`ga`='".$info['ga']."',`gd`='".((int)($info['gf'] - $info['ga']))."',`season`='".$info['season']."' WHERE `teamid`='".$info['teamid']."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function get_total_week($lid){

		$res = array();

		$sql = "SELECT `tweek` FROM `leagues` WHERE `leagueid`='$lid'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();			

			return $res[0]->tweek;

		}		

		

	}	

	

	public function get_top_scorer($lid){

		$res = array();

		$sql = "SELECT * FROM `players` WHERE `leagueid`='$lid' AND `goals`>0 order BY goals DESC, pgoals ASC";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

			if(count($res) > 0){

				foreach($res AS $v){

					$v->team_name = $this->get_team_name_by_id($v->teamid);

					$v->leauge_name = $this->get_league_name_by_id($v->leagueid);

				}

			}	

		}		

		return $res;

	}	

	

	public function get_scorer_info($scr_id){

		$res = array();

		$sql = "SELECT * FROM `players` WHERE `playerid`='$scr_id'";

		$f = $this->db->query($sql);

		if($f->num_rows() > 0){

			$res = $f->result();

		}		

		return $res;

	}

	

	public function add_new_scorer($info){

		$sql = "INSERT INTO `players` SET `name`='".mysql_real_escape_string($info['name'])."',`teamid`='".mysql_real_escape_string($info['teamid'])."',`leagueid`='".mysql_real_escape_string($info['leagueid'])."',`role`='".mysql_real_escape_string($info['role'])."',`goals`='".mysql_real_escape_string($info['goals'])."',`hgoals`='".mysql_real_escape_string($info['hgoals'])."',`agoals`='".mysql_real_escape_string($info['agoals'])."',`pgoals`='".mysql_real_escape_string($info['pgoals'])."',`season`='".mysql_real_escape_string($info['season'])."',`ycard`='".mysql_real_escape_string($info['ycard'])."',`rcard`='".mysql_real_escape_string($info['rcard'])."'";

		$f = $this->db->query($sql);

		$last_id = $this->db->insert_id();

		if($f) return $last_id;

	}

	

	public function edit_scorer($info){

		$sql = "UPDATE `players` SET `name`='".mysql_real_escape_string($info['name'])."',`teamid`='".mysql_real_escape_string($info['teamid'])."',`leagueid`='".mysql_real_escape_string($info['leagueid'])."',`role`='".mysql_real_escape_string($info['role'])."',`goals`='".mysql_real_escape_string($info['goals'])."',`hgoals`='".mysql_real_escape_string($info['hgoals'])."',`agoals`='".mysql_real_escape_string($info['agoals'])."',`pgoals`='".mysql_real_escape_string($info['pgoals'])."',`season`='".mysql_real_escape_string($info['season'])."',`ycard`='".mysql_real_escape_string($info['ycard'])."',`rcard`='".mysql_real_escape_string($info['rcard'])."' WHERE `playerid`='".$info['playerid']."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function delete_scorer($scr_id){

		$sql = "DELETE FROM `players` WHERE `playerid`='".$scr_id."'";

		$f = $this->db->query($sql);

		if($f) return TRUE;

	}

	

	public function get_league_lcl_time_diff($lid){

		$timediff = 0;

		switch($lid){

			case '1':

				$timediff = (5*3600);

			break;

			case '2':

				$timediff = (6*3600);

			break;

			case '3':

				$timediff = (5*3600);

			break;

			case '4':

				$timediff = (4*3600);

			break;

			case '5':

				$timediff = (4*3600);

			break;

			case '6':

				$timediff = (0.5*3600);

			break;

			case '7':

				$timediff = (5*3600);

			break;
			

			default:

				$timediff = 0;

		}

		return $timediff;

	}		

		

	

}