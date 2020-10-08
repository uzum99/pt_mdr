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
			if(isset($formAccess->isadd) && $formAccess->isadd==1)
			{
			?>
			<input type="hidden" id="saveLink" value="<?= site_url();?><?= $saveLink?>">
			<?php
			}
		?>
		
		<?php							
			if(isset($formAccess->isadd) && $formAccess->acc2==1 && isset($addbatch))
			{
			?>
			<input type="hidden" id="saveLink2" value="<?= site_url();?><?= $saveMultipleLink?>">
			<?php
			}
		?>
					
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
		  
		<?php
		$dt="datatable";
		if(isset($dtcustom))
		{
			$dt=$dtcustom;
		}
		?>
		  
       
          <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
                
                <div class="card-body">
				<table class="table table-hover table-striped  <?= $dt; ?>" id="tblView" width="100%">
				
				<?php
					if(!empty($render))
					{
					?>
						<thead>
							<tr>
								<?php if(!isset($dtcustom)){?>
								<th class="text-center" >#</th>
								<?php } ?>
								<th class="text-center" >No.</th>
							<?php
							foreach($tableHeader as $row)
							{
							?> 
								<th class="text-center"><?= $row?></th>
							<?php
							}
							?>
								<th class="text-center">Option</th>
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
								<?php if(!isset($dtcustom)){?>
								<td class="text-center">&nbsp;</td>
								<?php } ?>
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
								<td class="text-center">
								
								<?php
								
								if(isset($detLink))
								{
									$detid=$pid;
								?>
								<a  target="_blank" title="Show Detail" href="<?= site_url();?><?= $detLink;?>/<?= $detid;?>"><i class="fa fa-search fa-fw fa-lg"></i></a>
								<?php
								}
								?>
								
								
								
								<?php
								
								if((isset($formAccess->isedt) && $formAccess->isedt==1 && !isset($noedit)) )
								{
									if(!isset($editLink))
									{
										$editLink=$saveLink;
									}
								?>
								<a data-toggle="tooltip" title="Edit Data" href="<?= site_url();?><?= $editLink;?>/<?= $pid;?>">
									<i class="fa fa-cogs fa-fw text-purple"></i>
								</a>
								<?php
								}
								?>
								
								<?php
								if((isset($formAccess->isdel) && $formAccess->isdel==1 && !isset($nodelete)))
								{
								?>
								<a data-toggle="modal" data-target="#confirm-delete" title="Delete Data" href="#" name="<?= $pid;?>" class="deleteBtn">
									<i class="fa fa-trash fa-fw text-red"></i>
								</a>
								<?php
								}
								?>
								
								<?php
								if(isset($isprint) || isset($printLink))
								{
								?> 
								<a  title="Print Data" href="<?= site_url();?><?= $printLink;?>/<?= $pid;?>"  class="printBtn" target="_blank">
									<i class="fa fa-print fa-fw text-green"></i>
								</a>
								<?php
								}
								?>
								
								
								<?php
								if((isset($customButton)))
								{
									foreach($customButton as $cbi => $cbtn)
									{
									?> 
									<a title="<?= $cbtn->buttonTitle;?>" href="<?= site_url();?><?= $cbtn->buttonDestination;?>/<?= $pid;?>"  class="<?= $cbtn->buttonClass?>" target="_blank">
										<i class="<?= $cbtn->buttonIcon?> fa-fw <?= $cbtn->textColor?>"></i>
									</a>
									<?php
									}
								}
								?>
								
								
								</td>
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
	
	
	
	<!-- sign modal -->
	<?php if(isset($isSign)){?>
	<div class="modal fade" id="confirm-sign" tabindex="-1" role="dialog" aria-labelledby="asd" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			 <form method="post" action="<?= site_url();?>/Maintenance/savesign" id="form-mt-sign"> 
				<div class="modal-header">
					Sign & Close Order
				</div>
				<!---buat ttd digital-->
				<div class="modal-body">   
				<input type='hidden' class='form-control' id='txtsignId' name=txt[]  required >
				<input type='hidden' class='form-control' id='txtsignpad' name=txt[]   required >
					
					<canvas id='signature-pad' class='signature-pad' width=auto height=200 style="border:1px solid lightgrey"></canvas>
								<br>
								
								<!-- <a href='#' class='btn btn-danger btn-xs btn-flat' onclick='clearSignpad()'>Bersihkan</a> -->
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					<a href="<?= site_url();?><?= $breadcrumbLink?>" id="signSubmit" class="btn btn-success">Yes</a>
				</div>
				
		 </form> 
			</div>
		</div>
		
	</div>
	<?php } ?>
	
	
	<div class="modal modal-default fade" id="employee-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="employee-detail-content">
			 

			</div>
		</div>
	</div>
	
	<?= isset($modalList) ? implode("",$modalList):""; ?>
	
	
	