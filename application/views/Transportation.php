
	  <section class="content-header">
          <h1>
            Transportation
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
			$btnArr = Array("All","Available","Used");
			for($i = 0 ; $i<count($btnArr) ; $i++)
			{
				$bg="bg-white";
				if($btnArr[$i]==$category)
					$bg="bg-aqua";	
			?>
              <a href="<?= site_url();?>Transportation/show?category=<?= $btnArr[$i]?>"><button class="btn  btn-default btn-flat <?= $bg;?>"><?= $btnArr[$i]?></button></a>
			<?php 
			} 
			?>
			<a href="<?= site_url();?>Transportation/request"><button class="btn  btn-success btn-flat pull-right">Request</button></a>
            </div><!-- /.col -->
			
			
			
          </div><!-- /.row -->
		<hr>

		  
          <div class="row">
		 
            <div class="col-md-12 ">
			
				<div class="info-box">
					<div class="info-box-content">
					  <span class="info-box-number">Available</span>
					
					</div><!-- /.info-box-content -->
				</div>
			</div>
		  <?php
		  
		  if($permitQuery->num_rows()>0)
			  foreach($permitQuery->result() as $row)
			  {
		  ?>
            <div class="col-md-4 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-<?= $row->bg?> fa <?= $row->icon_transtype?>"></span>
                <div class="info-box-content">
                  <span class="info-box-number" title="Transportation"><?= $row->nm . " [ " .$row->nopol_trans . " ]"?></span>
                  <span class="info-box-text" title="Driver"><i class="fa fa-dashboard fa-fw"></i>&nbsp;<?= $row->stat?></span>
				  <a href="<?= site_url()?>Transportation/request?id=<?= $row->id_trans?>" class="btn btn-success btn-xs pull-right" title="Request Vehicle"><i class = "fa fa-plus"></i></a>
                  <span class="info-box-text" title="Passengers"><i class="fa fa-users fa-fw"></i>&nbsp;<?= $row->stat?></span>
                </div><!-- /.info-box-content -->
				
              </div><!-- /.info-box -->
            </div><!-- /.col -->
			  <?php } ?>
			
			
          </div><!-- /.row -->
		  
       