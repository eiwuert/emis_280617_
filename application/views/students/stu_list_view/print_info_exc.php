<style type="text/css">
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
                            font-size:20px;
                        }

                        .head_s3{
                            font-size:20px;
                        }

                        .head_s4{
                            font-size:20px;
                        }
                </style>


<?php
/////// BEGIN SETUP
$file="demo.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");

///// BEGIN GATHER
$test="<table>
			<colgroup>
	            <col style='width:5%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	            <col style='width:10%;'>
	        </colgroup>

	        <tr>
                <td colspan='2' rowspan='5'>
                    <img width='130' src='".base_url('assets/img/logo.png')."'>
                </td>
                <td colspan='7' class='head_kh1'><center>សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</center></td> 
            </tr>
            <tr>
                <td colspan='7' class='head_eng1'><center>UNIVERSITY OF MANAGEMENT AND ECONOMICS</center></td> 
            </tr>
            <tr>
                <td colspan='7' class='head_s2'><center>បញ្ជីឈ្មោះនិស្សិត ឆ្នាំទី".$course_schedule_semester." ឆមាស​ទី".$grade_name." ឆ្នាំសិក្សា ".$section_name."</center></td> 
            </tr>
            <tr>
                <td colspan='7' class='head_s3'><center>មហាវិទ្យាល័យ ".$university_name_kh." ថ្នាក់".$level_name_kh." ជំនាន់ទី".$batch_name." ជំនាញ ".$skill_name_kh."</center></td>    
            </tr>
            <tr>
                <td colspan='7' class='head_s4'><center>ពេលសិក្សា ".(($stu_acad_schedule_id == 1)? 'ចន្ទ​-សុក្រ': 'សៅរ៍-អាទិត្យ')." បន្ទប់សិក្សា  ".$room_name."</center></td>   
            </tr>
			<tr>
				<th>No.</th>
	            <th>Name</th>
	            <th>Name KH</th>
	            <th>Gender</th>
                <th>D.O.B</th>
	            <th>E-mail</th>
	            <th>Phone</th>
	            <th>Admission Date</th>
	            <th>Nationality</th>
            </tr>";
           if($get_stu_info->num_rows() > 0){
                $i = 0;
                foreach($get_stu_info->result() as $row){
                $i++;
            	$test.="<tr>";
                    $test.="<td>".$i."</td>";  
                    $test.="<td>".$row->stu_last_name." ".$row->stu_first_name."</td>";
                    $test.="<td>".$row->stu_last_name_kh." ".$row->stu_first_name_kh."</td>";
                    $test.="<td>".$row->stu_gender."</td>";
                    $test.="<td>".date_format(date_create($row->stu_dob),"j F, Y")."</td>";
                    $test.="<td>".$row->stu_email_id."</td>";
                    $test.="<td>".$row->stu_mobile_no."</td>";
                    $test.="<td>".date_format(date_create($row->stu_admission_date),"j F, Y")."</td>";
                    $test.="<td>".$row->nationality_name."</td>";
                $test.="</tr>";
            	}
            }
$test.="</table>";

echo $test;
?>
