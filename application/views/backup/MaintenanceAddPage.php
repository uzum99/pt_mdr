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
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">
					<span><?= $pageTitle?></span>
					</h3>
                </div><!-- /.box-header -->
				<form  id="formfield" enctype="multipart/form-data" data-toggle="validator" role="form" method="POST" action="<?= site_url();?><?= $saveLink;?>" >
					<div class="box-body">
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
						
						<?php if($isSaved==0){?>
						
						<div class="form-group">
							<!-- <button type="submit" class="btn btn-success" >Submit</button>  -->
							
							<button type="submit"  onClick="return confirm('Save data?')" id="btn-save-mtact" class='btn btn-success btn-flat btn-social' >
							<i class="fa fa-plus"></i>
							Request Maintenance</button>
							
							
					  </div>
						<?php } ?>
						
					</div><!-- /.box-body -->
				</form>
              </div><!-- /.box -->

            </div><!-- /.col -->
			</div>
			
          <div class="row">
			<?php
				if($isSaved==1)
				{
				?>
            <div class="col-md-12 col-sm-12">
              <div class="box box-warning">
                <div class="box-header  with-border">
                  <h3 class="box-title">
					<a data-toggle="collapse" class='text-black' href="#rel-item" role="button" aria-expanded="false" aria-controls="rel-item"><span>Related Items</span></a>
					</h3>
					
					
                </div><!-- /.box-header -->
					<div class="box-body collapse" id="rel-item">
					
					
						<?php if($isFinished==0){?>
					<form  id="form-mt-item" enctype="multipart/form-data" data-toggle="validator" role="form" method="post">
							<div class="form-group ">
								<label for="inputEmail3">
									Item Batch
								</label>	

									<input type="hidden" name="mtitem[]" value="<?= $mtID?>">
									<input type="hidden" name="mtitem[]" value="<?= $mtID?>">

									<input type="text" class='form-control' id='txtItemBatch' name="mtitem[]" required placeholder='Scan Item Barcode' >
							
							</div>
							
							 <div class="form-group ">
								<label for="inputEmail3">
								Item Description
								</label>	
								
								
								 <input type="text" id='txtItemDesc'  class='form-control' name="dummy" readonly required placeholder='Item Description'>
								
							
							</div>
							
							 <div class="form-group ">
								<label for="inputEmail3" >
								Serial Number
								</label>	
								
								
								 <input type="text" id='txtItemSN'  class='form-control' name="dummy" readonly  placeholder='Serial Number'>
								
							
							</div>
							
							
						  <div class="form-group ">
							<label for="inputEmail3" >
							Issues
							</label>	
							
							 
							<?= $itemDesc;?>
							
							 <input type="hidden" name="mtitem[]" value="<?= $itemResponse;?>">
							 <input type="hidden" name="mtitem[]" value="<?= $itemDateTime;?>">
							 <input type="hidden" name="mtitem[]" value="<?= $itemStatus;?>">
							
							
						</div>
						
						  <div class="form-group ">
								
							 
							<a href="#"  id="btn-save-mtitem" class='btn btn-success btn-social btn-flat'>
								<i class="fa fa-check"></i>Submit</a>
						
							
							</div>
							</form>
						  <br>
						<?php } ?>
						
						<?php if(isset($itemRender))
							if($itemRender->num_rows() > 0){?>
						<table class="table table-hover table-bordered  table-hover table-striped compact" >
				
						<thead>
							<tr>
								<th class="text-center">No.</th>
							<?php
							foreach($itemTableHeader as $row)
							{
							?> 
								<th class="text-center"><?= $row?></th>
							<?php
							}
							?>
							
						<?php if($isFinished==0){?>
								<th class="text-center">Option</th>
						<?php } ?>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						$totcol=count($itemTableHeader);
						foreach($itemRender->result() as $row)
						{ 			
						$ist="";
						if(isset($statusVar))
							$ist=$statusVar;
						?>
							<tr>
								<td class="text-center"><?= $i?>.</td>
								<?php
								//$pid=$row->$primaryKey;
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
								
						<?php if($isFinished==0){?>
							
							<?php
								if((isset($formAccess->isdel) && $formAccess->isdel==1 && !isset($nodelete)))
								{
								?>
								<td class="text-center">
								
								<a onClick="return confirm('Delete Item ?');" data-toggle="tooltip" title="Delete Item" href="<?= site_url();?><?= $itemDeleteLink;?>/<?= $row->tid?>"><i class="fa fa-trash fa-fw fa-lg"></i></a>
							
								
								</td>
								
						<?php } ?>
						<?php } ?>
							</tr>
							
						<?php
						$i++;
						}
						?>
						</tbody>
			
				</table>
				<?php } ?>
						
					</div><!-- /.box-body -->
				
              </div><!-- /.box -->

            </div><!-- /.col -->
			
            <div class="col-md-12 col-sm-12">
              <div class="box box-primary">
                <div class="box-header  with-border">
                  <h3 class="box-title">
					<span><?= $actFormTitle;?></span>
					</h3>
                </div><!-- /.box-header -->
				
					<div class="box-body">
					
					<?php if($isFinished==0 && $isAdmin==1){?>
					<form  id="form-mt-act" enctype="multipart/form-data" data-toggle="validator" role="form" method="post">
					
						<?php 
							//activity form
							if(isset($actFormTxt))
								foreach($actFormTxt as $i => $frm){ ?>
								<div class="form-group">
									<label><?= $actTableHeader[$i]?></label>	
									<?= $frm?>
								</div>
						<?php } ?>
					
						<div class="form-group ">
							<button type="submit" onClick="return confirm('Save data?')" id="btn-save-mtact" class='btn btn-success btn-flat btn-social' >
								<i class="fa fa-plus"></i>
								Add new activity
							</button>
						</div>
						
					</form>
						  <br>
						<?php } ?>
						
						
					<?php if(isset($actRender))
						if($actRender->num_rows() > 0){?>
					<table class="table table-hover table-bordered   table-hover table-striped compact" >
				
						<thead>
							<tr>
								<th class="text-center">No.</th>
							<?php
							foreach($actTableHeader as $row)
							{
							?> 
								<th class="text-center"><?= $row?></th>
							<?php
							}
							?>
						<?php if($isFinished==0){?>
								<th class="text-center">Option</th>
								
						<?php } ?>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						$totcol=count($actTableHeader);
						foreach($actRender->result() as $row)
						{ 			
						$ist="";
						if(isset($statusVar))
							$ist=$statusVar;
						?>
							<tr>
								<td class="text-center"><?= $i?>.</td>
								<?php
								//$pid=$row->$primaryKey;
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
						
								<?php if($isFinished==0 && $row->id == $codeUser){?>
									<td class="text-center">
									
									<a onClick="return confirm('Delete Activity ?');" data-toggle="tooltip" title="Delete Activity" href="<?= site_url();?><?= $actDeleteLink;?>/<?= $row->tid?>"><i class="fa fa-trash fa-fw fa-lg"></i></a>
									
									</td>
									
								<?php } ?>
							</tr>
							
						<?php
						$i++;
						}
						?>
						</tbody>
			
				</table>
				
					<?php
					}
					?>
					
					<?php
					}
					?>
               
						
					</div><!-- /.box-body -->
				
              </div><!-- /.box -->

            </div><!-- /.col -->
          
		  </div><!-- /.row -->
		  
		  <!-- modal -->
			<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							Confirm Submit
						</div>
						<div class="modal-body">
							Submit Transaction ?

							<!-- We display the details entered by the user here -->
						

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a href="#" id="submit" class="btn btn-success success">Submit</a>
						</div>
					</div>
				</div>
			</div>
			
		  </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
