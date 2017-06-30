<meta charset="utf-8" />

<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js" > </script>
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
   // jQuery(document).ready(function($) {
   //    if (window.history && window.history.pushState) {

   //      window.history.pushState('forward', null, null);

   //      $(window).on('popstate', function() {
   //          window.location.href = "<?php echo site_url('score')?>";
   //      });

   //    }
   //  });
</script>

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />

<div id="mydiv">
    <style type="text/css">
            body {
              background: rgb(204,204,204); 
            }
            page {
              background: white;
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
            @font-face {
                font-family: khmerOsMollight;
                src: url(../../assets/img/fonts/KhmerOSmuollight.ttf);
            }
            @font-face {
                font-family: time_new_romen;
                src: url(../../assets/img/fonts/times.ttf);
            }           
            @font-face {
                font-family: khmerOScontent;
                src: url(../../assets/img/fonts/KhmerOScontent.ttf);
            } 
        /*++++++++ start body transcript++++*/      

        .body_form{
            width: 1095px;
            float: left;
            overflow: auto;
            margin: 14px 0px 0px 15px;
        }

        .logo{
            width: 104px;
            height: 108px;
            margin: 30px 0px 16px 72px;
            left: 93px;
            float: left;
        }

        .head_center{
            width: 766px;
            float: left;
            text-align: center;
            color: #000000;
        }
        .head_kh1{             
            font-size: 30px;   
            font-family: khmerOsMollight;
            letter-spacing: 1px;
        }
        .head_eng1{ 
            font-size: 22px;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .head_s2{
            font-size:22px;
        }

        .head_s3{
            font-size:22px;
        }

        .head_s4{
            font-size:22px;
        }
        .main_title_center{
            float: left;
            width:100%;
        }
        .inner_main_center{
            float: left;
            width: 240px;
            position: relative;
            left: 263px;
        }
        .receipt_kh{
            font-size: 20px;
            font-family: khmerOsMollight;
            text-align: center;
            float:left;
        }.receipt_eng{
            float: left;
            font-size: 21px;
            line-height: 32px;
            margin-left: 41px;
            font-weight: bold;
        }
        .no{
            width:174px;
            float: right;
            font-size: 21px;
            line-height: 32px;
            font-weight: bold;
        }.num_no{
            float: left;
            padding: 0px 21px;
            border-bottom: dotted 2px #000;
            position: relative;
            top: 8px;
            line-height: 14px;
            margin: 0px 5px;
            color: red;
        }
        /* user form */
        .user_receipt{
            width:100%;
            overflow:auto;
        }
        .tblist{
            border-collapse: collapse;
            border-spacing: 0;
            background-color: transparent;
            font-family: arial;
            font-size: 11px;
            margin-top:5px;
            text-align: center;
        }
        .tblist tr th{
            text-align: center;
            padding:5px 0px;
        }        
        .tblist tr td{
            font-size: 10px;
            padding:5px 0px;
        }
        .uppercase{text-transform: uppercase;}
       
        
    </style>


    <page size="A4" layout="portrait">
        <div class="body_form">
        <!-- center -->
            <div class='logo'>
                <img width="100%" src="<?php echo base_url('assets/img/logo.png')?>">
            </div>
            <div style="margin-top:22px">
                <div class="head_center">
                    <div class="head_kh1">សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</div>
                    <div class="head_eng1">UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
                    <div class="head_s2">លទ្ធផលប្រឡង ឆមាសទី<?php echo ($get_stu->row()->course_schedule_semester)? $get_stu->row()->course_schedule_semester : ''?> ឆ្នាំទី<?php echo ($get_stu->row()->course_schedule_year)? $get_stu->row()->course_schedule_year : ''?> ឆ្នាំសិក្សា <?php echo ($get_stu->row()->section_name)? $get_stu->row()->section_name : ''?></div>
                    <div class="head_s3">មហាវិទ្យាល័យ<?php echo ($get_stu->row()->university_name)? $get_stu->row()->university_name : ''?> ជំនាន់ទី <?php echo ($get_stu->row()->batch_name)? $get_stu->row()->batch_name : ''?></div>
                    <div class="head_s4">សិក្សាថ្ងៃ​ <?php echo ($get_stu->row()->stu_master_stu_schedule​​ == '1')? 'Mon-Fri' : 'Sat-Sun'?> ពេលព្រឹកnull បន្ទប់ <?php echo ($get_stu->row()->room_name)? $get_stu->row()->room_name : ''?></div>
                </div>
            </div>

            <div class="user_receipt">
                <table class="tblist" border="1" cellspacing="0" width="100%">
                    <tr>
                        <th rowspan="2" style="width: 1px;">No.</th>
                        <th rowspan="2" style="min-width: 83px;">គោតនាម-នាម</th>
                        <th rowspan="2" style="min-width: 83px;">អក្សរឡាតាំង</th>
                        <th rowspan="2" style="width:40px">ភេទ</th> 
                        <?php if($subject->num_rows() > 0): ?>       
                            <?php foreach($subject->result() as $r_subject):?>       
                                <th colspan="4"><?php echo $r_subject->subject_name?></th>
                            <? endforeach ?>                         
                                <th rowspan="2">NAS</th>                      
                                <th rowspan="2">Total</th>                      
                                <th rowspan="2">Rank</th> 
                        <?php endif ?>                       
                    </tr>  
                    <?php if($subject->num_rows() > 0): ?>       
                        <?php foreach($subject->result() as $r_subject):?>       
                            <th style="width:27px">Att.</th>
                            <th style="width:27px">Mid.</th>
                            <th style="width:27px">Final</th>
                            <th style="width:27px">Total</th>
                        <? endforeach ?>   
                    <?php endif ?>        

                    <?php if($get_stu->num_rows() > 0): ?>
                        <?php $i= 1?>
                        <?php foreach($get_stu->result() as $row): ?>
                            <?php
                                $stu_id = $row->stu_info_id;
                                $stu_semester = $row->course_schedule_semester;
                                $stu_grade = $row->students_grade;
                                $stu_skill = $row->skill_id;
                            ?>
                            <tr>                       
                                <td><?php echo $i++?></td>
                                <td><?php echo $row->stu_first_name.'&nbsp;'.$row->stu_middle_name.'&nbsp;'.$row->stu_last_name ?></td>
                                <td><?php echo $stu_id.'&nbsp; - '.$stu_semester.'&nbsp; - '.$stu_grade.'&nbsp; - '.$stu_skill ?></td>
                                <td><?php echo $row->stu_gender?></td>  
                                <!-- subject -->
                                <?php if($subject->num_rows() > 0): ?>       
                                    <?php foreach($subject->result() as $r_subject):?> 
                                        <!-- start score -->
                                        <?php $stu_subject = $r_subject->sub_id ?> 
                                        <?php $result_score = $this->Score_model->get_result_score($stu_id, $stu_semester, $stu_grade, $stu_skill, $stu_subject);?>
                                                <?php
                                                    $r_socre = $result_score->row();
                                                    $attendance_score = $r_socre->attendance_score;
                                                    $midterm_group_discussion_score = $r_socre->midterm_group_discussion_score;
                                                    $midterm_quiz_score = $r_socre->midterm_quiz_score;
                                                    $midterm_assignment_score = $r_socre->midterm_assignment_score;
                                                    $midterm_exam_score = $r_socre->midterm_exam_score;
                                                    $sum_midterm = ($midterm_group_discussion_score + $midterm_quiz_score + $midterm_assignment_score + $midterm_exam_score);
                                                    $final_score = $result_score->row()->final_score;
                                                    $sum_all = ($attendance_score + $sum_midterm + $final_score); 
                                                ?>

                                        <th><?php echo (!empty($attendance_score))? $attendance_score : 0 ?></th>
                                        <th><?php echo (!empty($sum_midterm))? $sum_midterm : 0 ?></th>
                                        <th><?php echo (!empty($final_score))? $final_score : 0 ?></th>
                                        <th><?php echo (!empty($sum_all))? $sum_all : 0 ?></th>
                                    <? endforeach ?>    
                                        <?php $get_score = $this->db->query("SELECT SUM((edu_scores.midterm_group_discussion_score + edu_scores.midterm_quiz_score + edu_scores.midterm_assignment_score + edu_scores.midterm_exam_score + edu_scores.attendance_score + edu_scores.final_score)) as total_score,
                                                                                SUM(edu_scores.nas) as total_nas 
                                                                                FROM (`edu_scores`) 
                                                                                JOIN `edu_subjects` ON `edu_subjects`.`sub_id` = `edu_scores`.`subject_id` 
                                                                                JOIN `edu_subject_level_year` ON `edu_subject_level_year`.`subject_id` = `edu_subjects`.`sub_id` 
                                                                                AND edu_subject_level_year.level_year = edu_scores.student_grade
                                                                                WHERE `edu_scores`.`student_skill_id` = {$stu_skill} 
                                                                                AND `edu_scores`.`student_id` = {$stu_id} 
                                                                                AND `edu_scores`.`semester` = {$stu_semester} 
                                                                                AND `edu_scores`.`student_grade` = {$stu_grade}");?> 
                                        
                                <?php endif ?>                
                                        <?php $count = $get_stu->num_rows()+1 ?>                                        
                                        <?php $total_nas = $get_score->row()->total_nas ?>
                                        <?php $total_score = $get_score->row()->total_score + $total_nas ?>
                                        <?php $row_rank = $this->db->query("SELECT student_id FROM edu_scores WHERE semester = {$stu_semester} AND student_grade = {$stu_grade} AND student_skill_id = {$stu_skill} GROUP BY student_id HAVING SUM(midterm_group_discussion_score + midterm_quiz_score + midterm_assignment_score + midterm_exam_score + attendance_score + final_score) <= {$total_score}")->num_rows();?>  
                                        <?php $result_rank = $count - $row_rank?>

                                        <td><?php echo (!empty($total_nas))? $total_nas : 0 ?></td>
                                        <td><?php echo (!empty($total_score))? $total_score : 0 ?></td>
                                        <td><?php echo $result_rank?></td>   
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>

                </table>
            </div>

        <!-- end center -->
        </div>      
    </page>

</div>





