	<section class="content-header">
          <h1>
            <?= $breadcrumbTitle?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?= site_url();?><?= $breadcrumbLink?>"><?= $breadcrumbTitle?></a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
					<h3 class="box-title">
						<span><?= $pageTitle?></span>
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
					<form class="form-horizontal" id="formfield" enctype="multipart/form-data" data-toggle="validator" role="form" method="POST" action="<?= site_url();?><?= $saveLink;?>" >
					
					<?php
					if(!empty($formLabel))
					{
						$i=0;
						foreach($formLabel as $row)
						{
						?> 
							<div class="col-sm-2">
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
          </div><!-- /.row -->
         <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body">
				<?php
				$dt="datatableemp";
				
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
      
	  </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
