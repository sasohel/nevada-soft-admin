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
							<a href="<?php echo $base_url.'media/add'; ?>" class="btn button btn btn-primary">Add Link</a>
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
							  <thead>
								<tr>
								  <th>Link</th>
								  <th>Match ID</th>
								  <th>Edit</th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								if(!empty($media) && count($media) > 0){
									foreach($media AS $k=>$val){
										?>
										<tr>
										  <td><a href="<?php echo $val->link; ?>" target="_blank"><?php echo $val->link; ?></td>
										  <td><?php echo $val->match_id; ?></td>										  
										  <td><a href="<?php echo $base_url.'media/edit/'.$val->id ?>">Edit</a></td>
										  <td><a onclick="return delConfirmation();" href="<?php echo $base_url.'media/delete/'.$val->id; ?>">Delete</a></td>
										</tr>	
										<?php 
									}
								}else{
										?><tr><td colspan="8">There is no media links</td></tr><?php 
									}
								?>
							  </tbody>
							</table>
							
						
					  </div>
					</div>
				  </div>
				</div><!-- /.row -->

			  </div><!-- /.inner -->
			</div><!-- /.outer -->
		</div><!-- /#content -->
    
<?php $this->load->view('admin/admin_footer');
    