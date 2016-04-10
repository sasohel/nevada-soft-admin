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
							
							<a href="<?php echo $base_url.'topscorer/'.$lid.'/add'; ?>" class="btn btn-primary">Add Scorer</a><br/><br/>
							<table id="dataTable0" class="table table-bordered table-condensed table-hover table-striped">
							  <thead>
								<tr>
								  <th>#</th>
								  <th>Name</th>
								  <th>Team</th>								  
								  <th>Season</th>
								  <th>Goals</th>
								  <th title="Home Goals">HG</th>
								  <th title="Away Goals">AG</th>
								  <th title="Penalty Goals">PG</th>
								  <th title="Yellow Cards">YC</th>
								  <th title="Red Cards">RC</th>
								  <th>Edit</th>
								  <th>Delete</th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								if(!empty($scorers) && count($scorers) > 0){
									$c = 1;
									$pgoal = 0;
									
									foreach($scorers AS $k=>$val){																				
										if($pgoal != $val->goals){
											$rank = $c;
											$pgoal = $val->goals;
										}
										?>
										<tr>
										  <td><?php echo $rank; ?></td>
										  <td><?php echo $val->name; ?></td>
										  <td><?php echo $val->team_name; ?></td>										  
										  <td><?php echo $val->season; ?></td>
										  <td><?php echo $val->goals; ?></td>
										  <td><?php echo $val->hgoals; ?></td>
										  <td><?php echo $val->agoals; ?></td>
										  <td><?php echo $val->pgoals; ?></td>
										  <td><?php echo $val->ycard; ?></td>
										  <td><?php echo $val->rcard; ?></td>
										  <td><a title="Edit record" href="<?php echo $base_url.'topscorer/'.$lid.'/edit/'.$val->playerid; ?>">Edit</a></td>
										  <td><a title="Delete record" onclick="return delConfirmation();" href="<?php echo $base_url.'topscorer/'.$lid.'/delete/'.$val->playerid; ?>">Delete</a></td>
										</tr>	
										<?php 
										$c++;
									}
									
								}else{
										?><tr><td colspan="8">There is no Players</td></tr><?php 
									}
								?>
							  </tbody>
							</table>
							
							<br/><a href="<?php echo $base_url; ?>" class="btn btn-primary">Back</a>
							
						
					  </div>
					</div>
				  </div>
				</div><!-- /.row -->

			  </div><!-- /.inner -->
			</div><!-- /.outer -->
		</div><!-- /#content -->
    
<?php $this->load->view('admin/admin_footer');
    