<?php $this->load->view("partial/header"); ?>
<link href="<?php echo base_url(); ?>assets/css/jasny-bootstrap.min.css" rel="stylesheet" media="screen"/>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
     <h1><i class="icon fa fa-list"></i> <?php echo $title ?> (Files)</h1>
</div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <!-- Start -->
                    <div class="widget-content nopadding table_holder table-responsive" >
                        <?php echo $manage_table; ?>
                    </div>     
                        <div class="col-xs-12">
                        Fields in red are required
                        <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>
                                        </span>
                                        File upload
                                    </h5>
                                </div>
                                <div class="widget-body">
                                <br>
                                <form action="<?php echo site_url("$controller_name/uploads") ?>" id="form-uploads">  
							        <label class="control-label col-sm-3 col-md-3 col-lg-2">File Type:</label>							        
							        <input type="hidden" name="id_form" value="<?php echo $id_form?>" />
							        <div class="col-sm-8 col-md-4 col-lg-8 fileinput fileinput-new input-group" data-provides="fileinput">
							            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
							            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Select file</span><span class="fileinput-exists"><i class="glyphicon glyphicon-repeat"></i> Change</span><input type="file" name="file[]" multiple id="file"></span>
							            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="glyphicon glyphicon-remove"></i> Remove</a>
							            <a href="#" id="upload-btn" class="input-group-addon btn btn-success fileinput-exists"><i class="glyphicon glyphicon-open"></i> Upload</a>
							        </div>

							        <label class="control-label col-sm-3 col-md-3 col-lg-2"></label>	
							        <div class="col-sm-3 col-md-4 col-lg-4 input-group">
							        	<h5>  *.doc  *.pdf  *.docx  *.xlsx  *.png  *.jpeg  *.txt  *.zip</h5>
							        </div>



							    </form>

							    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-search"></i> View List File Upload</h3>
                                                <div class="clearboth"></div>
                                            </div><br>
                                                 
                                               		<div class='col-xs-12'>
													    <div class='box box-solid box-info col-xs-12 col-lg-12 no-padding'>
													    	<div class="progress" style="display:none;">
														      <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
														        20%
														      </div>
														    </div>
														    <ul class="list-group"><ul>
							                                
							                            </div>
						                            </div>  
                                            </div>
                                        </div> 
                    <!-- End -->
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>    
<script type="text/javascript">
	$(function () {
		var inputFile = $('input#file');
		var uploadURI = $('#form-uploads').attr('action');
		var progressBar = $('#progress-bar');	

		listFilesOnServer();

		$('#upload-btn').on('click', function(event) {
			var filesToUpload = inputFile[0].files;
			// make sure there is file(s) to upload
			if (filesToUpload.length > 0) {
				// provide the form data
				// that would be sent to sever through ajax
				var formData = new FormData();
				for (var i = 0; i < filesToUpload.length; i++) {
					var file = filesToUpload[i];

        			formData.append('id', <?php echo $id_form?>);
					formData.append("file[]", file, file.name);				
				}
				// now upload the file using $.ajax
				$.ajax({
					url: uploadURI,
					type: 'post',
					data: formData,
					processData: false,
					contentType: false,
					success: function(c) {
						// get list when success
						listFilesOnServer();
					},
					xhr: function() {
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event) {
							if (event.lengthComputable) {
								var percentComplete = Math.round( (event.loaded / event.total) * 100 );
								// console.log(percentComplete);
								
								$('.progress').show();
								progressBar.css({width: percentComplete + "%"});
								progressBar.text(percentComplete + '%');
							};
						}, false);

						return xhr;
					}
				});
			}
		});

		$('body').on('click', '.remove-file', function () {

			var me = $(this);
			var id = me.attr('href');
			var name = me.attr('data-file');
			$.ajax({
				url: uploadURI,
				type: 'post',
				data: {file_to_remove: me.attr('data-file'), id_to_remove: id},
				success: function() {
					me.closest('li').remove();
				}
			});
		})

		function listFilesOnServer () {
			var ca = "<?php echo site_url("$controller_name/get_list")?>";
			var item_id = $("input[name='id_form']").val();
		    $.post(ca,{ id : item_id },
			function(data){
				$('.list-group').html(data);		    
		    });
		}

		$('body').on('change.bs.fileinput', function(e) {
			$('.progress').hide();
			progressBar.text("0%");
			progressBar.css({width: "0%"});
		});
	});
</script>
<?php $this->load->view("partial/footer"); ?>