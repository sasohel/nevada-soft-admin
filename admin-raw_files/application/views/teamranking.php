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
						
							<table id="dataTable0" class="table table-bordered table-condensed table-hover table-striped">
							  <thead>
								<tr>
								  <th>#</th>
								  <th>Name</th>
								  <th>G.played</th>
								  <th>Points</th>
								  <th>Win</th>
								  <th>Lost</th>
								  <th>Drawn</th>
								  <th title="Goal Forward">GF</th>
								  <th title="Goal Against">GA</th>
								  <th title="Goal Difference">GD</th>
								  <th>Edit</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								if(!empty($ranking_teams) && count($ranking_teams) > 0){
									$c=1;
									foreach($ranking_teams AS $k=>$val){
										?>
										<tr>
										  <td><?php echo $c; ?></td>
										  <td><a href="<?php echo $base_url.'teams/edit/'.$val->teamid; ?>"><?php echo $val->sname; ?></a></td>
										  <td><?php echo $val->gp; ?></td>
										  <td><?php echo $val->points; ?></td>
										  <td><?php echo $val->win; ?></td>
										  <td><?php echo $val->lost; ?></td>
										  <td><?php echo $val->draw; ?></td>
										  <td><?php echo $val->gf; ?></td>
										  <td><?php echo $val->ga; ?></td>
										  <td><?php echo (int)($val->gf - $val->ga); ?></td>
										  <td><a href="<?php echo $base_url.'teamranking/'.$lid.'/edit/'.$val->teamid; ?>">Edit</a></td>
										  
										</tr>	
										<?php 
										$c++;
									}
									
								}else{
										?><tr><td colspan="8">There is no Teams</td></tr><?php 
									}
								?>
							  </tbody>
							</table>
							<br/><br/><a href="<?php echo $base_url; ?>" class="btn btn-primary">Back</a>
						
					  </div>
					</div>
				  </div>
				</div><!-- /.row -->

			  </div><!-- /.inner -->
			</div><!-- /.outer -->
		</div><!-- /#content -->
    
<?php $this->load->view('admin/admin_footer');
    