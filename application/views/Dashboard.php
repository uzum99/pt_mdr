
	  <section class="content-header">
          <h1>
            Attendance Dashboard <span id="year"><?= $year;?></span>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->

          <div class="row">
		 
            <div class="col-md-12 ">
			<?php
			foreach($yearList->result() as $row)
			{
				$bg="bg-white";
				if($row->year==$year)
				$bg="bg-aqua";	
			?>
              <a href="<?= site_url();?>Admin/show?year=<?= $row->year?>"><button class="btn  btn-default <?= $bg;?>"><?= $row->year?></button></a>
			<?php } ?>
            </div><!-- /.col -->
			
			
			
          </div><!-- /.row -->
<div class="row">
                <div class="col-md-12">
				
				
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Employees on Leave - Today</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Date</th>
                          <th>Reason</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						if(isset($currentLeaveRequest))
						foreach($currentLeaveRequest->result() as $row)
						{
						?>
                        <tr>
                          <td><a href="<?= site_url();?>vacation"><?= $row->id?></a></td>
                          <td><?= $row->nm?></td>
                          <td><?= $row->desc_lobtype?></td>
                          <td><?= $row->leaveDate?></td>
                          <td><?= $row->reason?></td>
                        </tr>
						<?php
						}
						?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
				
                 </div><!-- /.col -->
              </div><!-- /.row -->
			  
          <div class="row">
            <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Absence Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>Absence Report: 1 Jan, <?= $year?> - 31 Dec, <?= $year?></strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" style="height: 400px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
					
					
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                 </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Absence Diagram</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>Absence Report: 1 Jan, <?= $year?> - 31 Dec, <?= $year?></strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="pieChart" style="height: 400px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
					
					
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                 </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

		  <!-- jenis leave request
          <div class="row">
		  <?php
		  $bg=Array(
					"aqua",
					"red",
					"green",
					"yellow"
					);
		  if($permitQuery->num_rows()>0)
			  foreach($permitQuery->result() as $row)
			  {
				  $ranbg=$bg[rand(0,3)];
		  ?>
			  <a href="<?= site_url();?>Vacation?type=<?= $row->desc_lobtype;?>">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-<?= $ranbg?> fa fa-bell-o"></span>
                <div class="info-box-content">
                  <span class="info-box-text"><?= $row->desc_lobtype?></span>
                  <span class="info-box-number"><?= $row->tot?> Day(s)</span>
                </div>
              </div>
            </div>
			</a>
			  <?php } ?>
			
          </div>
			-->
		  
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-9">
              <!-- MAP & BOX PANE -->
              
			  
              <div class="row">
                <div class="col-md-12">
				
				
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Request</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th>Reason</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						if(isset($lob))
						foreach($lob->result() as $row)
						{
						?>
                        <tr>
                          <td><a href="<?= site_url();?>vacation"><?= $row->fulldate?></a></td>
                          <td><?= $row->nm?></td>
                          <td>
								<span class="btn btn-block <?= $row->label?> "><?= $row->st;?></span></td>
                          <td><?= $row->reason?></td>
                        </tr>
						<?php
						}
						?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?= site_url();?>Vacation" class="btn btn-sm btn-info btn-flat pull-left">View All History</a>
                  <a href="<?= site_url();?>Lobreport" class="btn btn-sm btn-default btn-flat pull-right">View Recap</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
				
                 </div><!-- /.col -->
              </div><!-- /.row -->

            </div><!-- /.col -->

            <div class="col-md-3">
              <!-- Info Boxes Style 2 -->
			    <?php
				$totalPermit=0;
			  if($permitStatus->num_rows()>0)
				  $i=0;
			  //echo $permitStatus->num_rows();
				  foreach($permitStatus->result() as $row)
				  {
					  
			  ?>
			  <a href="<?= site_url();?>Vacation?recap=<?= $row->stat_lob;?>">
					  <div class="info-box bg-<?= $row->bg_lob;?>">
						<span class="info-box-icon fa <?= $row->icon_lob;?>"></span>
						<div class="info-box-content">
						  <span class="info-box-text"><?= $row->stat_lob;?></span>
						  <span class="info-box-number"><?= number_format($row->tot);?></span>
						  <div class="progress">
							<div class="progress-bar" style="width: 100%"></div>
						  </div>
						  <span class="progress-description">
							
						  </span>
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
			  </a>
			  <?php $totalPermit+=$row->tot; $i++;} ?>
			  
			   <div class="info-box bg-yellow">
                <span class="info-box-icon fa fa-calendar"></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Request</span>
                  <span class="info-box-number"><?= number_format($totalPermit);?></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Permit request by employees
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
			  

			
              </div><!-- /.col -->
          </div><!-- /.row -->