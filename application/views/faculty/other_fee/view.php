<?php echo $this->load->view('partial/header'); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>
</div>
<div class="page-header" id='page-header'>
    <h1><i class="fa fa-search"></i>Fee School Detail</h1>
</div>
<div class="col-xs-12">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>
                </span>
                <?php echo lang('fees_school_detail'); ?>
            </h5>
        </div>

        <div class="widget-body" style="margin-left: 13px;">
            <br/>
            <table class="table table-bordered tbl-pay-fees">
                    <tr>
                        <th><label><?php echo lang('degree_code'); ?>:</label></th>
                        <td><?php echo $fees_info->level_code .' - '. $fees_info->level_name; ?></td>
                    </tr>
                    <tr>
                        <th><label><?php echo lang('major_name') ?>:</label></th>
                        <td><?php echo $fees_info->skill_name; ?></td>
                    </tr>
                    <tr>
                        <th><label><?php echo lang('common_scholarship'); ?>:</label></th>
                        <td>
                            <?php
                            foreach ($scholarships as $key => $item) {
                                echo "<p>" . $item->scholarship_from . "</p>";
                            }
                            ?>
                        </td>
                    </tr>
            </table>
            <div class="box-header with-border">
                <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('fees_category'); ?></h4>
                <div class="clearboth"></div>
            </div>
            <table class="table table-bordered tbl-pay-fees table-hover">
                <tr>
                    <th class="green"></th>
                    <th class="green"><label><?php echo lang('common_dollar'); ?></label></th>
                    <th class="green"><label><?php echo lang('common_riel'); ?></label></th>
                    <th class="green"><label><?php echo lang('common_baht'); ?></label></th>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_year_fee'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_cate_amount; ?></td>
                    <td>R<?php echo $fees_info->fees_cate_amount_riel; ?></td>
                    <td>R<?php echo $fees_info->fees_cate_amount_baht; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_six_months'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_cate_amount / 2; ?></td>
                    <td>R<?php echo $fees_info->fees_cate_amount_riel / 2; ?></td>
                    <td>R<?php echo $fees_info->fees_cate_amount_baht / 2; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_three_months'); ?>:</label></th>
                    <td>$<?php echo round(($fees_info->fees_cate_amount / 4),2); ?></td>
                    <td>R<?php echo round(($fees_info->fees_cate_amount_riel / 4),2); ?></td>
                    <td>R<?php echo round(($fees_info->fees_cate_amount_baht / 4),2); ?></td>
                </tr>
            </table>
            <div class="box-header with-border">
                <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('fees_other_fee'); ?></h4>
                <div class="clearboth"></div>
            </div>
            <table class="table table-bordered tbl-pay-fees table-hover">
                <tr>
                    <th class="green"></th>
                    <th class="green"><label><?php echo lang('common_dollar'); ?></label></th>
                    <th class="green"><label><?php echo lang('common_riel'); ?></label></th>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_other_fee'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_other_fee_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_other_fee_riel; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_pre_enter_exam'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_pre_enter_exam_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_pre_enter_exam_riel; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_final_exam'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_final_exam_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_final_exam_riel; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_re_exam_fee'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_re_exam_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_re_exam_riel; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_thesis_fee'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_thesis_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_thesis_riel; ?></td>
                </tr>
                <tr>
                    <th><label><?php echo lang('fees_certificate_fee'); ?>:</label></th>
                    <td>$<?php echo $fees_info->fees_other_certificate_usd; ?></td>
                    <td>R<?php echo $fees_info->fees_other_certificate_riel; ?></td>
                </tr>
            </table>

        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.col -->


<?php echo $this->load->view('partial/footer'); ?>