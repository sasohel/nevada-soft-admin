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
						<h5><?php if(!empty($heading_title)) echo $heading_title; ?></h5> <?php if(isset($team_info[0]->name) && $team_info[0]->name !='') echo ' <span style="color:orangered; margin:10px 0 0 0; display: block"> [ Team name: <em><strong>'.$team_info[0]->name.'</strong></em> ]</span>'; ?>
					  </header>
					  <div id="collapse4" class="body">
						
						<?php 
						
							?>
							<form class="form-horizontal" action="" method="post">							  
							  <input type="hidden" name="leagueid" value="<?php if(!empty($lid)) echo $lid; ?>"/>
							  <input type="hidden" name="teamid" value="<?php if(isset($team_info[0]->teamid)) echo $team_info[0]->teamid; ?>"/>
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Game played</label>
								<div class="col-lg-4">
									<input type="text" id="gp" name="gp" placeholder="Enter gameplayed" class="validate[required] form-control" value="<?php if(isset($team_info[0]->gp)) echo $team_info[0]->gp; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Points</label>
								<div class="col-lg-4">
									<input type="text" id="points" name="points" placeholder="Enter points" class="validate[required] form-control" value="<?php if(isset($team_info[0]->points)) echo $team_info[0]->points; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Win</label>
								<div class="col-lg-4">
									<input type="text" id="win" name="win" placeholder="Enter win" class="validate[required] form-control" value="<?php if(isset($team_info[0]->win)) echo $team_info[0]->win; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							 
							 <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Draw</label>
								<div class="col-lg-4">
									<input type="text" id="draw" name="draw" placeholder="Enter draw" class="validate[required] form-control" value="<?php if(isset($team_info[0]->draw)) echo $team_info[0]->draw; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Lost</label>
								<div class="col-lg-4">
									<input type="text" id="lost" name="lost" placeholder="Enter lost" class="validate[required] form-control" value="<?php if(isset($team_info[0]->lost)) echo $team_info[0]->lost; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">GF</label>
								<div class="col-lg-4">
									<input type="text" id="gf" name="gf" placeholder="Enter gf" class="validate[required] form-control" value="<?php if(isset($team_info[0]->gf)) echo $team_info[0]->gf; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">GA</label>
								<div class="col-lg-4">
									<input type="text" id="ga" name="ga" placeholder="Enter ga" class="validate[required] form-control" value="<?php if(isset($team_info[0]->ga) ) echo $team_info[0]->ga; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Season</label>
								<div class="col-lg-4">
									<input type="text" id="season" name="season" placeholder="Enter gd" class="validate[required] form-control" value="<?php if(isset($team_info[0]->season) ) echo $team_info[0]->season; ?>"  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label class="control-label col-lg-4">&nbsp;</label>
								<div class="col-lg-3">								  
									<input name="edit_ranking" type="submit" class="btn btn-primary" value="Update Score"/>	&nbsp;&nbsp;
									<a href="<?php echo $base_url.'teamranking/'.$lid; ?>" class="btn btn-primary">Back</a>	
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
    