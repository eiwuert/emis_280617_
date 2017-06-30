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
			  background-image: url('<?php echo $base_css_parth?>assets/img/fdy.png');
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
			    font-family: khmerOSmuol;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOSmuol.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/times.ttf);
			}
			@font-face {
			    font-family: khmerOScontent;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOScontent.ttf);
			}

			@font-face {
			    font-family: khmerOSbokor;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/KhmerOSbokor.ttf);
			}
			@font-face {
			    font-family: gothic;
			    src: url(<?php echo $base_css_parth?>assets/img/fonts/GOTHIC.TTF);
			}
			#body_page{
				    padding: 94px 72px;
				    color:#333399;
			}
			#inner_body{
				    width: 970px;
				    height: 552px;
			}
			.float_left{float:left;}
			.left_side{
				float: left;
				width:452px;
				height:200px;
			}
			.right_side{
				float: right;
				width:434px;
				height:200px;
			}

			.boss{
		    	margin: 0px 0px 0px 188px;
			    font-family: khmerOSmuol;
			    font-size: 15px;

			}
			.confirm{
			    margin: 4px 0px 0px 181px;
			    font-family: khmerOScontent;
			    font-size: 17px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			}
			.boss_eng{
			    margin: 0px 0px 0px 178px;
			    font-family: gothic;
			    font-size: 19px;
			    font-weight: bolder;
			}
			.confirm_eng{
			    margin: 15px 0px 0px 164px;
			    font-family: gothic;
			    font-size: 19px;
			}

			.body_view{
			    width: 100%;
			    float: left;
			    margin: 40px 0px 0px 9px;
			    font-family: khmerOScontent;
			    font-size: 15px;
			    line-height: 33px;
			    letter-spacing: 2px;
			}
			.float_left{float:left;}
			.name{
			    float: left;
			    min-width: 183px;
			    font-family: khmerOsMollight;
			    position: relative;
			    line-height: 2.6;
			    top: -5px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    margin-right: 5px;
			}
			.sex{
			    float: left;
			    min-width: 58px;
			    font-family: khmerOsMollight;
			    position: relative;
			    line-height: 2.6;
			    top: -5px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			}
			.body_view_right{
			    width: 100%;
			    float: left;
			    margin: 46px 0px 0px 9px;
			    font-family: time_new_romen;
			    font-size: 18px;
			    line-height: 33px;
			    letter-spacing: 2px;
			}
			.name_eng{
			    float: left;
			    min-width: 197px;
			    font-family: time_new_romen;
			    position: relative;
			    line-height: 2.6;
			    top: -2px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}
			.sex_eng{
			    float: left;
			    min-width: 68px;
			    font-family: time_new_romen;
			    position: relative;
			    line-height: 2.6;
			    top: -2px;
			    height: 25px;
			    text-indent: 13px;
			    font-size: 15px;
			    font-weight: bolder;
			}


			.confirm_more{
			    font-size: 15px;
			    line-height: 29px;
			    margin-top: 17px;
			    margin-left: 0px;
			    letter-spacing: 1;
			    margin-bottom: 13px;
			}
			.confirm_more_eng{
			    font-size: 15px;
			    line-height: 20px;
			    margin-top: 17px;
			    margin-left: 0px;
			    margin-bottom: 13px;
			    font-family: gothic;
			}
			.photo{
			    width: 91px;
			    height: 113px;
			    float: left;
			    border: solid 1px #000;
			    margin: 28px 14px;
			    line-height: 116px;
			    text-align: center;
			}
			.date{
			    margin-top: 56px;
			    margin-left: 5px;
			    float: left;
			    font-size: 14px;
			    font-family: khmerOScontent;
			}
			.date_eng{
				margin-top: 68px;
				margin-left: 5px;
				float: right;
				font-size: 14px;
				font-family: khmerOScontent;
				letter-spacing: 0px;
			}
			/*-----front side-------*/
			.front_left_side{
				float: left;
				width:452px;
				height:200px;
			}
			.front_right_side{
				float: right;
				width:434px;
				height:200px;
			}

			.front_academic_trans_kh{
		    	margin: 0px 0px 0px 174px;
			    font-family: khmerOSmuol;
			    font-size: 15px;
			    color: #993300;
			}
			.front_academic_trans_eng{
			    margin: 0px 0px 0px 141px;
			    font-family: time_new_romen;
			    font-size: 17px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			    color:#008080;
			}
			.front_name{
			    margin: 15px 0px 0px 8px;
			    font-family: time_new_romen;
			    font-size: 14px;
			    color:#333399;
			}
			.front_id{
			    margin: -16px 19px 0px 0px;
			    font-family: time_new_romen;
			    font-size: 14px;
			    font-weight: bold;
			    letter-spacing: 0.6px;
			    float: right;
			    color:#333399;
			}
			.khmerOSmuol{
			    font-family: khmerOSmuol;
    			font-weight: 100;
			}

			.khmerOScontent{
			    font-family: khmerOScontent !important;
    			font-weight: 100;
				font-size: 10px !important;
			}


			.front_table{
				padding:16px 0px 0px 0px;
			}
			.front_table table{
			    width: 100%;
			    overflow: auto;
			    color:#333399;
			}
			.front_table table tr th{
				font-size: 12px;
			}

			.front_table table tr td{
				font-size: 11px;
				font-family: time_new_romen;
				line-height: 19px;
			}

			.front_table2{
				padding:0px 0px 0px 0px;
			}
			.front_table2 table{
			    width: 100%;
			    overflow: auto;
			    color:#333399;
			}
			.front_table2 table tr th{
			    font-size: 12px;
			    text-align: left;
			    text-indent: 37px;
			    line-height: 16px;
			}

			.front_table2 table tr td{
				font-size: 11px;
				font-family: time_new_romen;
				line-height: 19px;
			}
			.front_gpa{
			    float: left;
			    font-size: 14px;
			    font-family: time_new_romen;
			    margin: 21px 0px 0px 8px;
			    font-weight: bolder;
			    color:#333399;
			}
			.front_grading{
			    font-family: time_new_romen;
			    float: left;
			    text-align: left;
			    width: 100%;
			    line-height: 22px;
			    margin: 0px 2px 0px 0px;
			    color:#333399;
			}
			.front_top_grading{
			    text-align: left;
			    text-indent: 8px;
			    width: 100%;
			    overflow: auto;
			    font-size: 13px;
			    margin: 2px 0px 0px 0px;
			    color:#333399;
			}
			.front_show_grading{
			    text-align: left;
			    width: 217px;
			    overflow: hidden;
			    font-size: 11px;
			    margin-top: -17px;
			    float: left;
			    color:#333399;
			}
			.front_only{
			    font-family: khmerOSbokor;
			    font-size: 14px;
			    line-height: 30px;
			    text-indent: 11px;
			    color:#333399;
			}

			/**/

			.front_body_kingdom{
			    float: right;
			    width: 225px;
			    font-family: khmerOsMollight;
			    color:#333399;
			}
			.fornt_txt_kingdom{
			    margin: -6px 0px 0px 44px;
			    font-family: khmerOsMollight;
			}
			.fornt_txt_kingdom_eng{
			    margin: 1px 0px 0px 51px;
			    font-family: time_new_romen;
			    letter-spacing: 1;
			}
			.fornt_txt_nation_kingdom{
			    margin: 0px 0px 0px 50px;
			    font-family: khmerOsMollight;
			    font-size: 12px;
			    letter-spacing: 0.5px;
			}
			.fornt_txt_nation_kingdom_eng{
				margin: 1px 0px 0px 75px;
				font-size: 13px;
				font-family: time_new_romen;
				letter-spacing: 0.3px;
			}

			.front_logo{
				padding: 17px 62px;
			}
			.front_logo img{
				width:85px;
			}
			.front_logo_text{
				    padding-left: 0px;
				    margin-top: -6px;
				    font-size: 15px;
				    font-family: khmerOSmuol;
				    color:#008080;
			}
			.front_logo_text_eng{
				    margin-top: -2px;
				    font-size: 15px;
				    font-family: time_new_romen;
				    color:#FF6600;
			}
			.front_big_title_kh{
			    width: 100%;
			    height: 36px;
			    float: left;
			    margin-top: 67px;
			    font-size: 23px;
			    font-family: khmerOSmuol;
			    text-align: center;
			    line-height: 39px;
			    color:#E36C0A;
			}
			.front_big_title_eng{
				width: 100%;
				height: 36px;
				float: left;
				margin-top: 2px;
				font-size: 24px;
				font-family: time_new_romen;
				text-align: center;
				line-height: 39px;
				font-weight: bold;
				letter-spacing: 1.4;
			    color:#FF6600;
			}
			.front_academic_year{
		    	width: 100%;
			    height: 36px;
			    float: left;
			    margin-top: 29px;
			    font-size: 18px;
			    font-family: khmerOSbokor;
			    text-align: center;
			    color:#993300;
			    line-height: 39px;
			    font-weight: bold;
			    letter-spacing: 1.4;
			}
			.front_no{
			    color:#333399;
				width: 100%;
				height: 36px;
				float: left;
				margin-top: 142px;
				font-size: 13px;
				font-family: khmerOSbokor;
				text-align: left;
				line-height: 39px;
				letter-spacing: 0.9;
				text-indent: 23px;
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
									$stu_dob = date_format(date_create($row->stu_dob),"d F Y");

                      $y= date_format(date_create($row->stu_dob),"Y");
                      $m= date_format(date_create($row->stu_dob),"m");
                      $d= date_format(date_create($row->stu_dob),"d");
                      $d1 = substr($d,0,1);
                      $d2 = substr($d,1,1);
                      $y1 = substr($y,0,1);
                      $y2 = substr($y,1,1);
                      $y3 = substr($y,2,1);
                      $y4 = substr($y,3,1);
                      $get_month = substr($m,1,1);
                      $months = array(1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
                      $softConv = array (0=>'០',1=>'១',2=>'២',3=>'៣',4=>'៤',5=>'៥',6=>'៦',7=>'៧',8=>'៨',9=>'៩');
                      $stu_dob_kh = $softConv[(int)$d1].$softConv[(int)$d2].'&nbsp;'.$months[(int)$get_month].'&nbsp;'.$softConv[(int)$y1].$softConv[(int)$y2].$softConv[(int)$y3].$softConv[(int)$y4];

									$stu_gender= $row->stu_gender;
									$get_gender_kh = ($stu_gender == 'Male')? 'ប្រុស':'ស្រី.';
									$level_name = $row->level_name;
									$level_name_kh = $row->level_name_kh;
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_unique_id;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;
								?>
						<page size="A4" layout="portrait">
								<div id="body_page">
									<div id="inner_body">
									<!-- start -->
											<div class="left_side">
												<div class="boss">នាយក</div>
												<div class="confirm">បញ្ជាក់ថា :</div>
												<div class="body_view">
													<div class="float_left">និស្សិតឈ្មោះ&nbsp;&nbsp;&nbsp;&nbsp;:</div><div class="name"><?php echo $name_kh?></div><div class="float_left">ភេទ&nbsp;:</div><div class="sex"><?php echo $get_gender_kh?></div>
													<div class="float_left">ថ្ងៃខែឆ្នាំកំណើត 	:</div><div class="name"><?php echo $stu_dob_kh?></div>
													<div class="float_left confirm_more">បានបញ្ចប់ថ្នាក់ឆ្នាំសិក្សាមូលដ្ឋានដោយជោគជ័យនៅសាកលវិទ្យាល័យ<br/>
													គ្រប់គ្រង និង សេដ្ឋកិច្ច ក្នុងឆ្នាំសិក្សា <?php echo $year_to_year_kh?>។</div>
													<div class="float_left confirm_more">វិញ្ញាបនបត្រនេះ ប្រគល់ជូនសាមីជន ដើម្បីយកទៅប្រើប្រាស់តាម<br/>
													ដែលអាចប្រើបាន ។</div>
												</div>

												<div class="photo">
													4 X 6
												</div>
												<div class="date">
													បន្ទាយមានជ័យ.ថ្ងៃទី...........ខែ.................ឆ្នាំ<?php echo $year_kh?>
												</div>
											</div>
											<div class="right_side">

												<div class="boss_eng">DIRECTOR</div>
												<div class="confirm_eng">Certifies that</div>
												<div class="body_view_right">
													<div class="float_left">Name:</div><div class="name_eng"><?php echo $name?></div><div class="float_left">Sex:</div><div class="sex_eng"><?php echo $stu_gender?></div><br/>
													<div class="float_left">Name:</div><div class="name_eng"><?php echo $stu_dob?></div><br/>
													<div class="float_left confirm_more_eng">Has successfully completed Foundation Year<br/>
																						Course at <b>University of Management and</b><br/>
																						<b>Economics in  <?php echo $year_to_year?><b/>  academic year.</div>
													<div class="float_left confirm_more_eng">This certificate is presented to the bearer with all
																						right and privileges there to pertaining.</div>

													<div class="date_eng">
														  Issued at Banteay Meanchey, date ......... /............../ <?php echo $year?>
													</div>

												</div>
											</div>
									<!-- stop -->
									</div>
								</div>

						</page>

						<page size="A4" layout="portrait">
								<div id="body_page">
									<div id="inner_body">
									<!-- start -->
											<div class="front_left_side">
												<div class="front_academic_trans_kh">ព្រឹត្តិបត្រពិន្ទុ</div>
												<div class="front_academic_trans_eng">Academic Transcript</div>
												<div class="front_name"><div class="float_left">Name:</div><div style="font-weight:bold;margin-left: 44px;letter-spacing: 0.5px;text-transform: uppercase;"><?php echo $name ?></div></div>
												<div class="front_id">ID: <?php echo $stu_unique_id?></div>
												<div class="front_table">
													<table>
														<colgroup>
															<col style="width: 127px;"></col>
															<col style="width:124px;"></col>
															<col style="width:5px;"></col>
															<col style="width:5px;"></col>
														</colgroup>
														<tr>
															<th class="khmerOSmuol">មុខវិជ្ជាទូទៅ</th>
															<th>General Subjects</th>
															<th>Credits</th>
															<th>Grade</th>
														</tr>
														<tr>
															<td class="khmerOScontent">-	ប្រវត្តិសាស្រ្តប្រទេសកម្ពុជា</td>
															<td>-	History of Cambodia</td>
															<td><center>3</center></td>
															<td><center>B</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	គណិតវិទ្យាអាជីវកម្ម</td>
															<td>-	Business Math</td>
															<td><center>3</center></td>
															<td><center>B</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	សង្គមវិទ្យា</td>
															<td>-	Sociology</td>
															<td><center>3</center></td>
															<td><center>C</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	ទស្សនទានអាជីវកម្ម ១</td>
															<td>-	Business Concepts I</td>
															<td><center>3</center></td>
															<td><center>B</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	មូលដ្ឋានគ្រឹះនៃព្រះពុទ្ធសាសនា</td>
															<td>-	Basic  Buddhism</td>
															<td><center>3</center></td>
															<td><center>C</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	កុំព្យូទ័ររដ្ឋបាល</td>
															<td>-	Administrative Computer</td>
															<td><center>3</center></td>
															<td><center>A</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	រដ្ឋបាលសាធារណៈ និង ការិយាល័យ</td>
															<td>-	Public and Office Administration</td>
															<td><center>3</center></td>
															<td><center>C+</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	ទស្សនទានអាជីវកម្ម ២</td>
															<td>-	Business Concepts II</td>
															<td><center>3</center></td>
															<td><center>C</center></td>
														</tr>
													</table>
												</div>
												<div class="front_table2">
													<table>
														<colgroup>
															<col style="width: 26%;"></col>
															<col style="width:25%;"></col>

															<col style="width: 11%;"></col>
															<col style="width:5%;"></col>
														</colgroup>
														<tr>
															<th class="khmerOSmuol">មុខវិជ្ជាតម្រង់ទិស</th>
															<th colspan="3">Oriented Subjects</th>
														</tr>

														<tr>
															<td class="khmerOScontent">-	ជំនាញការសរសេរ</td>
															<td>-	Academic Writing</td>
															<td><center>3</center></td>
															<td><center>B</center></td>
														</tr>
														<tr>
															<td class="khmerOScontent">-	អង់គ្លេសស្នូល</td>
															<td>-	Academic Writing</td>
															<td><center>3</center></td>
															<td><center>B</center></td>
														</tr>
													</table>
												</div>
												<div class="gpa">
													GPA:   2.50
												</div>
												<div class="front_grading">
												<div class="front_top_grading">
													<b>Note:</b>
												</div>
												<div class="front_show_grading">
													<div style="margin: 13px 0px 0px 3px;width: 208px;">
														A &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;85%  - 100%&nbsp;&nbsp;=Excellent&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អប្រសើរ<br>
														B+&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;80%  - 84%&nbsp;&nbsp;&nbsp;&nbsp;=Very Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អណាស់<br>
														B &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;70%  - 79%&nbsp;&nbsp;&nbsp;&nbsp;=Good&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ល្អ<br>
														C+ &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;65%  - 69%&nbsp;&nbsp;&nbsp;&nbsp;=Fairly Good&nbsp;&nbsp;&nbsp;ល្អបង្គួរ<br>

													</div>
												</div>
												<div class="front_show_grading">
													<div style="margin: 13px 0px 0px 3px;width: 208px;">
														C &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;50%  - 64%&nbsp;&nbsp;=Fairly&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;មធ្យម<br>
														D &nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;45%  - 49% &nbsp;&nbsp;=Poor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ្សោយ<br>
														E &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;40%  - 44%&nbsp;=Very poor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ខ្សោយណាស់<br>
														F &nbsp;&nbsp;&nbsp; ≤ &nbsp;&nbsp;&nbsp;39% &nbsp;&nbsp;&nbsp;&nbsp;=Failure&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ធ្លាក់<br>

													</div>
												</div>
												<div class="front_only">
													<div style="font-size: 30px;line-height: 46px;float: left;">*</div>	វិញ្ញាបនបត្រនេះ មិនចេញជូនជាលើកទី២ ទេ​​ ។
												</div>
											</div>
											</div>
											<div class="front_right_side">
												<div class="front_body_kingdom">
													<div class="fornt_txt_kingdom">ព្រះរាជាណាចក្រកម្ពុជា</div>
													<div class="fornt_txt_kingdom_eng">Kingdom of Cambodia</div>
													<div class="fornt_txt_nation_kingdom">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
													<div class="fornt_txt_nation_kingdom_eng">Nation Religion King</div>
												</div>

												<div class='front_logo'>
													<img src="<?php echo base_url('assets/img/logo.png')?>">
												</div>
												<div>
													<div class="front_logo_text">សកលវិទ្យាល័យគ្រប់គ្រង និង​ សេដ្ឋកិច្ច</div>
													<div class="front_logo_text_eng">University of Management and Economics</div>
												</div>

												<div class="front_big_title_kh">
													វិញ្ញាបនបត្រថ្នាក់ឆ្នាំសិក្សាមូលដ្ឋាន
												</div>
												<div class="front_big_title_eng">
													Certificate of Foundation Year Course
												</div>
												<div class="front_academic_year">
													<?php echo $year_to_year_kh?>
												</div>
												<div class="front_no">
													No  គ.ទ.ក ០៣៤០១ ១៣០៣៨/០០១/១៤/សគស.បជ
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
