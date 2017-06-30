<meta charset="utf-8" />
<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js')?>" > </script>
<script type="text/javascript">
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }
    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Transcription</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
      	if (window.history && window.history.pushState) {
	        window.history.pushState('forward', null, null);
	        $(window).on('popstate', function() {
	            window.location.href = "<?php echo site_url('student_print_form')?>";
	        });
      	}
    });
</script>
<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
<div id="mydiv">
	<style type="text/css">
			body {
			  background: rgb(204,204,204); 
			}
			page {
			  background: white;		  
			  /*background-image: url('<?php echo $base_css_parth?>assets/img/student_card.png');*/
			  background-size: contain;
			  display: block;
			  margin: 0 auto;
			  margin-bottom: 0.5cm;
			  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
			}
			page[size="A4"] {  
			  width: 21cm;
			  height: 29.7cm; 
			}
			@media print {
			  body, page {
			    margin: 0;
			    box-shadow: 0;
			  }
			}	
		/*++++++++ start body transcript++++*/
			
			@font-face {
			    font-family: khmerOsMollight;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: ahronbd;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/ahronbd.ttf);
			}			
			@font-face {
			    font-family: khmerOScontent;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOScontent.ttf);
			}
			.body_card{
				padding:38px 25px;
			}
			.inner_body_card{
				width:741px;
				height: 1055px;
			}
			.block{
				width: 227px;
			    height: 331px;
			    border: solid 2px #4C4CB7;
			    margin: 2px 5px 22px 10px;
			    border-radius: 11px;
			    float: left;
			}
			.head_card_orange{   
				width: 100%;
    			height: 68px;
			    border-top-right-radius: 9px;
			    border-top-left-radius: 9px;
			    /*background: rgba(0, 230, 255, 0.48);*/
				background-image: url('<?php echo $base_css_parth?>assets/img/bg_card.png');
				background-size: contain;
			}
			.head_card_orange img{
				width: 50px;
    			margin: 1px 7px;
    			float: left;
			}

			.head_card_green{   
				width: 100%;
    			height: 68px;
			    border-top-right-radius: 11px;
			    border-top-left-radius: 11px;
			    background: #008000;
			}
			.head_card_green img{
				width: 50px;
    			margin: 1px 7px;
    			float: left;
			}

			.head_card_green_light{   
				width: 100%;
    			height: 68px;
			    border-top-right-radius: 11px;
			    border-top-left-radius: 11px;
			    /*background: rgba(0, 230, 255, 0.48);*/
				background-image: url('<?php echo $base_css_parth?>assets/img/bg_card_yellow.png');
				background-size: contain;
			}
			.head_card_green_light img{
				width: 50px;
    			margin: 1px 7px;
    			float: left;
			}

			.head_card_blue{   
				width: 100%;
    			height: 68px;
			    border-top-right-radius: 9px;
			    border-top-left-radius: 9px;
			    background: #0000FF;
				/*background-image: url('<?php echo $base_css_parth?>assets/img/bg_card_yellow.png');
				background-size: contain;*/
			}
			.head_card_blue img{
				width: 50px;
    			margin: 1px 7px;
    			float: left;
			}

			.head_text{				
			    font-family: ahronbd;
			    font-size: 27px;
			    padding-top: 4px;
			    color:white;
			}
			.head_text_bottom{

			    font-family: ahronbd;
			    font-size: 12px;
			    padding-top: 0px;
			    color:white;
			}
			.small_bottom{
				font-size: 8px;
			    height: 15px;
			    background: rgb(255, 234, 171);
			    margin-top: 4px;
			    line-height: 14px;
			    color: blue;
			    letter-spacing: 0.2px;
			    text-align: center;
			}
			.photo{
				width: 62px;
			    height: 85px;
			    margin: 6px 6px 0px 8px;
			    border: solid 1px #ccc;
			    float: left;
			}
			.id{
				width:100%;
				height: 12px;
				float: left;
				text-indent: 12px;
				font-size: 10px;
				margin-top: 4px;
			}
			.school_detail{
			        width: 191px;
				    overflow: auto;
				    border: solid 2px #3B3BFF;
				    border-radius: 12px;
				    margin: 0px 15px;
				    padding: 2px 0px;
				    position: absolute;
				    margin-top: 113px;
				    float: left;
				    font-size: 11px;
				    text-align: center;
				    line-height: 11px;
				    color: blue;
			}
			.free_space{
				width: 100%;
			    height: 112px;
			    float: left;
			}
			.director{
				    width: 114px;
				    height: 20px;
				    border-top: solid 2px;
				    float: left;
				    margin-left: 52px;
				    text-align: center;
				    font-size: 10px;
    				line-height: 10px;
			}
			.foot{   
				    width: 225px;
				    height: 19px;
				    border-bottom-right-radius: 9px;
				    border-bottom-left-radius: 9px;
				    background: rgba(0, 230, 255, 0.48);
				    float: left;
				    font-size: 7px;
				    line-height: 7px;
				    text-align: left;
				    padding-left: 2px;
			}
	</style>


				
					<?php if($get_query->num_rows() > 0 ):?>
					<?php $count = $get_query->num_rows()?>	

							<?php $p = 0 ?>
							<?php $b = 0?>
							<?php for ($i=0; $i < $count ; $i++): ?> 
								<?php $limit = ($i == 0)? 0 : $p+=9;?>

								<page size="A4">
									<div class="body_card">
										<div class="inner_body_card">
										<?php $n = 0?>
										<?php $s = ''?>
										<?php foreach(array_slice($get_query->result(), $limit, 9) as $key=>$row ): ?>

						    						<?php 
														$n++;
														$name = $row->stu_last_name.(isset($row->stu_middle_name)? '&nbsp;'.$row->stu_middle_name.'&nbsp;' : '&nbsp;').$row->stu_first_name;
														$stu_dob = $row->stu_dob;
														$level_name = $row->level_name;
														$section_name = $row->section_name;
														$stu_unique_id = $row->stu_acad_stu_acad_card;
														$university_name = $row->university_name;
														$university_id = $row->university_id;
														$color_card = $row->card_color_type;
														$profile_img = $row->profile_img;
														
														if($color_card == 1){
															$exstra ="head_card_orange";
														}
														if($color_card == 2){
															$exstra ="head_card_green";
														}
														if($color_card == 3){
															$exstra ="head_card_green_light";
														}
														if($color_card == 4){
															$exstra ="head_card_blue";
														}

													?>

											<div class="block">
												<div class="<?php echo $exstra?>">
													<img src='<?php echo base_url('assets/img/logo.png')?>'>
													<div class="head_text">University of</div>
													<div class="head_text_bottom">Management and Economics</div>

													<div class="small_bottom">Your success with national consciousness is our top prionity</div>
												</div>
												<div class="photo">
													<img style="width: 100%" src="<?php echo base_url("assets/avatars/$profile_img")?>">
												</div>
												<table style="width: 145px;height: 94px;float:left;font-size: 9px;">
													
												  	<colgroup>
													    <col style="width: 28px;">
													    <col style="width:30px;">
													</colgroup>
													<tr>
														<td colspan="2"><div style="font-size:10px;">Name: <?php echo $name?></div></td>
													</tr>
													<tr>
														<td>Date of Birth</td>
														<td>: <?php echo date("d-M-Y", strtotime($stu_dob))?></td>
													</tr>

													<tr>
														<td>Degree</td>
														<td>: <?php echo $level_name?></td>
													</tr>
													<tr>
														<td>Year</td>
														<td>: <?php echo $section_name?></td>
													</tr>
													<tr>
														<td>Issue Date</td>
														<td>: 26-Sep-2015</td>
													</tr>
													<tr>
														<td>Expire Date</td>
														<td>26-Sep-2016</td>
													</tr>
												</table>
												<div class="id">ID: <?php echo $stu_unique_id?></div>
												<div class="school_detail">
													Department of <?php echo $university_name?>
												</div>
												<div class="free_space"></div>
												<div class="director">
													NORNG THA<br>Diriector
												</div>
												<div class="foot">
													Banteay Meanchey Campus, Cambodia. Tel:054-6666-669/012-911-988<br>
													Email:ume_bmc@yahoo.com Website:www.ume-bmc.edu.kh
													<div style="color:red;float:right;font-size: 5px;line-height: 4px;padding-right: 9px;">@2016 All right reserved</div>
												</div>
											</div>
										<?php endforeach ?>	
										</div>
									</div>
								</page>
							
								<?php if($n < 9) break;?>
							<?php endfor ?>
					<?php endif ?>	
</div>


