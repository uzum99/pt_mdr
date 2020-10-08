
	  <section class="content-header">
          <h1>
            Driver Dashboard 
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
                <div class="col-md-12">
				
				
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Ongoing Trip</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered datatable nochecklist table-striped no-margin ">
                      <thead>
					  <?php
						if(isset($viewFormTableHeader)){
						 } ?>
						
                        <tr>
							<th> No.</th>
						<?php
						foreach($viewFormTableHeader as $i => $row)
						{
						?>
							<th> <?= $row?></th>
						<?php
						}
						?>
                        </tr>
                      </thead>
                      <tbody>
						<?php
						if(isset($render))
						foreach($render->result() as $i => $row)
						{
						?>
                        <tr>
							<td> <?= $i+1;?></td>
						<?php 
						$j=0;
						foreach($row as $col){
							if($j<count($viewFormTableHeader)){
							?>
							<td> <?= $col?></td>
							<?php } $j++;} ?>
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
			  
        </section>
		