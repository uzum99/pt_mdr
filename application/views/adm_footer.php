
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
          <b>Version</b> 2.0
    </div>
        <strong>Copyright &copy; 2016 <a href="#"><?= $dbset[2];?></a>.</strong> All rights reserved.
  </footer>
  

      
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

    </div><!-- ./wrapper -->
	
	
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery-2.1.3.min.js"></script> -->
	<!--
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	-->
	
	<script src="<?php echo base_url();?>assets/landing/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/landing/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url();?>assets/landing/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	
    <!-- <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css"></script> -->
	
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/bootstrap-datepicker.js"></script>

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


	<!-- JQVMap -->
	<script src="<?php echo base_url();?>assets/landing/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url();?>assets/landing/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url();?>assets/landing/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url();?>assets/landing/plugins/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/landing/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php echo base_url();?>assets/landing/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="<?php echo base_url();?>assets/landing/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="<?php echo base_url();?>assets/landing/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>assets/landing/dist/js/adminlte.js"></script>
	
	
	
<!--
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/app.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/dist/js/pages/dashboard2.js"></script>
	-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/admin/validator/dist/validator.js"></script>
	
	
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	<!-- All functions-->
	<script src="<?php echo base_url();?>assets/admin/iconpicker/dist/js/fontawesome-iconpicker.js" type="text/javascript"></script>
	 <script type="text/javascript">       
	  $(".iconpicker").iconpicker();	  
    </script>
	
	<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
	
	<script type="text/javascript">   
   function validateFileType(){
        var fileName = document.getElementByClass("fileupload").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
        }   
    }	  
    </script>

	<script type="text/javascript">
		
		//setting datatable
		if($(".datatable"))
		var dto = $('.datatable').DataTable({
			"mark"		: true,
			"scrollX"	: true,
			"autowidth"	: false,
			"dom"		: 'Bfrtip',
        "columnDefs": [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        "select": {
            style:    'os',
            selector: 'td:first-child'
        },
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
										text:      '<i class="fas fa-file-excel text-green"></i>',
										titleAttr: 'Export to Excel',
										className : "btn btn-default"
									},
									{
										extend:    'pdfHtml5',
										text:      '<i class="fas fa-file-pdf text-red"></i>',
										titleAttr: 'Export to PDF',
										className : "btn btn-default"
									},
									{
										extend:    'print',
										text:      '<i class="fas fa-print"></i>',
										titleAttr: 'Print',
										className : "btn btn-default"
									},
									{
										text:      '<i class="fa fa-check"></i>&nbsp; Approve',
										titleAttr: 'Approve Selected Data',
										className : "btn btn-primary approveButton"
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
		
		if(!document.getElementById("isApproved")  )
		{
			//alert("as");
			 dto.button('5').remove();
		}
		
		
		$('.approveButton').click(function(){
			//alert();
			//var count = dto.rows( { selected: true } ).count();
			var id=new Array();
			dto.rows( { selected: true }).every(function( rowIdx, tableLoop, rowLoop){
				if($("#txt"+rowIdx).attr('data') != "")
				{
					id[rowIdx]=$("#txt"+rowIdx).attr('data');
					//alert(id);
				}
			});
			
			if(id.length > 0)
			{ 
				var link = $("#isApproved").attr('data');
				//alert(link);
				$.ajax({
					url:"<?= site_url()?>"+link+"/ApproveBatch",
					data:{'id':id},
					method:"POST",
					success:function(s){
						//alert(s);
						
						alert(s)
						if(s=="Approved")
						{
							window.location = "<?= site_url()?>"+link;
						}
					}
				});
			
			}
			
			
		})
		
		$('#btnExportExcel').click(function(){
			//alert();
			  //dto.button('1').remove();
		})
		
		var dtoemp = $('.datatableemp').DataTable({
			
			mark: true,
			"scrollX":true,
			"autowidth":false,
			"select" : true,
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
										text:      '<i class="fa fa-file-excel"></i>',
										titleAttr: 'Export to Excel',
										className : "btn btn-default "
									},
									{
										extend:    'pdfHtml5',
										text:      '<i class="fa fa-file-pdf"></i>',
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
			rowGroup: {
				// Group by office
				dataSrc: 12
			},
			"responsive": 		{
									details: {
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
		
		//alert($("#saveLink2").val());
		
		if(typeof $("#saveLink").val() === "undefined" ){
			
			//alert(document.getElementById("#saveLink"));
			dto.button('.addButton').remove();
			dtoemp.button('.addButton').remove();
		}
		
		if(typeof $("#saveLink2").val() === "undefined" ){
			
			//alert(document.getElementById("#saveLink"));
			dto.button('.addMultipleButton').remove();
			dtoemp.button('.addMultipleButton').remove();
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

    <script src="<?php echo base_url();?>assets/admin/select2/select2.full.js"></script>

    <script type="text/javascript">
	
        $(".select2").select2();
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
		
		//check point confirmation
		$('#tblView').on("click",".checkPointBtn",function(e) {
			var pid=$(this).attr("name");
			//var delLink=$("#startSubmit").attr("href")+"/Start/"+pid;
			//alert(pid);
			$("#frm-checkpoint").attr("action",pid);
		});
	 
		//add new data confirmation
		$('#tblView').on("click","#submitBtn",function(e) {
			var pid=$(this).attr("name");
			var delLink=$("#deleteSubmit").attr("href")+"/Save/";
			$("#confirmSubmit").attr("href",delLink);
		});
		
		//add new data confirmation
		$('#tblView').on("click",".signBtn",function(e) {
			var pid=$(this).attr("name");
			$("#txtsignId").val(pid);
			//var delLink=$("#signSubmit").attr("href")+"/saveSign/";
			//$("#confirm-sign").attr("href",delLink);
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

	  
	
	$("#signSubmit").on("click",function(){
		//alert();
		var res = window.confirm("Submit signature?");
		//alert(res);
		if (res == true)
		{
			//alert($(this).attr("name"));
			//$("#txtsignId").val($(this).attr("name"));
			$("#form-mt-sign").submit();
		}
			
	});
	
	$("#form-mt-sign").on("submit",function(e){
		var saveData = $(this).serialize();
		//alert(saveData);
		e.preventDefault();
		$.ajax({
			url : "<?= site_url();?>Maintenance/saveSign",
			method:"post",
			data : saveData,
			success : function(s)
			{
				
				//alert(s);
				window.location.reload();
				return false;
			}
			
		});
	});
	  
 //   var yourStartLatLng = new google.maps.LatLng(53.307697, -6.222317);
	</script>
	
  <script type="text/javascript">
  
  var year=0;
  
  if($("#year").html())
	  year=$("#year").html();
  
  if($("#salesChart"))
	  salesChart($("#salesChart").data('id'));
	 
  function salesChart(codeUser="")
  {
  
  $.ajax({
		url:"<?= site_url()?>Admin/getMonthlyRecap/"+year+"/"+codeUser,
		success:function(s)
		{

			//alert(s);
			var label=new Array();
			var data1=new Array();
			var data2=new Array();
			var dataAll=s.split("##");
			var total = new Array(0,0);
			
			var dataReturn=dataAll[1].split("||");
			//last year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				label[i]=dt[0];
				data1[i]=dt[1];
				total[1] += parseInt(dt[1]);
			}
			
			
			dataReturn=dataAll[0].split("||");
			
			//current year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				//label[i]=dt[0];
				data2[i]=dt[1];
				total[0] += parseInt(dt[1]);
			}
			
			
			$("#lrCurrent").html(total[0].toString());
			$("#lrLast").html(total[1].toString());
			
			var ctx = document.getElementById('salesChart').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: label,
					datasets: [{
						label: 'Current year',
						data: data2,
						backgroundColor: 'rgba(255, 99, 132, 0.2)'
						,
						borderColor: 'rgba(255, 99, 132, 1)',
						borderWidth: 1
					},{
						label: 'Last year',
						data: data1,
						backgroundColor: 'rgba(54, 162, 235, 0.2)'
						,
						borderColor: 'rgba(54, 162, 235, 1)',
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					},
				plugins:{
				  labels: 
				  {
					render: 'value',
					fontColor: "black",
					position: 'outside'
				  }
				  
				}
				}
			});
			
		}
		
		});
		
	}
</script>

	<script type="text/javascript">

  if($("#salesChartAttendance").html())
	  salesChartAttendance($("#salesChartAttendance").data('id'));
	 
  function salesChartAttendance(codeUser="")
  {
  var year=0;
  
  if($("#year").html())
	  year=$("#year").html();
  
  $.ajax({
		url:"<?= site_url()?>Admin/getMonthlyAttendanceRecap/"+year+"/"+codeUser,
		success:function(s)
		{

			//alert(s);
			var label=new Array();
			var data1=new Array();
			var data2=new Array();
			var dataAll=s.split("##");
			var total = new Array(0,0);
			
			var dataReturn=dataAll[1].split("||");
			//last year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				label[i]=dt[0];
				data1[i]=dt[1];
				total[1] += parseInt(dt[1]);
			}
			
			
			dataReturn=dataAll[0].split("||");
			
			//current year
			for(var i=0;i<dataReturn.length;i++)
			{
				
				var dt=dataReturn[i].split("++");
				//label[i]=dt[0];
				data2[i]=dt[1];
				total[0] += parseInt(dt[1]);
			}
			
			
			$("#laCurrent").html(total[0].toString());
			$("#laLast").html(total[1].toString());
			
			var ctx = document.getElementById('salesChartAttendance').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: label,
					datasets: [{
						label: 'Current year',
						data: data2,
						backgroundColor: 'rgba(255, 99, 132, 0.2)'
						,
						borderColor: 'rgba(255, 99, 132, 1)',
						borderWidth: 1
					},{
						label: 'Last year',
						data: data1,
						backgroundColor: 'rgba(54, 162, 235, 0.2)'
						,
						borderColor: 'rgba(54, 162, 235, 1)',
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});
			
		}
		
		});
		
	}
</script>
	
	<script type="text/javascript">

  if($("#salesChar2t").html())
	  salesChar2t();
	 
  function salesChar2t()
  {
	  
  'use strict';
  //-----------------------
  //- MONTHLY ABSENCE CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChar2t").get(0).getContext("2d");
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

		  //Create the line chart
		  salesChart.Bar(salesChartData);
		},
		error : function(a,b,c)
		{
			alert(c);
		}
	});
  }

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

    </script>
	
	 <script type="text/javascript">

  if($("#pieChart"))
	  pieChart();
  
  function pieChart()
  {
	  //alert();
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  
  //alert();

			
			  
	
		$.ajax({
		url:"<?= site_url()?>Admin/getCategoryRecap/"+year,
		success:function(s)
		{
			
			var pieValue=new Array();	
			var pieColor = new Array();
			var colorPallette=new Array(
									"#af460f",
									"#fe8761",
									"#fed39f",
									"#d3f4ff",
									"#52de97",
									"#c9b6e4",
									"#ede59a",
									"#bbded6",
									"#ff6464",
									"#916dd5",
									"#2c786c");
			var pieLabel=new Array();
			
			var dataAll=s.split("||");
		
			
			
			for(var i=0;i<dataAll.length;i++)
			{
				
				var dt=dataAll[i].split("++");
				pieLabel[i]=dt[0];
				pieValue[i]=dt[1];
				pieColor[i]=colorPallette[i];
			}
			
			
		var pieOptions = {
		legend: {
			display:false
		},tooltips: {
			display:true
		},
		plugins:{
		  labels: [
		  {
			render: 'percentage',
			fontColor: "black",
			precision: 1
		  },
		  {
			render: 'label',
			fontColor: "black",
			position: 'outside',
        outsidePadding: 10
		  }
		  ]
		}
		};

		var pie = document.getElementById('pieChart').getContext('2d');
		var myChart = new Chart(pie, {
			type: 'doughnut',
			data: {
				datasets: [{
					data: pieValue,
				backgroundColor: pieColor,
				
				}],
				labels: pieLabel
			},
			options: pieOptions
		});
		
		  
		$("#pieChart").click( 
			function(evt){
				var activePoints = myChart.getElementsAtEvent(evt)[0];
				var leaveType = activePoints._view.label;
				var url = "<?= site_url();?>Vacation?type=" + leaveType.replace(/ /g,"_")+"&year="+year;
				location.href=url;
				//console.log(activePoints._view.label);
			}
		); 
			
			
		}
		});
	}
  //-----------------
  //- END PIE CHART -
  //-----------------

    </script>
	
	<script type="text/javascript">
	$(".btn-vac-approve").on("click",function(e){
		e.preventDefault();
		var lnk = $(this).data("lnk");
		var idData = $(this).data("id");
		var picData = $(this).data("pic");
		var msgData = window.prompt("Additional Notes");
		//alert(lnk+idData+picData);
		
		$.ajax({
			url : "<?= site_url();?>"+lnk,
			method : "post",
			data : { 'id' : idData, 'pic' : picData, 'msg' : msgData},
			success : function(s)
			{
				//alert(s);
				alert("Success");
				location.reload();
			}
		});
		
	})
	
	
	$(".btn-vac-reject").on("click",function(e){
		e.preventDefault();
		var lnk = $(this).data("lnk");
		var idData = $(this).data("id");
		var picData = $(this).data("pic");
		var msgData = window.prompt("Reason");
		//alert(lnk+idData+picData);
		
		$.ajax({
			url : "<?= site_url();?>"+lnk,
			method : "post",
			data : { 'id' : idData, 'pic' : picData, 'msg' : msgData},
			success : function(s)
			{
				//alert(s);
				alert("Success");
				location.reload();
			}
		});
		
	})
	</script>
	
	<!-- maintenance add item -->
	<script type="text/javascript">
	$("#txtItemBatch").on("blur",function(){
		var itemBatch = $(this).val();
		if(itemBatch != "")
		{
		$.ajax({
			url : "<?= site_url();?>Maintenance/getItemDetail/",
			method :"post",
			data : {"itemBatch" : itemBatch},
			success : function(s)
			{
				//alert(s);
				if(s != "0")
				{
					var dt = s.split("~");
					$("#txtItemDesc").val(dt[0]);
					$("#txtItemSN").val(dt[1]);
					//$("#txtItemPic").val(dt[1]);
					$("#txtItemPic").attr("src","<?= base_url();?>assets/admin/img/item/"+dt[2])
				}
			}
		});
		}
	})
	
	$("#btn-save-mtitem").on("click",function(){
		//alert();
		var res = window.confirm("Add new item?");
		//alert(res);
		if (res == true)
		{
			$("#form-mt-item").submit();
		}
			
	});
	
	$("#form-mt-item").on("submit",function(e){
		var saveData = $(this).serialize();
		//alert(saveData);
		e.preventDefault();
		$.ajax({
			url : "<?= site_url();?>Maintenance/saveItem",
			method:"post",
			data : saveData,
			success : function(s)
			{
				
				//alert(s);
				location.reload();
			}
			
		});
	});
	
	
	/*
	$("#btn-save-mtact").on("click",function(){
		//alert();
		var res = window.confirm("Add new Activity?");
		//alert(res);
		if (res == true)
		{
			$("#form-mt-act").submit();
		}
			
	});
	*/
	
	$("#form-mt-act").on("submit",function(e){
		//var saveData = $(this).serialize();
		
		var saveData = new FormData(this);
		//console.log(saveData);
		e.preventDefault();
		
		$.ajax({
			url : "<?= site_url();?>Maintenance/saveAct",
			method:"post",
			data : saveData,
			processData: false,
			contentType: false,
			success : function(s)
			{
				
				//alert(s);
				location.reload();
			}
			
		});
		
	});
	
	$(".btn-mt").on("click",function(e){
		e.preventDefault();
		//alert();
		var id = $(this).data('id');
		var lnk = $(this).data('lnk');
		$.ajax({
			url : "<?= site_url();?>Maintenance/"+lnk,
			method : "post",
			data : {"id" : id},
			success : function(s)
			{
				//alert(s);
				alert("Success");
				location.reload();
			}
		})
	})
	
	</script>
	
	
	 <script type="text/javascript">
	 if($("#signature-pad"))
	 {
		//alert();
		
		var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
		  backgroundColor: 'rgba(255, 255, 255, 0)',
		  penColor: 'rgb(0, 0, 0)',
		  onEnd: function()
		  {
			  
			var imgData = signaturePad.toDataURL();
			//alert(imgData);
			$("#txtsignpad").val(imgData);
			 //alert();
		  }
		});
		
		signaturepad.onEnd(function(){
			//alert();
		});
		
		function clearSignpad()
		{
			signaturePad.clear();
			$("#txtsignpad").val("");
		}
		 
	 }
	
			 
	</script>
	
	
	
</body>
</html>
