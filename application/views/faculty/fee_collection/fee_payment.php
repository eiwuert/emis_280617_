<?php $this->load->view("partial/header"); ?>
<style type="text/css">
    #get_scholarship{
        background: #f5f5f5;
    }
    #get_head{
        background: #f5f5f5;
    }
</style>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-plus"></i>
        <?php echo "Fees Collection"; ?>
    </h1>
</div>
    <div class="page-content">   
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                        <div class="col-xs-12">
                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1%">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('student_information')?></h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table">   
                                                <tbody>
                                                    <?php echo $manage_student_info?>   
                                                </tbody>
                                            </table>  
                                   </div>
                                   <!--./end box-body-->
                            </div>
                        <?php if($suggest_data_payment): ?>      
                            <?php $stu_id = $stu_info->row()->stu_info_id?>
                            <?php $stu_id_acad = $stu_info->row()->stu_acad_id?>
                            <?php $edit_fee = ($get_edit->pay_id)? $get_edit->pay_id : 0 ?>
                            <?php echo form_open("$controller_name/save_payment/$stu_id/$edit_fee", array('id' => 'stu_payment', 'class' => 'form-horizontal')); ?>
                                <?php echo $this->load->view('faculty/fee_collection/data_payment');?>
                                    <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1%">
										   	<div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-inr"></i><sub><i class="fa fa-info-circle"></i></sub> Fees Collection Category :  Tuition Fees</h3>
                                                <div class="clearboth"></div>
                                            </div>
										    <div class="box-body table-responsive">
                                                <table class="table table-bordered tbl-pay-fees">
                                                    <tbody>
                                                        <tr id="get_head">
                                                            <th>Fee Type</th>
                                                            <th>Fees Details</th>
                                                            <th style="display:block" class="ch_dollar">Amount $</th>
                                                            <th style="display:none" class="ch_riel">Amount R</th>
                                                            <th style="display:none" class="ch_baht">Amount B</th>
                                                        </tr>
                                                        <tr>
                                                            <td>+ School Fee:</td>
                                                            <td>Fee Year:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="fees_cate_amount"><?php echo $suggest_data_payment->fees_cate_amount?></span></td>
                                                <?php echo form_hidden('e_pay_amount_fee', ($get_edit->pay_amount_fee)? $get_edit->pay_amount_fee : $suggest_data_payment->fees_cate_amount)?>
                                                            <td style="display:none" class="ch_riel">R<span id="fees_cate_amount_riel"><?php echo ($get_edit->pay_amount_fee)? $on_disp_fee_r : $suggest_data_payment->fees_cate_amount_riel?></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="fees_cate_amount_baht"><?php echo ($get_edit->pay_amount_fee)? $on_disp_fee_b : $suggest_data_payment->fees_cate_amount_baht?></span></td>
                                                        </tr>  
                                                        <tr>
                                                            <td id="get_row" rowspan="1">+ Other Fees</td>
                                                        </tr>                                                              
                                                        <tr id="get_other_fee" style="display:none">
                                                            <td>Other Fee:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="other_fee_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="other_fee_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="other_fee_baht"></span></td>
                                                        </tr>

                                                        <tr id="get_pre_enter_exam" style="display:none">
                                                            <td>Pre-Enter Exam:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="pre_enter_exam_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="pre_enter_exam_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="pre_enter_exam_baht"></span></td>
                                                        </tr>
                                                        <tr id="get_final_exam" style="display:none">
                                                            <td>Final Exam:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="final_exam_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="final_exam_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="final_exam_baht"></span></td>
                                                        </tr>
                                                        <tr id="get_re_exam" style="display:none">
                                                            <td>Re-Exam:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="re_exam_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="re_exam_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="re_exam_baht"></span></td>
                                                        </tr>
                                                        <tr id="get_thesis_fee" style="display:none">
                                                            <td>Thesis Fee:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="thesis_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="thesis_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="thesis_baht"></span></td>
                                                        </tr>
                                                        <tr id="get_certificate" style="display:none">
                                                            <td>Certificate:</td>
                                                            <td style="display:block" class="ch_dollar">$<span id="certificate_dollar"></span></td>
                                                            <td style="display:none" class="ch_riel">R<span id="certificate_riel"></span></td>
                                                            <td style="display:none" class="ch_baht">B<span id="certificate_baht"></span></td>

                                                        </tr>

                                                        <tr id="id_show_sholarship" style="border-top: solid 3px #009fff;">
                                                            <th class="text-right">Sholarship</th>
                                                            <td><span style="float:left" class="view_selected_scholarship"></span>&nbsp;&nbsp;<span id="show_scholl_scho_percent"></span>%</td>   
                                                            <td style="display:block" class="ch_dollar">$ <span id="show_school_scholarship_d"></span></td>   
                                                            <td style="display:none" class="ch_riel">R <span id="show_school_scholarship_r"></span></td>   
                                                            <td style="display:none" class="ch_baht">B <span id="show_school_scholarship_b"></span></td>   
                                                        </tr>

                                                        <tr id="id_show_self_paid" style="display: none">
                                                            <th class="text-right">School Fee</th>
                                                            <td><span style="float:left" class="view_selected_scholarship"></span>&nbsp;&nbsp;<span class="show_scho_self_paid_percent"></span>%</td>  
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_self_paid_d"></span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_self_paid_r"></span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_self_paid_b"></span></td>   
                                                        </tr>
                                                        <tr id="id_show_method_paid" >
                                                            <th class="text-right">School Fee</th>
                                                            <td>&nbsp;&nbsp;<span class="show_payment_method"></span>&nbsp;&nbsp;Month
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_pay_method_d"></span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_pay_method_r"></span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_pay_method_b"></span></td>   
                                                        </tr>

                                                        <tr>
                                                            <th class="text-right">Other Fees</th>
                                                            <td></td>  
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_other_fees_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_other_fees_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_other_fees_b">0</span></td>   
                                                        </tr>

                                                                    <tr>
                                                                        <th class="text-right">Add Penalty:</th>
                                                                        <td><center><span id="show_penalty">0</span></center></td>   
                                                                        <td style="display:block" class="ch_dollar">$ <span class="show_penalty_d">0</span></td>   
                                                                        <td style="display:none" class="ch_riel">R <span class="show_penalty_r">0</span></td>   
                                                                        <td style="display:none" class="ch_baht">B <span class="show_penalty_b">0</span></td> 
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="text-right">Thesis Group Fee:</th>
                                                                        <td><center><span id="show_thesis_group_fee">0</span></center></td>   
                                                                        <td style="display:block" class="ch_dollar">$ <span class="show_thesis_group_fee_d">0</span></td>   
                                                                        <td style="display:none" class="ch_riel">R <span class="show_thesis_group_fee_r">0</span></td>   
                                                                        <td style="display:none" class="ch_baht">B <span class="show_thesis_group_fee_b">0</span></td> 
                                                                    </tr>

                                                        <tr>
                                                            <th class="text-right" style="color:blue">Sub Total</th>
                                                            <td></td>  
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_subtotal_1_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_subtotal_1_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_subtotal_1_b">0</span></td>   
                                                        </tr>
                                                        <tr>
                                                            <th class="text-right">Discount</th>
                                                            <td><center><span id="show_discount_percent">0</span>%</center></td>
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_discount_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_discount_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_discount_b">0</span></td>  
                                                        </tr>

                                                        <tr>
                                                            <th class="text-right">Debt</th>
                                                            <td><center>$<span id="show_debt">0</span></center></td>  
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_debt_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_debt_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_debt_b">0</span></td>  
                                                        </tr>

                                                        <tr>
                                                            <th class="text-right" style="color:blue">Sub Total</th>
                                                            <td></td>  
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_subtotal_2_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_subtotal_2_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_subtotal_2_b">0</span></td>   
                                                        </tr>

                                                        <tr>
                                                            <th class="text-right">Vat%</th>
                                                            <td><center><span id="show_vat">0</span></center></td>   
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_vat_d">0</span></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_vat_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_vat_b">0</span></td> 
                                                        </tr>
                                                        <tr class="warning">
                                                            <th class="text-right" style="color:blue">Grand Total</th>
                                                            <td></td>
                                                            <td style="display:block" class="ch_dollar">$ <span class="show_subtotal_3_d">0</span><input type="hidden" name="pay_grand_total_d" class="show_subtotal_3_d" /></td>   
                                                            <td style="display:none" class="ch_riel">R <span class="show_subtotal_3_r">0</span></td>   
                                                            <td style="display:none" class="ch_baht">B <span class="show_subtotal_3_b">0</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>   

                                                <div class="col-sm-12">
                                                        <?php echo form_hidden('pay_stu_acad_id',$stu_id_acad)?>
                                                        <div class="pull-right">Check Result <input type="checkbox" name="ch_result"/></div>
                                                </div> 
                                            </div>      

                                            <?php echo $this->load->view('faculty/fee_collection/set_print');?>                                             
                                            
                                            <div class="box-footer">
                                                <div class="pull-right" style="padding-bottom:10px;margin-right:10px">
                                                    <?php echo form_hidden('stu_unique_id',$stu_unique_id)?>
                                                    <button type="submit" name="submit" class="btn btn-primary" disabled><i class="fa fa-plus-circle"></i> Save</button>                                                                      
                                                    <a class="btn btn-active" href="<?php echo site_url("$controller_name")?>"><i class="fa fa-clear"></i> Back</a>
                                                </div>
                                            </div>
									</div>
                                    <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1	%">
										   	<div class="box-header with-border">
                                               <h3 class="box-title"><i class="fa fa-inr"></i><sup><i class="fa fa-clock-o"></i></sup> Payment History</h3>
                                                <div class="clearboth"></div>
                                            </div>
										   
                                            <div class="box-body table-responsive no-padding">
                                                <div id="w0">
                                                    <div id="w1" class="grid-view">
                                                        <table class="table table-striped table-bordered">
                                                            <?php echo $view_stu_payment_info?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
									</div>
                            </form>
                        <?php else:?>
                            <center><h3 class="box-title"><i class="fa fa-list"></i> No Fees Information</h3></center>
                        <?php endif ?>                  
                        </div>
                    <!-- End -->
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<?php echo $this->load->view('faculty/fee_collection/processing');?>

