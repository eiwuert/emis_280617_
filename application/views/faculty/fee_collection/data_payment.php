
<div class="box box-solid box-info col-xs-12 col-lg-12 no-padding checking">
    <div class="box-body">
             <!--  -->
                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                   
                    <div class="col-sm-6 col-xs-12">
                        <label for="scholarship" class="col-sm-12 col-xs-12 required no-padding"><input type="checkbox" class="ch_scholarship" name="ch_scholarship" value="1"> Scholarship:</label>
                        <label for="scholarship" class="col-sm-12 col-xs-12 required no-padding">Scholarship From: <?php echo (($scholarship)? $scholarship : 'No')?></label>
                        <?php echo form_hidden('scholarship_id',(($get_edit->pay_scholarship_id)?$get_edit->pay_scholarship_id : $scholarship_id))?>
                    </div>
                    
                    <div class="col-sm-6 col-xs-12">    
                        <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">Schlarship Percent:</label>
                        <?php echo form_dropdown('scholarship_percent', $scholarship_percent, ($get_edit->pay_scholarship_percent)?$get_edit->pay_scholarship_percent : '', 'id="ch" class="form-control" disabled=""'); ?>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="row">
                            <label class="col-sm-6 col-xs-12 required"> Payment Method:</label> 
                            <div class="col-sm-12 col-xs-12​​ ch_payment_schedule">
                                <input type="checkbox" data-three = '3' id="three_m" value="3" name="schedule_three" <?php echo (!empty($get_edit->pay_schedule_three)? 'checked' : '')?>    > 3 Month
                                <input type="checkbox" data-six = '6' id="six_m" value="6" name="schedule_six" <?php echo (!empty($get_edit->pay_schedule_six)? 'checked' : '')?>    > 6 Month
                                <input type="checkbox" data-twelve = '12' id="twelve_m" value="12" name="schedule_twelve" <?php echo (!empty($get_edit->pay_schedule_twelve)? 'checked' : '')?>   > 12 Month
                            </div>
                            <?php                               
                                // check re exam vs exchange xx
                                $edit_re_exam = $get_edit->pay_re_exam;
                                $ex_r = $get_edit->pay_ex_rate;
                                $ex_b = $get_edit->pay_ex_baht;
                                if($edit_re_exam){
                                    $get_edit_re_exam = $edit_re_exam;
                                    $get_edit_re_exam_r = $edit_re_exam * $ex_r;
                                    $get_edit_re_exam_b = $edit_re_exam * $ex_b;                                    
                                }
                            ?>
                            <?php echo form_hidden('persent_schedule_pay_month',$pay_schedule_month)?>
                        </div>
                    </div>
                    <div class="col-xs-12 page-header"></div>
                    <div class="col-sm-12 col-xs-12">
                        <label for="scholarship" class="col-sm-12 col-xs-12 required no-padding"> Other Fees:</label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="other_fee" value="1"> Other Fees:
                            <?php echo form_hidden('e_other_ch', ($get_edit->pay_other_ch)? $get_edit->pay_other_ch : '0')?>
                            <?php echo form_hidden('hbox_other_fee', $suggest_data_payment->fees_other_other_fee_usd ) ?>
                            <?php echo form_hidden('hbox_other_fee_riel', $suggest_data_payment->fees_other_other_fee_riel ) ?>
                            <?php echo form_hidden('hbox_other_fee_baht', $suggest_data_payment->fees_other_other_fee_baht ) ?>
                        </label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="pre_enter_exam" value="1"> Pre-Enter-Exam:
                            <?php echo form_hidden('e_pre_ex_ch', ($get_edit->pay_pre_ex_ch)? $get_edit->pay_pre_ex_ch : '0')?>
                            <?php echo form_hidden('hbox_pre_enter_exam', $suggest_data_payment->fees_other_pre_enter_exam_usd) ?>
                            <?php echo form_hidden('hbox_pre_enter_exam_riel', $suggest_data_payment->fees_other_pre_enter_exam_riel ) ?>
                            <?php echo form_hidden('hbox_pre_enter_exam_baht', $suggest_data_payment->fees_other_pre_enter_exam_baht ) ?>
                        </label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="final_exam" value="1"> Final Exam:
                            <?php echo form_hidden('e_final_ch', ($get_edit->pay_final_ch)? $get_edit->pay_final_ch : '0')?>
                            <?php echo form_hidden('hbox_final_exam', $suggest_data_payment->fees_other_final_exam_usd) ?>
                            <?php echo form_hidden('hbox_final_exam_riel', $suggest_data_payment->fees_other_final_exam_riel ) ?>
                            <?php echo form_hidden('hbox_final_exam_baht', $suggest_data_payment->fees_other_final_exam_baht ) ?>
                        </label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="thesis_fee" value="1"> Thesis Fee:        
                            <?php echo form_hidden('e_thesis_ch', ($get_edit->pay_thesis_ch)? $get_edit->pay_thesis_ch : '0')?>
                            <?php echo form_hidden('hbox_thesis_fee', $suggest_data_payment->fees_other_thesis_usd) ?>
                            <?php echo form_hidden('hbox_thesis_fee_riel', $suggest_data_payment->fees_other_thesis_riel ) ?>
                            <?php echo form_hidden('hbox_thesis_fee_baht', $suggest_data_payment->fees_other_thesis_baht ) ?>
                        </label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="certificate_fee" value="1"> Certificate Fee:
                            <?php echo form_hidden('e_certificate_ch', ($get_edit->pay_certificate_ch)? $get_edit->pay_certificate_ch : '0')?>
                            <?php echo form_hidden('hbox_certificate_fee', $suggest_data_payment->fees_other_certificate_usd) ?>
                            <?php echo form_hidden('hbox_certificate_fee_riel', $suggest_data_payment->fees_other_certificate_riel ) ?>
                            <?php echo form_hidden('hbox_certificate_fee_baht', $suggest_data_payment->fees_other_certificate_baht ) ?>
                        </label>
                    </div>
                    <div class="col-xs-12 page-header"></div>

                    <!-- xxxx -->
                    <div class="col-sm-12 col-xs-12">
                        <label for="re-exam" class="col-sm-4 col-xs-12 required no-padding">
                            <input type="checkbox" name="re_exam_fee" value="1"> Re-Exam Fee: 
                            <?php echo form_hidden('e_re_ex_ch', ($get_edit->pay_re_ex_ch)? $get_edit->pay_re_ex_ch : '0')?>
                            <?php echo form_input('hbox_re_exam_fee', (($get_edit_re_exam)? $get_edit_re_exam : $suggest_data_payment->fees_other_re_exam_usd), 'readonly="true"') ?>
                            <?php echo form_hidden('hbox_re_exam_fee_riel', (($get_edit_re_exam_r)? $get_edit_re_exam_r : $suggest_data_payment->fees_other_re_exam_riel) ) ?>
                            <?php echo form_hidden('hbox_re_exam_fee_baht', (($get_edit_re_exam_b)? $get_edit_re_exam_b : $suggest_data_payment->fees_other_re_exam_baht) ) ?>
                        </label>
                        <label for="scholarship" class="col-sm-4 col-xs-12 required no-padding">
                            <label class="col-sm-6 col-xs-12 no-padding">Re-Exam per times: </label>
                            <?php $data_tprx = array(''=>'--','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5')?>
                            <?php echo form_dropdown('times_per_re_ex',$data_tprx, ($get_edit->times_per_re_ex)? $get_edit->times_per_re_ex : '', 'class="col-sm-6 col-xs-12 times_per_re_ex" disabled')?>
                        </label>
                    </div>

                    <div class="col-xs-12 page-header"></div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-12">
                            <label for="penalty" class="col-sm-6 col-xs-12 required no-padding">Add Penalty:</label>
                            <input type="text" name="penalty" value="<?php echo ($get_edit->pay_penalty)? $get_edit->pay_penalty : 0 ?>" placeholder='Penalty'>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="thesis_group_fee" class="col-sm-6 col-xs-12 required no-padding">Thesis Group Fee:</label>
                            <input type="text" name="thesis_group_fee" value="<?php echo ($get_edit->pay_thesis_group_fee)? $get_edit->pay_thesis_group_fee : 0 ?>" placeholder='Thesis Group Fee'>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">VAT:</label>
                            <input type="text" name="vat" value="<?php echo ($get_edit->pay_vat)? $get_edit->pay_vat : 0 ?>" placeholder='Exchange Rate'>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">Discount:</label>
                            <input type="text" name="discount" value="<?php echo ($get_edit->pay_discount)? $get_edit->pay_discount : 0 ?>" placeholder='Discount'>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">Debt:</label>
                            <input type="text" name="debt" value="<?php echo ($get_edit->pay_debt)? $get_edit->pay_debt : 0 ?>" placeholder='Debt'>
                        </div>                        
                    </div>
                    <div class="col-xs-12 page-header"></div>
                    <div class="col-sm-12 col-xs-12">                        
                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">Exchange Rate Dollar:</label>
                            <input type="text" name="exchange_dollar" value="<?php echo ($get_edit->pay_ex_rate)? $get_edit->pay_ex_rate : $suggest_data_payment->fees_exchange_rate?>" placeholder='Exchange Rate'>
                        </div>

                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-6 col-xs-12 required no-padding">Exchange Rate Baht:</label>
                            <input type="text" name="exchange_baht" value="<?php echo ($get_edit->pay_ex_baht)? $get_edit->pay_ex_baht : $suggest_data_payment->fees_exchange_baht?>" placeholder='Exchange Rate'>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <label for="scholarship" class="col-sm-12 col-xs-12 required no-padding"> View Payment Currency:</label>
                            <div class="col-sm-12 col-xs-12​​ ch_currentcy">
                                <input type="checkbox" name="ch_dollar" checked=""> Dollar
                                <input type="checkbox" name="ch_riel"> Riel
                                <input type="checkbox" name="ch_baht"> Baht
                            </div>
                        </div>
                    </div>

                </div>
             <!--  -->
    </div>
</div>