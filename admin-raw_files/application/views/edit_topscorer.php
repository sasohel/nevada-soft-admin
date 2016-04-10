	<?php $this->load->view('admin/admin_header'); ?>
	<?php $this->load->view('left_menu'); ?>
	  
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
						<h5><?php if(!empty($heading_title)) echo $heading_title; ?></h5><?php if(isset($scr_info[0]->name) && $scr_info[0]->name !='') echo ' <span style="color:orangered; margin:10px 0 0 0; display: block"> [ Player name: <em><strong>'.$scr_info[0]->name.'</strong></em> ]</span>'; ?>
					  </header>
					  <div id="collapse4" class="body">
						
						<?php 
						
							
							?>
							<form class="form-horizontal" action="" method="post">							  
							  <input type="hidden" name="leagueid" value="<?php if(!empty($lid)) echo $lid; ?>"/>
							  <input type="hidden" name="playerid" value="<?php if(isset($scr_info[0]->playerid)) echo $scr_info[0]->playerid; ?>"/>
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Name</label>
								<div class="col-lg-4">
									<input type="text" id="name" name="name" placeholder="Enter player name" class="validate[required] form-control" value="<?php if(isset($scr_info[0]->name) && !empty($scr_info[0]->name)) echo $scr_info[0]->name; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">League</label>
								<div class="col-lg-4">
									<select name="leagueid" id="leagueid" class="validate[required] form-control" required="required">
										<option value="">Choose a League</option>
										<?php 
										foreach($leagues as $v){
											?><option value="<?php echo $v->leagueid; ?>" <?php if($v->leagueid==$scr_info[0]->leagueid) echo 'selected="selected"'; ?>><?php echo $v->name; ?></option><?php 
										}
										?>
									</select>
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Team</label>
								<div class="col-lg-4">
									<select name="teamid" id="teamid" class="validate[required] form-control" required="required">
										<option value="">Choose a Team</option>
										<?php 
										foreach($teams as $v){
											?><option value="<?php echo $v->teamid; ?>" <?php if($v->teamid==$scr_info[0]->teamid) echo 'selected="selected"'; ?>><?php echo $v->sname; ?></option><?php 
										}
										?>
									</select>
								</div>
							  </div><!-- /.form-group -->
							  
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Role</label>
								<div class="col-lg-4">
									<input type="text" id="role" name="role" placeholder="Enter role" class="validate[required] form-control" value="<?php if(isset($scr_info[0]->role) && !empty($scr_info[0]->role)) echo $scr_info[0]->role; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Goals</label>
								<div class="col-lg-4">
									<input type="text" id="goals" name="goals" placeholder="Enter goals" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->goals) ? $scr_info[0]->goals : '0'; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Home Goals</label>
								<div class="col-lg-4">
									<input type="text" id="hgoals" name="hgoals" placeholder="Enter home goals" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->hgoals) ? $scr_info[0]->hgoals : $scr_info[0]->hgoals; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Away Goals</label>
								<div class="col-lg-4">									<input type="text" id="agoals" name="agoals" placeholder="Enter away goals" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->agoals) ? $scr_info[0]->agoals : '0'; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							   
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Penalty Goals</label>
								<div class="col-lg-4">
									<input type="text" id="pgoals" name="pgoals" placeholder="Enter penalty goals" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->pgoals) ? $scr_info[0]->pgoals : '0'; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							   
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Current Season</label>
								<div class="col-lg-4">
									<input type="text" id="season" name="season" placeholder="Enter season" class="validate[required] form-control" value="<?php if(isset($scr_info[0]->season) && !empty($scr_info[0]->season)) echo $scr_info[0]->season; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							   
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Yellow Card</label>
								<div class="col-lg-4">
									<input type="text" id="ycard" name="ycard" placeholder="Enter yellow cards" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->ycard) ? $scr_info[0]->ycard : '0'; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Red Card</label>
								<div class="col-lg-4">
									<input type="text" id="rcard" name="rcard" placeholder="Enter red cards" class="validate[required] form-control" value="<?php echo !empty($scr_info[0]->rcard) ? $scr_info[0]->rcard : '0'; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  
							  <div class="form-group">
								<label class="control-label col-lg-4">&nbsp;</label>
								<div class="col-lg-3">								  
									<input name="edit_scorer" type="submit" class="btn btn-primary" value="Update Scorer"/>	&nbsp;&nbsp;
									<a href="<?php echo $base_url.'topscorer/'.$lid; ?>" class="btn btn-primary">Back</a>	
								</div>
							  </div>
							  
						
							</form>
							<?php 
						
						?>
						
					  </div>
					</div>
				  </div>
				</div><!-- /.row -->

			  </div><!-- /.inner -->
			</div><!-- /.outer -->
		</div><!-- /#content -->
    
<?php $this->load->view('admin/admin_footer');
    