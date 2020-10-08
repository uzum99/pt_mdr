
	<!-- 
		retrieve data 
	-->
	<?php

	// from Product Category 
	foreach($setting ->result() as $row)
	{
		foreach($row as $rs)
		{
			$dbset[]=$rs;
		}
	}
	?>
<!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $dbset[2];?>">
    <meta name="author" content="Aldila">
    <title><?= $dbset[2];?></title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css" type="text/css">   -->
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/font-awesome/css/font-awesome.min.css" type="text/css"> -->
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/datepicker.css" type="text/css"> 
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/clockpicker.css" type="text/css"> 
	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/DataTables-1.10.10/media/css/jquery.dataTables.css" type="text/css"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css" type="text/css">
	
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css" type="text/css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.0/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
	
	 
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css" type="text/css">
	
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iCheck/all.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/select2/select2.min.css" type="text/css">
	
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bootstrap-fileinput-master/css/fileinput.css" type="text/css"> -->
	
	
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fileinput/css/fileinput.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/summernote/dist/summernote.css" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iconpicker/dist/css/fontawesome-iconpicker.css" type="text/css">
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/admin/img/<?= $dbset[3];?>" />


  <body class="hold-transition sidebar-collapse skin-yellow-light sidebar-mini">
    <div class="wrapper ">

      <header class="main-header">

        <!-- Logo -->
        <a href="<?= site_url();?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>MiO</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?= $dbset[1];?></b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			
              
			   <!-- LOB -->
			  
					<!-- 
						retrieve data 
					-->
					<?php
					// from Product Category 
				
					$totalert=0;
					foreach($alert->result() as $row)
					{
						$idAlert[]=$row->id;
						$remAlert[]=$row->rem;
						$linkAlert[]=$row->link;						
					}
					
					if($alert->num_rows()>0)
					{
						$totalert=$alert->num_rows();
					}
					?>	
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
				  
				  <?php
				  if(!$totalert==0)
				  {
				  ?>
                  <span class="label label-danger"><?= $totalert?></span>
				  <?php
				  }
				  ?>
                </a>
				
                <ul class="dropdown-menu">
                  <li class="header">You have <?= $totalert;?> Pending Request(s)</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
					<?php
					if(isset($idAlert))
						for($i=0;$i<count($idAlert);$i++)
						{
						?>	
						<ul class="menu">
						  <li>
							<a href="<?= site_url();?><?= $linkAlert[$i];?>">
							  <i class="fa fa-flag-o text-aqua"></i> <?= $remAlert[$i]?>
							</a>
						  </li>
						</ul>
						<?php
						}
					?>	
                    </ul>
                  </li>
                </ul>
              </li>
			  
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= base_url();?>assets/admin/img/avatar/thumb/<?= $ses['picUser'];?>"  class="user-image" >
                  <span class="hidden-xs">
                      <?= $ses['name'];?>
					  </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= base_url();?>assets/admin/img/avatar/thumb/<?= $ses['picUser'];?>"  class="img-circle" >
                    <p>
                      <?= $ses['name'];?>
                      <small>Employed since  <?= date_format(date_create($ses['joinDate']),"j F Y"); ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="col-md-6">
                      <a href="<?= site_url();?>Profile" class="btn btn-success btn-flat btn-block">Profile</a>
                    </div>
                    <div class="col-md-6">
                      <a href="<?= site_url();?>Login/logout" class="btn btn-danger btn-flat  btn-block">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
			  
              <!-- Control Sidebar Toggle Button -->
            
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
			
            <li><a href="<?= site_url();?>Admin"><i class="fa fa-dashboard text-yellow"></i> <span>Dashboard</span></a></li>
			
            <li><a href="<?= site_url();?>Profile"><i class="fa fa-user text-yellow"></i> <span>My Profile</span></a></li>
			
		
			
			<?php
			
			
			
			//echo $frmList;
			$grptemp="";
			if(isset($frmList))
			{
				foreach($frmHead as $head)
				{
					?>
					 <li class="treeview">
					  <a href="#">
						<i class="fa <?= $head->ico?> <?= $head->iclr?>"></i><span><?= $head->groupnm?></span> <i class="fa fa-angle-left pull-right"></i>
					  </a>
					  <ul class="treeview-menu">
					<?php
					foreach($frmList as $row)
					{		
						if($row->groupnm==$head->groupnm)
						{
						?>					
						<li><a href="<?= site_url();?><?= $row->id?>"><i class="fa fa-circle-o"></i><?= $row->descs?></a></li>
						<?php
						}
					}
					
					?>
					  </ul>
					</li>
				<?php
				}
			}
			
			?>
			
           <!--
            <li class="header">SHORTCUT</li>
			
					<?php
					foreach($frmList as $row)
					{		
						if($row->iss == 1)
						{
						?>					
						
						<li>
							<a href="<?= site_url();?><?= $row->id?>"><i class="fa <?= $row->ico?> <?= $row->iclr?>"></i> <span><?= $row->descs?></span>			
							
							</a>
						</li>
						
						<?php
						
						}
					}
					
					?>
			-->
       
			
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">