
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
	  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/fontawesome-free/css/all.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/landing/plugins/summernote/summernote-bs4.min.css">
  
  
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css" type="text/css">
	
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css" type="text/css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.0/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/datepicker.css" type="text/css"> 
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/clockpicker.css" type="text/css"> 
	<!--
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
	
	
	 
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/summernote/dist/summernote.css" type="text/css">
	-->
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/select2/select2.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fileinput/css/fileinput.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iconpicker/dist/css/fontawesome-iconpicker.css" type="text/css">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/admin/img/<?= $dbset[3];?>" />


  <body class="hold-transition sidebar-collapse sidebar-mini skin-yellow-light sidebar-mini  layout-navbar-fixed">
	
    <div class="wrapper ">
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
	  
	  
	  
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	
  
	  
      <!-- Notifications Dropdown Menu 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
		  
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
	  -->
    </ul>
  </nav>
  <!-- /.navbar -->


	   <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url();?>" class="brand-link">
      <img src="<?= base_url()?>assets/admin/img/mdr-logo.png" alt="MiO Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $dbset[2];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <img src="<?= base_url();?>assets/admin/img/avatar/thumb/<?= $ses['picUser'];?>" class="user-image img-circle elevation-2" alt="User Image">
        </div>
		 <!-- 
		<div class = "profile-user-img-tiny img-fluid img-circle" style="background-image:url('<?= base_url();?>assets/admin/img/avatar/thumb/<?= $ses['picUser'];?>');">&nbsp;</div>
		-->
        <div class="info">
          <a href="<?= site_url();?>Profile" class="d-block"><?= $ses['name'];?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
          <li class="nav-item">
            <a href="<?= site_url();?>Admin" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  
		<?php
			
			
			
			//echo $frmList."cek";
			$grptemp="";
			if(isset($frmList))
			{
				foreach($frmHead as $head)
				{
					?>
					<li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="nav-icon fas <?= $head->ico?>"></i>
					  <p>
						<?= $head->groupnm?>
						<i class="fas fa-angle-left right"></i>
						<!-- <span class="badge badge-info right">6</span> -->
					  </p>
					</a>
					<ul class="nav nav-treeview">
					
					<?php
					foreach($frmList as $row)
					{		
						if($row->groupnm==$head->groupnm)
						{
						?>		
						<li class="nav-item">
							<a href="<?= site_url();?><?= $row->id?>" class="nav-link">
							  <i class="far fa-circle nav-icon"></i>
							  <p><?= $row->descs?></p>
							</a>
						 </li>
			  
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

          <li class="nav-item">
            <a href="<?= base_url('Pelaporan/pelaporan') ?>" class="nav-link">
              <i class="nav-icon fas fa-user text-white"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
			
			
          <li class="nav-item">
            <a href="<?= site_url();?>Login/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-red"></i>
              <p>
                Signout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">