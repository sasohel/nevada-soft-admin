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
						
							<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
							  <thead>
								<tr>
								  <th>Name</th>
								  <th>Short name</th>
								  <th>Key</th>
								  <th>Home ground</th>
								  <th>Edit</th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								if(!empty($teams) && count($teams) > 0){
									foreach($teams AS $k=>$val){
										?>
										<tr>
										  <td><?php echo $val->name; ?></td>
										  <td><?php echo $val->sname; ?></td>
										  <td><?php echo $val->key; ?></td>
										  <td><?php echo $val->stadium; ?></td>
										  <td><a href="<?php echo $base_url.'teams/edit/'.$val->teamid ?>">Edit</a></td>
										  <td><a onclick="return delConfirmation();" href="<?php echo $base_url.'teams/delete/'.$val->teamid; ?>">Delete</a></td>
										</tr>	
										<?php 
									}
									
								}else{
										?><tr><td colspan="8">There is no Teams</td></tr><?php 
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
    