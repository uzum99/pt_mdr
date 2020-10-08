<!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Aldila">
    <title>aldi manis</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css" type="text/css">   -->
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/font-awesome/css/font-awesome.min.css" type="text/css"> -->
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/datepicker.css" type="text/css"> 
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/clockpicker.css" type="text/css"> 
	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/DataTables-1.10.10/media/css/jquery.dataTables.css" type="text/css"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css" type="text/css">
	
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css" type="text/css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.0.0/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css">
	
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
	
	 
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css" type="text/css">
	
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iCheck/all.css" type="text/css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/select2/select2.min.css" type="text/css">
	
  <body class="hold-transition sidebar-collapse skin-yellow-light sidebar-mini">



        <!-- Main content -->
        <section class="content">
		
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
					<h3 class="box-title">
						<span>PA</span>
					</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				
				
				<button class='btn btn-danger' onClick="randomPA()">abrakadabra</button>
				<button class='btn btn-default' onClick="bersihPA()">bersihkan dosa</button>
				
				<form method="POST" action="<?= site_url();?>Pa/Save">
				<input type="submit" value="Kirim" class="btn btn-success">
				<?= $cboDiv;?>
				<table class="table table-hover table-striped table-bordered datatable compact" id="tblView" width="100%">
				
				<thead>
				<tr>
				
				<th class="text-center" >#</th>
				<th class="text-center" >Nama</th>
				<th class="text-center" >Nik</th>
				<?php foreach($krit->result() as $j => $col){ ?>
					<th class="text-center" ><?= $col->nama_krit;?></th>
				<?php } ?>
				<th class="text-center" >Keterangan</th>
				</tr>
				</thead>
				
				<tbody>
				
				<?php $no=0;foreach($emp->result() as $i => $row){ ?>
				
				<tr>
					<td class="text-center"><?= ($i+1)?>.</td>
					<td  class="text-center"><?= $row->nama_emp?></td>
					<td  class="text-center">'<?= $row->id_emp?></td>
					
					<?php foreach($krit->result() as $j => $col){ ?>
						<td class="text-center" ><?= isset($cbodef[$no]) ? $cbodef[$no] : $cbo?></td>
					<?php $no++;} ?>
					
					<td  class="text-center"><?= isset($cbodef[$no]) ? $cbodef[$no] : "<input type='text' name=txt[] class='form-control'>"?></td>
					<?php $no++; ?>
				</tr>
				<?php } ?>
				</tbody>
				</table>
				</form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
	  
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css"></script> -->
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/bootstrap.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.js"></script>

	<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/DataTables-1.10.10/media/js/jquery.dataTables.js" ></script> -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.14/js/jquery.dataTables.min.js" ></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" ></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js" ></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js" ></script>
	
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.0.0/js/dataTables.rowGroup.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.0/js/dataTables.responsive.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>

    <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/fastclick/fastclick.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/app.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/pages/dashboard2.js"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/demo.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/validator/dist/validator.js"></script>
	<!--
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/chartjs/Chart.min.js"></script>
	-->
	
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.bundle.min.js"></script>
	<script type="text/javascript">
	//	alert();
	 var table = $('.datatable').DataTable({
	scrollX: true,
	scrollCollapse: true,
	paging: false,
	autoWidth : true,
	fixedColumns: {
	  leftColumns: 3
	},
			"pageLength": 100
	
  });
	
	
$(function() {
    // Check the initial Poistion of the Sticky Header
 var stickyHeaderTop = $('.datatable').offset().top;
 $(window).scroll(function() {
if ($(window).scrollTop() > stickyHeaderTop) {
  $('.dataTables_scrollHead, .DTFC_LeftHeadWrapper').css('transform', 'translateY(0%)');
  $('.DTFC_LeftHeadWrapper').css({position: 'fixed',top: '0px',zIndex: '1',left: 'auto'});
  $('.dataTables_scrollHead').css({position: 'fixed',top: '0px', zIndex: '1' });
  $('.DTFC_ScrollWrapper').css({height: ''});
 
 }
 else {
  $('.DTFC_LeftHeadWrapper, .DTFC_LeftHeadWrapper').css({position: 'relative',top: '0px'});
  $('.dataTables_scrollHead').css({position: 'relative', top: '0px'});
  $('.dataTables_scrollHead').css('transform', 'translateY(0%)');
      }

    });
  });


function randomPA()
{
	//alert();
	var grade = new Array("SS","S","KS","TS","STS");
	$(".cbopa").each(function(index,obj){
		//alert(obj);
		var ind = Math.floor((Math.random() * 5) );
		$(obj).val(grade[ind]);
	});
}

function bersihPA()
{
	//alert();
	var grade = new Array("SS","S","KS","TS","STS");
	$(".cbopa").each(function(index,obj){
		//alert(obj);
		$(obj).val("");
	});
}
		
	</script>
</body>
</html>

