<div class="tab-pane active" id="choose">
	<div class="row">


		<?php echo form_open_multipart("$controller_name/upload_prof");?>
    		<div class="col-md-12 col-sm-12 col-xs-12">
    			<div class="photo col-md-6 col-sm-6 col-xs-12" style="border-right:1px solid #ccc">
    				<center><?php echo $old_prof?></center>
    			</div>
    			<div class="btn_upload col-md-6 col-sm-6 col-xs-12" style="padding: 50px 20px;">
    				<input type="file" name="userfile" id="fileToUpload">
    			</div>
    		</div>
    			<div class="col-md-12 col-sm-12 col-xs-12">                      
                    <?php echo form_hidden('id_emp',$person_info->id)?>
                    <?php echo form_hidden('id_person',$person_info->person_id)?>
    				<input class="btn btn-success col-sm-12" type="submit" name="upload" value="Save" />
    			</div>
    	</form>

	
	</div>
</div>