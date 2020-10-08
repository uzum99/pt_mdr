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
	
			
			
			
			
		<?php
		  
		  if(null != $this->session->flashdata('successNotification'))
		  {
			  $type="success";
			  $note="Success!";
			  $fa="check";
			  $notificationText=$this->session->flashdata('successNotification');
			  if($notificationText=="1")
				  $notificationText="Data saved successfully";
			  else
			  if($notificationText=="2")
				  $notificationText="Data updated succesfully";
			  else
			  if($notificationText=="3")
				  $notificationText="Data deleted succesfully";
			  else
			  if($notificationText=="5")
			  {
				  $notificationText="Cannot edit transaction. Transaction already Approved";
				  $type="danger";
				  $note="Denied!";
				  $fa="times";
			  }
			  
		?>
          <div class="row">
		
            <div class="col-md-12">
			
                  <div class="alert alert-<?= $type; ?> alert-dismissable" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-<?=$fa;?>"></i><?=  $note; ?></h4>
                    <?= $notificationText; ?>
                  </div>
            </div><!-- /.col -->
		
			
          </div><!-- /.row -->
		  <?php
		  }
		  ?>
		  
		  
       
          <div class="row">
            <div class="col-md-2">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
                
				<form method="POST" action="<?= site_url().$breadcrumbLink;?>" >
			
				
                <div class="card-body">
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-flat " ><i class="fa fa-table"></i>&nbsp; Refresh Data</button>  
				</div>
					<?php
					if(!empty($formLabel))
					{
					?>
						<?php
						$i=0;
						foreach($formLabel as $row)
						{
						?> 
						  <div class="form-group ">
							<label for="inputEmail3" ><?= $row ?></label>
							
							  <?= $formTxt[$i] ?>
								<div class="help-block with-errors"></div>
							
						  </div>
						<?php
						$i++;
						}
						?>
					<?php
					}
					?>
						

					  
				</div>
					
				</form>
				</div>
			</div>
            <div class="col-md-10">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
                <div class="card-body">
				
				<?php
				$dt="datatable";
				if(isset($dtcustom))
				{
					$dt=$dtcustom;
				}
				?>
				
				<table class="table table-hover table-striped table-bordered <?= $dt; ?> compact" id="tblView" width="100%">
				
				<?php
					if(!empty($render))
					{
					?>
						<thead>
							<tr>
								<th class="text-center" >#</th>
								<th class="text-center" >No.</th>
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
						$totcol=count($tableHeader);
						foreach($render->result() as $row)
						{ 			
						$ist="";
						if(isset($statusVar))
							$ist=$statusVar;
						?>
							<tr>
								<td class="text-center">&nbsp;</td>
								<td class="text-center"><?= $i?>.</td>
								<?php
								$pid=$row->$primaryKey;
								$j=0;
								foreach($row as $col)
								{
								if($j<$totcol)
									{	
								?>
									<td  class="text-center"><?= $col?></td>
								<?php
								$j++;
									}
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

	<!-- delete modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Delete confirmation
				</div>
				<div class="modal-body">
					Delete Data?
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">No</button>
					<a href="<?= site_url();?><?= $breadcrumbLink?>" id="deleteSubmit" class="btn btn-danger success">Yes</a>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="modal modal-default fade" id="employee-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="employee-detail-content">
			 

			</div>
		</div>
	</div>
	