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
            <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data</h3>
              </div>
                
					<form  id="formfield" enctype="multipart/form-data" data-toggle="validator" role="form" method="POST" action="<?= site_url();?><?= $saveLink;?>" >
                <div class="card-body">
				
					
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
						
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
					 <button type="submit" class="btn btn-success" >Submit</button>  
							   <!-- <button  name="btn" id="submitBtn" data-toggle="modal" data-target="#confirm-submit"   class="btn btn-success"  />Submit</button> -->
						</div>
					  </div>
			
					<!-- modal -->
					<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									Confirm Submit
								</div>
								<div class="modal-body">
									Save transaction?

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
				
					</form>
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
