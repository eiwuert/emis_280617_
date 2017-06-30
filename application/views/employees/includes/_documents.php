<div class="tab-pane" id="documents">
	<!---Start Permenant Address Block-->
	<div class="row">
  		<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
				<i class="fa fa-files-o"></i> Uploaded Documents
			</h4>
  		</div><!-- /.col -->
	</div>

	<div class="table-responsive disp-doc">

		<table class="table table-bordered">
			<tbody>
				<tr>
					<th class="text-center"><label for="studocs-stu_docs_category_id">Category</label></th>
					<th class="text-center"><label for="studocs-stu_docs_details">Document Details</label></th>
					<th class="text-center"><label for="studocs-stu_docs_status">Status</label></th>
					<th class="text-center " style="width: 34%;">Action</th>
				</tr>
				<tr>
					<th class="text-center" colspan="4">No Documents Uploaded..</th>
				</tr>		
			</tbody>
		</table>
	</div>

	<script>
		/*$(document).ready(function(){
		     $('input[type=file]').bootstrapFileInput();
		});*/
	</script>

	<div class="col-xs-12 col-lg-12 no-padding" style="display:block">
		<div class="row">
			<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
				<i class="fa fa-upload"></i> Upload Remaining Documents	     
			</h4>
			</div><!-- /.col -->
		</div>

		<div class="box-default box view-item col-xs-12 col-lg-12">
			<div class="stu-docs-form">       
				<form id="stu-docs-form" action="/EduSec/index.php?r=student%2Fstu-master%2Fadddocs" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_csrf" value="TDZQZE45eEl4eiUzO3YeBgMCaFF9Tksafk4jHS1YEzk.fmANFHM5EA==">	   		
					<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
						<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_category_id_temp-1">
								<label class="control-label" for="studocs-stu_docs_category_id_temp-1">Category</label>
								<input type="text" id="studocs-stu_docs_category_id_temp-1" class="form-control" name="StuDocs[stu_docs_category_id_temp][1]" value="S.S.C. Marksheet" maxlength="100" readonly="">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_category_id-1 required">
								<input type="hidden" id="studocs-stu_docs_category_id-1" class="form-control" name="StuDocs[stu_docs_category_id][1]" value="1">
							</div>
						</div>			

						<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_details-1">
								<label class="control-label" for="studocs-stu_docs_details-1">Document Details</label>
								<input type="text" id="studocs-stu_docs_details-1" class="form-control" name="StuDocs[stu_docs_details][1]" maxlength="100">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_stu_master_id required">
								<input type="hidden" id="studocs-stu_docs_stu_master_id" class="form-control" name="StuDocs[stu_docs_stu_master_id]" value="16">
							</div>
						</div>

					    <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
							<div class="col-lg-10 col-sm-6 col-md-10">
								<div class="form-group field-studocs-stu_docs_path-1">
									<label class="control-label" for="studocs-stu_docs_path-1">Document</label>
									<input type="hidden" name="StuDocs[stu_docs_path][1]" value="">
									<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 ">
										<span>Browse Document</span>
										<input type="file" id="studocs-stu_docs_path-1" name="StuDocs[stu_docs_path][1]" title="Browse Document" data-filename-placement="inside">
									</a>
									<div class="help-block"></div>
								</div>
							</div>
					    </div>
					</div>

						<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
						<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_category_id_temp-2">
								<label class="control-label" for="studocs-stu_docs_category_id_temp-2">Category</label>
								<input type="text" id="studocs-stu_docs_category_id_temp-2" class="form-control" name="StuDocs[stu_docs_category_id_temp][2]" value="H.S.C. Marksheet" maxlength="100" readonly="">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_category_id-2 required">
								<input type="hidden" id="studocs-stu_docs_category_id-2" class="form-control" name="StuDocs[stu_docs_category_id][2]" value="2">
							</div>
						</div>			

						<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_details-2">
								<label class="control-label" for="studocs-stu_docs_details-2">Document Details</label>
								<input type="text" id="studocs-stu_docs_details-2" class="form-control" name="StuDocs[stu_docs_details][2]" maxlength="100">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_stu_master_id required">
								<input type="hidden" id="studocs-stu_docs_stu_master_id" class="form-control" name="StuDocs[stu_docs_stu_master_id]" value="16">
							</div>		    
						</div>

					    <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
							<div class="col-lg-10 col-sm-6 col-md-10">
								<div class="form-group field-studocs-stu_docs_path-2">
									<label class="control-label" for="studocs-stu_docs_path-2">Document</label>
									<input type="hidden" name="StuDocs[stu_docs_path][2]" value="">
									<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 ">
										<span>Browse Document</span>
										<input type="file" id="studocs-stu_docs_path-2" name="StuDocs[stu_docs_path][2]" title="Browse Document" data-filename-placement="inside">
									</a>
									<div class="help-block"></div>
								</div>
							</div>
					    </div>
					</div>

			   		<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
				    	<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_category_id_temp-3">
								<label class="control-label" for="studocs-stu_docs_category_id_temp-3">Category</label>
								<input type="text" id="studocs-stu_docs_category_id_temp-3" class="form-control" name="StuDocs[stu_docs_category_id_temp][3]" value="Leaving Certificate" maxlength="100" readonly="">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_category_id-3 required">
								<input type="hidden" id="studocs-stu_docs_category_id-3" class="form-control" name="StuDocs[stu_docs_category_id][3]" value="3">
							</div>
						</div>			

				    	<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_details-3">
								<label class="control-label" for="studocs-stu_docs_details-3">Document Details</label>
								<input type="text" id="studocs-stu_docs_details-3" class="form-control" name="StuDocs[stu_docs_details][3]" maxlength="100">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_stu_master_id required">
								<input type="hidden" id="studocs-stu_docs_stu_master_id" class="form-control" name="StuDocs[stu_docs_stu_master_id]" value="16">
							</div>
						</div>

					    <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
							<div class="col-lg-10 col-sm-6 col-md-10">
								<div class="form-group field-studocs-stu_docs_path-3">
									<label class="control-label" for="studocs-stu_docs_path-3">Document</label>
									<input type="hidden" name="StuDocs[stu_docs_path][3]" value="">
									<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 ">
										<span>Browse Document</span>
										<input type="file" id="studocs-stu_docs_path-3" name="StuDocs[stu_docs_path][3]" title="Browse Document" data-filename-placement="inside">
									</a>
									<div class="help-block"></div>
								</div>
							</div>
					    </div>
					</div>

			   		<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
				    	<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_category_id_temp-4">
								<label class="control-label" for="studocs-stu_docs_category_id_temp-4">Category</label>
								<input type="text" id="studocs-stu_docs_category_id_temp-4" class="form-control" name="StuDocs[stu_docs_category_id_temp][4]" value="Bonafied Certificate" maxlength="100" readonly="">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_category_id-4 required">
								<input type="hidden" id="studocs-stu_docs_category_id-4" class="form-control" name="StuDocs[stu_docs_category_id][4]" value="4">
							</div>
						</div>			

					    <div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_details-4">
								<label class="control-label" for="studocs-stu_docs_details-4">Document Details</label>
								<input type="text" id="studocs-stu_docs_details-4" class="form-control" name="StuDocs[stu_docs_details][4]" maxlength="100">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_stu_master_id required">
								<input type="hidden" id="studocs-stu_docs_stu_master_id" class="form-control" name="StuDocs[stu_docs_stu_master_id]" value="16">
							</div>		    
						</div>

					    <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
							<div class="col-lg-10 col-sm-6 col-md-10">
								<div class="form-group field-studocs-stu_docs_path-4">
									<label class="control-label" for="studocs-stu_docs_path-4">Document</label>
									<input type="hidden" name="StuDocs[stu_docs_path][4]" value="">
									<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 ">
										<span>Browse Document</span>
										<input type="file" id="studocs-stu_docs_path-4" name="StuDocs[stu_docs_path][4]" title="Browse Document" data-filename-placement="inside">
									</a>
									<div class="help-block"></div>
								</div>
							</div>
					    </div>
					</div>

			   		<div class="col-xs-12 col-sm-12 col-lg-12" style="background-color:#f4f4f4; border-bottom:2px solid #ddd;margin-bottom:2%;padding:1%">
				    	<div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_category_id_temp-6">
								<label class="control-label" for="studocs-stu_docs_category_id_temp-6">Category</label>
								<input type="text" id="studocs-stu_docs_category_id_temp-6" class="form-control" name="StuDocs[stu_docs_category_id_temp][6]" value="Migration Certificate" maxlength="100" readonly="">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_category_id-6 required">
								<input type="hidden" id="studocs-stu_docs_category_id-6" class="form-control" name="StuDocs[stu_docs_category_id][6]" value="6">
							</div>		    
						</div>			

					    <div class="col-xs-12 col-sm-4 col-lg-4">
							<div class="form-group field-studocs-stu_docs_details-6">
								<label class="control-label" for="studocs-stu_docs_details-6">Document Details</label>
								<input type="text" id="studocs-stu_docs_details-6" class="form-control" name="StuDocs[stu_docs_details][6]" maxlength="100">
								<div class="help-block"></div>
							</div>
							<div class="form-group field-studocs-stu_docs_stu_master_id required">
								<input type="hidden" id="studocs-stu_docs_stu_master_id" class="form-control" name="StuDocs[stu_docs_stu_master_id]" value="16">
							</div>
						</div>

					    <div class="col-xs-12 col-sm-4 col-lg-4 no-padding">
							<div class="col-lg-10 col-sm-6 col-md-10">
								<div class="form-group field-studocs-stu_docs_path-6">
									<label class="control-label" for="studocs-stu_docs_path-6">Document</label>
									<input type="hidden" name="StuDocs[stu_docs_path][6]" value="">
									<a class="file-input-wrapper btn btn-primary col-xs-12 col-lg-12 ">
										<span>Browse Document</span>
										<input type="file" id="studocs-stu_docs_path-6" name="StuDocs[stu_docs_path][6]" title="Browse Document" data-filename-placement="inside"></a>
										<div class="help-block"></div>
								</div>
							</div>
					    </div>
					</div>

				    <div class="form-group col-xs-12 col-sm-3" style="display:block;margin-top: 10px;">
						<button type="submit" class="btn btn-success btn-block"><i class="fa fa-upload"></i>Upload</button>    
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
