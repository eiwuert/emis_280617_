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
			  background-image: url('<?php echo $base_css_parth?>/assets/img/transcript.png');
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
			    src: url(<?php echo $base_css_parth?>/assets/img/fonts/KhmerOSmuollight.ttf);
			}
			@font-face {
			    font-family: ahronbd;
			    src: url(<?php echo $base_css_parth?>/assets/img/fonts/ahronbd.ttf);
			}
			@font-face {
			    font-family: khmerOScontent;
			    src: url(<?php echo $base_css_parth?>/assets/img/fonts/KhmerOScontent.ttf);
			}
			@font-face {
			    font-family: time_new_romen;
			    src: url(<?php echo $base_css_parth?>/assets/img/fonts/times.ttf);
			}
			@font-face {
			    font-family: coprgtb;
			    src: url(<?php echo $base_css_parth?>/assets/img/fonts/COPRGTB.TTF);
			}
			.transcript{
			    padding: 67px 0px 0px 38px;
			}
			.inner_transcript{
			    width: 722px;
			    height: 984px;
			    float: left;
			}

			.ministry_left{
			    width: 366px;
			    height: 173px;
			    float: left;
			}
			.ministry_text{
			    font-family: time_new_romen;
			    font-size: 14.5px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 5px;
			    margin-top: 60px;
			    line-height: 31px;
			    letter-spacing: 0.1px;
			}
			.kingdom{
			    width: 227px;
			    height: 125px;
			    float: right;
			}
			.kingdom_text{
			    text-align: left;
			    font-family: time_new_romen;
			    font-size: 16px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 7px;
			}

			.nation{
			    text-align: left;
			    font-family: time_new_romen;
			    font-size: 16px;
			    color: blue;
			    font-weight: bold;
			    margin-left: 7px;
			    margin-top: 9px;
			    letter-spacing: 0.9px;
			}
			.title_transcript{
			    width: 100%;
			    height: 33px;
			    text-align: center;
			    font-family: coprgtb;
			    font-size: 17.3px;
			    float: left;
			    margin-top: -1px;
			    text-decoration: underline;
			}


			#info_left{
				float:left;
				padding: 8px 0 0 0px;
			    line-height: 15px;
			    letter-spacing: 0px;
			    position: absolute;
				margin-left: 0px;
				font-size: 13px;
			}
			#info_right{
				float: right;
			    padding: 8px 80px 0 0;
			    line-height: 15px;
			    letter-spacing: 0px;
			    position: absolute;
				margin-left: 440px;
				font-size: 13px;
			}

			.body_transaction{
				width:100%;float:left;
			}
			#the_following{
				color: black;
		    	padding: 6px 0px;
			    font-size: 14px;
			    font-weight: bold;
			    letter-spacing: 0.2px;
			}
			.score{
			    border: solid 1px #000;
			    width: 685px;
			    margin-top: 10px;
			}

			.score_head tr{
			    line-height: 14px;
			    text-align: center;
			    font-size: 14px;
			}


			.score_body tr{
			    line-height: 35px;
			    font-size: 14px;
			    text-indent: 8px;
			}
			.score_body tr td center{
			    text-indent: 0px;
			}
			.score_foot tr{
			    line-height: 16px;
			    font-size: 14px;
			    text-indent: 8px;
			}
			.score_foot tr td center{
			    text-indent: 0px;
			}
			.photo{
				width: 97px;
			    height: 153px;
			    text-align: center;
			    font-size: 14px;
			    line-height: 2.5;
			    margin: 21px 0px 0px 295px;
			    float: left;
			}
			.inner_photo{
				width: 95px;
			    height: 113px;
			    border: solid 1px rgba(97, 97, 97, 0.93);
			    text-align: center;
			    line-height: 9.5;
			    font-size: 12px;
			}
			.date_director{
			    font-family: time_new_romen;
			    overflow: auto;
			    float: right;
			    text-align: left;
			    margin-top: 44px;
			    text-indent: 1px;
			}
			.director{
			    font-family: time_new_romen;
				width: 231px;
			    overflow: auto;
			    float: right;
			    text-align: left;
			    text-indent: 1px;
			    text-align: center;

			}
			.grading{
				font-family: time_new_romen;
			    width: 173px;
			}
			.top_grading{
				text-align: center;
			    width: 100%;
			    overflow: auto;
			    font-size: 11px;
			    margin: 2px 0px 0px 0px;
			    text-decoration: underline;
			}
			.show_grading{
				text-align: left;
			    width: 100%;
			    overflow: hidden;
			    font-size: 11px;
			}
			.table_score{
		    color: black;
		    margin: 0 auto;
		    font-size: 11px;
		    border-style: solid solid none none;
		    border-width: 1px;
		    border-color: black;
    		line-height: 14px;
	}
	.table_score tr td{
		    vertical-align: top;
	}
	.inner_tb{
		    color: black;
		    margin: 0 auto;
		    font-size: 11px;
		    border-style: solid solid none none;
		    border-width: 0px;
		    border-color: black;
    		line-height: 14px;
	}
	.td_left{
		border-left:0px !important;
	}
	.td_top{border-bottom:0px !important;}

	.table_score tr{
						padding: 1px 0px;
	}
	.table_score tr th{
						padding: 1px 6px;
						border-style: none none solid solid;
						border-width: 1px;
    					border-color: black;
    					font-weight: bolder;
    					font-size: 10px;
	}

	.table_score tr td{
						border-style: none none solid solid;
						border-width: 1px;
    					border-color: black;
	}
	.table_score tr th span{
						text-indent: 12px;
	}
	</style>

	<?php if($get_query->num_rows() > 0 ):?>
		<?php $count = $get_query->num_rows()?>
			<?php $p = 0 ?>
				<?php $b = 0?>
				<?php for ($i=0; $i < $count ; $i++): ?>
					<? $i?>
					<?=$count[$i]?>
					<?php $limit = ($i == 0)? 0 : $p+=1;?>
							<?php $n = 0?>
							<?php $s = ''?>
							<?php foreach(array_slice($get_query->result(), $limit, 1) as $key=>$row ): ?>

								<?php
									$n++;
									$stu_info_id = $row->stu_info_id;
									$name = $row->stu_last_name.(isset($row->stu_middle_name)? '&nbsp;'.$row->stu_middle_name.'&nbsp;' : '&nbsp;').$row->stu_first_name;
									$name_kh = $row->stu_last_name_kh.(isset($row->stu_middle_name_kh)? '&nbsp;'.$row->stu_middle_name_kh.'&nbsp;' : '&nbsp;').$row->stu_first_name_kh;
									$stu_dob = date_format(date_create($row->stu_dob),"j-F-Y");
									$stu_gender= $row->stu_gender;
									$get_gender = ($stu_gender == 'Male')? 'Mr.':'Miss.';
									$level_name = $row->level_name;
									$level_name_kh = $row->level_name_kh;
									$grade = $row->grade_name;
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_acad_stu_acad_card;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_id = $row->skill_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;
									$nationality_name = $row->nationality_name;
									$batch_name = $row->batch_name;
								?>
				<page size="A4">

						<div class="transcript">
							<div class="inner_transcript">
								<div class="ministry_left">
									<div class="ministry_text">
										MINISTRY OF EDUCATION, YOUTH AND SPORT<br>
										UNIVERSITY OF MANAGEMENT AND ECONOMICS<br>
										<div style="float:left">No</div><div style="float:left;line-height: 1;border-bottom: dotted 1px;text-align: center;width: 100px;margin-top: 7px;"><?php echo ($id_transcript)? sprintf("%07s", $id_transcript++) : '&nbsp;'?></div>ume/bmc
									</div>
								</div>

								<div class='kingdom'>
									<div class="kingdom_text">
										KINGDOM OF CAMBODIA
									</div>
									<div class="nation">
										NATION RELIGION KING
									</div>
								</div>
								<div class="title_transcript">
									TRANSCRIPT OF RECORD
								</div>
								<div class="body_transaction">
									<center><span id='director_detail'>Director of University of Management and Economics certifies that:</span></center>
									<div style="width:100%;min-height: 124px">
										<table id="info_left">
											<tr>
												<td>Name in Khmer</td>
												<td><b>: <?php echo $name_kh?></b></td>
											</tr>
											<tr>
												<td>Name in English</td>
												<td><b>: <?php echo $name?></b></td>
											</tr>
											<tr>
												<td>Sex</td>
												<td>: <?php echo $stu_gender?></td>
											</tr>
											<tr>
												<td>Date of Birth</td>
												<td>: <?php echo $stu_dob ?></td>
											</tr>
											<tr>
												<td>Nationality</td>
												<td>: <?php echo $nationality_name?></td>
											</tr>
											<tr>
												<td>Place of Birth</td>
												<td>: <?php echo $stu_birthplace?></td>
											</tr>
										</table>

										<table id="info_right">
											<tr>
												<td>Degree</td>
												<td>: <?php echo $level_name?></td>
											</tr>
											<tr>
												<td>Promotion</td>
												<td>: <?php echo $batch_name?></td>
											</tr>
											<tr>
												<td>YEAR</td>
												<td>: <?php echo $section_name?></td>
											</tr>
											<tr>
												<td>Period</td>
												<td>: <?php echo $grade?></td>
											</tr>
											<tr>
												<td>School of</td>
												<td>: <?php echo $university_name?></td>
											</tr>
											<tr>
												<td>Major</td>
												<td>: <?php echo $skill_name?></td>
											</tr>
										</table>
									</div>
									<div id="the_following" style="width:100%;overflow:auto;">
											<center>The following transcript is certified as correct according to the record of University.</center>
									</div>

									<div style="width: 100%; height: 515px">

									<table class="table_score" cellpadding="0" cellspacing="0" width="705">
										  <colgroup>
										    <col style="width: 50px;">
										    <col style="width: 180px;">
										    <col style="width: 50px;">
										    <col style="width:50px;">
										    <col style="width:50px;">
										    <col style="width:180px;">
										    <col style="width: 50px;">
										    <col style="width:50px;">
										    <col style="width:50px;">
										  </colgroup>
										<tr>
											<th><center>YEAR</center></th>
											<th colspan="4"><center>FIRST SEMESTER</center></th>
											<th colspan="4"><center>SECOND SEMESTER</center></th>
										</tr>
										<?php $level_students = $this->Student_card_model->get_level_student($stu_info_id, $skill_id);?>

										<?php if($level_students->num_rows() > 0): ?>
											<?php $t = 1;?>
											<?php foreach($level_students->result() as $row_level ): ?>
												<?php
													$t++;
													$student_id = $row_level->student_id;
													$student_skill_id = $row_level->student_skill_id;
													$student_grade = $row_level->student_grade;
												?>
												<tr>
													<th rowspan="<?php echo $t?>"><center><?php echo $student_grade ?>st</center></th>
													<th><center>SUBJECT</center></th>
													<!-- <th><center>CREDIT</center></th> -->
													<th><center>CREDIT</center></th>
													<!-- <th><center>GRADE</center></th> -->
													<th><center>GRADE</center></th>
													<!-- <th><center>SCORE</center></th> -->
													<th><center>SCORE</center></th>
													<th><center>SUBJECT</center></th>
													<th><center>CREDIT</center></th>
													<th><center>GRADE</center></th>
													<th><center>SCORE</center></th>
												</tr>
												<?php $student_semester = "1";?>
												<?php $subject1 = $this->Student_card_model->get_row_subjects($student_skill_id, $student_semester, $student_grade); ?>

												<?php $student_semester = "2";?>
												<?php $subject2 = $this->Student_card_model->get_row_subjects($student_skill_id, $student_semester, $student_grade); ?>

												<?php
													$count_sub1 = $subject1->num_rows();
													$count_sub2 = $subject2->num_rows();
													$make_fild1 = '';
													$make_fild2 = '';
													if($count_sub1 < $count_sub2){
														$make_fild1 .= ($count_sub2 - $count_sub1);
													}elseif($count_sub1 > $count_sub2){
														$make_fild2 .= ($count_sub1 - $count_sub2);
													}
												?>

												<tr>
													<td colspan="4" class="td_top">
														<table class="inner_tb" class="table_score" cellpadding="0" cellspacing="0" width="100%">
															<colgroup>
															    <col style="width: 174px">
															    <col style="width: 52px;">
																<col style="width: 50px;">
																<col style="width: 49px;">
															 </colgroup>
															<?php if($subject1->num_rows() > 0): ?>
																<?php echo $rank?>
																<?php foreach($subject1->result() as $row_subj1): ?>
																	<tr>
																		<td class="td_left"><?php echo $row_subj1->subject_name ?></td>
																		<!-- start score -->
																		<?php
																			$student_id;
																			$sco_semester = $row_subj1->semester;
																			$sco_skill = $row_subj1->major_id;
																			$sco_grade = $row_subj1->level_year;
																			$sco_subject = $row_subj1->sub_id;
																		?>
                                        								<?php $result_score = $this->Student_card_model->get_result_score($student_id, $sco_semester, $sco_grade, $sco_skill, $sco_subject)->row();?>
                                        								<?php

						                                                    $attendance_score = $result_score->attendance_score;
						                                                    $midterm_group_discussion_score = $result_score->midterm_group_discussion_score;
						                                                    $midterm_quiz_score = $result_score->midterm_quiz_score;
						                                                    $midterm_assignment_score = $result_score->midterm_assignment_score;
						                                                    $midterm_exam_score = $result_score->midterm_exam_score;
						                                                    $sum_midterm = ($midterm_group_discussion_score + $midterm_quiz_score + $midterm_assignment_score + $midterm_exam_score);
						                                                    $final_score = $result_score->final_score;

						                                                    $sum_all = floatval($attendance_score + $sum_midterm + $final_score);

						                                                    $grade = '';
																		    if($sum_all >= 0 && $sum_all <= 39){
																		        $grade .= 'F';
																		    }
																		    if($sum_all >= 40 && $sum_all <= 44){
																		        $grade .= 'E';
																		    }
																		    if($sum_all >= 45 && $sum_all <= 49){
																		        $grade .= 'D';
																		    }
																		    if($sum_all >= 50 && $sum_all <= 64){
																		        $grade .= 'C';
																		    }
																		    if($sum_all >= 65 && $sum_all <= 69){
																		        $grade .= 'C+';
																		    }
																		    if($sum_all >= 70 && $sum_all <= 79){
																		        $grade .= 'B';
																		    }
																		    if($sum_all >= 80 && $sum_all <= 84){
																		        $grade .= 'B+';
																		    }
																		    if($sum_all >= 85 && $sum_all <= 100 || $sum_all > 100){
																		        $grade .= 'A';
																		    }

						                                                ?>
																		<td><center><?php echo $row_subj1->subject_credit?></center></td>
																		<td><center><?php echo $grade?></center></td>
																		<td><center><b><?php echo $sum_all ?></b></center></td>
																	</tr>
																<?php endforeach ?>
																	<?php if(!empty($make_fild1)): ?>
																		<?php for ($i=0; $i < $make_fild1; $i++): ?>
																			<tr>
																				<td class="td_left">&nbsp;</td>
																				<td>&nbsp;</td>
																				<td>&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																		<?php endfor ?>
																	<?php endif ?>
															<?php endif ?>
														</table>
													</td>
													<td colspan="4" class="td_top">
														<table class="inner_tb" class="table_score" cellpadding="0" cellspacing="0" width="100%">
															<colgroup>
															    <col style="width: 174px">
															    <col style="width: 52px;">
																<col style="width: 50px;">
																<col style="width: 49px;">
															 </colgroup>
															<?php if($subject2->num_rows() > 0): ?>
																<?php foreach($subject2->result() as $row_subj2): ?>
																	<tr>
																		<td class="td_left"><?php echo $row_subj2->subject_name ?></td>
																		<!-- start score -->
																		<?php
																			$student_id;
																			$sco_semester = $row_subj2->semester;
																			$sco_skill = $row_subj2->major_id;
																			$sco_grade = $row_subj2->level_year;
																			$sco_subject = $row_subj2->sub_id;
																		?>
                                        								<?php $result_score = $this->Student_card_model->get_result_score($student_id, $sco_semester, $sco_grade, $sco_skill, $sco_subject)->row();?>
                                        								<?php

						                                                    $attendance_score = $result_score->attendance_score;
						                                                    $midterm_group_discussion_score = $result_score->midterm_group_discussion_score;
						                                                    $midterm_quiz_score = $result_score->midterm_quiz_score;
						                                                    $midterm_assignment_score = $result_score->midterm_assignment_score;
						                                                    $midterm_exam_score = $result_score->midterm_exam_score;
						                                                    $sum_midterm = ($midterm_group_discussion_score + $midterm_quiz_score + $midterm_assignment_score + $midterm_exam_score);
						                                                    $final_score = $result_score->final_score;

						                                                    $sum_all = ($attendance_score + $sum_midterm + $final_score);

						                                                    $grade = '';
																		    if($sum_all >= 0 && $sum_all <= 39){
																		        $grade .= 'F';
																		    }
																		    if($sum_all >= 40 && $sum_all <= 44){
																		        $grade .= 'E';
																		    }
																		    if($sum_all >= 45 && $sum_all <= 49){
																		        $grade .= 'D';
																		    }
																		    if($sum_all >= 50 && $sum_all <= 64){
																		        $grade .= 'C';
																		    }
																		    if($sum_all >= 65 && $sum_all <= 69){
																		        $grade .= 'C+';
																		    }
																		    if($sum_all >= 70 && $sum_all <= 79){
																		        $grade .= 'B';
																		    }
																		    if($sum_all >= 80 && $sum_all <= 84){
																		        $grade .= 'B+';
																		    }
																		    if($sum_all >= 85 && $sum_all <= 100 || $sum_all > 100){
																		        $grade .= 'A';
																		    }
						                                                ?>
																		<td><center><?php echo $row_subj1->subject_credit?></center></center></td>
																		<td><center><?php echo $grade?></center></td>
																		<td><center><b><?php echo $sum_all ?></b></center></td>
																	</tr>
																<?php endforeach ?>
																	<?php if(!empty($make_fild2)): ?>
																		<?php for ($null=0; $null < $make_fild2; $null++): ?>
																			<tr>
																				<td class="td_left">&nbsp;</td>
																				<td>&nbsp;</td>
																				<td>&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																		<?php endfor ?>
																	<?php endif ?>
															<?php endif ?>
														</table>
													</td>
												</tr>


											<?php endforeach ?>
										<?php endif ?>

									</table>
										<div class="photo">
											<div class="inner_photo">
												4 X 6
											</div>
											<center>ID: <?php echo $stu_unique_id?></center>
										</div>

										<div class="date_director">
											Banteay Meanchey, <?php echo $tmonth?> <?php echo $tdate?>, <?php echo $tyear?>
										</div>
									</div>
										<div class="grading">
											<div class="top_grading">
												<b>GRADING SYSTEM</b>
											</div>
											<div class="show_grading">
												<div style="margin: 6px 0px 0px 9px">
													A &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;90%  - 100%&nbsp;&nbsp;Excellent<br>
													B+&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;85%  - 89%&nbsp;&nbsp;&nbsp;&nbsp;Very Good<br>
													B &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;75%  - 84%&nbsp;&nbsp;&nbsp;&nbsp;Good<br>
													C &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;70%  - 74%&nbsp;&nbsp;&nbsp;&nbsp;Fairly Good<br>
													D &nbsp;&nbsp;&nbsp; =&nbsp;&nbsp;&nbsp;60%  - 69%&nbsp;&nbsp;&nbsp;&nbsp;Fair<br>
													F &nbsp;&nbsp;&nbsp;&nbsp; = &nbsp;< &nbsp;60&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Failure
												</div>
											</div>
										</div>

								</div>
							</div>
						</div>
				</page>
							<?php endforeach ?>
				<?php endfor ?>
	<?php endif ?>

</div>
