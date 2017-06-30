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
			page[size="A5"][layout="portrait"] {
			  width: 21cm;
			  height: 14.8cm;  
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
		    width: 760px;
		    float: left;
		    overflow: auto;
			margin: 14px 0px 0px 15px;
		}

		.logo{
            width: 104px;
		    height: 108px;
		    margin: 25px 0px 0px 25px;
		    left: 93px;
		    float: left;
        }

        .head_center{
            width: 615px;
		    float: left;
		    text-align: center;
		    color: #ffa700;
		    text-shadow: 1px 1px 0px #000;
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
        	width:230px;
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
    	.re_c{
    		width:100%;
    		float:left;
    		overflow: auto;	
			padding: 5px 0px;
    	}
    	.user_receipt{
    		width:100%;
    		float:left;
    		text-align: center;
    	}
    	.username{
    		width:323px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
            text-transform: uppercase;
            font-weight: bold;
    	}
    	.sex{
    		width:80px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
            line-height: 13px;

    	}
    	.dateofbirth{
    		width:157px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
            line-height: 13px;
    	}
    	.amount{
    		width:282px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
            text-transform: capitalize;
            font-weight: bold;
    	}
    	.school_of{
    		width:100px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
    	}
    	.skill{
    		width:100px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
    	}
    	.promotion{
    		width:50px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
    	}
    	.group{
    		width:66px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
    	}
    	.semester{
    		width:50px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
            text-transform: uppercase;
    	}
    	.year{
    		width:50px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
            text-transform: uppercase;
    	}
    	.description{
    		width:423px;
    		border-bottom: dotted 1px #ccc;
    		float:left;
			line-height: 13px;
    	}
    	/*sign*/

    	.sign{
    		width:100%;
    		float:left;
    	}
    	.sign_block{
    		width:253px;
    		float: left;
    		height: 77px;
    		line-height: 2;
    	}

        .date{
            width:253px;
            float: right;
            height: 22px;
            line-height: 2;}
    	.address{
    		width:100%;
    		float:left;
    		padding:15px 0px;
    		border-top:solid 2px #000;
    	}			
	</style>
	<page size="A5" layout="portrait">

    <?php

        $username = $get_print->stu_first_name.''.$get_print->stu_middle_name.' '.$get_print->stu_last_name;
        $sex = $get_print->stu_gender;
        $dob = $get_print->stu_dob;
        $grand_total = $get_print->pay_grand_total;
        $university = $get_print->university_name_short_word;
        $skill = $get_print->skill_short_word;
        $batch = $get_print->batch_name;
        $class = $get_print->school_class_name;
        $stu_code = $get_print->stu_unique_id;
        $course_schedule_semester = $get_print->course_schedule_semester;
        $course_schedule_year = $get_print->course_schedule_year;
        $level_id = $get_print->level_id;

        $pay_payment_method = $get_print->pay_payment_method;
        $pay_currency = $get_print->pay_currency;
        $pay_schedule = $get_print->pay_schedule;
        $pay_description = $get_print->pay_description;
        $pay_grand_total_word = $get_print->pay_grand_total_word;

        $ch_method_cash = ($pay_payment_method == 'Cash')? 'ch_block':'ch_none';
        $ch_method_check = ($pay_payment_method == 'Check')? 'ch_block':'ch_none';

        $ch_dollar = ($pay_currency == 'USD')?'ch_block':'ch_none';
        $ch_riel = ($pay_currency == 'Riel')?'ch_block':'ch_none';
        $ch_baht = ($pay_currency == 'Baht')?'ch_block':'ch_none';

        $ch_doctor = ($level_id == 5)? 'ch_block' : 'ch_none';
        $ch_master = ($level_id == 2)? 'ch_block' : 'ch_none';
        $ch_bachelor = ($level_id == 1)? 'ch_block' : 'ch_none';
        $ch_associate = ($level_id == 4)? 'ch_block' : 'ch_none';
        $ch_gep = ($level_id == 3)? 'ch_block' : 'ch_none';
        $ch_short_course = ($level_id == 7)? 'ch_block' : 'ch_none';
        $ch_final_exam = ($pay_payment_method == '')? 'ch_block' : 'ch_none';
        $ch_other = ($pay_payment_method == '')? 'ch_block' : 'ch_none';

        $ch_sch_mf = ($pay_schedule == 'Mon-Fri')?'ch_block':'ch_none';
        $ch_sch_ss = ($pay_schedule == 'Sat-Sun')?'ch_block':'ch_none';

    ?>


		<div class="body_form">
		<!-- center -->
			<div class='logo'>
                <img width="100%" src="<?php echo base_url('assets/img/logo.png')?>">
            </div>
            <div style="margin-top:22px">
	            <div class="head_center">
	                <div class="head_kh1">សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</div>
	                <div class="head_eng1">UNIVERSITY OF MANAGEMENT AND ECONOMICS</div>
	            </div>
            </div>
            <div class="main_title_center">
            	<div class="inner_main_center">
            		<div class="receipt_kh">វិក្កយបត្រ</div><div class="receipt_eng">RECEPT</div>
            	</div>
            	<div class="no"><div style="float:left">No.: </div><div class="num_no"><?php echo $stu_code?></div></div>
            </div>

            <div class="user_receipt">
            	<div class="re_c">
            		<div style="float:left">Name :</div>
            			<div class="username"> <?php echo $username ?></div>
            		<div style="float:left">Sex :</div>
            			<div class="sex"><?php echo $sex?></div>
            		<div style="float:left">Date of Birth :</div>
            			<div class="dateofbirth"><?php echo $dob?></div>
            	</div>
            	<div class="re_c">
            		<div style="float:left">Amount :</div>
            			<div class="amount"> <?php echo $grand_total.'&nbsp;&nbsp;('.$pay_grand_total_word.')' ?></div>
            		<div style="float:left">USD<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_dollar.png")?>"/></div>
            		<div style="float:left">Riel<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_riel.png")?>"/></div>
                    <div style="float:left">Baht<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_baht.png")?>"/></div>
            		<div style="float:left">Payment Method: </div>
            		<div style="float:left">Cash<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_method_cash.png")?>"/></div>
            		<div style="float:left">Check<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_method_check.png")?>"/></div>
            	</div>
            	<div class="re_c">
            		<div style="float:left">School of: </div>
            			<div class="school_of"> <?php echo $university?> </div>
            		<div style="float:left">Skill: </div>
            			<div class="skill"> <?php echo $skill?> </div>
            		<div style="float:left">Promotion: </div>
            			<div class="promotion"> <?php echo $batch?> </div>
            		<div style="float:left">Class: </div>
            			<div class="group"> <?php echo $class?> </div>
            		<div style="float:left">Semester: </div>
            			<div class="semester"> <?php echo $course_schedule_semester?> </div>
            		<div style="float:left">Year: </div>
            			<div class="year"> <?php echo $course_schedule_year ?> </div>
            	</div>
            	<div class="re_c">
            		<div style="float:left;">Doctor <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_doctor.png")?>"/></div>
            		<div style="float:left; margin-left:130px;">Master &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_master.png")?>"/></div>
            		<div style="float:left; margin-left:130px;">Bachelor &nbsp;&nbsp;<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_bachelor.png")?>"/></div>
            		<div style="float:left; margin-left:106px;">Associate <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_associate.png")?>"/></div>
            	</div>            	
            	<div class="re_c">
            		<div style="float:left;">GEP &nbsp;&nbsp;&nbsp;&nbsp;<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_gep.png")?>"/></div>
            		<div style="float:left; margin-left:130px;">Short Course <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_short_course.png")?>"/></div>
            		<div style="float:left; margin-left:130px;">Fail Exam <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_final_exam.png")?>"/></div>
            		<div style="float:left; margin-left:130px;">Other <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_other.png")?>"/></div>
            	</div>


                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                
                                                                                                                
            	<div class="re_c">            			
            		<div style="float:left">Description :</div>
            			<div class="description"> <?php echo $pay_description?> </div>
            			<div style="float:left;">Mon-Fri ( &nbsp; )<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_sch_mf.png")?>"/></div>
            			<div style="float:left; margin-left:25px;">Sat-Sun <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_sch_ss.png")?>"/></div>

            	</div>
            </div>
            <div class="sign">
                    <div class="date">
                        <center>Date: <?php echo date("j F, Y"); ?></center>
                    </div>
            </div>
            <div class="sign">
            		<div class="sign_block">
            		</div>

            		<div class="sign_block">
            			<center>Paid By</center>
            		</div>

            		<div class="sign_block">
            			<center>Cashier</center>
            		</div>
            </div>
            <div class="address">
            	<div style="text-decoration: underline;">ADDRESS</div>
            	<div class="ad1">
            		Location: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            		II Village, Sangkat Kampong Svay, Serey Sophorn Munucipality, Banteay Meanchey Province
            	</div>
            	<div class="ad2">
            		Telephone: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            		054 6666 669 / 097 999 7717 / 017 787 874
            	</div>
            </div>
        <!-- end center -->
		</div>		
	</page>

</div>


