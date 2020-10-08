
	
		 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ongoing Trip Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url();?>admin">Home</a></li>
              <li class="breadcrumb-item active">Ongoing Trip Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
     

        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">
		
          <div class="row">
		  <?php
			if(isset($render))
			foreach($render->result() as $i => $row)
			{
			?>
			
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Trip ID : <?= $row->id;?></h3>
              </div>
                <div class="card-body box-profile box-driver">
				<div class = "profile-user-img-driver" style="background-image:url('<?= base_url();?>assets/admin/img/avatar/thumb/<?= $row->ava_user;?>');">&nbsp;</div>
				
				<div class = "profile-user-img-driver" style="background-image:url('<?= base_url();?>assets/admin/img/<?= $row->img;?>');">&nbsp;</div>
                  
				  <h3 class="profile-username">
				  
                      <?= $row->nm_trans;?> <?= $row->prio;?>
				  </h3> 
				  
				  <p class="text-muted ">
				  
                      <?= $row->nopol_trans;?>
				  </p>
				  
				  <p class="text-muted h20 overflow-hidden">
				  
                      <?= $row->driver;?>
				  </p>
				  <p class="text-muted">
				  
					  <?= $row->st;?>
				  </p>
				  
				  <hr>
				  
                <ul class="list-group list-group-unbordered">
				
				<?php 
				$j=0;
				foreach($row as $col){
					if($j<count($viewFormTableHeader))
					{
						?>
						<p >
					  
							<b><?= $viewFormTableHeader[$j];?></b><br>
							<b class="text-muted  "><?= $col?></b>
						</p>
				
					<?php }
					$j++;} ?>
					
				</ul>
				
					
                </div><!-- /.box-footer -->
              </div><!-- /.box -->

          
            </div><!-- /.col -->
			<?php } ?>
          </div><!-- /.row -->
		  
      </div><!-- /.container-fluid -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

	<div id="profileMonthlyLeaveChart">&nbsp;</div>
	
	
	<!-- modal -->
	<div class="modal fade" id="confirm-start" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="POST" action="#" id="frm-confirm-start" enctype="multipart/form-data" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Enter Departure Odometer
				</div>
				<div class="modal-body">
					
					<div class="form-group ">
						<label for="inputEmail3" >Input Departure KM</label>
							<input type='number' class='form-control' id='txtKmDep' name=txt[]	placeholder='Km' autocomplete='off'>
							<div class="help-block with-errors"></div>
					 </div>
					 
					<div class="form-group ">
						<label for="inputEmail3" >Upload Photo</label>
							
						<input type='file' class='form-control fileupload' id='txtImgKmDep' name=txtfl	placeholder='File' >
							<div class="help-block with-errors"></div>
					 </div>
					  
					
				

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button id="submit" class="btn btn-success success">Submit</button>
				</div>
			</div>
		</div>
		</form>
	</div>
	
	
	<!-- modal -->
	<div class="modal fade" id="confirm-finish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="POST" action="#" id="frm-confirm-finish" enctype="multipart/form-data">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Enter Arrival Odometer
				</div>
				<div class="modal-body">
					<div class="form-group ">
						<label for="inputEmail3" >Input Arrival KM</label>
							
							<input type='number' class='form-control' id='txtKmArr' name=txt[]	placeholder='Km' autocomplete='off'>
							<div class="help-block with-errors"></div>
					 </div> 
					 
					<div class="form-group ">
						<label for="inputEmail3" >Upload Photo</label>
							
						<input type='file' class='form-control fileupload' id='txtImgKmArr' name=txtfl	placeholder='File' >
							<div class="help-block with-errors"></div>
					 </div>

					
				

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button id="submit" class="btn btn-success success">Submit</button>
				</div>
			</div>
		</div>
		</form>
	</div>
	
	
	<!-- modal -->
	<div class="modal fade" id="confirm-checkpoint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form method="POST" action="#" id="frm-checkpoint" enctype="multipart/form-data" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Checkpoint
				</div>
				<div class="modal-body">
					
					<div class="form-group ">
						<label for="inputEmail3" >Notes</label>
							<textarea class='form-control' id='txtNotes' name=txt[]	placeholder='Enter Description Here' autocomplete='off'></textarea>
							<div class="help-block with-errors"></div>
					 </div>
					 
					<div class="form-group ">
						<label for="inputEmail3" >Upload Photo</label>
							
						<input type='file' class='form-control fileupload' id='txtImg' name=txtfl	placeholder='File' >
							<div class="help-block with-errors"></div>
					 </div>
					  
					
				

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button id="submit" class="btn btn-success success">Submit</button>
				</div>
			</div>
		</div>
		</form>
	</div>