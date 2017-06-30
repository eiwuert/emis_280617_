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


<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
<input type="button" onclick="location.href='<?php echo site_url($controller_name)?>';" value="Back" />
<div id="mydiv">
	<style type="text/css">
			body {
			  background: rgb(204,204,204); 
			}
			page {
			  background: white;		  
			  background-image: url('<?php echo $base_css_parth?>assets/img/bachelor.png');
			  background-size: contain;
			  display: block;
			  margin: 0 auto;
			  margin-bottom: 0.5cm;
			  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
			}
			page[size="A4"][layout="portrait"] {
			  width: 29.7cm;
			  height: 21cm;  
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
			    font-family: time_new_romen;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/times.ttf);
			}			
			@font-face {
			    font-family: khmerOScontent;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOScontent.ttf);
			}
			#body_page{
				    /*background: rgba(255, 165, 0, 0.46);*/
    				padding: 95px 100px;
			}	
			#inner_body{
			    width: 926px;
			    height: 602px;
			}
			.logo{
				padding: 5px 123px;
			}
			.logo img{
				width:105px;
			}
			.body_logo{
				width: 345px;
			    /*background: rgba(255, 255, 0, 0.69);*/
			    height: 170px;
			    margin: 5px 0px 0px 5px;
			    float: left;
			}
			.logo_text{
    			    padding-left: 34px;
				    font-size: 15px;
				    font-family: khmerOsMollight;
			}
			.logo_text_eng{
    			    padding-left: 47px;
				    font-size: 15px;
				    font-family: time_new_romen;
			}
			.body_txt_center{
				    /*background: rgba(14, 255, 0, 0.39);*/
				    float: left;
				    width: 230px;
				    margin: 5px 0px 0px 0px;
				    height: 170px;
			}
			.txt_center_welcom{
				    font-size: 22px;
				    font-family: khmerOsMollight;
				    margin-top: 77px;
				    text-align:center;
			}
			.txt_center_welcom_bottom{
				    font-size: 14px;
				    font-family: time_new_romen;
				    margin-top: 5px;
				    letter-spacing: 1px;				    
					text-transform: uppercase;
				    text-align:center;
			}	
			.body_kingdom{
				    /*background: rgba(0, 77, 255, 0.39);*/
				    float: left;
				    width: 230px;
				    margin: 5px 0px 0px 102px;
				    height: 170px;
				    font-family: khmerOsMollight;
			}
			.txt_kingdom{  
				    font-family: khmerOsMollight;
    				text-align: center;
			}
			.txt_kingdom_eng{  
				    font-family: time_new_romen;
				    letter-spacing: 0.5;
    				text-align: center;
			}
			.txt_nation_kingdom{  
				    font-family: khmerOsMollight;
				    font-size: 14px;
				    letter-spacing: 0.5;
    				text-align: center;
			}
			.txt_nation_kingdom_eng{  
				    font-family: time_new_romen;
				    letter-spacing: 0.3px;
    				text-align: center;
			}
			.body_cen_left{
				    /*background: rgba(0, 77, 255, 0.21);*/
				    float: left;
				    width: 461px;
				    margin: 0px 0px 0px 5px;
				    height: 262px;
			}
			.cen_left_title{				
				margin: 1px 0px 0px 0px;
			    font-family: khmerOsMollight;
			    font-size: 13.3px;
			}
			.cen_left_see{				
				    margin: 4px 0px 0px 0px;
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}			
			.cen_left_see_span{		
				float:left;
				width:145px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: khmerOsMollight;
				position: relative;
				line-height: 3.2;
				top: -8px;
				height: 25px;
				text-indent: 14px;
			}
			.cen_left_confirm{				
				    margin: 2px 0px 0px 0px;
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}			
			.conf_name{	

				float:left;
				width:313px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: khmerOsMollight;
				position: relative;
				line-height: 3.2;
				top: -8px;
				height: 25px;
				text-indent: 115px;
			}			
			.conf_gender{

				float:left;
				width:64px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: khmerOsMollight;
				position: relative;
				line-height: 3.2;
				top: -8px;
				height: 25px;
				text-indent: 22px;
			}			
			.cen_left_dob{			
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}		
			.cen_left_dob_span{	 

				float:left;
				width:406px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: khmerOsMollight;
				position: relative;
				line-height: 3.2;
				top: -8px;
				height: 25px;
				text-indent: 102px;
			}			
			.cen_left_have_to{			
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}
			.cen_left_have_to b{			
				    font-family: khmerOsMollight;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}
			.cen_left_major{		
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    letter-spacing: 1.5px;
			}
			.cen_left_major_text{	
				float:left;
				width:404px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: khmerOsMollight;
				position: relative;
				line-height: 3.2;
				top: -8px;
				height: 25px;
				text-indent: 103px;
			}
			.body_cen_right{
				    /*background: rgba(0, 255, 245, 0.3);*/
				    float: right;
				    width: 455px;
				    margin: 0px 5px 0px 0px;
				    height: 262px;
			}
			.cen_right_title{				
				    margin: 8px 0px 0px 23px;
				    font-family: time_new_romen;
				    font-size: 12px;
			}
			.cen_right_see{				
				    margin: 6px 0px 0px 24px;
				    font-family: time_new_romen;
				    font-size: 12px;
				    line-height: 26px;
			}			
			.cen_right_see_text{	

				float:left;
				width:223px;
				border-bottom: dotted 1px #8C8C8C;
				font-family: time_new_romen;
				font-weight: bolder;
				position: relative;
				line-height: 2.7;
				font-size: 14;
				top: -8px;
				height: 25px;
				text-indent: 75px;
			}

			.cen_right_confirm{				
				    margin: -1px 0px 0px 24px;
				    font-family: time_new_romen;
				    font-size: 12px;
				    line-height: 26px;
			}			
			.right_conf_name{		
					float:left;
					width:252px;
					border-bottom: dotted 1px #8C8C8C;
					font-family: time_new_romen;
					font-weight: bolder;
					position: relative;
					line-height: 2.7;
					font-size: 14;
					top: -8px;
					height: 25px;
					text-indent: 68px;
					text-transform: uppercase;
			}			
			.right_conf_gender{		

					float:left;
					width:87px;
					border-bottom: dotted 1px #8C8C8C;
					font-family: time_new_romen;
					font-weight: bolder;
					position: relative;
					line-height: 2.7;
					font-size: 14;
					top: -8px;
					height: 25px;
					text-indent: 25px;
			}
			.cen_right_dob{			
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    margin: 0px 0px 0px 25px;
			}		
			.cen_right_dob_span{	

					float:left;
					width:372px;
					border-bottom: dotted 1px #8C8C8C;
					font-family: time_new_romen;
					font-weight: bolder;
					position: relative;
					line-height: 2.7;
					font-size: 14;
					top: -8px;
					height: 25px;
					text-indent: 110px;
			}		
			.cen_right_have_to{
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    margin: 0px 0px 0px 24px;
			}	

			.cen_right_major{
				    font-family: KhmerOScontent;
				    font-size: 12px;
				    line-height: 26px;
				    margin: 0px 0px 0px 23px;
			}
			.cen_right_major_span{	
					float:left;
					width:405px;
					border-bottom: dotted 1px #8C8C8C;
					font-family: time_new_romen;
					font-weight: bolder;
					position: relative;
					line-height: 2.7;
					font-size: 14;
					top: -8px;
					height: 25px;
					text-indent: 117px;
			}
			.foot_left{
				width: 345px;
			    /*background: rgba(255, 0, 0, 0.4);*/
			    height: 170px;
			    margin: 0px 0px 0px 5px;
			    float: left;
			}
			.f_left_date{			
				margin: 0px 0px 0px 51px;
			    font-family: KhmerOScontent;
			    font-size: 13px;
			    line-height: 23px;
			    letter-spacing: 1.2;
			}
			.f_left_date_bottom{
				    margin: 6px 0px 0px 98px;
				    font-family: khmerOsMollight;
				    font-size: 13px;
				    line-height: 23px;
				    letter-spacing: 1.9;
			}
			.foot_center{
				    /*background: rgba(14, 255, 0, 0.39);*/
				    float: left;
				    width: 230px;
				    height: 170px;
			}
			.foot_no{
				margin: 8px 0px 0px 5px;
			    font-family: KhmerOScontent;
			    font-size: 13px;
			    line-height: 23px;
			    letter-spacing: 1.2;
			    width: 195px;
			    height: 24px;
			}
			.foot_right{
			    /*background: rgba(255, 0, 0, 0.4);*/
			    float: left;
			    width: 340px;
			    height: 170px;
			}
			.foot_city_date{
				    margin: 0px 0px 0px 15px;
				    font-family: KhmerOScontent;
				    font-size: 13px;
				    line-height: 23px;
			}
			.f_right_president{
				    margin: -4px 0px 0px 132px;
				    font-family: time_new_romen;
				    font-size: 16px;
				    line-height: 23px;
				    font-weight: bold;
				    letter-spacing: 0.6px;
			}
	</style>

	<?php if($get_query->num_rows() > 0 ):?>
		<?php $count = $get_query->num_rows()?>	
			<?php $p = 0 ?>
				<?php $b = 0?>
				<?php for ($i=0; $i < $count ; $i++): ?> 
					<?php $limit = ($i == 0)? 0 : $p+=1;?>

								<?php $n = 0?>
								<?php $s = ''?>
								<?php foreach(array_slice($get_query->result(), $limit, 1) as $key=>$row ): ?>
									<?php 
										$n++;
										$name = $row->stu_last_name.(isset($row->stu_middle_name)? '&nbsp;'.$row->stu_middle_name.'&nbsp;' : '&nbsp;').$row->stu_first_name;
										$name_kh = $row->stu_last_name_kh.(isset($row->stu_middle_name_kh)? '&nbsp;'.$row->stu_middle_name_kh.'&nbsp;' : '&nbsp;').$row->stu_first_name_kh;
										$stu_dob = date_format(date_create($row->stu_dob),"F j, Y");
										$stu_gender = $row->stu_gender;
										$level_name = $row->level_name;
										$level_name_kh = $row->level_name_kh;
										$section_name = $row->section_name;
										$stu_unique_id = $row->stu_unique_id;
										$university_name = $row->university_name;
										$university_id = $row->university_id;
										$skill_name = $row->skill_name;
										$skill_name_kh = $row->skill_name_kh;

										$y= date_format(date_create($row->stu_dob),"Y");
										$m= date_format(date_create($row->stu_dob),"m");
										$d= date_format(date_create($row->stu_dob),"d");
										$months = array (1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
										$get_month = $months[(int)$m];
										$stu_dob_kh = $d.'&nbsp;'.$get_month.',&nbsp;'.$y;
									?>
											<page size="A4" layout="portrait">
													<div id="body_page">
														<div id="inner_body">

														<!-- start -->
															<div>
																<div class="body_logo">
																	<div class='logo'>
																		<img src="<?php echo base_url('assets/img/logo.png')?>">
																	</div>
																	<div class="logo_text">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
																	<div class="logo_text_eng">University of Management and Economics</div>
																</div>
																<div class="body_txt_center">						
																	<div class="txt_center_welcom"><?php echo $level_name_kh?></div>
																	<div class="txt_center_welcom_bottom"><?php echo $level_name?></div>
																</div>
																<div class="body_kingdom">
																	<div class="txt_kingdom">ព្រះរាជាណាចក្រកម្ពុជា</div>
																	<div class="txt_kingdom_eng">Kingdom of Cambodia</div>
																	<div class="txt_nation_kingdom">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
																	<div class="txt_nation_kingdom_eng">Nation Religion King</div>
																</div>
																<!--  -->
																<div class="body_cen_left">
																	<div class="cen_left_title">ក្រុមប្រឹក្សាភិបាលនៃ សាកលវិទ្យាល័យគ្រប់គ្រង និង សេដ្ឋកិច្ច</div>						
																	<div class="cen_left_see"><div style="float:left">បានឃើញកំណត់ហេតុចុះថ្ងៃទី</div><div class="cen_left_see_span"><?php echo $aproved_date_kh?></div>របស់ក្រុមប្រឹក្សាបណ្តុះបណ្តាល
											នៃសាកលវិទ្យាល័យគ្រប់គ្រង និង សេដ្ឋកិច្ច</div>
																	<div class="cen_left_confirm"><div style="float:left">បញ្ជាក់ថាៈ</div><div class="conf_name"><?php echo $name_kh?></div><div style="float:left">ភេទ</div><div class="conf_gender">ស្រី</div></div>	
																	<div class="cen_left_dob"><div style="float:left">កើតថ្ងៃទីៈ</div><div class="cen_left_dob_span"><?php echo $stu_dob_kh?></div></div>	
																	<div class="cen_left_have_to">បានបំពេញគ្រប់លក្ខខណ្ឌរបស់សាកលវិទ្យាល័យ <br>សម្រាប់ទទួលសញ្ញាបត្រ <span style="font-family: khmerOsMollight;">បរិញ្ញាបត្ររង</span></div>	
																	<div class="cen_left_major"><div style="float:left">ឯកទេសៈ</div><div class="cen_left_major_text"><?php echo $skill_name_kh?></div><br>ប្រគល់ជូនសញ្ញាបត្រនេះ ដើម្បីប្រើប្រាស់តាមការដែលអាចប្រើបាន។</div>	
																</div>
																<div class="body_cen_right">
																	<div class="cen_right_title">THE PRESIDENT OF THE UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
																	<div class="cen_right_see"><div style="float:left">having approved the minutes dated</div><div class="cen_right_see_text"><?php echo $aproved_date?></div>of the
											Academic Board of the University of Management and Economics</div>
																	<div class="cen_right_confirm"><div style="float:left">certifies that</div><div class="right_conf_name"><?php echo $name ?></div><div style="float:left">sex:</div><div class="right_conf_gender"><?php echo $stu_gender ?></div></div>	
																	<div class="cen_right_dob"><div style="float:left">born on:</div><div class="cen_right_dob_span"><?php echo $stu_dob?></div></div>	
																	<div class="cen_right_have_to">has satisfied the requirements of the University <br>for the award of the Associate’s degree</div>	
																	<div class="cen_right_major"><div style="float:left">in:</div><div class="cen_right_major_span"><?php echo $skill_name?></div><br>This Bachelor’s degree is presented to the bearer with all rights and privileges thereto pertaining.</div>
																</div>
																<!--  -->
																<div class="foot_left">
																	<div class="f_left_date">បាត់ដំបង ថ្ងៃទី<?php echo ($pd)? '&nbsp;'.$pd.'&nbsp;' : '..........' ?>ខែ<?php echo ($pm)? '&nbsp;'.$pm.'&nbsp;' : '..........' ?>ឆ្នាំ<?php echo ($py)? '&nbsp;'.$py.'&nbsp;' : '..........' ?></div>
																	<div class="f_left_date_bottom">ប្រធានក្រុមប្រឹក្សាភិបាល</div>
																</div>
																<div class="foot_center">	
																	<div class="foot_no"><div style="float:left">លេខ</div><div style="float:left;line-height: 1;border-bottom: dotted 1px;padding: 2px 20px 0px 20px;"><?php echo $n?></div><div style="float: left">ស.គ.ស/បជ</div></div>
																	<div style="width: 80px;height: 100px;border: solid 1px rgba(97, 97, 97, 0.93);text-align: center;line-height: 7.5;font-size: 12px;margin: 20px 64px;">
																		4 X 6
																	</div>
																</div>
																<div class="foot_right">	
																	<div class="foot_city_date">Battambang, Date.<?php echo ($date_out_chairman_of_the_board)? '&nbsp;&nbsp;&nbsp;'.$date_out_chairman_of_the_board : '..................................................'?></div>
																	<div class="f_right_president">President</div>
																</div>
															</div>
														<!-- stop -->

														</div>
													</div>

											</page>

								<?php endforeach ?>
				<?php endfor ?>
	<?php endif ?>

</div>


