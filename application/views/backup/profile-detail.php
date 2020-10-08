
	<?php

	// from Product Category 
	foreach($setting ->result() as $row)
	{
		foreach($row as $rs)
		{
			$dbset[]=$rs;
		}
	}
	?>
<!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $dbset[2];?>">
    <meta name="author" content="Aldila">
    <title><?= $dbset[2];?></title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/bootstrap.css" type="text/css">   -->
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/font-awesome/css/font-awesome.min.css" type="text/css"> -->
	
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
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
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.0/css/dataTables.responsive.css">
	
	 
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE2.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iCheck/all.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/select2/select2.min.css" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bootstrap-fileinput-master/css/fileinput.css" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fullcalendar.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fullcalendar.print.css" media="print" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/fileinput/css/fileinput.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/summernote/dist/summernote.css" type="text/css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/iconpicker/dist/css/fontawesome-iconpicker.css" type="text/css">
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/admin/img/favicon.ico" />


  <body class="hold-transition sidebar-collapse skin-yellow-light sidebar-mini">
    
	<?php
	
	$row = $users->row();

	//$vacationLeft=0;
	if($row->sex==1)
	{
		$row->sex="<span class='label label-primary'><i class='fa fa-mars'></i>&nbsp; Male</span>";
	}
	else
	{
		$row->sex="<span class='label label-success'><i class='fa fa-venus'></i>&nbsp; Female</span>";		
	}
	
	//work profile
	$profileLabel = Array(
						"Nik",
						"E-Mail",
						"Phone",
						"Workplace",
						"Division",
						"Department"
						);
						
	$profileValue = Array(
						$row->nik,
						$row->email,
						$row->phone,
						$row->loc,
						$row->divs,
						$row->dept
						);
						
	//personal info
	$pinfoLabel = Array(
						"Sex",
						"Address",
						"Phone",
						"Birthdate"
						);		
	$pinfoValue = Array(
						$row->sex,
						$row->address,
						$row->phone,
						$row->bd
						);
						
	//Social Media info
	$socmedLabel = Array(
						"Facebook",
						"Twitter",
						"Linkedin",
						"Google"
						);		
	$socmedValue = Array(
						$row->facebook,
						$row->twitter,
						$row->linkedin,
						$row->gplus
						);
	

	$tottoday=0;
	$totmonth=0;
	$tottodate=0;

	?>


        <!-- Main content -->
        <section class="content">
		  
          <div class="row">
            <div class="col-md-3">
				  
              <!-- Profile Image -->
              <div class="box box-warning">
			  
			  
                <div class="box-body box-profile ">
				<div class = "profile-user-img" style="background-image:url('<?= base_url();?>assets/admin/img/avatar/thumb/<?= $row->ava;?>');">&nbsp;</div>
                  
				  <!-- 
				  <img class="profile-user-img img-responsive img-circle" src="<?= base_url();?>assets/admin/img/avatar/thumb/<?= $this->session->userdata('picUser');?>"  alt="User profile picture" >
				  -->
                  
				  <h3 class="profile-username text-center">
				  
                      <?= $row->name;?>
				  </h3> 
				  <p class="text-muted text-center">
				  
                      <?= $row->title;?>
				  </p>
				  
                <ul class="list-group list-group-unbordered">
				<?php for($i=0; $i<count($profileLabel) ; $i++){ ?>
					<li class="list-group-item">
					  <b><?= $profileLabel[$i]?></b> <b class="text-muted pull-right"><?= $profileValue[$i]?></b>
					</li>
				<?php } ?>
				
				</ul>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->

          
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->

	<!-- 
		retrieve data 
	-->
	
     

      

    </div><!-- ./wrapper -->
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery-2.1.3.min.js"></script> -->
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
	
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

    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/fastclick/fastclick.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/app.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/pages/dashboard2.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/demo.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/validator/dist/validator.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/chartjs/Chart.min.js"></script>
	
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dashboard2.js"></script>
	
	<!-- All functions-->
	<script src="<?php echo base_url();?>assets/admin/iconpicker/dist/js/fontawesome-iconpicker.js" type="text/javascript"></script>
	  <script type="text/javascript">       
	  $(".iconpicker").iconpicker();	  
    </script>

	 <script type="text/javascript">
		
		//setting datatable
		var dto = $('.datatable').DataTable({
			"mark"		: true,
			"scrollX"	: true,
			"autowidth"	: false,
			"dom"		: 'Bfrtip',
			"buttons"	:  	{
							   "dom"		: {
								  "button": {
									"tag": "button",
									"className": "btn btn-flat cusDTButton"
								  }
							},
								"buttons" 	: 
								[
									{
										text:      '<i class="fa fa-plus"></i>&nbsp; Add New Data',
										titleAttr: 'Add new data',
										action: function ( e, dt, node, config ) {
											window.location = $("#saveLink").val();
										},
										className : "btn btn-success addButton"
									},
									{
										text:      '<i class="fa fa-plus"></i>&nbsp; Add Multiple Data',
										titleAttr: 'Add Multiple data',
										action: function ( e, dt, node, config ) {
											window.location = $("#saveLink2").val();
										
										},
										className : "btn btn-primary addMultipleButton"
									},
									{
										extend:    'excelHtml5',
										text:      '<i class="fa fa-file-excel-o"></i>',
										titleAttr: 'Export to Excel',
										className : "btn btn-default"
									},
									{
										extend:    'pdfHtml5',
										text:      '<i class="fa fa-file-pdf-o"></i>',
										titleAttr: 'Export to PDF',
										className : "btn btn-default"
									},
									{
										extend:    'print',
										text:      '<i class="fa fa-print"></i>',
										titleAttr: 'Print',
										className : "btn btn-default"
									}
								]
							},
			"pageLength": 50,
			"responsive": 		{
									details: {
									display: $.fn.dataTable.Responsive.display.childRowImmediate,
										renderer: function ( api, rowIdx, columns ) {
											var data = $.map( columns, function ( col, i ) {
												return col.hidden ?
													'<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
														'<td>'+col.title+':'+'</td> '+
														'<td>'+col.data+'</td>'+
													'</tr>' :
													'';
											} ).join('');
							 
											return data ?
												$('<table/>').append( data ) :
												false;
										}
									}
								}
		});
		
		$('#btnExportExcel').click(function(){
			//alert();
			  //dto.button('1').remove();
		})
		
		$('.datatableemp').DataTable({
			
			mark: true,
			"scrollX":true,
			"autowidth":false,
			dom: 'Bfrtip',
			"buttons"	:  	{
							   "dom"		: {
								  "button": {
									"tag": "button",
									"className": "btn btn-flat cusDTButton"
								  }
							},
								"buttons" 	: 
								[
									{
										text:      '<i class="fa fa-plus"></i>&nbsp; Add New Data',
										titleAttr: 'Add new data',
										action: function ( e, dt, node, config ) {
											window.location = $("#saveLink").val();
										},
										className : "btn btn-success addButton"
									},
									{
										extend:    'excelHtml5',
										text:      '<i class="fa fa-file-excel-o"></i>',
										titleAttr: 'Export to Excel',
										className : "btn btn-primary addMultipleButton"
									},
									{
										extend:    'pdfHtml5',
										text:      '<i class="fa fa-file-pdf-o"></i>',
										titleAttr: 'Export to PDF',
										className : "btn btn-primary"
									},
									{
										extend:    'print',
										text:      '<i class="fa fa-print"></i>',
										titleAttr: 'Print',
										className : "btn btn-primary"
									}
								]
							},
			"pageLength": 50,
			rowGroup: {
				// Group by office
				dataSrc: 3
			}
		});
		
		//alert($("#saveLink2").val());
		
		if(typeof $("#saveLink").val() === "undefined" ){
			
			//alert(document.getElementById("#saveLink"));
			dto.button('.addButton').remove();
		}
		
		if(typeof $("#saveLink2").val() === "undefined" ){
			
			//alert(document.getElementById("#saveLink"));
			dto.button('.addMultipleButton').remove();
		}
			
			
			
		$('#next').on( 'click', function () {
			dto.page( 'next' ).draw( 'page' );
		} );
		 
		$('#previous').on( 'click', function () {
			dto.page( 'previous' ).draw( 'page' );
		} );
		$("#tp1").on("blur",function(){
			var nowTime =parseInt($("#tp1").val().substr(0,2));
			var untilTime =parseInt($("#tp2").val().substr(0,2));
			if(untilTime<nowTime)
				untilTime+=24;
			var dur=untilTime-nowTime;
			//alert(dur);
			if(dur<1)
				dur=1;
			
			$("#tpdur").val(dur);
			$("#lbltpdur").val(dur+" Hour(s)");
		});
			
		$("#tp2").on("blur",function(){
			var nowTime =parseInt($("#tp1").val().substr(0,2));
			var untilTime =parseInt($("#tp2").val().substr(0,2));
			if(untilTime<nowTime)
				untilTime+=24;
			var dur=untilTime-nowTime;
			//alert(nowTime+""+untilTime);
			if(dur<1)
				dur=1;
			
			$("#tpdur").val(dur);
			$("#lbltpdur").val(dur+" Hour(s)");
		});
		
		
		//set datetimepicker
		$('.dtp').datepicker().on('changeDate',function(ev){	
			//set data duration
			try{
				var dur=$('#dtp2').datepicker().data('datepicker').date.valueOf()-$('#dtp1').datepicker().data('datepicker').date.valueOf();
			if(dur<0 || $('#dtp2').val()=="")
			{
				$('#dur').val("0");
			}
			else
			{
				var lama=(dur/60/60/24/1000)+1;
				$('#dur').val(lama);
				$('#lbldur').val(lama+" Day(s)");		
			}
			}
			catch(err){
				//alert(err.message);
			}
			
			
			
			$('.dtp').datepicker('hide');
		});
		
		//show tooltip
		$('[data-toggle="tooltip"]').tooltip(); 
	</script>


    <script src="<?php echo base_url();?>assets/admin/select2/select2.full.min.js"></script>

    <script type="text/javascript">
	
        $(".mulselect").select2();
    </script>
	
	
    <script src="<?php echo base_url();?>assets/js/clockpicker.js"></script>

    <script type="text/javascript">
		
