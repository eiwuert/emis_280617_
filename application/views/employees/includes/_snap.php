<style>
      .add-video {
        clear: both;
        display: block;
      }
      #snapshot {
        display: none;
      }
      #user-videos img {
        margin: 10px;
        padding: 10px;
        background-color: #ddd;
        border: 1px solid #aaa;
      }
      button.add-video,
      div#snapshot * {
        margin: 0 auto;
        text-align: center;
      }
</style>

<script type="text/javascript" src="<?php echo base_url('assets/cam')?>/webcam.js"></script>
	
    <style>
		.main
		{
		    margin-left: auto;
		    margin-right: auto;
		    width: 690px;
		}
		.snap
		{
		    color: white;
		    border-radius: 4px;
		    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
		    background: rgb(28, 184, 65);
		    font-family: inherit;
		    font-size: 100%;
		    padding: .5em 1em;
		    border: 0 hsla(0, 0%, 0%, 0);
		    text-decoration: none;
		}
		.border
		{
		    border: 3px rgb(28, 184, 65) solid;
		    width: 226px;
    		height: 226px;
		}
	</style>
<div class="tab-pane" id="snap">
	<div class="row">
		<table class="main" style="width:100%">
	        <tr>
	            <td valign="top">
	            	<center>
		                <div id="upload_results">
		                	<?php echo $old_prof?>		                    
		                </div>
		                <center class="msg_prof"></center>
		                <?php echo form_hidden('get_name')?>		                
	    				<?php echo form_hidden('id_emp',$person_info->id)?>
	    				<?php echo form_hidden('id_person',$person_info->person_id)?>
	                </center>
	            </td>


	            <td valign="top">
	            	<center>
			            <div class="border">
		                <script>
		                	document.write( webcam.get_html(220, 220) );
		                </script>
		                </div>
		                <div class="btn_snap">
		                	<?php echo $btn_snap?>
		                </div>
	                </center>
	            </td>
	        </tr>
	    </table>


	</div>
</div>

	<script>
        webcam.set_api_url( '<?php echo base_url('assets/cam')?>/upload_pro.php' );
        webcam.set_quality( 90 ); // JPEG quality (1 - 100)
        webcam.set_shutter_sound( true ); // play shutter click sound
        
        webcam.set_hook( 'onComplete', 'my_completion_handler' );
        
        function take_snapshot() {
            // take snapshot and upload to server
            document.getElementById('upload_results').innerHTML =
            '<img src="<?php echo base_url('assets/cam')?>/uploading.gif">';
            webcam.snap();
            $('.btn_snap').html('<input style="background:red" type="button" class="snap" value="Change" onClick="clear_snapshot()">');
        }
        function clear_snapshot() {
        	var id_emp = $('input[name="id_emp"]').val();
        	var site_url = "<?php echo site_url('employees/clear_prof')?>";
            $.post(site_url, {id_emp:id_emp},function(data, status){
				if(data == 'TRUE'){
		        	$(".msg_prof").html('<div class="blue">Profile is removed</div>');
		        }else{
		        	$(".msg_prof").html('<div class="red">Profile is not remove..!</div>');
		        }
			});
			$('.btn_snap').html('<input type="button" class="snap" value="SNAP IT" onClick="take_snapshot()">');
        }
        function my_completion_handler(msg) {
            // extract URL out of PHP output
            if (msg.match(/(http\:\/\/\S+)/)) {
                var image_url = RegExp.$1;
                // show JPEG image in page
                document.getElementById('upload_results').innerHTML =
                    '<a href="'+image_url+'" target"_blank"><img src="' + image_url + '"></a>';
                $('input[name=get_name]').val(image_url);
                //
                var image_name = image_url;
                var id_emp = $('input[name="id_emp"]').val();
                var id_person = $('input[name="id_person"]').val();
                var site_url = "<?php echo site_url('employees/snap')?>";
                var data_url = {id_emp: id_emp,image_name:image_name, id_person:id_person};
                if(image_url !== ''){

	        		$.post(site_url, data_url,function(data, status){
				        if(data == 'TRUE'){
				        	$(".msg_prof").html('<div class="blue">Upload Profile Successful !</div>');
				        }else{
				        	$(".msg_prof").html('<div class="red">Upload Profile Failed !</div>');
				        }
				    });
	        	}else{
	        		alert('fale');
	        	} 
                // 

                // reset camera for another shot
                webcam.reset();
            }
            else alert("PHP Error: " + msg);
        }
    </script>
