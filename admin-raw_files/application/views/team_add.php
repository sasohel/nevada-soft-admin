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
						<h5><?php if(!empty($heading_title)) echo $heading_title; ?></h5>
					  </header>
					  <div id="collapse4" class="body">
						<input type="hidden" name="leagueid" value="<?php if(!empty($lid)) echo $lid; ?>"/>
						<?php 
						
							
							?>
							<form class="form-horizontal" action="" method="post">							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">League</label>
								<div class="col-lg-4">
									<select name="league" id="league" class="validate[required] form-control" required="required">
										<option value="">Choose a League</option>
										<?php 
										foreach($leagues as $v){
											?><option value="<?php echo $v->leagueid; ?>"><?php echo $v->name; ?></option><?php 
										}
										?>
									</select>
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Name</label>
								<div class="col-lg-4">
									<input type="text" id="team_name" name="team_name" placeholder="Team name" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Short Name</label>
								<div class="col-lg-4">
									<input type="text" id="short_name" name="short_name" placeholder="Short name" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Key</label>
								<div class="col-lg-4">
									<input type="text" id="key" name="key" placeholder="Key" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Home ground</label>
								<div class="col-lg-4">
									<input type="text" id="home_ground" name="home_ground" placeholder="Home ground" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label class="control-label col-lg-4">&nbsp;</label>
								<div class="col-lg-3">
								  
									<input name="add_new_team" type="submit" class="btn btn-primary" value="Add Team"/>	&nbsp;&nbsp;							
									<a href="<?php echo $base_url.'teams'; ?>" class="btn btn-primary">Back</a>	
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
    