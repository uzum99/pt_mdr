
	<!-- 
		retrieve data 
	-->
	<?php
	date_default_timezone_set('Asia/jakarta');
	// from Product Category 
	foreach($setting ->result() as $row)
	{
		foreach($row as $rs)
		{
			$dbset[]=$rs;
		}
	}
	$row = $users->row();

	//$vacationLeft=0;
	if($row->sex==1)
	{
		$row->sex="<span class='label label-primary'><i class='fa fa-mars'></i>&nbsp; Male</span>";
	}
	else
	{
		$row->sex="<span class='label label-success'><i class='fa fa-venus'></i>&nbsp; Female</span>";		
	}
	
	//work profile
	$profileLabel = Array(
						"Nik",
						"Access",
						"E-Mail",
						"Workplace",
						"Division",
						"Department",
						"Title",
						"Level"
						);
						
	$profileValue = Array(
						$row->nik,
						$row->acc,
						$row->email,
						$row->loc,
						$row->divs,
						$row->dept,
						$row->title,
						$row->about
						);
						
	//personal info
	$pinfoLabel = Array(
						"Sex",
						"Address",
						"Phone",
						"Birthdate"
						);		
	$pinfoValue = Array(
						$row->sex,
						$row->address,
						$row->phone,
						$row->bd
						);
						
	//Social Media info
	$socmedLabel = Array(
						"Facebook",
						"Twitter",
						"Linkedin",
						"Google"
						);		
	$socmedValue = Array(
						$row->facebook,
						$row->twitter,
						$row->linkedin,
						$row->gplus
						);
	

	$tottoday=0;
	$totmonth=0;
	$tottodate=0;

	?>
	
	<div id="profileMonthlyLeaveChart">&nbsp;</div>
	
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Profile
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
<?php
		  if(null != $this->session->flashdata('successNotification'))
		  {
			  $notificationText=$this->session->flashdata('successNotification');
			  $notificationIcon="";
			  $notificationType="";
			  $notificationLabel="";
			  
			  
			  if($notificationText=="1")
			  {
				  $notificationText="Password changed successfully.";
				  $notificationIcon="check";
				  $notificationType="success";
				  $notificationLabel="Success!";
			  }
			  else
			  if($notificationText=="2")
			  {
				  $notificationText="Cannot change password!! Re-typed password mismatch";
				  $notificationIcon="times";
				  $notificationType="danger";
				  $notificationLabel="Failed!";
			  }
			  else
			  if($notificationText=="3")
			  {
				  $notificationText="Profile changed successfully";
				  $notificationIcon="check";
				  $notificationType="success";
				  $notificationLabel="Success!";
			  }
			  
		  ?>
          <div class="row">
		
            <div class="col-xs-12">
			
                  <div class="alert alert-<?= $notificationType; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-<?= $notificationIcon; ?>"></i> <?= $notificationLabel; ?></h4>
                    <?= $notificationText; ?>
                  </div>
            </div><!-- /.col -->
		
			
          </div><!-- /.row -->
		  <?php
		  }
		  ?>
		  
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
			  
			  
                <div class="box-body box-profile">
				<div class = "profile-user-img" style="background-image:url('<?= base_url();?>assets/admin/img/avatar/thumb/<?= $row->ava;?>');">&nbsp;</div>
                  
				  <!-- 
				  <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/admin/img/avatar/thumb/<?= $this->session->userdata('picUser');?>"  alt="User profile picture" >
				  -->
                  
				  <h3 class="profile-username text-center">
				  
                      <?= $row->name;?>
				  </h3> 
				  <p class="text-muted text-center">
				  
                      <?= $row->title;?>
				  </p>
				  
                <ul class="list-group list-group-unbordered">
				<?php for($i=0; $i<count($profileLabel) ; $i++){ ?>
					<li class="list-group-item">
					  <b><?= $profileLabel[$i]?></b> <b class="text-muted pull-right"><?= $profileValue[$i]?></b>
					</li>
				<?php } ?>
				
					<li class="list-group-item" title="See History">
					  <b>Leave Quota</b> <a href="<?= site_url();?>Lobreport" class="pull-right "><?= $vacationLeft?></a>
					</li>
				</ul>
					<a href="<?= site_url();?>Profile/change/<?= $row->code;?>" class="btn btn-primary  btn-flat btn-block" >
						<i class="fa fa-cog"></i>&nbsp; Edit Profile
					</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->

          
            </div><!-- /.col -->
			
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li ><a href="#leaverequest" data-toggle="tab"><i class="fa fa-calendar"></i>&nbsp;Leave Request</a></li>
                  <li class="active"><a href="#attendance" data-toggle="tab"><i class="fa fa-calendar"></i>&nbsp;Attendance</a></li>
                  <li><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
                  <li><a href="#changepassword" data-toggle="tab"><i class="fa fa-lock"></i>&nbsp;Change Password</a></li>
                </ul>
				
                <div class="tab-content">
					<div class="  tab-pane" id="leaverequest">
					
				  <div class="row">
				 
					<div class="col-md-12 ">
					<?php
					foreach($yearList->result() as $row)
					{
						$bg="bg-white";
						if($row->year==$year)
						$bg="bg-aqua";	
					?>
					  <a href="<?= site_url().$breadcrumbLink;?>/show?year=<?= $row->year?>"><button class="btn  btn-default <?= $bg;?>"><?= $row->year?></button></a>
					<?php } ?>
					</div><!-- /.col -->
					
					
					
				  </div><!-- /.row -->
				  
				  <div class="row">
					<div class="col-md-12">
					  <div class="box  box-info">
						<div class="box-header with-border">
						  <h3 class="box-title">Monthly Chart <span id="year"><?= $year;?></span>
						  &nbsp;<a href="<?= site_url();?>Vacation/add" class="btn btn-flat btn-box-tool btn-default text-black" >
									<i class="fa fa-plus "></i>&nbsp; New Leave Request
								</a></h3>
						  <div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								
						  </div>
						</div><!-- /.box-header -->
						<div class="box-body">
						  <div class="row">
							<div class="col-md-12">
							  <p class="text-center">
								<strong>Leave Report: Jan 1<sup>st</sup>, <?= $year?> - Dec 31<sup>st</sup>, <?= $year?> </strong>
							  </p>
							  <div class="chart">
								<!-- Sales Chart Canvas -->
								<canvas id="salesChart" style="height: 250px;" data-id="<?= $codeUser;?>"></canvas>
							  </div><!-- /.chart-responsive -->
							</div><!-- /.col -->
							
							
						  </div><!-- /.row -->
						  <div class="row">
							<div class="col-md-12">
							  <p class="text-left">
							   <strong>Leave Request on <?= $year;?> : <span id="lrCurrent"></span> Day(s)</strong>
							  </p>
							  <p class="text-left">
							   <strong>Leave Request on <?= $year-1;?> : <span id="lrLast"></span> Day(s)</strong>
							  </p>
							  </div>
						  </div><!-- /.row -->
						</div><!-- ./box-body -->
						 </div><!-- /.box -->
					</div><!-- /.col -->
				  </div><!-- /.row -->
						

			  <div class="row">
				<div class="col-md-12">
				  <div class="box  box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Leave Categories</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">		
					
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
					<div class="col-md-4 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-<?= $ranbg?> fa fa-bell-o"></span>
						<div class="info-box-content">
						  <span class="info-box-text"><?= $row->desc_lobtype?></span>
						  <span class="info-box-number"><?= $row->tot?> Day(s)</span>
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div><!-- /.col -->
					</a>
					  <?php } ?>
					
					
				  </div><!-- /.row -->
					</div>
					</div>
					</div>
				</div>
				  <div class="row">
					<div class="col-md-12">
			
			
					  <!-- TABLE: LATEST ORDERS -->
					  <div class="box box-info">
						<div class="box-header with-border">
						  <h3 class="box-title">Unapproved Request (<?= $lob->num_rows();?>)</h3>
						  <div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
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

					
			</div>
					
					<div class="active tab-pane" id="attendance">
					
				  <div class="row">
				 
					<div class="col-md-12 ">
					<?php
					foreach($yearList->result() as $row)
					{
						$bg="bg-white";
						if($row->year==$year)
						$bg="bg-aqua";	
					?>
					  <a href="<?= site_url().$breadcrumbLink;?>/show?year=<?= $row->year?>"><button class="btn  btn-default <?= $bg;?>"><?= $row->year?></button></a>
					<?php } ?>
					</div><!-- /.col -->
					
					
					
				  </div><!-- /.row -->
				  
				  <div class="row">
					<div class="col-md-12">
					  <div class="box  box-info">
						<div class="box-header with-border">
						  <h3 class="box-title">Monthly Late Attendance Chart <span id="year"><?= $year;?></span></h3>
						  <div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								
						  </div>
						</div><!-- /.box-header -->
						<div class="box-body">
						  <div class="row">
							<div class="col-md-12">
							  <p class="text-center">
								<strong>Late Attendance Report: Jan 1<sup>st</sup>, <?= $year?> - Dec 31<sup>st</sup>, <?= $year?> </strong>
							  </p>
							  <div class="chart">
								<!-- Sales Chart Canvas -->
								<canvas id="salesChartAttendance" style="height: 250px;" data-id="<?= $codeUser;?>"></canvas>
							  </div><!-- /.chart-responsive -->
							</div><!-- /.col -->
							
							
						  </div><!-- /.row -->
						  <div class="row">
							<div class="col-md-12">
							  <p class="text-left">
							   <strong>Late Attendance on <?= $year;?> : <span id="laCurrent"></span> Minute(s)</strong>
							  </p>
							  <p class="text-left">
							   <strong>Late Attendance on <?= $year-1;?> : <span id="laLast"></span> Minute(s)</strong>
							  </p>
							  </div>
						  </div><!-- /.row -->
						</div><!-- ./box-body -->
						 </div><!-- /.box -->
					</div><!-- /.col -->
				  </div><!-- /.row -->
						

				  <div class="row">
					<div class="col-md-12">
			
			
					  <!-- TABLE: LATEST ORDERS -->
					  <div class="box box-info">
						<div class="box-header with-border">
						  <h3 class="box-title">Latest Attendance </h3>
						  <div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						  </div>
						</div><!-- /.box-header -->
						<div class="box-body">
						  <div class="table-responsive">
							<table class="table no-margin">
							  <thead>
								<tr>
								  <th>Date</th>
								  <th>Name</th>
								  <th>Check-In</th>
								  <th>Check-Out</th>
								  <th>Late</th>
								  <th>Working Time</th>
								</tr>
							  </thead>
							  <tbody>
								<?php
								if(isset($att))
								foreach($att->result() as $row)
								{
								?>
								<tr>
								  <td><a href="<?= site_url();?>vacation"><?= $row->fulldate?></a></td>
								  <td><?= $row->nm?></td>
								  <td>
										<span class="btn btn-block <?= $row->label?> "><?= $row->st;?></span></td>
								  <td><?= $row->reason?></td>
								  <td><?= $row->reason?></td>
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

					
			</div>
					
					<div class=" tab-pane" id="profile">
                    <!-- Post -->
					
					
					<h4>Personal Info</h4>
					<?php for($i=0; $i<count($pinfoLabel) ; $i++){ ?>
                      <div class="form-group">
                        <label for="inputName" class="col-md-2 col-sm-3"><?= $pinfoLabel[$i]?></label>
                        : <?= $pinfoValue[$i]?>
                      </div>
					<?php } ?>
					  
                  <hr>
					<h4>Social Media</h4>
					<?php for($i=0; $i<count($socmedLabel) ; $i++){ ?>
                      <div class="form-group">
                        <label for="inputName" class="col-md-2 col-sm-3 "><?= $socmedLabel[$i]?></label>
                        : <?= $socmedValue[$i]?>
                      </div>
					<?php } ?>
					  
					</div>
					
					

                  <div class="tab-pane" id="changepassword">
                    <form class="form-horizontal" action="<?= site_url();?>Changepassword/change" method="POST">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Password Lama</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="pwdOld" placeholder="Max. 32 Characters" name='txt_pwdold'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Password Baru</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="pwdNew" placeholder="Max. 32 Characters" name='txt_pwdnew' required   >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
							<input type="password" class="form-control" id="pwdNew1" placeholder="Max. 32 Characters" name='txt_pwdnew1' required  data-match='#pwdNew' data-match-error='Password Baru tidak sama' >
							<div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Ubah Password</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
			
          </div><!-- /.row -->
