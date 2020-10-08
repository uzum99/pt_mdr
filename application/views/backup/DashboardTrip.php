
	
	<div id="profileMonthlyLeaveChart">&nbsp;</div>
	
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard Trip
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ongoing Trip Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
          <div class="row">
		  <?php
			if(isset($render))
			foreach($render->result() as $i => $row)
			{
			?>
			
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile box-driver">
				<div class = "profile-user-img-driver" style="background-image:url('<?= base_url();?>assets/admin/img/avatar/thumb/<?= $row->ava_user;?>');">&nbsp;</div>
				
				<div class = "profile-user-img-driver" style="background-image:url('<?= base_url();?>assets/admin/img/<?= $row->img;?>');">&nbsp;</div>
                  
				  <h3 class="profile-username">
				  
                      <?= $row->nm_trans;?> <?= $row->prio;?>
				  </h3> 
				  
				  <p class="text-muted ">
				  
                      <?= $row->nopol_trans;?>
				  </p>
				  
				  <p class="text-muted h20 overflow-hidden">
				  
                      <?= $row->driver;?>
				  </p>
				  <p class="text-muted">
				  
					  <?= $row->st;?>
				  </p>
				  
				  <hr>
				  
                <ul class="list-group list-group-unbordered">
				
				<?php 
				$j=0;
				foreach($row as $col){
					if($j<count($viewFormTableHeader))
					{
						?>
						<p >
					  
							<b><?= $viewFormTableHeader[$j];?></b><br>
							<b class="text-muted  "><?= $col?></b>
						</p>
				
					<?php }
					$j++;} ?>
					
				</ul>
				
					
                </div><!-- /.box-footer -->
              </div><!-- /.box -->

          
            </div><!-- /.col -->
			<?php } ?>
          </div><!-- /.row -->