<script type='text/javascript'>
    $(document).ready(function()
    {  
        initDatePicker("input[name='pay_date']");
        setTimeout(function(){$(":input:visible:first", "#stu_payment").focus(); }, 100);        
        $('#stu_payment').validate({
            submitHandler:function(form)
            {
                doPaymentStu(form);
            },
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            },
            rules:
            {},
            messages:
            {}
            
        });
    });
    $(document).ready(function(){
        $('.delete_pay').on('click',function(){
            var url_pay = "<?php echo site_url('fees_collection/delete_payment_stu')?>";
            var stu_id = "<?php echo $stu_id?>";
            var pay_id = $(this).data('id');
            $.post(url_pay, {stu_id: stu_id, pay_id: pay_id }, function(result){
                if(result == 'ok'){
                }
                                    
            });
            
                    $(this).find("td").addClass({backgroundColor:"#FF0000"},1200,"linear").end().animate({opacity:0},1200,"linear",function()
                    {
                        $(this).parent().parent().remove();                        
                    });
        });
    })
    //submit faile
    var submitting = false;
    function doPaymentStu(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.score : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name/fee_payment_transaction/$stu_id_acad/0"); ?>'
                }
            },
            <?php if (!$result_pre_byid->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }


</script>

<?php $this->load->view("partial/footer"); ?>