	<?php $this->load->view('admin/admin_header'); ?>

	<?php $this->load->view('left_menu'); ?>

		

		<link rel="stylesheet" type="text/css" href="<?php echo $base_url.'css/jquery.datetimepicker.css'; ?>"/>		

		<script src="<?php echo $base_url.'js/jquery.datetimepicker.js'; ?>"></script>

		

		<div id="content">

			<div class="outer">

			  <div class="inner bg-light lter">



				<!--Begin Datatables-->

				<div class="row">

				  <div class="col-lg-12">

					<div class="box">

					  <header>

						<div class="icons">

						  <i class="fa fa-table"></i>

						</div>

						<h5><?php if(!empty($league)) echo $league; ?></h5> 
						<a class="form-submit btn btn-primary button submit success"href="<?php echo $base_url.'matchdetail/lineup/'.$lid.'/'; if(!empty($matchid)) echo $matchid; ?>">Update Lineup</a>

					  </header>

					  <div id="collapse4" class="body">

						

						<div class="headpart">
							<?php if($mschedule[0]->second_leg){ ?>
							<div class="leg-status-cont left-float">
								<h4>First Leg Score</h4>
								<table>
									<tr><th>Team</th><th>Score</th></tr>
									<tr><td><?php if(!empty($mschedule[0]->hside)) echo $mschedule[0]->hside; ?></td><td><?php echo $mschedule[0]->hside_goal; ?></td></tr>
									<tr><td><?php if(!empty($mschedule[0]->aside)) echo $mschedule[0]->aside; ?></td><td><?php echo $mschedule[0]->aside_goal; ?></td></tr>
								</table>
							</div>
							<?php } ?>
							
							
							<input type="hidden" id="hsteam" value="<?php if(!empty($mschedule[0]->hside)) echo $mschedule[0]->hside; ?>"/>
							<input type="hidden" id="lid4p" value="<?php if(!empty($leagueid)) echo $leagueid; ?>"/>
							
							<input type="hidden" id="asteam" value="<?php if(!empty($mschedule[0]->aside)) echo $mschedule[0]->aside; ?>"/>
							
							<input type="hidden" id="fulltscore" value="<?php if(!empty($mschedule[0]->ftscore)) echo $mschedule[0]->ftscore; ?>"/>
							<input type="hidden" id="hsid" value="<?php if(isset($teams[0]->hside)) echo $teams[0]->hside; ?>"/>
							<input type="hidden" id="asid" value="<?php if(isset($teams[0]->aside)) echo $teams[0]->aside; ?>"/>
							
							<h5> <?php if(!empty($mschedule[0]->hside)) echo $mschedule[0]->hside; echo '<strong> Vs </strong>'; if(!empty($mschedule[0]->aside)) echo $mschedule[0]->aside; ?></h5><br/>

							

							<h5><?php if(!empty($mschedule[0]->ldate)) echo 'Date: '. @date("d M Y h:i:s A", strtotime($mschedule[0]->ldate)+($timediff)); ?> </h5><br/>

							

							<div class="scoreline">

									<span>Half Time</span>

									<h4 class="half_time_score"><strong><?php if(!empty($mschedule[0]->htscore)) echo $mschedule[0]->htscore; ?></strong></h4>

									

									<span >Full Time</span>

									<h4 class="full_tme_score"><strong><?php if(!empty($mschedule[0]->ftscore)) echo $mschedule[0]->ftscore; ?> </strong></h4>

							</div>

						</div><br/>

						<div class="status-cont">

							<label>Status</label>

							<span><?php if(!empty($mschedule[0]->status_title)) echo '<em>'.$mschedule[0]->status_title.'</em>';  ?></span>

							<span class="changestatus">Change</span>

							

							<div class="statusfrm hidden">

								<input type="hidden" id="matchid" value="<?php echo $mschedule[0]->matchid; ?>"/>

								<input id="change_time" class="datetimepicker hidden" type="text" name="change_time" value="" placeholder="Date & Time"/> 
								<input id="custom_time2" class="datetimepicker hidden" type="text" name="custom_time2" value="" placeholder="Enter custom time"/>
								<select id="custom_time" class=" hidden" type="text" name="custom_time" value="" placeholder="Enter Time">
									<option value=""><?php echo ' scheduled time'; ?></option>
                                    <option value="0"><?php echo ' Just now (0 Munites ago)'; ?></option>
                                    <option value="30"><?php echo ' 30 sec later'; ?></option>
									<?php 
									for($i = 1; $i < 6; $i++){
										?><option value="<?php echo $i; ?>"><?php echo $i.' min ago'; ?></option><?php 
									}
									?>
									<option value="custom">Custom</option>
								</select>
                                
                                <!-- custom_time select box for 'second half kickoff'  -->
                                <select id="custom_time_sf" class=" hidden" type="text" name="custom_time" value="" placeholder="Enter Time">
                                    <option value="0"><?php echo ' Now'; ?></option>
                                    <option value="30"><?php echo ' 30 sec ago'; ?></option>
									<?php 
									for($i = 1; $i < 6; $i++){
										?><option value="<?php echo $i; ?>"><?php echo $i.' min ago'; ?></option><?php 
									}
									?>
									<option value="custom">Custom</option>
								</select>

								<select name="status" id="status" class="" required>

									<option value="">Choose a Status</option>

									<?php 

									foreach($mstatus as $v){

										?><option value="<?php echo $v->status_id; ?>"><?php echo $v->title; ?></option><?php 

									}

									?>

								</select>

								<input type="button" id="change_status" value="Update"/>

							</div>

							

						</div>	

						

						<?php 

						if(!empty($action) && $action=='edit' && !empty($maction)){

							

							?>

							<form class="form-horizontal" action="" method="post">

								<input type="hidden" name="cmatchid" value="<?php if(!empty($matchid)) echo $matchid; ?>"/>
								<input type="hidden" name="mactionid" value="<?php if(isset($maction[0]->id) && is_numeric($maction[0]->id)) echo $maction[0]->id; ?>"/>
								
									
									
							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Time (Munite)</label>

								<div class="col-lg-4">

									<input type="text" name="time_munite" id="time_munite" placeholder="Time (Munite)" class="validate[required] form-control" value="<?php if(!empty($maction[0]->time)) echo $maction[0]->time; ?>">

								</div>

							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Action</label>

								<div class="col-lg-4">

									<select name="action" class="validate[required] form-control">

										<option value="">Choose action</option>

										<option value="g" <?php if(isset($maction[0]->action) && $maction[0]->action=='g') echo 'selected="selected"'; ?>>Goal</option>

										<option value="yc"> <?php if(isset($maction[0]->action) && $maction[0]->action=='yc') echo 'selected="selected"'; ?>Yellow Card</option>

										<option value="rc" <?php if(isset($maction[0]->action) && $maction[0]->action=='rc') echo 'selected="selected"'; ?>>Red Card</option>

										<option value="2yr" <?php if(isset($maction[0]->action) && $maction[0]->action=='2yr') echo 'selected="selected"'; ?>>Two Yellow Card (Red)</option>

										<option value="p" <?php if(isset($maction[0]->action) && $maction[0]->action=='p') echo 'selected="selected"'; ?>>Goal (Penalty)</option>

										<option value="pm" <?php if(isset($maction[0]->action) && $maction[0]->action=='pm') echo 'selected="selected"'; ?>>Penalty Miss</option>
										
										<option value="st" <?php if(isset($maction[0]->action) && $maction[0]->action=='st') echo 'selected="selected"'; ?>>Substitute</option>

										

										

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  
                                <!-- Player -->
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Player</label>
								<div class="col-lg-4">
                                    <select name="player" id="player" class="validate[required] form-control">
                                        <?php foreach($players as $k => $v){ ?>
                                        <option value="<?php echo $k; ?>" <?php if($maction[0]->player == $k){ ?> selected <?php } ?> > <?php echo $v; ?> </option>
                                        <?php } ?>
                                    </select>
								</div>
							  </div><!-- /.form-group -->
                              
                              
                              <!-- Assist Player -->
                              <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Assist player</label>
								<div class="col-lg-4">
                                    <select name="assist_player" id="assist_player" class="validate[required] form-control">
                                        <?php foreach($players as $k => $v){ ?>
                                        <option value="<?php echo $k; ?>" <?php if($maction[0]->assist_player == $k){ ?> selected <?php } ?> > <?php echo $v; ?> </option>
                                        <?php } ?>
                                    </select>
								</div>
							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Action Team</label>

								<div class="col-lg-4">
									
									
									<select name="action_for" id="action_for" class="validate[required] form-control">

										<option value="">Choose action Team</option>

										<option value="<?php if(isset($teams[0]->hside)) echo $teams[0]->hside; ?>" <?php if(isset($maction[0]->actionfor) && $maction[0]->actionfor==$teams[0]->hside) echo 'selected="selected"'; ?>>

											<?php if(isset($teams[0]->hside_title)) echo $teams[0]->hside_title; ?>

										</option>

										<option value="<?php if(isset($teams[0]->aside)) echo $teams[0]->aside; ?>" <?php if(isset($maction[0]->actionfor) && $maction[0]->actionfor==$teams[0]->aside) echo 'selected="selected"'; ?>>

											<?php if(isset($teams[0]->aside_title)) echo $teams[0]->aside_title; ?>

										</option>

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">Half time score</label>

								<div class="col-lg-3">

									<input name="halftime_score" type='text' class="form-control" value="<?php if(!empty($maction[0]->htscore)){ echo $maction[0]->htscore; } ?>" />								  

								</div>

							  </div>

							 

							  <div class="form-group">

								<label class="control-label col-lg-4">Full time score</label>

								<div class="col-lg-3">

									<input name="fulltime_score" type='text' class="form-control" value="<?php if(!empty($maction[0]->scorecard)){ echo $maction[0]->scorecard; } ?>" />

								</div>

							  </div>

							  

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">&nbsp;</label>

								<div class="col-lg-3">

									<input name="match_action_submit" type="submit" class="btn btn-primary" value="Update"/>

									<a href="<?php echo $base_url.'matchdetail/'.$lid.'/'; if(!empty($matchid)) echo $matchid; ?>" class="btn btn-primary">Back</a>	

								</div>

							  </div>

							  

						

							</form>

							<?php 

						}

						else{

							?>

							<form action="" method="post" class="add_maction">

								<table>

									<tr>

										<td>

											<input type="hidden" id="cmatchid" name="cmatchid" value="<?php if(!empty($matchid)) echo $matchid; ?>"/>

											<input type="hidden" id="mactionid" name="mactionid" value="<?php if(isset($matchid) && is_numeric($matchid)) echo $matchid; ?>"/>

											<input type="hidden" id="timediff" name="timediff" value="<?php if(isset($timediff) && is_numeric($timediff)) echo $timediff; ?>"/>

											<input required="required" type="text" id="time_munite" name="time_munite" placeholder="Time (Munite)" class="validate[required] form-control " value="">

										</td>

										<td>

											<select required="required" name="action" id="action" class="validate[required] form-control">

												<option value="">Choose action</option>

												<option value="g">Goal</option>
												<option value="og">Own Goal</option>
												<option value="yc">Yellow Card</option>

												<option value="rc">Red Card</option>

												<option value="2yr">Two Yellow Card (Red)</option>

												<option value="p">Goal (Penalty)</option>

												<option value="pm">Penalty Miss</option>
												
												<option value="st">Substitute</option>
												

											</select>

										</td>

										<td>

											<select required="required" name="action_for" id="action_for" class="validate[required] form-control">

												<option value="">Choose action Team</option>

												<option value="<?php if(isset($teams[0]->hside)) echo $teams[0]->hside; ?>">

													<?php if(isset($teams[0]->hside_title)) echo $teams[0]->hside_title; ?>

												</option>

												<option value="<?php if(isset($teams[0]->aside)) echo $teams[0]->aside; ?>">

													<?php if(isset($teams[0]->aside_title)) echo $teams[0]->aside_title; ?>

												</option>

											</select>

										</td>

										<td>
											<select required="required" type="text" name="player" id="player" value="" placeholder="Player name">
												<option value="">Goal Scorer</option>
											</select>
										</td>

										<td>
											<select title="Assist by" type="text" name="assist_by" id="assist_by" value="" placeholder="Assist By">
												<option value="">Assist By</option>
											</select>
										</td>

										

										

										<input required="required" name="halftime_score" id="halftime_score" type='hidden' class="" value="<?php if(!empty($mschedule[0]->htscore)) echo $mschedule[0]->htscore; ?>"/>

										

										<input required="required" name="fulltime_score" id="fulltime_score" type='hidden' class="" value="<?php if(!empty($mschedule[0]->ftscore)) echo $mschedule[0]->ftscore; ?>"/>

										

										

										<td><input id="add_new_maction" name="match_action_add" type="submit" class="btn btn-primary" value="Add"/> </td> 

									</tr>

								</table>

							</form>

							

							<table id="dataTable" class="record-table table table-bordered table-condensed table-hover table-striped">

							  <thead>

								<tr>

								  <th>Time (Munite)</th>

								  <th>Player</th>

								  <th>Action</th>

								  <th>Team</th>

								  <th>Half time score</th>

								  <th>Full time score</th>

								  <th>Edit</th>

								  <th>Delete</th>

								</tr>

							  </thead>

							  <tbody>

								<?php 

								if(!empty($mdetails) && count($mdetails) > 0){

									foreach($mdetails AS $k=>$val){

										?>

										<tr>

										  <td><?php echo $val->time; ?></td>

										  <td><?php echo $val->player_name; if(!empty($val->assist_player_name)) echo ' &#9650;  '.$val->assist_player_name.' &#9660;'; ?></td>

										  <td><span title="<?php echo $val->action; ?>" class="action-symbol <?php if($val->action == '2yr') { echo 'yr2'; }else { echo $val->action; } ?>">&nbsp;</span></td>

										  <td><?php echo $val->actionfor; ?></td>

										  <td><?php echo $val->htscore; ?></td>

										  <td><?php echo $val->scorecard; ?></td>

										  <td><a href="<?php echo $base_url.'matchdetail/'.$lid.'/'.$mschedule[0]->matchid.'/edit/'.$val->id ?>">Edit</a></td>

										  <td><a onclick="return delConfirmation();" href="<?php echo $base_url.'matchdetail/'.$lid.'/'.$mschedule[0]->matchid.'/delete/'.$val->id; ?>">Delete</a></td>

										</tr>	

										<?php 

									}

								}

								?>

							  </tbody>

							</table>

							<br/><br/><a class="btn btn-primary" href="<?php echo $base_url.'matches/'.$lid; ?>">Back</a>

							<?php 

						}

						?>

						

						

						

						

						

						

						

					  </div>

					</div>

				  </div>

				</div><!-- /.row -->



			  </div><!-- /.inner -->

			</div><!-- /.outer -->

		</div><!-- /#content -->

		<script>

			jQuery('.datetimepicker').datetimepicker({ format:'Y-m-d H:i:s' });

		</script>

<?php $this->load->view('admin/admin_footer');

    