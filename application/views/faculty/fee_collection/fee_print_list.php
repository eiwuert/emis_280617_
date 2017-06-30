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
    $(function() {
        $('#display').click(function(){
            if ( $('[name="ch_dollar"]').is(':checked') ) {
                $('.ch_dollar').show();
            } else{
                $('.ch_dollar').hide();
            }
            if ( $('[name="ch_riel"]').is(':checked') ) {
                $('.ch_riel').show();
            }else{
                $('.ch_riel').hide();
            }
            if ( $('[name="ch_baht"]').is(':checked') ) {
                $('.ch_baht').show();
            }else{
                $('.ch_baht').hide();
            }
        });
    });

</script>

<input type="button" value="Print Div" onclick="PrintElem('#mydiv')" />
<style type="text/css">
    #display{
        display: inline-block;
    }
    #display li{
        display: inline-block;
        list-style: none;
    }
    .ch_dollar{display:table-cell;}
    .ch_riel{display:none}
    .ch_baht{display:none}
</style>
<ul id="display">
    <li><input type="checkbox" name="ch_dollar" checked=""> Dollar</li>
    <li><input type="checkbox" name="ch_riel"> Riel</li>
    <li><input type="checkbox" name="ch_baht"> Baht</li>
</ul>

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
			page[size="A4"]{
			  width: 21cm;
			  height: 29.7cm;  
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
        /**/
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
        /**/
        .table_view{
            border:solid 1px #cdcdcd;
            margin-top: 20px;
            float: left;
            font-family: arial;
            font-size: 12px;
        }
        .table_view tr th{
            height:30px;
            background: rgba(204, 204, 204, 0.24); 
        }

        .table_view tr td{
            height:30px;
        }

        .center{
           text-align:center;
        }
        .left{
           text-align:left;
        }
        .right{
           text-align:right;
        }
        .b{font-weight: bold}
        .blue{color:blue;}
        .red{color:red;}
    	
    	/*sign*/

    	.sign{
    		width:100%;
    		float:left;
    	}
    	.sign_block{
    		width:253px;
    		float: left;
    		height: 104px;
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
            margin-top: 232px;
    	}			
	</style>
	<page size="A4">

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
        $pay_currency = $get_print->pay_currency;
        $pay_payment_method = $get_print->pay_payment_method;
        $pay_schedule = $get_print->pay_schedule;


        $ch_method_cash = ($pay_payment_method == 'Cash')? 'ch_block':'ch_none';
        $ch_method_check = ($pay_payment_method == 'Check')? 'ch_block':'ch_none';

        $ch_dollar = ($pay_currency == 'USD')?'ch_block':'ch_none';
        $ch_riel = ($pay_currency == 'Riel')?'ch_block':'ch_none';
        $ch_baht = ($pay_currency == 'Baht')?'ch_block':'ch_none';

        $ch_doctor = ($level_id == 5)? 'ch_block' : 'ch_none';
        $ch_master = ($level_id == 2)? 'ch_block' : 'ch_none';

        $ch_sch_mf = ($pay_schedule == 'Mon-Fri')?'ch_block':'ch_none';
        $ch_sch_ss = ($pay_schedule == 'Sat-Sun')?'ch_block':'ch_none';

        // 
        $grand_total = $get_print->pay_grand_total;
        $stu_code = $get_print->stu_unique_id;
        
        $scho_percent = $get_print->pay_scholarship_percent;
        $stu_paid_percent = (100-($get_print->pay_scholarship_percent));
        $amount_scho = $get_print->pay_amount_fee;
        $scho_amount_d = (($amount_scho * $scho_percent)/100);

        // check by month
        if($get_print->pay_schedule_month == '3'){
            $stu_paid_amount_d = ((($amount_scho * $stu_paid_percent)/100) / 3);
        }elseif($get_print->pay_schedule_month == '6'){
            $stu_paid_amount_d = ((($amount_scho * $stu_paid_percent)/100) / 2);
        }elseif($get_print->pay_schedule_month == '12'){
            $stu_paid_amount_d = (($amount_scho * $stu_paid_percent)/100);
        }

        $ex_riel =  $get_print->pay_ex_rate;
        $ex_baht =  $get_print->pay_ex_baht;

        $scho_amount_ex_r = ($scho_amount_d * $ex_riel);
        $stu_paid_amount_ex_r = ($stu_paid_amount_d * $ex_riel);
        $scho_amount_ex_b = ($scho_amount_d * $ex_baht);
        $stu_paid_amount_ex_b = ($stu_paid_amount_d * $ex_baht);

        $other_fee = (($get_print->pay_other_ch == 1)? $get_print->pay_other_fees:0) + (($get_print->pay_pre_ex_ch == 1)? $get_print->pay_pre_enter_exam:0) + (($get_print->pay_final_ch == 1)? $get_print->pay_final_exam:0) + (($get_print->pay_re_ex_ch == 1)? $get_print->pay_re_exam:0) + (($get_print->pay_thesis_ch == 1)? $get_print->pay_thesis:0) + (($get_print->pay_certificate_ch == 1)? $get_print->pay_certificate:0);
        $other_fee_r = ($other_fee * $ex_riel);
        $other_fee_b = ($other_fee * $ex_baht);

        $pay_penalty_d = $get_print->pay_penalty;
        $pay_penalty_r = ($pay_penalty_d * $ex_riel);
        $pay_penalty_b = ($pay_penalty_d * $ex_baht);

        $pay_thesis_group_fee_d = $get_print->pay_thesis_group_fee;        
        $pay_thesis_group_fee_r = ($pay_thesis_group_fee_d * $ex_riel);
        $pay_thesis_group_fee_b = ($pay_thesis_group_fee_d * $ex_baht);

        $cal_all_total1 = ($other_fee + $pay_penalty_d + $pay_thesis_group_fee_d);

        $sub_total1_d = ($stu_paid_amount_d + $cal_all_total1);
        $sub_total1_r = (($stu_paid_amount_d + $cal_all_total1)*$ex_riel);
        $sub_total1_b = (($stu_paid_amount_d + $cal_all_total1)*$ex_baht);

        $discount = $get_print->pay_discount;
        $discount_d = (($sub_total1_d*($get_print->pay_discount))/100);
        $discount_r = ((($sub_total1_d*($get_print->pay_discount))/100)*$ex_riel);
        $discount_b = ((($sub_total1_d*($get_print->pay_discount))/100)*$ex_baht);

        $debt_d = $get_print->pay_debt;
        $debt_r = (($get_print->pay_debt)*$ex_riel);
        $debt_b = (($get_print->pay_debt)*$ex_baht);

        $sub_total2_d = ($sub_total1_d - ($discount_d + $debt_d));
        $sub_total2_r = (($sub_total1_d - ($discount_d + $debt_d))*$ex_riel);
        $sub_total2_b = (($sub_total1_d - ($discount_d + $debt_d))*$ex_baht);

        $vat = $get_print->pay_vat;
        $vat_d = (($sub_total2_d*$vat)/100);
        $vat_r = ((($sub_total2_d*$vat)/100)*$ex_riel);
        $vat_b = ((($sub_total2_d*$vat)/100)*$ex_baht);       
        

        $sub_total3_d = ($sub_total2_d + $vat_d);
        $sub_total3_r = (($sub_total2_d + $vat_d)*$ex_riel);
        $sub_total3_b = (($sub_total2_d + $vat_d)*$ex_baht);


        $ntb .="";
        $ntb .="<tr>
                    <td>Scholarship</td>
                    <td class='center'>".$get_print->scholarship_from."&nbsp;".$scho_percent."%</td>
                    <td class='right b ch_dollar'>".$scho_amount_d."</td>
                    <td class='right b ch_riel'>".$scho_amount_ex_r."</td>
                    <td class='right b ch_baht'>".$scho_amount_ex_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>School Fee</td>
                    <td class='center'>".$get_print->scholarship_from."&nbsp;".$stu_paid_percent."%&nbsp;".$get_print->pay_schedule_month." Month</td>
                    <td class='right b ch_dollar'>".$stu_paid_amount_d."</td>
                    <td class='right b ch_riel'>".$stu_paid_amount_ex_r."</td>
                    <td class='right b ch_baht'>".$stu_paid_amount_ex_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>Other Fees</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar'>".$other_fee."</td>
                    <td class='right b ch_riel'>".$other_fee_r."</td>
                    <td class='right b ch_baht'>".$other_fee_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>Penalty</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar'>".$pay_penalty_d."</td>
                    <td class='right b ch_riel'>".$pay_penalty_r."</td>
                    <td class='right b ch_baht'>".$pay_penalty_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>Thesis Group Fee</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar'>".$pay_thesis_group_fee_d."</td>
                    <td class='right b ch_riel'>".$pay_thesis_group_fee_r."</td>
                    <td class='right b ch_baht'>".$pay_thesis_group_fee_b."</td>
                </tr>";









        $ntb .="<tr>
                    <td class='right b'>Sub Total</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar blue'>".$sub_total1_d."</td>
                    <td class='right b ch_riel blue'>".$sub_total1_r."</td>
                    <td class='right b ch_baht blue'>".$sub_total1_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>Discount</td>
                    <td class='center'>".$discount."%</td>
                    <td class='right b ch_dollar'>".$discount_d."</td>
                    <td class='right b ch_riel'>".$discount_r."</td>
                    <td class='right b ch_baht'>".$discount_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>Debt</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar'>".$debt_d."</td>
                    <td class='right b ch_riel'>".$debt_r."</td>
                    <td class='right b ch_baht'>".$debt_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td class='right b'>Sub Total</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar blue'>".$sub_total2_d."</td>
                    <td class='right b ch_riel blue'>".$sub_total2_r."</td>
                    <td class='right b ch_baht blue'>".$sub_total2_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td>VAT</td>
                    <td class='center'>".$vat."%</td>
                    <td class='right b ch_dollar'>".$vat_d."</td>
                    <td class='right b ch_riel'>".$vat_r."</td>
                    <td class='right b ch_baht'>".$vat_b."</td>
                </tr>";
        $ntb .="<tr>
                    <td class='right b'>Grand Total</td>
                    <td class='center'></td>
                    <td class='right b ch_dollar red'>".$sub_total3_d."</td>
                    <td class='right b ch_riel red'>".$sub_total3_r."</td>
                    <td class='right b ch_baht red'>".$sub_total3_b."</td>
                </tr>";

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
            <br>
            <div class="user_receipt">

                <div>

                    <div class="re_c">
                        <div style="float:left">Name :</div>
                            <div class="username"> <?php echo $username ?></div>
                        <div style="float:left">Sex :</div>
                            <div class="sex"><?php echo $sex?></div>
                        <div style="float:left">Date of Birth :</div>
                            <div class="dateofbirth"><?php echo $dob?></div>
                    </div>
                    <div class="re_c">
                        <div style="float:left">Payment Method: </div>
                        <div style="float:left">Cash<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_method_cash.png")?>"/></div>
                        <div style="float:left">Check<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_method_check.png")?>"/></div>
                        <div style="float:left;">Mon-Fri ( &nbsp; )<img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_sch_mf.png")?>"/></div>
                        <div style="float:left; margin-left:25px;">Sat-Sun <img style="width: 14px; margin: 0px 5px;" src="<?php echo base_url("assets/img/$ch_sch_ss.png")?>"/></div>
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

                </div>
            
                <table class="table_view" width="100%" border="1" cellspacing="0" cellpadding="0">
                        <tr>
                            <th>Fee Type</th>
                            <th>Fees Details</th>
                            <th class="ch_dollar">Amount $</th>
                            <th class="ch_riel">Amount R</th>
                            <th class="ch_baht">Amount B</th>
                        </tr>
                        <?php echo $ntb?>
                </table>  
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