$('.tp').clockpicker({
    donetext: 'Done',
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});
    </script>
	
	    <script src="<?php echo base_url();?>assets/admin/fileinput/js/fileinput.js" type="text/javascript"></script>
	  <script type="text/javascript">
	  
        
	  $(".fileupload").fileinput();
		
		
	  $(".programPicUpload").fileinput();
	  
    </script>
	
	
	<script src="<?php echo base_url();?>assets/admin/summernote/dist/summernote.js" type="text/javascript"></script>
	  <script type="text/javascript">
	  
      
			$('.summernote').summernote({
				height: 200,
				onImageUpload: function(files) {
					sendFile(files[0]);
				}
			});

		   function sendFile(file,editor,welEditable) {
			  data = new FormData();
			  data.append("file", file);
			  var urlTmp = "<?php echo site_url(); ?>";
			   $.ajax({
			   url: urlTemp+"/Uploader",
			   data: data,
			   cache: false,
			   contentType: false,
			   processData: false,
			   type: 'POST',
			   success: function(data){
			   alert(data);
				$('.summernote').summernote("insertImage", data, 'filename');
			},
			   error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus+" "+errorThrown);
			  }
			});
		   }
		
	  
    </script>
	
	 <script type="text/javascript">
	 
		//$("#notificationAlert").hide();
		
		//delete confirmation
		$('#tblView').on("click",".deleteBtn",function(e) {
			var pid=$(this).attr("name");
			var delLink=$("#deleteSubmit").attr("href")+"/Delete/"+pid;
			$("#deleteSubmit").attr("href",delLink);
		});
	 
		//Start confirmation
		$('#tblView').on("click",".startBtn",function(e) {
			var pid=$(this).attr("name");
			//var delLink=$("#startSubmit").attr("href")+"/Start/"+pid;
			//alert(pid);
			$("#frm-confirm-start").attr("action",pid);
		});
		
		//Finish confirmation
		$('#tblView').on("click",".finishBtn",function(e) {
			var pid=$(this).attr("name");
			//var delLink=$("#startSubmit").attr("href")+"/Start/"+pid;
			//alert(pid);
			$("#frm-confirm-finish").attr("action",pid);
		});
	 
		//add new data confirmation
		$('#tblView').on("click","#submitBtn",function(e) {
			var pid=$(this).attr("name");
			var delLink=$("#deleteSubmit").attr("href")+"/Save/";
			$("#confirmSubmit").attr("href",delLink);
		});
		
		
		//employee detail
		$('#tblView').on("click",".employeeDetailBtn",function(e) {
			var pid=$(this).attr("name");
		//alert(pid);
			
			$.ajax({
				url : "<?= site_url()?>Users/getEmployeeDetail/" + pid,
				success : function(s){
					//alert(s);
					$("#employee-detail-content").html(s);
				}
			});
			//var delLink=$("#deleteSubmit").attr("href")+"/Save/";
			//$("#confirmSubmit").attr("href",delLink);
		});
		
		$('#submit').click(function(){
			 /* when the submit button in the modal is clicked, submit the form */
			//$("#success-alert").alert();
			$('#formfield').submit();
		});

	  
	  
    var yourStartLatLng = new google.maps.LatLng(53.307697, -6.222317);
	</script>
	
  
	 <script type="text/javascript">

  'use strict';
  //-----------------------
  //- MONTHLY ABSENCE CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);
  var year=0;
  
  if($("#year").html())
	  year=$("#year").html();
 
	$.ajax({
		url:"<?= site_url()?>Admin/getMonthlyRecap/"+year,
		success:function(s)
		{

			//alert(s);
			var label=new Array();
			var data1=new Array();
			var data2=new Array();
			var dataAll=s.split("##");
			
			var dataReturn=dataAll[1].split("||");
			//last year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				label[i]=dt[0];
				data1[i]=dt[1];
			}
			
			
			dataReturn=dataAll[0].split("||");
			
			//current year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				label[i]=dt[0];
				data2[i]=dt[1];
			}
			
			//change label name
			
			
			var dt1=
			  {
				label: "last Year",
				fillColor: "rgb(210, 214, 222)",
				strokeColor: "rgb(210, 214, 222)",
				pointColor: "rgb(210, 214, 222)",
				pointStrokeColor: "#c1c7d1",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgb(220,220,220)",
				data: data1
			  };
			var dt2=
			  {
				label: "Current Year",
				fillColor: "rgba(60,141,188,0.9)",
				strokeColor: "rgba(60,141,188,0.8)",
				pointColor: "#3b8bba",
				pointStrokeColor: "rgba(60,141,188,1)",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(60,141,188,1)",
				data: data2
			  }
			 
			var salesChartData = {
				labels: label,
				datasets: [dt1,dt2]
			};

		  var salesChartOptions = {
			  
			//Boolean - If we should show the scale at all
			showScale: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,
			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",
			//Number - Width of the grid lines
			scaleGridLineWidth: 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - Whether the line is curved between points
			bezierCurve: true,
			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.3,
			//Boolean - Whether to show a dot for each point
			pointDot: true,
			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,
			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,
			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,
			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,
			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,
			//Boolean - Whether to fill the dataset with a color
			datasetFill: true,
			//String - A legend template
			 //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true
		  };

		  //Create the line chart
		  salesChart.Line(salesChartData,);
		},
		error : function(a,b,c)
		{
			alert(c);
		}
	});
	

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------


  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  
  
	var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
	var pieChart = new Chart(pieChartCanvas);
	
		$.ajax({
		url:"<?= site_url()?>Admin/getCategoryRecap",
		success:function(s)
		{
			
			var pieValue=new Array();	
			var pieLabelColor=new Array("cyan","lightgreen","pink","yellow","orange","grey","lightgrey","lightblue","pink","darkgreen","magenta");
			var pieLabel=new Array();
			
			var dataAll=s.split("||");
			
			for(var i=0;i<dataAll.length;i++)
			{
				
				var dt=dataAll[i].split("++");
				pieLabel[i]=dt[0];
				pieValue[i]=dt[1];
			}
			
			var PieTemp={};
			
			//alert(pieValue.length);
			for(var i=0;i<pieValue.length;i++)
			{
				PieTemp[i]= 
				{
				  value: pieValue[i],
				  color: pieLabelColor[i],
				  highlight: "rgba(60,141,188,1)",
				  label: pieLabel[i]
				};
			}	
			//alert(PieTemp[0]['value']);
			
			var PieData = PieTemp;
			
		  
		  var pieOptions = {
			legend: {
				display: true,
				labels: {
					fontColor: 'rgb(255, 99, 132)'
			}},
			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,
			//String - The colour of each segment stroke
			segmentStrokeColor: "#fff",
			//Number - The width of each segment stroke
			segmentStrokeWidth: 1,
			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 50, // This is 0 for Pie charts
			//Number - Amount of animation steps
			animationSteps: 100,
			//String - Animation easing effect
			animationEasing: "easeOutBounce",
			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,
			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: false,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true,
			// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: false,
			//String - A legend template
			legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
			//String - A tooltip template
			tooltipTemplate: "<%=label%> = <%=value %> "
		  };
		  //Create pie or douhnut chart
		  // You can switch between pie and douhnut using the method below.
		  pieChart.Doughnut(PieData, pieOptions);
		}
		});
	
  //-----------------
  //- END PIE CHART -
  //-----------------

    </script>
	
	
	
</body>
</html>
