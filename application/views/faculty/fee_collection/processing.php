<script type="text/javascript">
    $(function(){
        $('.checking').on('click',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });
        $('[name="exchange_dollar"]').on('input',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });           
        $('[name="exchange_baht"]').on('input',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });           
        $('[name="vat"]').on('input',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });                   
        $('[name="discount"]').on('input',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });                    
        $('[name="debt"]').on('input',function(){
            $('[name="ch_result"]').attr('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });       
    });

    $(function(){
        $('#twelve_m').attr('checked', true);
        var fee_year_amount_d = parseFloat($('#fees_cate_amount').text());
        var fee_year_amount_r = parseFloat($('#fees_cate_amount_riel').text());
        var fee_year_amount_b = parseFloat($('#fees_cate_amount_baht').text());
        e_disp_scholarship = "<?php echo $e_scho_paid?>";
        e_scho_paid_fee_d = "<?php echo $e_scho_paid_fee_d?>";
        e_scho_paid_fee_r = "<?php echo $e_scho_paid_fee_r?>";
        e_scho_paid_fee_b = "<?php echo $e_scho_paid_fee_b?>";
        // xxxxxx
        e_disp_stu_paid = "<?php echo $e_disp_stu_paid?>";
        e_stu_self_paid_d = "<?php echo $e_stu_self_paid_d?>";
        e_stu_self_paid_r = "<?php echo $e_stu_self_paid_r?>";
        e_stu_self_paid_b = "<?php echo $e_stu_self_paid_b?>";
/*===========*/ 
// check edit
/*===========*/ 
        e_scho = "<?php echo $e_scho_paid?>";        
        check_edit_scho = "<?php echo $get_edit->pay_scholarship_id?>";
        if(e_scho !== ''){
            $('[name="ch_scholarship"]').prop('checked', true); 
            $('#ch[name="scholarship_id"]').removeAttr("disabled");
            $('#ch[name="scholarship_percent"]').removeAttr("disabled");

            $('[name="scholarship_percent"]').prop('disabled', false); 

            $('#show_scholl_scho_percent').text(e_disp_scholarship);
            $('#show_school_scholarship_d').text(e_scho_paid_fee_d);
            $('#show_school_scholarship_r').text(e_scho_paid_fee_r);
            $('#show_school_scholarship_b').text(e_scho_paid_fee_b);            

            $('.show_scho_self_paid_percent').text(e_disp_stu_paid);
            $('.show_self_paid_d').text(e_stu_self_paid_d);
            $('.show_self_paid_r').text(e_stu_self_paid_r);
            $('.show_self_paid_b').text(e_stu_self_paid_b);

            $('.view_selected_scholarship').text("<?php echo $e_scholarship_id?>");
        }else{
            $('#show_scholl_scho_percent').text(0);
            $('#show_school_scholarship_d').text(0);
            $('#show_school_scholarship_r').text(0);
            $('#show_school_scholarship_b').text(0);

            $('.show_scho_self_paid_percent').text(100);
            $('.show_self_paid_d').text(fee_year_amount_d);
            $('.show_self_paid_r').text(fee_year_amount_r);
            $('.show_self_paid_b').text(fee_year_amount_b);
            $('.view_selected_scholarship').text('');
        }  
/*===========*/ 
// check payment method 3, 6, 12
/*===========*/
        if ( $('#three_m').is(':checked') ) {
            var month = $('#three_m').data('three');

            $('input[name="persent_schedule_pay_month"]').val(month);
            $('.show_payment_method').text(month);
            $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()) / 4);
            $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()) / 4);
            $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()) / 4);
        };
        if ( $('#six_m').is(':checked') ) {
            var month = $('#six_m').data('six');

            $('input[name="persent_schedule_pay_month"]').val(month);
            $('.show_payment_method').text(month);

            $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()) / 2);
            $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()) / 2);
            $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()) / 2);
        };
        if ( $('#twelve_m').is(':checked') ) {
            var month = $('#twelve_m').data('twelve');

            $('input[name="persent_schedule_pay_month"]').val(month);
            $('.show_payment_method').text(month);

            $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()));
            $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()));
            $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()));
        };
   
        e_other_fee = "<?php echo $e_pay_other_ch ?>";
        e_pre_ex = "<?php echo $e_pay_pre_ex_ch ?>";
        e_final_ex = "<?php echo $e_pay_final_ch ?>";
        e_re_ex = "<?php echo $e_pay_re_ex_ch ?>";
        e_thesis = "<?php echo $e_pay_thesis_ch ?>";
        e_certificate = "<?php echo $e_pay_certificate_ch ?>";

        if(e_other_fee > 0){
            $('[name="other_fee"]').prop('checked',true);
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_other_fee').show();

            $('#other_fee_dollar').text(<?php echo $suggest_data_payment->fees_other_other_fee_usd?>);
            $('#other_fee_riel').text(<?php echo $suggest_data_payment->fees_other_other_fee_riel?>);
            $('#other_fee_baht').text(<?php echo $suggest_data_payment->fees_other_other_fee_baht?>);
        }
        if(e_pre_ex > 0){
            $('[name="pre_enter_exam"]').prop('checked',true);
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_pre_enter_exam').show();

            $('#pre_enter_exam_dollar').text(<?php echo $suggest_data_payment->fees_other_pre_enter_exam_usd?>);
            $('#pre_enter_exam_riel').text(<?php echo $suggest_data_payment->fees_other_pre_enter_exam_riel?>);
            $('#pre_enter_exam_baht').text(<?php echo $suggest_data_payment->fees_other_pre_enter_exam_baht?>);
        }
        if(e_final_ex > 0){
            $('[name="final_exam"]').prop('checked',true);
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_final_exam').show();

            $('#final_exam_dollar').text(<?php echo $suggest_data_payment->fees_other_final_exam_usd?>);
            $('#final_exam_riel').text(<?php echo $suggest_data_payment->fees_other_final_exam_riel?>);
            $('#final_exam_baht').text(<?php echo $suggest_data_payment->fees_other_final_exam_baht?>);
        }
        if(e_re_ex > 0){
            $('[name="re_exam_fee"]').prop('checked',true);
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_re_exam').show();

            $('#re_exam_dollar').text(<?php echo $suggest_data_payment->fees_other_re_exam_usd?>);
            $('#re_exam_riel').text(<?php echo $suggest_data_payment->fees_other_re_exam_riel?>);
            $('#re_exam_baht').text(<?php echo $suggest_data_payment->fees_other_re_exam_baht?>);
        }
        if(e_thesis > 0){
            $('[name="thesis_fee"]').prop('checked',true);
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_thesis_fee').show();

            $('#thesis_dollar').text(<?php echo $suggest_data_payment->fees_other_thesis_usd?>);
            $('#thesis_riel').text(<?php echo $suggest_data_payment->fees_other_thesis_riel?>);
            $('#thesis_baht').text(<?php echo $suggest_data_payment->fees_other_thesis_baht?>);

            // on change
            $('[name="scholarship_id"]').change(function(){
                var val_select_scholarship = $('option:selected',this).text();
                //view title scholaship
                $('.view_selected_scholarship').text(val_select_scholarship);
            });

            // ======
            $('[name="scholarship_percent"]').change(function(){                
                val_scholarship_percent = $('option:selected',this).val();
                if(val_scholarship_percent > '0'){
                    $('.show_scho_self_paid_percent').text(100 - val_scholarship_percent);

                    $('.show_self_paid_d').text(fee_year_amount_d - ((fee_year_amount_d * val_scholarship_percent) / 100));
                    $('.show_self_paid_r').text(fee_year_amount_r - ((fee_year_amount_r * val_scholarship_percent) / 100 ));
                    $('.show_self_paid_b').text(fee_year_amount_b - ((fee_year_amount_b * val_scholarship_percent) / 100 ));

                    $('#show_scholl_scho_percent').text(val_scholarship_percent);

                    $('#show_school_scholarship_d').text((fee_year_amount_d * val_scholarship_percent) / 100);
                    $('#show_school_scholarship_r').text((fee_year_amount_r * val_scholarship_percent) / 100 );
                    $('#show_school_scholarship_b').text((fee_year_amount_b * val_scholarship_percent) / 100 );
                }else{
                    $('.show_self_paid_d').text(fee_year_amount_d);
                    $('.show_self_paid_r').text(fee_year_amount_r);
                    $('.show_self_paid_b').text(fee_year_amount_b);
                }
            });
        }
        if(e_certificate > 0){
            $('[name="certificate_fee"]').prop('checked',true); 
            $('#get_row').attr('rowspan', (parseFloat($('#get_row').attr('rowspan')) + 1));
            $('#get_certificate').show();

            $('#certificate_dollar').text(<?php echo $suggest_data_payment->fees_other_certificate_usd?>);
            $('#certificate_riel').text(<?php echo $suggest_data_payment->fees_other_certificate_riel?>);
            $('#certificate_baht').text(<?php echo $suggest_data_payment->fees_other_certificate_baht?>);
        }
    });
    $(document).ready(function(){   
/*===========*/ 
// Check Scholarship
/*===========*/
        $('.ch_scholarship').on('click', function(){
            fee_year_amount_d = parseFloat($('#fees_cate_amount').text());
            fee_year_amount_r = parseFloat($('#fees_cate_amount_riel').text());
            fee_year_amount_b = parseFloat($('#fees_cate_amount_baht').text());
                // start do
                if ( $(this).is(':checked') ) {

                    $('#ch[name="scholarship_id"]').removeAttr("disabled");
                    $('#ch[name="scholarship_percent"]').removeAttr("disabled");

                    $('#get_scholarship').show();
                    
                    $('[name="scholarship_id"]').change(function(){
                        var val_select_scholarship = $('option:selected',this).text();
                        //view title scholaship
                        $('.view_selected_scholarship').text(val_select_scholarship);
                    });

                        // Sholarship attach old percent click (still view)
                        val_scholarship_percent = $('option:selected',$('[name="scholarship_percent"]')).val();

                        $('#show_scholl_scho_percent').text(val_scholarship_percent);

                        $('#show_school_scholarship_d').text((fee_year_amount_d * val_scholarship_percent) / 100);
                        $('#show_school_scholarship_r').text((fee_year_amount_r * val_scholarship_percent) / 100 );
                        $('#show_school_scholarship_b').text((fee_year_amount_b * val_scholarship_percent) / 100 );
                    
                        $('.show_scho_self_paid_percent').text(100 - val_scholarship_percent);
                        $('.show_self_paid_d').text(fee_year_amount_d - ((fee_year_amount_d * val_scholarship_percent) / 100));
                        $('.show_self_paid_r').text(fee_year_amount_r - ((fee_year_amount_r * val_scholarship_percent) / 100 ));
                        $('.show_self_paid_b').text(fee_year_amount_b - ((fee_year_amount_b * val_scholarship_percent) / 100 ));

                    // scholarship use when to chenge percent 
                    $('[name="scholarship_percent"]').change(function(){
                        val_scholarship_percent = $('option:selected',this).val();

                        if(val_scholarship_percent > '0'){
                            $('.show_scho_self_paid_percent').text(100 - val_scholarship_percent);

                            cal_scholaship_d = fee_year_amount_d - ((fee_year_amount_d * val_scholarship_percent) / 100);
                            cal_scholaship_r = fee_year_amount_r - ((fee_year_amount_r * val_scholarship_percent) / 100 );
                            cal_scholaship_b = fee_year_amount_b - ((fee_year_amount_b * val_scholarship_percent) / 100 );

                            $('.show_self_paid_d').text(cal_scholaship_d);
                            $('.show_self_paid_r').text(cal_scholaship_r);
                            $('.show_self_paid_b').text(cal_scholaship_b);
                                // display for by month
                                if ( $('#three_m').is(':checked') ) {                                    
                                    $('.show_pay_method_d').text(cal_scholaship_d / 4);
                                    $('.show_pay_method_r').text(cal_scholaship_r / 4);
                                    $('.show_pay_method_b').text(cal_scholaship_b / 4);
                                };
                                if ( $('#six_m').is(':checked') ) {                                    
                                    $('.show_pay_method_d').text(cal_scholaship_d / 2);
                                    $('.show_pay_method_r').text(cal_scholaship_r / 2);
                                    $('.show_pay_method_b').text(cal_scholaship_b / 2);
                                };
                                if ( $('#twelve_m').is(':checked') ) {                                    
                                    $('.show_pay_method_d').text(cal_scholaship_d);
                                    $('.show_pay_method_r').text(cal_scholaship_r);
                                    $('.show_pay_method_b').text(cal_scholaship_b);
                                };      

                            $('#show_scholl_scho_percent').text(val_scholarship_percent);

                            $('#show_school_scholarship_d').text((fee_year_amount_d * val_scholarship_percent) / 100);
                            $('#show_school_scholarship_r').text((fee_year_amount_r * val_scholarship_percent) / 100 );
                            $('#show_school_scholarship_b').text((fee_year_amount_b * val_scholarship_percent) / 100 );
                        }else{
                            $('.show_self_paid_d').text(fee_year_amount_d);
                            $('.show_self_paid_r').text(fee_year_amount_r);
                            $('.show_self_paid_b').text(fee_year_amount_b);
                        }
                    });
                // statement scholarship else uncheck
                }else{

                    // esle if uncheck scholarship_id
                    $('#ch[name="scholarship_id"]').attr("disabled", 'disable');
                    $('#ch[name="scholarship_percent"]').attr("disabled", 'disable');
                    $('#ch[name="scholarship_percent"]').val(0);

                    $('#get_scholarship').hide();

                    $('#show_scholl_scho_percent').text(0);

                    $('#show_school_scholarship_d').text(0);
                    $('#show_school_scholarship_r').text(0);
                    $('#show_school_scholarship_b').text(0);

                    // $('.show_scho_self_paid_percent').text(100);
                    // $('.show_self_paid_d').text(fee_year_amount_d);
                    // $('.show_self_paid_r').text(fee_year_amount_r);
                    // $('.show_self_paid_b').text(fee_year_amount_b);
                    // display for by month

                    if ( $('#three_m').is(':checked') ) {                                    
                        $('.show_pay_method_d').text(fee_year_amount_d / 4);
                        $('.show_pay_method_r').text(fee_year_amount_r / 4);
                        $('.show_pay_method_b').text(fee_year_amount_b / 4);
                    };
                    if ( $('#six_m').is(':checked') ) {                                    
                        $('.show_pay_method_d').text(fee_year_amount_d / 2);
                        $('.show_pay_method_r').text(fee_year_amount_r / 2);
                        $('.show_pay_method_b').text(fee_year_amount_b / 2);
                    };
                    if ( $('#twelve_m').is(':checked') ) {                                    
                        $('.show_pay_method_d').text(fee_year_amount_d);
                        $('.show_pay_method_r').text(fee_year_amount_r);
                        $('.show_pay_method_b').text(fee_year_amount_b);
                    };               
                }
        });
/*===========*/ 
// End Check Scholarship
/*===========*/
        $('.ch_currentcy').click(function(){
            if ( $('[name="ch_dollar"]').is(':checked') ) {
                $('.ch_dollar').show();
            }else{
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
    $(function(){
        $('#three_m').click(function(){
            if ( $(this).is(':checked') ) {
                var month = $(this).data('three');

                $('#six_m').attr('checked', false);
                $('#twelve_m').attr('checked', false);
                $('input[name="persent_schedule_pay_month"]').val(month);
                $('.show_payment_method').text(month);
                
                $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()) / 4);
                $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()) / 4);
                $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()) / 4);
            }else{
                $('input[name="persent_schedule_pay_month"]').val('');
            };        
        });
        $('#six_m').click(function(){
            if ( $(this).is(':checked') ) {
                var month = $(this).data('six');

                $('#three_m').attr('checked', false);
                $('#twelve_m').attr('checked', false);
                $('input[name="persent_schedule_pay_month"]').val(month);
                $('.show_payment_method').text(month);

                $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()) / 2);
                $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()) / 2);
                $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()) / 2);
            }else{
                $('input[name="persent_schedule_pay_month"]').val('');
            };        
        });    
        $('#twelve_m').click(function(){
            if ( $(this).is(':checked') ) {
                var month = $(this).data('twelve');
                $('#three_m').attr('checked', false);
                $('#six_m').attr('checked', false);
                $('input[name="persent_schedule_pay_month"]').val(month);
                $('.show_payment_method').text(month);

                $('.show_pay_method_d').text(parseFloat($('.show_self_paid_d').text()));
                $('.show_pay_method_r').text(parseFloat($('.show_self_paid_r').text()));
                $('.show_pay_method_b').text(parseFloat($('.show_self_paid_b').text()));
            }else{
                $('input[name="persent_schedule_pay_month"]').val('');
            };        
        });
    });
                                
    
    $(function(){
        $('[name="other_fee"]').on('click',function(){        
            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_other_fee = <?php echo $suggest_data_payment->fees_other_other_fee_usd?>;
            var hbox_other_fee_riel = <?php echo $suggest_data_payment->fees_other_other_fee_riel?>;
            var hbox_other_fee_baht = <?php echo $suggest_data_payment->fees_other_other_fee_baht?>;


            if ( $(this).is(':checked') ) {  
                $('#get_other_fee').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#other_fee_dollar').text(hbox_other_fee);
                $('#other_fee_riel').text(hbox_other_fee_riel);
                $('#other_fee_baht').text(hbox_other_fee_baht);
                $('[name="e_other_ch"]').val(1);      

            }else{                               
                $('#get_other_fee').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#other_fee_dollar').text('');
                $('#other_fee_riel').text('');
                $('#other_fee_baht').text('');
                $('[name="e_other_ch"]').val(0);      
            }
        });
        $('[name="pre_enter_exam"]').on('click',function(){

            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_pre_enter_exam = <?php echo $suggest_data_payment->fees_other_pre_enter_exam_usd?>;
            var hbox_pre_enter_exam_riel = <?php echo $suggest_data_payment->fees_other_pre_enter_exam_riel?>;
            var hbox_pre_enter_exam_baht = <?php echo $suggest_data_payment->fees_other_pre_enter_exam_baht?>;

            if ( $(this).is(':checked') ) {                
                $('#get_pre_enter_exam').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#pre_enter_exam_dollar').text(hbox_pre_enter_exam);
                $('#pre_enter_exam_riel').text(hbox_pre_enter_exam_riel);
                $('#pre_enter_exam_baht').text(hbox_pre_enter_exam_baht);
                $('[name="e_pre_ex_ch"]').val(1);
            }else{                               
                $('#get_pre_enter_exam').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#pre_enter_exam_dollar').text('');
                $('#pre_enter_exam_riel').text('');
                $('#pre_enter_exam_baht').text('');
                $('[name="e_pre_ex_ch"]').val(0);
            }
        });

        $('[name="final_exam"]').on('click',function(){
            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_final_exam = <?php echo $suggest_data_payment->fees_other_final_exam_usd?>;
            var hbox_final_exam_riel = <?php echo $suggest_data_payment->fees_other_final_exam_riel?>;
            var hbox_final_exam_baht = <?php echo $suggest_data_payment->fees_other_final_exam_baht?>;

            if ( $(this).is(':checked') ) {                
                $('#get_final_exam').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#final_exam_dollar').text(hbox_final_exam);
                $('#final_exam_riel').text(hbox_final_exam_riel);
                $('#final_exam_baht').text(hbox_final_exam_baht);
                $('[name="e_final_ch"]').val(1);
            }else{                               
                $('#get_final_exam').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#final_exam_dollar').text('');
                $('#final_exam_riel').text('');
                $('#final_exam_baht').text('');
                $('[name="e_final_ch"]').val(0);
            }
        });

        $('[name="re_exam_fee"]').on('click',function(){            
            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_re_exam_fee = <?php echo $suggest_data_payment->fees_other_re_exam_usd?>;
            var hbox_re_exam_fee_riel = <?php echo $suggest_data_payment->fees_other_re_exam_riel?>;
            var hbox_re_exam_fee_baht = <?php echo $suggest_data_payment->fees_other_re_exam_baht?>;

            if ( $(this).is(':checked') ) { 
                $('[name="hbox_re_exam_fee"]').attr('readonly', false);
                $('.times_per_re_ex').prop('disabled', false);
                $(".times_per_re_ex").prop('required',true);
                $('#get_re_exam').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#re_exam_dollar').text(hbox_re_exam_fee);
                $('#re_exam_riel').text(hbox_re_exam_fee_riel);
                $('#re_exam_baht').text(hbox_re_exam_fee_baht);
                $('[name="e_re_ex_ch"]').val(1);
            }else{     
                $('[name="hbox_re_exam_fee"]').attr('readonly', true); 
                $('.times_per_re_ex').prop('disabled', true);           
                $(".times_per_re_ex").prop('required',false);                          
                $('#get_re_exam').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#re_exam_dollar').text('');
                $('#re_exam_riel').text('');
                $('#re_exam_baht').text('');
                $('[name="e_re_ex_ch"]').val(0);
            }
        });

            // written re exam price
            $('input[name="hbox_re_exam_fee"]').change(function(){                
            var ex_dollar = $('[name="exchange_dollar"]').val();
            var ex_baht = $('[name="exchange_baht"]').val();
            var p_re_ex = $(this).val();
                $('input[name="hbox_re_exam_fee_riel"]').val(p_re_ex * ex_dollar);
                $('input[name="hbox_re_exam_fee_baht"]').val(p_re_ex * ex_baht);

                $('#re_exam_dollar').text(p_re_ex);
                $('#re_exam_riel').text(p_re_ex * ex_dollar);
                $('#re_exam_baht').text(p_re_ex * ex_baht);
            });

        $('[name="thesis_fee"]').on('click',function(){
            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_thesis_fee = <?php echo $suggest_data_payment->fees_other_thesis_usd?>;
            var hbox_thesis_fee_riel = <?php echo $suggest_data_payment->fees_other_thesis_riel?>;
            var hbox_thesis_fee_baht = <?php echo $suggest_data_payment->fees_other_thesis_baht?>;

            if ( $(this).is(':checked') ) {                
                $('#get_thesis_fee').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#thesis_dollar').text(hbox_thesis_fee);
                $('#thesis_riel').text(hbox_thesis_fee_riel);
                $('#thesis_baht').text(hbox_thesis_fee_baht);
                $('[name="e_thesis_ch"]').val(1);
            }else{                               
                $('#get_thesis_fee').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#thesis_dollar').text('');
                $('#thesis_riel').text('');
                $('#thesis_baht').text('');
                $('[name="e_thesis_ch"]').val(0);
            }
        });

        $('[name="certificate_fee"]').on('click',function(){
            var pull_rowspan = $('#get_row').attr('rowspan');            
            var hbox_certificate_fee = <?php echo $suggest_data_payment->fees_other_certificate_usd?>;
            var hbox_certificate_fee_riel = <?php echo $suggest_data_payment->fees_other_certificate_riel?>;
            var hbox_certificate_fee_baht = <?php echo $suggest_data_payment->fees_other_certificate_baht?>;

            if ( $(this).is(':checked') ) {                
                $('#get_certificate').show();
                $('#get_row').attr('rowspan', (parseFloat(pull_rowspan) + 1));

                $('#certificate_dollar').text(hbox_certificate_fee);
                $('#certificate_riel').text(hbox_certificate_fee_riel);
                $('#certificate_baht').text(hbox_certificate_fee_baht);
                $('[name="e_certificate_ch"]').val(1);
            }else{                               
                $('#get_certificate').hide();
                $('#get_row').attr('rowspan', pull_rowspan - 1);

                $('#certificate_dollar').text('');
                $('#certificate_riel').text('');
                $('#certificate_baht').text('');
                $('[name="e_certificate_ch"]').val(0);
            }
        });

    });

