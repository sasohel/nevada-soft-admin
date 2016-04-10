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

					  </header>

					  <div id="collapse4" class="body">

						

						<?php 

						if(!empty($action) && $action=='edit' && !empty($mdata)){

							

							?>

							<form class="form-horizontal" action="" method="post">

							  <input type="hidden" name="leagueid" value="<?php if(!empty($lid)) echo $lid; ?>"/>

								<input type="hidden" name="timediff" value="<?php if(!empty($timediff)) echo $timediff; ?>"/>

							  <input type="hidden" name="matchid" value="<?php if(isset($mdata[0]->matchid) && is_numeric($mdata[0]->matchid)) echo $mdata[0]->matchid; ?>"/>

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">League</label>

								<div class="col-lg-4">

									<select name="league" id="league" class="validate[required] form-control">

										<option value="">Choose a League</option>

										<?php 

										foreach($leagues as $v){

											?><option value="<?php echo $v->leagueid; ?>" <?php if($v->leagueid == $mdata[0]->leagueid) echo 'selected="selected"'; ?>><?php echo $v->name; ?></option><?php 

										}

										?>

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Season</label>

								<div class="col-lg-4">

									<input type="text" id="season" name="season" placeholder="Season" class="validate[required] form-control" value="<?php if(!empty($mdata[0]->season)) echo $mdata[0]->season; ?>">

								</div>

							  </div><!-- /.form-group -->

							  

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Week</label>

								<div class="col-lg-4">

									<select name="week" id="week" class="validate[required] form-control">

										<option value="">Choose a week</option>

										<?php 

										if(isset($tweek) && !empty($tweek)){

											for($i=1; $i<=$tweek; $i++){

												?><option value="<?php echo $i; ?>" <?php if( isset($mdata[0]->week) && ($i == $mdata[0]->week)) echo 'selected="selected"'; ?>>Week <?php echo $i; ?></option><?php 

											}

										}

										?>

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Home side</label>

								<div class="col-lg-4">

									

									<select name="home" id="home" class="validate[required] form-control">

										<option value="">Choose a Team</option>

										<?php 

										foreach($teams as $v){

											?><option value="<?php echo $v->teamid; ?>" <?php if($v->teamid == $mdata[0]->hside) echo 'selected="selected"'; ?>><?php echo $v->sname; ?></option><?php 

										}

										?>

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  <div class="form-group">

								<label for="text1" class="control-label col-lg-4">Away side</label>

								<div class="col-lg-4">

									<select name="away" id="away" class="validate[required] form-control">

										<option value="">Choose a Team</option>

										<?php 

										foreach($teams as $v){

											?><option value="<?php echo $v->teamid; ?>" <?php if($v->teamid == $mdata[0]->aside) echo 'selected="selected"'; ?>><?php echo $v->name; ?></option><?php 

										}

										?>

									</select>

								</div>

							  </div><!-- /.form-group -->

							  

							  <?php if(0){ ?>

							  <div class="form-group">

								<label class="control-label col-lg-4" for="dp3">Local Date</label>

								<div class="col-lg-4">

								  <div class="input-group input-append date" id="dp3">

									<input name="local_date" class="form-control datetimepicker" type="text" value="<?php if(!empty($mdata[0]->ldate)){ echo $mdata[0]->ldate; } ?>">

									<span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>

								  </div>

								</div>

							  </div><!-- /.form-group -->

							  <?php } ?>

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">Match Time</label>

								<div class="col-lg-4">

								  <div name="match-time" class='input-group date' id='datetimepicker4'>

									<input name="match_started" type='text' class="form-control datetimepicker" value="<?php if(!empty($mdata[0]->ldate)){ echo @date("Y-m-d H:i:s", @strtotime($mdata[0]->ldate)+$timediff); } ?>" />

									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>

									</span>

								  </div>

								</div>

							  </div>

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">Second half started at</label>

								<div class="col-lg-4">

								  <div name="secondhalf-started" class='input-group date' id='datetimepicker4'>

									<input name="second_half_started" type='text' class="form-control datetimepicker" value="<?php if(!empty($mdata[0]->second_half)){ echo @date("Y-m-d H:i:s", @strtotime($mdata[0]->second_half)+(6*3600)); } ?>" />

									<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>

									</span>

								  </div>

								</div>

							  </div>

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">Half time score</label>

								<div class="col-lg-4">

									<input name="halftime_score" type='text' class="form-control" value="<?php if(!empty($mdata[0]->htscore)){ echo $mdata[0]->htscore; } ?>" />

								</div>

							  </div>
							  
							  <div class="form-group">

								<label class="control-label col-lg-4">Media Link</label>

								<div class="col-lg-4">

									<input name="media_link" type='text' class="form-control" value="<?php if(!empty($mdata[0]->media_link)){ echo $mdata[0]->media_link; } ?>" />

								</div>

							  </div>
							  
							  

							 

							 

							 <?php 

							  ?>

							  <div class="form-group">

								<label class="control-label col-lg-4">Full time score</label>

								<div class="col-lg-3">

									<input name="fulltime_score" type='text' class="form-control" value="<?php if(!empty($mdata[0]->ftscore)){ echo $mdata[0]->ftscore; } ?>" />	

								</div>

							  </div>

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">Match Status</label>

								<div class="col-lg-3">

								  <div name="status" class='input-group date' id='datetimepicker4'>

									<select name="status" id="sport2" class="validate[required] form-control">

										<option value="">Choose a Status</option>

										<?php 

										foreach($mstatus as $v){

											?><option value="<?php echo $v->status_id; ?>" <?php if($v->status_id == $mdata[0]->status) echo 'selected="selected"'; ?>><?php echo $v->title; ?></option><?php 

										}

										?>

									</select>

									

								  </div>

								</div>

							  </div>

							  

							  <div class="form-group">

								<label class="control-label col-lg-4">&nbsp;</label>

								<div class="col-lg-3">

								  <div name="match-time" class='input-group date' id='datetimepicker4'>

									<input name="match-submit" type="submit" class="btn btn-primary" value="Update"/>&nbsp;&nbsp;								

									<a href="<?php echo $base_url.'matches/'.$lid; ?>" class="btn btn-primary">Back</a>								

								  </div>

								</div>

							  </div>

							  

						

							</form>

							<?php 

						}

						else{

							

							?>

							<ul class="tab-cont">

								<li class="matchtable sch active">Scheduled Match</li>

								<li class="matchtable cpl">Completed Match</li>

							</ul>

							

							<div class="match-cont scheduled">							

								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">

								  <thead>

									<tr>

									  <th>Match Id</th>

									  <th>Season</th>

									  <th>Week</th>

									  <th>Teams</th>									  

									  <th title="Bangladesh standard date and time">Date</th>

									  <th>Status</th>

									  <th>Edit</th>

									  <th>Delete</th>

									</tr>

								  </thead>

								  <tbody>

									<?php 

									if(!empty($smatches) && count($smatches) > 0){

										foreach($smatches AS $k=>$val){

											?>

											<tr>

											  <td><?php echo $val->matchid; ?></td>

											  <td><?php echo $val->season; ?></td>

											  <td><?php echo $val->week; ?></td>

											  <td><a href="<?php echo $base_url.'matchdetail/'.$lid.'/'.$val->matchid; ?>"><?php echo $val->hside.' <strong>Vs</strong> '.$val->aside; ?></a></td>											  

											  <td><?php echo @date("d M Y H:i:s", (strtotime($val->ldate)+($timediff))); ?></td>

											  <td><?php echo $val->status; ?></td>

											  <td><a href="<?php echo $base_url.'matches/'.$lid.'/edit/'.$val->matchid ?>">Edit</a></td>

											  <td><a onclick="return delConfirmation();" href="<?php echo $base_url.'matches/'.$lid.'/delete/'.$val->matchid; ?>">Delete</a></td>

											</tr>	

											<?php 

										}

										

									}else{

											?><tr><td colspan="8">There is no Match</td></tr><?php 

										}

									?>

								  </tbody>

								</table>

							</div>

							

							<div class="match-cont completed hidden">

								<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">

								  <thead>

									<tr>

									  <th>Match Id</th>

									  <th>Season</th>

									  <th>Week</th>

									  <th>Teams</th>

									  <th>Date</th>

									  <th>Status</th>

									  <th>Half time Score</th>

									  <th>Full time Score</th>

									  <th>Edit</th>

									  <th>Delete</th>

									</tr>

								  </thead>

								  <tbody>

									<?php 

									if(!empty($cmatches) && count($cmatches) > 0){

										

										foreach($cmatches AS $k=>$val){

											?>

											<tr>

											  <td><?php echo $val->matchid; ?></td>

											  <td><?php echo $val->season; ?></td>

											  <td><?php echo $val->week; ?></td>

											  <td><?php echo $val->hside.' <strong>Vs</strong> '.$val->aside; ?></td>

											  <td><?php echo @date("d M Y H:i:s", (strtotime($val->utc)+($timediff))); ?></td>

											  <td><?php echo $val->status; ?></td>

											  <td><?php echo $val->hscore; ?></td>

											  <td><?php echo $val->fscore; ?></td>

											  <td><a href="<?php echo $base_url.'matches/'.$lid.'/edit/'.$val->matchid ?>">Edit</a></td>

											  <td><a onclick="return delConfirmation();" href="<?php echo $base_url.'matches/'.$lid.'/delete/'.$val->matchid; ?>">Delete</a></td>

											</tr>	

											<?php 

										}

										

									}else{

											?><tr><td colspan="8">There is no Match</td></tr><?php 

										}

									?>

								  </tbody>

								</table>

							</div>

							

							

							

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

			jQuery('.datetimepicker2').datetimepicker({ format:'Y-m-d H:i:s' });

			

		</script>

		

<?php $this->load->view('admin/admin_footer');

    