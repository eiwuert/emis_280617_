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
			  background-image: url('<?php echo $base_css_parth?>assets/img/transcript.png');
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
			@font-face {
			    font-family: time_new_romen;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/times.ttf);
			}	
			@font-face {
			    font-family: coprgtb;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/COPRGTB.TTF);
			}					
			@font-face {
			    font-family: cambria;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/cambria.ttc);
			}			
			@font-face {
			    font-family: lhandw;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/LHANDW.TTF);
			}
		
			@font-face {
			    font-family: nirmalaB;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/NirmalaB.ttf);
			}
			.transcript{
			    padding: 67px 0px 0px 53px;
			}
			.inner_transcript{
			    width: 688px;
			    height: 984px;
			    float: left;	
			}
			.title_top{
			    text-align: center;
			    font-family: cambria;
			    font-weight: bolder;
			    font-size: 26px;
			    line-height: 47px;
			    padding-top: 13px;
			    letter-spacing: 6px;
			    text-shadow: 2px 1px 0px #7B7D17;
			    color: #787B14;
			}

			.title_bottom{
			    text-align: center;
			    font-family: cambria;
			    font-weight: bolder;
			    font-size: 26px;
			    line-height: 47px;
			    padding-top: 13px;
			    letter-spacing: 6px;
			    text-shadow: 2px 1px 0px #7B7D17;
			    color: #986049;
			}
			

			.date_top{
			    text-align: right;
			    font-family: lhandw;
			    font-weight: bolder;
			    font-size: 15px;
			    line-height: 47px;
			    padding-top: 29px;
			    margin-right: 35px;
			}
			.welcome_top{
				font-family: nirmalaB;
			    width: 100%;
			    text-align: center;
			    line-height: 83px;
			    font-size: 29px;
			    color:#808080;
			}
			.desc{
				text-align: left;
				float: left;
				width: 475px;
				margin-left: 34px;
				font-family: lhandw;
				font-size: 18px;
				line-height: 35px;
				padding-top: 29px;
			}

			.photo{
			    width: 160px;
			    height: 131px;
			    text-align: center;
			    font-size: 12px;
			    line-height: 4.5;
			    margin: 92px 15px 0px 0px;
			    float: right;
			}
			.inner_photo{
			    width: 75px;
			    height: 93px;
			    border: solid 1px rgba(97, 97, 97, 0.93);
			    text-align: center;
			    line-height: 9.5;
			    font-size: 12px;
			    margin-left: 29px;
			}
			.end_name{
			    width: 100%;
			    margin: 98px 0px 0px 0px;
			    float: left;
			}
			.e_name{
			    width: 206px;
			    margin: 0px 0px 0px 105px;
			    float: left;
			    text-align: center;
			    border-top: solid 1px #000;
			    font-size: 20px;
			    font-family: cambria;
			    font-weight: bold;
			}
			.director{
			    width: 206px;
			    margin: 0px 0px 0px 105px;
			    text-align: center;
			    border-top: solid 1px #000;
			    font-size: 20px;
			    font-family: lhandw;
			    font-weight: bold;
    			line-height: 32px;
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
									$stu_gender= $row->stu_gender;
									$get_gender = ($stu_gender == 'Male')? 'Mr.':'Miss.';
									$level_name = $row->level_name;
									$level_name_kh = $row->level_name_kh;
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_acad_stu_acad_card;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;
								?>
							<page size="A4">
									
									<div class="transcript">
										<div class="inner_transcript">
											<div class="title_top">
												University of Management<br>
												and Economics
											</div>
											<div class="title_bottom">
												Banteay Meanchey Campus
											</div>


											<div class="date_top">
												<?php echo $english_certify_date?>
											</div>

											<div class="welcome_top">
												TO WHOM IT MAY CONCERN
											</div>

											<div class="desc">
												This is to certify that  <span style='color:#774F28; font-family: nirmalaB;font-size: 20px;'><?php echo $get_gender ?> <?php echo $name?></span>, born on <?php echo $stu_dob ?> in  <?php echo $stu_birthplace?>, Cambodia, has successfully completed General English Program (GEP) <span style='font-family: nirmalaB;font-size: 20px;'><?php echo $english_level?></span> in the academic year <?php echo $year_to_year ?>.<br/>
												This is a twelve-level Program conducted at the Department of English, University of Management and Economics Banteay Meanchey (UME_BMC).

											</div>

											<div class="photo">
												<div class="inner_photo">
													4 X 6
												</div>
												<div>
												<div style="float:left">No:</div><div  style="border-bottom:dotted 1px #ccc;min-width: 92px;float:left;text-align:center;margin-top: 20px;line-height: 12px;"><?php echo ($stu_unique_id)? $stu_unique_id : '&nbsp;'?></div>ume.bmc
												</div>
											</div>

											<div class="end_name">
												<div class="e_name">
													Mr. Norng Tha
												</div>
												<div class="director">
													Director
												</div>
											</div>


										</div>
									</div>

							</page>
							<?php endforeach ?>
				<?php endfor ?>
	<?php endif ?>

</div>