$(function(){
    $('[name="ch_result"]').click(function(){
        if ( $(this).is(':checked') ) {
            // var persent_schedule_p = parseFloat($('input[name="persent_schedule_pay"]').val());
            var fees_amount_d = parseFloat($('#fees_cate_amount').text());
            var fees_amount_r = parseFloat($('#fees_cate_amount_riel').text());
            var fees_amount_b = parseFloat($('#fees_cate_amount_baht').text());

            var show_scho_school_paid_d = parseFloat($('#id_show_sholarship').find('#show_school_scholarship_d').text());
            var show_scho_school_paid_r = parseFloat($('#id_show_sholarship').find('#show_school_scholarship_r').text());
            var show_scho_school_paid_b = parseFloat($('#id_show_sholarship').find('#show_school_scholarship_b').text());

            var show_payment_method_d = parseFloat($('#id_show_method_paid').find('.show_pay_method_d').text());
            var show_payment_method_r = parseFloat($('#id_show_method_paid').find('.show_pay_method_r').text());
            var show_payment_method_b = parseFloat($('#id_show_method_paid').find('.show_pay_method_b').text());

            var penalty = parseFloat($('input[name="penalty"]').val());
            var thesis_group_fee = parseFloat($('input[name="thesis_group_fee"]').val());

            // convert exchange riel <<--xxxx
            if($('[name="exchange_dollar"]').val() == 0 || $('[name="exchange_dollar"]').val() == ''){
                var exchange_dollar = 1;
            }else{
                var exchange_dollar = parseFloat($('[name="exchange_dollar"]').val());

                        if($('[name="ch_scholarship"]').is(':checked')){                    
                            re_exchange_amount_riel = (show_payment_method_d * exchange_dollar);
                        }else{
                            re_exchange_amount_riel = (fees_amount_d * exchange_dollar);
                        }

                $('#fees_cate_amount_riel').text(fees_amount_d * exchange_dollar);
                $('#show_school_scholarship_r').text(show_scho_school_paid_d * exchange_dollar);
                $('.show_self_paid_r').text(show_payment_method_d * exchange_dollar);
            }

            //  ->> convert exchange baht <<--
            if($('[name="exchange_baht"]').val() == 0 || $('[name="exchange_baht"]').val() == ''){
                var exchange_baht = 1;
            }else{
                var exchange_baht = parseFloat($('[name="exchange_baht"]').val());

                        if($('[name="ch_scholarship"]').is(':checked')){
                            re_exchange_amount_baht = (show_payment_method_d * exchange_baht);
                        }else{
                            re_exchange_amount_baht = (fees_amount_d * exchange_baht);
                        }

                $('#fees_cate_amount_baht').text(fees_amount_d * exchange_baht);
                $('#show_school_scholarship_b').text(show_scho_school_paid_d * exchange_baht);
                $('.show_self_paid_b').text(show_payment_method_d * exchange_baht);
            }


            // exchange Vat
            var vat = parseFloat($('[name="vat"]').val());
            
            // exchange Debt    
            var debt = parseFloat($('[name="debt"]').val());
            if( debt == 0 || debt == ''){
                get_debt = debt;
                get_debt_riel = debt;
                get_debt_baht = debt;
            }else{
                get_debt = debt;
                get_debt_riel = debt*exchange_dollar;
                get_debt_baht = debt*exchange_baht;
            }

            // exchange Discount               
            var discount = parseFloat($('[name="discount"]').val());  

            if($('[name="other_fee"]').is(':checked')){
                var other_fee_dollar = parseFloat($('#other_fee_dollar').text());
                var other_fee_riel = parseFloat($('#other_fee_riel').text());
                var other_fee_baht = parseFloat($('#other_fee_baht').text());

            }else{
                var other_fee_dollar = 0;
                var other_fee_riel = 0;
                var other_fee_baht = 0;
            }

            if($('[name="pre_enter_exam"]').is(':checked')){
                var pre_enter_exam_dollar = parseFloat($('#pre_enter_exam_dollar').text());
                var pre_enter_exam_riel = parseFloat($('#pre_enter_exam_riel').text());
                var pre_enter_exam_baht = parseFloat($('#pre_enter_exam_baht').text());                
            }else{
                var pre_enter_exam_dollar = 0;
                var pre_enter_exam_riel = 0;
                var pre_enter_exam_baht = 0;
            }

            if($('[name="final_exam"]').is(':checked')){
                var final_exam_dollar = parseFloat($('#final_exam_dollar').text());
                var final_exam_riel = parseFloat($('#final_exam_riel').text());
                var final_exam_baht = parseFloat($('#final_exam_baht').text());             
            }else{
                var final_exam_dollar = 0;
                var final_exam_riel = 0;
                var final_exam_baht = 0;
            }

            if($('[name="re_exam_fee"]').is(':checked')){
                var re_exam_dollar = parseFloat($('#re_exam_dollar').text());
                var re_exam_riel = parseFloat($('#re_exam_riel').text());
                var re_exam_baht = parseFloat($('#re_exam_baht').text());           
            }else{
                var re_exam_dollar = 0;
                var re_exam_riel = 0;
                var re_exam_baht = 0;
            }

            if($('[name="thesis_fee"]').is(':checked')){
                var thesis_dollar = parseFloat($('#thesis_dollar').text());
                var thesis_riel = parseFloat($('#thesis_riel').text());
                var thesis_baht = parseFloat($('#thesis_baht').text());          
            }else{
                var thesis_dollar = 0;
                var thesis_riel = 0;
                var thesis_baht = 0;
            }

            if($('[name="certificate_fee"]').is(':checked')){
                var certificate_dollar = parseFloat($('#certificate_dollar').text());
                var certificate_riel = parseFloat($('#certificate_riel').text());
                var certificate_baht = parseFloat($('#certificate_baht').text());         
            }else{
                var certificate_dollar = 0;
                var certificate_riel = 0;
                var certificate_baht = 0;
            }
            var get_show_other_fee_d = other_fee_dollar + pre_enter_exam_dollar + final_exam_dollar + re_exam_dollar + thesis_dollar + certificate_dollar;
            var get_show_other_fee_r = other_fee_riel + pre_enter_exam_riel + final_exam_riel + re_exam_riel + thesis_riel + certificate_riel;
            var get_show_other_fee_b = other_fee_baht + pre_enter_exam_baht + final_exam_baht + re_exam_baht + thesis_baht + certificate_baht;

            $('.show_other_fees_d').text(get_show_other_fee_d);
            $('.show_other_fees_r').text(get_show_other_fee_r);
            $('.show_other_fees_b').text(get_show_other_fee_b);
// xxx do
                    if($('input[name="penalty"]').val() == ''){ var penalty = 0; }
                    $('#show_penalty').text(penalty);

                    get_penalty_d = penalty;
                    get_penalty_r = penalty*exchange_dollar;
                    get_penalty_b = penalty*exchange_baht;

                    $('.show_penalty_d').text(get_penalty_d);
                    $('.show_penalty_r').text(get_penalty_r);
                    $('.show_penalty_b').text(get_penalty_b);

                    if($('input[name="thesis_group_fee"]').val() == ''){ var thesis_group_fee = 0; }
                    $('#show_thesis_group_fee').text(thesis_group_fee);

                    get_thesis_group_fee_d = thesis_group_fee;
                    get_thesis_group_fee_r = thesis_group_fee*exchange_dollar;
                    get_thesis_group_fee_b = thesis_group_fee*exchange_baht;

                    $('.show_thesis_group_fee_d').text(get_thesis_group_fee_d);
                    $('.show_thesis_group_fee_r').text(get_thesis_group_fee_r);
                    $('.show_thesis_group_fee_b').text(get_thesis_group_fee_b);


            get_subtotal_1_d = (show_payment_method_d + get_show_other_fee_d) + ( get_penalty_d + get_thesis_group_fee_d);
            get_subtotal_1_r = ((show_payment_method_r + get_show_other_fee_r) + ( get_penalty_r + get_thesis_group_fee_r));
            get_subtotal_1_b = ((show_payment_method_b + get_show_other_fee_b) + ( get_penalty_b + get_thesis_group_fee_b));

            // sum total 1
        
            $('.show_subtotal_1_d').text(get_subtotal_1_d);
            $('.show_subtotal_1_r').text(get_subtotal_1_r);
            $('.show_subtotal_1_b').text(get_subtotal_1_b);
            
            $('#show_discount_percent').text(discount);

            get_discount_d = ((show_payment_method_d*discount)/100);
            get_discount_r = (((show_payment_method_r*discount)/100)*exchange_dollar);
            get_discount_b = (((show_payment_method_b*discount)/100)*exchange_baht);

            $('.show_discount_d').text(get_discount_d);
            $('.show_discount_r').text(get_discount_r);
            $('.show_discount_b').text(get_discount_b);           

            $('#show_debt').text(debt);

            get_debt_d = debt;
            get_debt_r = debt*exchange_dollar;
            get_debt_b = debt*exchange_baht;

            $('.show_debt_d').text(get_debt_d);
            $('.show_debt_r').text(get_debt_r);
            $('.show_debt_b').text(get_debt_b);

            get_subtotal_2_d = get_subtotal_1_d - (((get_subtotal_1_d * discount)/100)+get_debt);
            get_subtotal_2_r = get_subtotal_1_r - (((get_subtotal_1_r * discount)/100)+get_debt_riel);
            get_subtotal_2_b = get_subtotal_1_b - (((get_subtotal_1_b * discount)/100)+get_debt_baht);

            $('.show_subtotal_2_d').text(get_subtotal_2_d);
            $('.show_subtotal_2_r').text(get_subtotal_2_r);
            $('.show_subtotal_2_b').text(get_subtotal_2_b);

            $('#show_vat').text(vat);

            get_vat_d = ((get_subtotal_2_d*vat)/100);
            get_vat_r = ((get_subtotal_2_r*vat)/100);
            get_vat_b = ((get_subtotal_2_b*vat)/100);

            $('.show_vat_d').text(get_vat_d);
            $('.show_vat_r').text(get_vat_r);
            $('.show_vat_b').text(get_vat_b);

            get_subtotal_3_d = (get_subtotal_2_d + ((get_subtotal_2_d*vat)/100));
            get_subtotal_3_r = (get_subtotal_2_r + ((get_subtotal_2_r*vat)/100));
            get_subtotal_3_b = (get_subtotal_2_b + ((get_subtotal_2_b*vat)/100));

            $('.show_subtotal_3_d').text(get_subtotal_3_d);
            $('.show_subtotal_3_r').text(get_subtotal_3_r);
            $('.show_subtotal_3_b').text(get_subtotal_3_b);

            $('.show_subtotal_3_d').val(get_subtotal_3_d);


            $('button[type="submit"]').prop('disabled', false);            
        }else{
            $('button[type="submit"]').prop('disabled', true);
        }
    });
});
</script>