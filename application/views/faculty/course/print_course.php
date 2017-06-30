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
<div id="mydiv">
    <style type="text/css">
            body {
              background: rgb(204,204,204); 
            }
            page {
              background: white;          
              /*background-image: url('../../assets/img/ongo.png');*/
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
            @font-face {
                font-family: khmerOsMollight;
                src: url(../../assets/img/fonts/KhmerOSmuollight.ttf);
            }
            @font-face {
                font-family: time_new_romen;
                src: url(assets/img/fonts/times.ttf);
            }           
            @font-face {
                font-family: khmerOScontent;
                src: url(assets/img/fonts/KhmerOScontent.ttf);
            }  
        /*++++++++ start body transcript++++*/
            .body_full{
                width: 1100px;
                height: 760px;
                position: relative;
                margin: 0px 0px 0px 7px;
                top: 27px;
            }
            .logo{
                width: 104px;
                height: 136px;
                position: relative;
                margin: 0px 0px 0px 0px;
                top: 17px;
                left: 93px;
                float: left;
            }

            .head_center{
                width: 615px;
                height: 218px;
                float: left;
                position: relative;
                left: 139px;
                text-align: center;
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
            .head_eng2{
                font-size: 22px;
                letter-spacing: 1px;
                font-weight: bold;
                margin-top: 28px;
            }
            .head_eng3{
                font-size: 21px;
                letter-spacing: 1px;
                margin-top: 4px;
            }

            .head_eng4{
                font-size: 22px;
                letter-spacing: 1px;
                margin-top: 1px;
            }

            .head_eng5{
                font-size: 22px;
                letter-spacing: 1px;
                margin-top: 3px;
            }
            .body_table{
                width: 100%;
                min-height: 150px;
                float: left;
                margin-top: 2px;
            }
            .table_schedule tr{ height:40px; }
            .block_director{
                float:left;
                width:375px;
                height:20px;
                margin-left:20px;
            }
            .block_foot_date{
                float:left;
                width:375px;
                height:20px;
                padding-top: 40px;
            }

            .block_department_right{
                float:left;
                width:310px;
                height:20px;                
                text-align: center;
                font-size: 18px;
            }
            .foot1{
                margin-top: 14px;
                font-size: 16px;
                text-decoration: underline;
                text-align: center;
            }
            .foot2{
                margin-top: 8px;
                font-size: 19px;
                text-align: center;
            }
            .foot3{
                width: 132px;
                height: 20px;
                position: relative;
                float: left;
                top: -3px;
                border-bottom: dotted 1px #696868;
            }
            .foot4{
                text-align: center;
                width:100%;
                float: left;
                font-size:20px;
            }
            .ul_foot{
                margin: 0px;
                padding: 0px;
                list-style: none;
                font-size: 15px;
            }

            .ul_foot li{
                width: 340px; 
                padding-left: 34px;
                line-height: 25px;
            }
            .right_li{
                float: right;
                width: 182px;
            }
            .foot_right1{
                margin-top: 20px;
            }
            .foot_right2{
            }
    </style>
    <page size="A4" layout="portrait">
            <div id="body_page">
                <div id="inner_body">
                <!-- start -->
                    <div class="body_full">
                        <div class='logo'>
                            <img width="100%" src="<?php echo base_url('assets/img/logo_schedule.png')?>">
                        </div>
                        <div class="head_center">
                            <div class="head_kh1">សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</div>
                            <div class="head_eng1">UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
                            <div class="head_eng2">SCHOOL OF BUSINESS ADMINISTRATION</div>
                            <div class="head_eng3"><b><?php echo $head_view_schedule->level_name?></b>, Major in <b><?php echo $head_view_schedule->skill_name?></b></div>
                            <div class="head_eng4">Year <b><?php echo $head_view_schedule->course_schedule_year?></b> Semester <b><?php echo $head_view_schedule->course_schedule_semester?></b> Promotion <b><?php echo $head_view_schedule->batch_name?></b> Room <?php echo $head_view_schedule->room_name?></div>
                            <div class="head_eng5">Academic Year <b><?php echo $head_view_schedule->section_name?></b></div>
                        </div>
                        <?php $id_type = $this->uri->segment(4) ?>
                        <?php if($id_type == 1): ?>
                            <?php echo $this->load->view('faculty/course/print_course_table_full_time');?>
                        <?php endif ?>
                        <?php if($id_type == 2): ?>
                            <?php echo $this->load->view('faculty/course/print_course_table_part_time');?>
                        <?php endif ?>
                        <div style="width:100%; float:left">
                            <div class="block_director">
                                <div class="foot1">University has the rights to change in case it is necessary.</div>
                                <div class="foot2"><div style="float:left;margin-left: 27px;">BanteayMeanchey, Date:</div><div class="foot3"><?php echo date_format(date_create($head_view_schedule->course_schedule_date_today),"d/M/Y")?></div></div>
                                <div class="foot4">Director</div>
                            </div>

                            <div class="block_foot_date">
                                <ul class="ul_foot">
                                    <li>Starting Date:<div class="right_li"><?php echo date_format(date_create($head_view_schedule->course_schedule_adjust_date),"d/M/Y")?></div></li>
                                    <li>Midterm Examination<div class="right_li"><?php echo date_format(date_create($head_view_schedule->course_schedule_midterm),"d/M/Y")?></div></li>
                                    <li>Ending Date<div class="right_li"><?php echo date_format(date_create($head_view_schedule->course_schedule_enddate),"d/M/Y")?></div></li>
                                    <li>Final Examination<div class="right_li"><?php echo date_format(date_create($head_view_schedule->course_schedule_final_from),"d/M/Y")?><?php echo ' To '.date_format(date_create($head_view_schedule->course_schedule_final_to),"d/M/Y")?></div></li>
                                </ul>
                            </div>

                            <div class="block_department_right">
                                <div class="foot_right1">UME-BMC, Date:<?php echo date_format(date_create($head_view_schedule->course_faculty_date),"d/M/Y")?></div>
                                <div class="foot_right2"><?php echo $head_view_schedule->university_name?></div>
                            </div>
                        </div>
                    </div>
                <!-- stop -->
                </div>
            </div>

    </page>

</div>


