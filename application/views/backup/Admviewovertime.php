		<section class="content-header">
          <h1>
            <?= $pageTitle?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?= site_url();?><?= $breadcrumbLink?>"><?= $breadcrumbTitle?></a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<?php
			//echo $yearList->num_rows()."kljkll";
			foreach($yearList->result() as $row)
			{
				$bg="bg-white";
				if($row->year==$year)
				$bg="bg-aqua";	
			?>
			  <a href="<?= site_url();?>Overtime/show?year=<?= $row->year?>"><button class="btn  btn-default <?= $bg;?>"><?= $row->year?></button></a>
		<?php } ?>
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
		
            <div class="col-xs-12">
			
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
		  
       <div id="isApproved" data ="<?= (isset($isApproved) ? $isApproved : "")?>"></div>
		<?php
		$dt="datatable";
		if(isset($dtcustom))
		{
			$dt=$dtcustom;
		}
		?>
		  
       
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body">
				<table class="table table-hover table-striped table-bordered <?= $dt; ?> compact" id="tblView" width="100%">
				
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
								
								<div id="txt<?= $i-1;?>" style="display:none" data="<?= $pid;?>"></div>
								<?php
								
								if(isset($detLink))
								{
									$detid=$pid;
								?>
								<a data-toggle="tooltip" target="_blank" title="Show Detail" href="<?= site_url();?><?= $detLink;?>/<?= $detid;?>"><i class="fa fa-search fa-fw fa-lg"></i></a>
								<?php
								}
								?>
								
								<?php
								
								if(isset($empDetailLink))
								{
									$detid=$pid;
								?>
								<a data-toggle="modal" data-target="#employee-detail" title="Show Detail" href="#" name="<?= $detid;?>" class="employeeDetailBtn"><i class="fa fa-search fa-fw fa-lg"></i></a>
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
									<i class="fa fa-cogs fa-fw fa-lg text-purple"></i>
								</a>
								<?php
								}
								?>
								
								<?php
								if((isset($formAccess->isdel) && $formAccess->isdel==1 && !isset($nodelete)))
								{
								?>
								<a data-toggle="modal" data-target="#confirm-delete" title="Delete Data" href="#" name="<?= $pid;?>" class="deleteBtn">
									<i class="fa fa-trash fa-fw fa-lg text-red"></i>
								</a>
								<?php
								}
								?>
								
								<?php
								if((isset($isprint)))
								{
								?> 
								<a  title="Print Data" href="<?= site_url();?><?= $printLink;?>/<?= $pid;?>"  class="printBtn" target="_blank">
									<i class="fa fa-print fa-fw fa-lg text-green"></i>
								</a>
								<?php
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
	