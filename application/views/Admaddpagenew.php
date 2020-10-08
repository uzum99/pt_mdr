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
				
			<form  id="formfield" enctype="multipart/form-data" data-toggle="validator" role="form" method="POST" action="<?= site_url();?><?= $saveLink;?>" >
			
			
			<?php
			//echo count($formTxt[0]);
										if(!empty($formLabel))
										{
										?>
										
											<?php
												
											for($j=0;$j<count($formLabel);$j++)
											{
											?>
												<div class="col-sm-12">
												<?php
												for($i=0;$i<count($formLabel[$j]);$i++)
												{
													$size="col-xs-12";
													if($formSize[$j][$i]>0)
														$size="col-xs-".$formSize[$j][$i];
											?> 
													<div class="form-group <?= $size?>">
														<label for="inputEmail3" class="control-label text-left"><?= $formLabel[$j][$i] ?></label>	
														<?= $formTxt[$j][$i] ?>
														<div class="help-block with-errors"></div>
														
													</div>
												<?php
												}
												?>
												</div>
										<?php
											}
										}
										?>
								  
			  
			  <div class="form-group col-xs-12">
				<button type="submit" class="btn btn-success" >Submit</button>  
				 	   <!-- <button  name="btn" id="submitBtn" data-toggle="modal" data-target="#confirm-submit"   class="btn btn-success"  />Submit</button> -->
			
			  </div>
			</form>
			
			<!-- modal -->
			<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							Confirm Submit
						</div>
						<div class="modal-body">
							Save data?

							<!-- We display the details entered by the user here -->
						

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<a href="#" id="submit" class="btn btn-success success">Submit</a>
						</div>
					</div>
				</div>
			</div>
			
			
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
