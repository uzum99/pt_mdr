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
		
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
					<span>Item Information</span>
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			
					<?php
						if(!empty($formLabel))
						{
						?>
							<table class="table table-condensed table-bordered">
								
								<tbody>
									<tr>
										<td width="20%" rowspan=5><?= $formTxt[0] ?></td>
									</tr>
									<?php
									for($i=1;$i<count($formLabel);$i++)
									{
										?>
										<tr>														
											<td width="12%"><strong><?= $formLabel[$i]; ?></strong></td>
											<td><?= $formTxt[$i] ?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						
								
						<?php
						}
					?>
				
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
		  
		  
		   <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
				  	Item Batch			
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table class="table table-hover datatable compact" id="tblView" width="100%">
				
				<?php
					if(!empty($render))
					{
					?>
						<thead>
							<tr>
								<th class="text-center">No.</th>
							<?php
							foreach($detailtableHeader as $row)
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
						$totcol=count($detailtableHeader);
						foreach($render->result() as $row)
						{ 			
						$ist="";
						if(isset($statusVar))
							$ist=$statusVar;
						?>
							<tr>
								<td class="text-center"><?= $i?>.</td>
								<?php
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
        </section><!-- /.content -->
		
		
      </div><!-- /.content-wrapper -->
