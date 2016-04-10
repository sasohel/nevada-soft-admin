	<?php $this->load->view('admin/admin_header'); ?>	<?php $this->load->view('left_menu'); ?>	  	  <link rel="stylesheet" type="text/css" href="<?php echo $base_url.'css/jquery.datetimepicker.css'; ?>"/>				<script src="<?php echo $base_url.'js/jquery.datetimepicker.js'; ?>"></script>				<div id="content">			<div class="outer">			  <div class="inner bg-light lter">				<!--Begin Datatables-->				<div class="row">				  <div class="col-lg-12">					<div class="box">					  <header>						<div class="icons">						  <i class="fa fa-table"></i>						</div>						<h5><?php if(!empty($heading_title)) echo $heading_title; ?></h5>					  </header>					  <?php 					  if($message){ foreach($message AS $v){ ?><div class="error .bg-green"><?php echo $v; ?></div><?php } }					  if($errors){ foreach($errors AS $v){ ?><div class="error .dk"><?php echo $v; ?></div><?php } }					  					  ?>					  					  <div id="collapse4" class="body">						<input type="hidden" name="leagueid" value="<?php if(!empty($lid)) echo $lid; ?>"/>						<?php 							if(!empty($match_lineup) && is_array($match_lineup)){ ?>							<h2><center>Update Lineup</center></h2>														<form class="form-horizontal" action="" method="post">							  								<input type="hidden" name="matchid" value="<?php  if(!empty($matchid)) echo $matchid;  ?>"/>								<?php 								$home_pids = array();								$home_sts = array();								for($i=1;$i<12;$i++){									$key = 'hp'.$i;									$stk = 'hs'.$i;									if(isset($match_lineup[$key])) $home_pids[] = $match_lineup[$key];									if(isset($match_lineup[$stk])) $home_sts[] = $match_lineup[$stk];								}																$away_pids = array();								$away_sts = array();								for($i=1;$i<12;$i++){									$key = 'ap'.$i;										$stk = 'as'.$i;									if(isset($match_lineup[$key])) $away_pids[] = $match_lineup[$key];									if(isset($match_lineup[$stk])) $away_sts[] = $match_lineup[$stk];								}																?>																<div class="col-md-6">									<div class="form-group">									<label for="text1" class="control-label col-lg-4">Stadium</label>									<div class="col-lg-4">									<input type="text" id="stadium" name="stadium" placeholder="Stadium" class="validate[required] form-control" value="<?php if($match_lineup['stadium']) echo $match_lineup['stadium']; ?>"  required="required">									</div>									</div><!-- /.form-group -->								</div>																<div class="col-md-6">									<div class="form-group">									<label for="text1" class="control-label col-lg-4">Referee</label>									<div class="col-lg-4">										<input type="text" id="referee" name="referee" placeholder="Refree" class="validate[required] form-control" value="<?php if($match_lineup['referee']) echo $match_lineup['referee']; ?>"  required="required">									</div>									</div><!-- /.form-group -->								</div>																								<div class="col-md-6"><h3>Home Side</h3></div>								<div class="col-md-6"><h3>Away Side</h3></div>								<div class="col-md-3">									<?php 									$cnt = 1;									foreach($home_players as $k => $v){																										$selected = '';										if(in_array($k,$home_pids))											$selected = ' checked ';											?>										<div class="player-name-cont">										<?php echo '<span class="sl">'.$cnt.'</span>'; ?>&nbsp;<input class="chkbox home_players" type="checkbox" name="hp[]" value="<?php echo $k; ?>" <?php echo $selected; ?> /> &nbsp; <?php echo $v;?>																				</div>										<?php										$cnt++;									}									?>								</div>								<div class="col-md-3">									<?php 									$cnt = 1;									foreach($home_players as $k => $v){																										$selected = '';										if(in_array($k,$home_sts))											$selected = ' checked ';											?>										<div class="player-name-cont">										<?php echo '<span class="sl">'.$cnt.'</span>'; ?>&nbsp;<input class="chkbox home_players" type="checkbox" name="hs[]" value="<?php echo $k; ?>" <?php echo $selected; ?> /> &nbsp; <?php echo $v;?>																				</div>										<?php										$cnt++;									}									?>								</div>								<div class="col-md-3">									<?php 									$cnt = 1;									foreach($away_players as $k => $v){																										$selected = '';										if(in_array($k,$away_pids))											$selected = ' checked ';											?>										<div class="player-name-cont">										<?php echo '<span class="sl">'.$cnt.'</span>'; ?>&nbsp;<input class="chkbox home_players" type="checkbox" name="ap[]" value="<?php echo $k; ?>" <?php echo $selected; ?> /> &nbsp; <?php echo $v;?>																				</div>										<?php										$cnt++;									}									?>								</div>								<div class="col-md-3">									<?php 									$cnt = 1;									foreach($away_players as $k => $v){																										$selected = '';										if(in_array($k,$away_sts))											$selected = ' checked ';											?>										<div class="player-name-cont">										<?php echo '<span class="sl">'.$cnt.'</span>'; ?>&nbsp;<input class="chkbox home_players" type="checkbox" name="as[]" value="<?php echo $k; ?>" <?php echo $selected; ?> /> &nbsp; <?php echo $v;?>																				</div>										<?php										$cnt++;									}									?>								</div>																				 							  							  <div class="form-group">								<label class="control-label col-lg-4">&nbsp;</label>								<div class="col-lg-3">								  <div name="match-time" class='input-group date' id='datetimepicker4'>									<input name="update_lineup" type="submit" class="btn btn-primary" value="Update Lineup"/>&nbsp;&nbsp;																	  </div>								</div>							  </div>							  													</form>							<?php } else { ?>								<h3>There is no correct schedule for this match. </h3>								<a href="<?php echo $base_url.'matchdetail/'.$lid.'/'.$matchid; ?>" class="btn btn-primary">Back</a>							<?php } ?>					  </div>					</div>				  </div>				</div><!-- /.row -->			  </div><!-- /.inner -->			</div><!-- /.outer -->		</div><!-- /#content -->		<script>			jQuery('.datetimepicker').datetimepicker({ format:'Y-m-d H:i:s' });		</script><?php $this->load->view('admin/admin_footer');    