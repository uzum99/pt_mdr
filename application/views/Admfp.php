	 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $pageTitle?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url();?>admin">Home</a></li>
              <li class="breadcrumb-item active"><?= $breadcrumbTitle?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
		
          <div class="row">
            <div class="col-md-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Download Data</h3>
              </div>
                
                <div class="card-body">
				
					<form class="form-horizontal" id="formfield" enctype="multipart/form-data" data-toggle="validator" role="form" method="POST" action="<?= site_url();?><?= $saveLink;?>" >
					
					<?php
					if(!empty($formLabel))
					{
						$i=0;
						foreach($formLabel as $row)
						{
						?> 
							<div class="col-sm-12">
						  <div class="form-group ">
							<label for="inputEmail3" class=" control-label text-left"><?= $row ?></label>
							  <?= $formTxt[$i] ?>
								<div class="help-block with-errors"></div>
						  </div>
							</div>
						<?php
						$i++;
						}
					}
					?>
						
					  <div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-success" >Download</button>  
						</div>
					  </div>
					</form>
					
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
            <div class="card card-primary">
			
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
                
                <div class="card-body">
				<?php
				$dt="datatable";
				
				?>
				<table class="table table-hover table-striped table-bordered <?= $dt; ?> compact" id="tblView" width="100%">
				
				<?php
					if(!empty($render))
					{
					?>
						<thead>
							<tr>
								<th class="text-center" colspan=2>No.</th>
							<?php
							foreach($tableHeader as $row)
							{
							?> 
								<th class="text-center"><?= $row?></th>
							<?php
							}
							?>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						
						foreach($render as $row)
						{ 			
						$ist="";
						if(isset($statusVar))
							$ist=$statusVar;
						?>
							<tr>
								<td class="text-center">&nbsp;</td>
								<td class="text-center"><?= $i?>.</td>
								<?php
								foreach($row as $col)
								{
								?>
									<td  class="text-center"><?= $col?></td>
								<?php
								}
								?>
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
      
      </div><!-- /.container-fluid -->
	  </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
