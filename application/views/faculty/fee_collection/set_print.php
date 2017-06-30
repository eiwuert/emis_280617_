<div class="form-group required" style="margin-bottom: 10px;">
    <?php echo form_label('Currency Text:', 'currency', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <?php echo form_input('grand_total_word',($get_edit->pay_grand_total_word)? $get_edit->pay_grand_total_word :"",'class="form-control"'); ?>
    </div>
    <?php echo form_label('Currency Text:', 'currency', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
            <input type="text" class="form-control hasDatepicker" name="pay_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $get_edit->pay_date != "" ? date('d-m-Y', strtotime($get_edit->pay_date)) : ""; ?>">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </span>
    </div>
</div>

<div class="form-group required" style="margin-bottom: 10px;">
    <?php echo form_label('Currency:', 'currency', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <?php echo form_dropdown('currency', $currency, ($get_edit->pay_currency)? $get_edit->pay_currency :"",'class="form-control"'); ?>
    </div>

    <?php echo form_label('Payment Method:', 'payment_method', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <?php echo form_dropdown('payment_method', $payment_method, ($get_edit->pay_payment_method)? $get_edit->pay_payment_method :"",'class="form-control"'); ?>
    </div>
</div>
<div class="form-group required" style="margin-bottom: 10px;">
    <?php echo form_label('Description:', 'description', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <textarea name="description" class="form-control"><?php echo ($get_edit->pay_description)? $get_edit->pay_description :"" ?></textarea>
    </div>

    <?php echo form_label('Schedule:', 'schedule', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <?php echo form_dropdown('schedule', $schedule, ($get_edit->pay_schedule)? $get_edit->pay_schedule :"",'class="form-control"'); ?>
    </div>
</div>