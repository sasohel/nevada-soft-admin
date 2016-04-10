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
						<h5>All active leagues</h5>
					  </header>
					  <div id="collapse4" class="body">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
						  <thead>
							<tr>
							  <th>League Id</th>
							  <th>Country</th>
							  <th>League Name</th>
							  <th title="Top Ranking">T.Ranking</th>
							  <th title="Top Scorer">T.Scorer</th>
							  <th>Key</th>
							  <th>Current Week</th>
							  <!--
							  <th>Edit</th>
							  <th>Delete</th>
							  -->
							</tr>
						  </thead>
						  <tbody>
							<?php 
							if(!empty($leagues) && count($leagues) > 0){
								foreach($leagues AS $k=>$val){
									?>
									<tr>
									  <td><?php echo $val->leagueid; ?></td>
									  <td><?php echo $val->country; ?></td>
									  <td><a href="<?php echo $base_url.'matches/'.$val->leagueid; ?>"><?php echo $val->name; ?></a></td>
									  <td><a href="<?php echo $base_url.'teamranking/'.$val->leagueid; ?>">Ranking</a></td>
									  <td><a href="<?php echo $base_url.'topscorer/'.$val->leagueid; ?>">T.Scorer</a></td>
									  <td><?php echo $val->key; ?></td>
									  <td><span class="ck"><?php echo $val->cweek; ?></span>
										<span class="upweeks hidden" data="<?php echo $val->leagueid; ?>">
											<input type="text" class="cweek" value="<?php echo $val->cweek; ?>"/>
											<input type="button" class="upweek" value="OK"/> <span class="xclose">X</span></span>
										</td>
									  <!--
									  <td><a href="<?php echo $base_url.'add' ?>">Edit</a></td>
									  <td><a href="<?php echo $base_url.'edit/'.$val->leagueid; ?>">Delete</a></td>
									  -->
									</tr>	
									<?php 
								}
							}
							else{
								?><tr><td colspan="7">There is no league</td></tr><?php 
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
    