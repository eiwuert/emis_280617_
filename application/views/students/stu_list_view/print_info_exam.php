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
   jQuery(document).ready(function($) {
        if (window.history && window.history.pushState) {
            window.history.pushState('forward', null, null);
            $(window).on('popstate', function() {
                window.location.href = "<?php echo site_url('student_list_view/search_student')?>";
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
            font-size:20px;
        }

        .head_s3{
            font-size:20px;
        }

        .head_s4{
            font-size:20px;
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
                    <div class="head_s2">បញ្ជីឈ្មោះនិស្សិត ឆ្នាំទី<?php echo $course_schedule_semester?> ឆមាស​ទី<?php echo $grade_name?> ឆ្នាំសិក្សា <?php echo $section_name?></div>
                    <div class="head_s3">មហាវិទ្យាល័យ <?php echo $university_name_kh?> ថ្នាក់<?php echo $level_name_kh?> ជំនាន់ទី<?php echo $batch_name?> ជំនាញ <?php echo $skill_name_kh?></div>
                    <div class="head_s4">ពេលសិក្សា <?php echo (($stu_acad_schedule_id == 1)? 'ចន្ទ​-សុក្រ': 'សៅរ៍-អាទិត្យ')?> បន្ទប់សិក្សា  <?php echo $room_name?></div>
                </div>
            </div>
            <?php $count_field = $get_subj->num_rows()?>
            <div class="user_receipt">
                <table class="tblist" border="1" cellspacing="0" width="100%">
                    <colgroup>
                        <col style="width:5%;">
                        <col style="width:10%;">
                        <col style="width:10%;">
                        <col style="width:10%;">
                        <col style="width:10%;">
                        <col style="width:5%;">
                        <?php for ($i=0; $i < $count_field; $i++):?>
                        <col style="width:5%;">
                        <?php endfor ?>
                        <col style="width:5%;">
                    </colgroup>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Name KH</th>
                        <th>Gender</th>
                        <th>D.O.B</th>
                        <th>Table</th>
                        <?php if($get_subj->num_rows() > 0): ?>
                            <?php foreach($get_subj->result() as $sub): ?>
                                <th><?php echo $sub->subjects_short_name?></th>
                            <?php endforeach ?>
                        <?php endif ?>                    
                        <th>Other</th>                    
                    </tr>
                    <?php if($get_stu_info->num_rows() > 0):?>
                        <?php $i = 0?>
                        <?php $tb_stu = (($table_number)? $table_number : 0)?>
                        <?php foreach($get_stu_info->result() as $row): ?>
                            <?php $i++ ?>
                            <?php $tb_stu++ ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td style="text-align:left"><?php echo $row->stu_last_name ?> <?php echo $row->stu_first_name ?></td>
                                <td style="text-align:left"><?php echo $row->stu_last_name_kh ?> <?php echo $row->stu_first_name_kh ?></td>
                                <td><?php echo $row->stu_gender ?></td>
                                <td><?php echo date_format(date_create($row->stu_dob),"j F, Y") ?></td>
                                <td><?php echo $tb_stu ?></td>
                                <?php for($i=0; $i < $count_field; $i++):?>
                                <td></td> 
                                <?php endfor ?>              
                                <td></td>                    
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>

            </div>
        <!-- end center -->
        </div>      
    </page>

</div>






