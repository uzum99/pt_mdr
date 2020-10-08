		<section class="content-header">
          <h1>
            <?= $pageTitle?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= site_url();?>/admin"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?= site_url();?>/<?= $breadcrumbLink?>"><?= $breadcrumbTitle?></a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
				  <button class="btn btn-primary btn-flat">
					<a href="<?= site_url();?>/<?= $saveLink?>">
						<i class="fa fa-plus"></i>&nbsp; Add new data
					</a>
					</button>
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table class="table  table-hover table-heading datatable table-condensed" >
				
				<?php
										if(!empty($render))
										{
										?>
                                            <thead>
                                                <tr>
													<th class="text-center">No.</th>
												<?php
												foreach($tableHeader as $row)
												{
												?> 
													<th class="text-center"><?= $row?></th>
												<?php
												}
												?>
													<th class="text-center">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
											$i=1;
											
											foreach($render->result() as $row)
											{ 											
											?>
                                                <tr>
													<td class="text-center"><?= $i?>.</td>
													<?php
													$pid=$row->$primaryKey;
													
													?>
														<td ><img src="<?= base_url()."assets/img/avatar/thumb/".$row->ava?>" width="60px" height="auto" class="img-responsive img-circle center-block"></td>
														
														<td>
															<?php 
																echo "<strong>".$row->nm."</strong>";
																if($row->sex==1)
																	echo "<i class='fa fa-mars fa-fw fa-lg text-blue pull-right'></i>";
																else
																	echo "<i class='fa fa-venus fa-fw fa-lg text-red pull-right'></i>";
																echo "<br>";
																echo $row->nik."<br>";
																echo $row->email."<br>";
															?>
														</td>
														<td><?= $row->addr?></td>
													<td class="text-center">
													<a  data-toggle="tooltip" title="Edit Data" href="<?= site_url();?>/<?= $saveLink;?>/<?= $pid;?>"><i class="fa fa-cog fa-fw fa-lg"></i></a>
													<a  data-toggle="tooltip" title="Delete Data" href="<?= site_url();?>/<?= $deleteLink;?>/<?= $pid;?>"><i class="fa fa-trash fa-fw fa-lg"></i></a>
													</td>
                                                </tr>
												
											<?php
											$i++;
											}
											?>
                                            </tbody>
										<?php
										}
										?>
			
				</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


