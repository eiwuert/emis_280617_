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
			.transcript{
			    padding: 67px 0px 0px 53px;
			}
			.inner_transcript{
			    width: 688px;
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
			.body_transaction{
				width:100%;float:left;
			}
			.the_following{
			    width: 100%;
			    text-indent: 48px;
			    font-family: time_new_romen;
			    margin-top: 16px;
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
									$section_name = $row->section_name;
									$stu_unique_id = $row->stu_unique_id;
									$stu_birthplace = $row->stu_birthplace;
									$university_name = $row->university_name;
									$university_name_kh = $row->university_name_kh;
									$university_id = $row->university_id;
									$skill_id = $row->skill_id;
									$skill_name = $row->skill_name;
									$skill_name_kh = $row->skill_name_kh;
									$nationality_name_kh = $row->nationality_name_kh;
									$nationality_name = $row->nationality_name;
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
									<center style='line-height: 20px;'>Director of University of Management and Economics, Banteay Meanchey Campus, Certifies that:</center>
									<table style="margin-left: 24px;margin-top: 15px;width: 328px;line-height: 16px;text-indent: -1px;">
										<colgroup>
											<col style="width:8px;"></col>
											<col style="width:40px"></col>
											<col style="width:40px"></col>
										</colgroup>
										<tr>
											<td>-</td>
											<td>Surname and Name</td>
											<td>: <b><?php echo $name?></b></td>
										</tr>
										<tr>
											<td>-</td>
											<td>Sex</td>
											<td>: <?php echo $stu_gender?></td>
										</tr>
										<tr>
											<td>-</td>
											<td>Date of Birth</td>
											<td>: <?php echo $stu_dob ?></td>
										</tr>
										<tr>
											<td>-</td>
											<td>Nationality</td>
											<td>: <?php echo $nationality_name?></td>
										</tr>
									</table>
									<div class="the_following">
										<div style="padding-left:3px;">
											The following transcript of record is certified as correct according to the record of General English Program (GEP) at University of Management and Economics, Banteay Meanchey Campus.
										</div>
									</div>

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
											<?php $i = 1;?>
											<?php foreach($level_students->result() as $row_level ): ?>
												<?php 
													$i++;
													$student_id = $row_level->student_id;
													$student_skill_id = $row_level->student_skill_id;
													$student_grade = $row_level->student_grade;
												?>

												<?php $get_student_subject1 = $this->Student_card_model->get_student_subject1($student_id, $student_skill_id,$student_grade);?>
												<?php $get_student_subject2 = $this->Student_card_model->get_student_subject2($student_id, $student_skill_id,$student_grade);?>
												<?php 
													$count1 = $get_student_subject1->num_rows();
													$count2 = $get_student_subject2->num_rows();
													$make_fild1 = '';
													$make_fild2 = '';
													if($count1 < $count2){
														$make_fild1 .= ($count2 - $count1);
													}elseif($count1 > $count2){
														$make_fild2 .= ($count1 - $count2);
													}
												?>
												<tr>
													<th rowspan="<?php echo $i?>"><center><?php echo $student_grade ?>st</center></th>
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
												<tr>
													<td colspan="4" class="td_top">
														<table class="inner_tb" class="table_score" cellpadding="0" cellspacing="0" width="100%">
															<colgroup>
															    <col style="width: 174px">
															    <col style="width: 52px;">
																<col style="width: 50px;">
																<col style="width: 49px;">
															 </colgroup>
															<?php if($get_student_subject1->num_rows() > 0): ?>
																<?php foreach($get_student_subject1->result() as $r1): ?>
																	<?php
																		$r_sub_id = $r1->sub_id;
																		$r_subject = $r1->subject_name;
																		$r_credit = $r1->subject_credit;
																		$r_attendance_score = $r1->attendance_score;
																		$r_midterm_group_discussion_score = $r1->midterm_group_discussion_score;
																		$r_midterm_quiz_score = $r1->midterm_quiz_score;
																		$r_midterm_assignment_score = $r1->midterm_assignment_score;
																		$r_midterm_exam_score = $r1->midterm_exam_score;
																		$r_final_score = $r1->final_score;
																		$r_total_score = ($r_attendance_score + $r_midterm_group_discussion_score + $r_midterm_quiz_score + $r_midterm_assignment_score + $r_midterm_exam_score + $r_final_score);
																	?>
																	<tr>												
																		<td class="td_left"><?php echo $r_subject?></td>
																		<td><center><?php echo $r_credit?></center></td>
																		<td><center>null</center></td>
																		<td><center><?php echo $r_total_score ?></center></td>
																	</tr>																	
																<?php endforeach ?>
																	<?php if(!empty($make_fild1)): ?>	
																		<?php for ($i=0; $i < $make_fild1; $i++): ?>
																			<tr>												
																				<td class="td_left"></td>
																				<td></td>
																				<td></td>
																				<td></td>
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
															<?php if($get_student_subject2->num_rows() > 0): ?>
																<?php foreach($get_student_subject2->result() as $r2): ?>
																	<?php
																		$r_sub_id = $r2->sub_id;
																		$r_subject = $r2->subject_name;
																		$r_credit = $r2->subject_credit;
																		$r_attendance_score = $r2->attendance_score;
																		$r_midterm_group_discussion_score = $r2->midterm_group_discussion_score;
																		$r_midterm_quiz_score = $r2->midterm_quiz_score;
																		$r_midterm_assignment_score = $r2->midterm_assignment_score;
																		$r_midterm_exam_score = $r2->midterm_exam_score;
																		$r_final_score = $r2->final_score;
																		$r_total_score = ($r_attendance_score + $r_midterm_group_discussion_score + $r_midterm_quiz_score + $r_midterm_assignment_score + $r_midterm_exam_score + $r_final_score);
																	?>
																	<tr>																
																		<td class="td_left"><?php echo $r_subject?></td>
																		<td><center><?php echo $r_credit?></center></td>
																		<td><center>null</center></td>
																		<td><center><?php echo $r_total_score ?></center></td>
																	</tr>
																<?php endforeach ?>
																	<?php if(!empty($make_fild2)): ?>	
																		<?php for ($i=0; $i < $make_fild2; $i++): ?>
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


