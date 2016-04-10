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
								<label for="text1" class="control-label col-lg-4">Link</label>
								<div class="col-lg-4">
									<input type="text" id="link" name="link" placeholder="Enter youtube media link" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  
							  <div class="form-group">
								<label for="text1" class="control-label col-lg-4">Match ID</label>
								<div class="col-lg-4">
									<input type="text" id="match_id" name="match_id" placeholder="Enter match id" class="validate[required] form-control" value=""  required="required">
								</div>
							  </div><!-- /.form-group -->
							  <div class="form-group">
								<label class="control-label col-lg-4">&nbsp;</label>
								<div class="col-lg-3">
								  
									<input name="add_new_media" type="submit" class="btn btn-primary" value="Add Link"/>	&nbsp;&nbsp;							
									<a href="<?php echo $base_url.'media'; ?>" class="btn btn-primary">Back</a>	
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
    