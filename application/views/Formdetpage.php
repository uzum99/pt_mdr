		<section class="content-header">
          <h1>
            <?= $pageTitle?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= site_url();?>/admin"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?= site_url();?>/<?= $breadcrumbLink?>"><?= $breadcrumbTitle?></a></li>
			<li><a href="<?= site_url();?>/<?= $breadcrumbLink2?>"><?= $breadcrumbTitle2?></a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
				  <button class="btn btn-success btn-flat">
					<a href="<?= site_url();?>/<?= $saveLink?>">
						<i class="fa fa-plus"></i>&nbsp; Add new data
					</a>
					</button>
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table class="table table-hover datatable compact" >
				
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
                                                <tr class="text-center">
													<td class="text-center"><?= $i?>.</td>
													<?php
													$pid=$row->id;
													$pfrm=$row->forms;
														
													
													?>
													<td><?= $row->id;?></td>
													<td><?= $row->names;?></td>
													<td><?= $row->forms;?></td>
													<?php
													$frmHeader=array("adds","upds","dels","sp1","sp2");
													foreach($frmHeader as $col)
													{
														if($row->$col==1)
														{
															?>
															
															<td><span class="label label-success">Granted</span></td>
															<?php
															
														}
														else
														{
															
															?>
															
															<td><span class="label label-danger">Denied</span></td>
															<?php
														}
													}
													?>
													<td class="text-center">
													
													<?php
													if(isset($detLink))
													{
													?>
													<a data-toggle="tooltip" title="Show Detail" href="<?= site_url();?>/<?= $detLink;?>/<?= $pid;?>"><i class="fa fa-search fa-fw fa-lg"></i></a>
													<?php
													}
													?>
													<a data-toggle="tooltip" title="Edit Data" href="<?= site_url();?>/<?= $saveLink;?>/<?= $pid;?>"><i class="fa fa-cog fa-fw fa-lg"></i></a>
													<a data-toggle="tooltip" title="Delete Data" href="<?= site_url();?>/<?= $deleteLink;?>/<?= $pid;?>"><i class="fa fa-trash fa-fw fa-lg"></i></a>
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


