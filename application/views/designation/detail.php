<?php echo $this->load->view('partial/header'); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>                                      
</div>
<div class="page-header" id='page-header'>
    <h1 ><i class="fa fa-search"></i> <?php
        echo lang('designation_view_designation');
        ?>  </h1>

        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding pull-right" style="padding-top: 20px !important; padding-bottom: 5px !important;">
            <div class="col-xs-4 left-padding">
                <a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name"); ?>"><?php echo lang('common_back'); ?></a>  </div>
            <div class="col-xs-4 left-padding">
            <?php if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                <a class="btn btn-block btn-info" href="<?php echo site_url("$controller_name/form/".$designation_info->designation_id); ?>"><?php echo lang('common_update'); ?></a>
            <?php } ?>
            </div>
            <div class="col-xs-4 left-padding">
            <?php if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                <a class="btn btn-block btn-danger btn-delete" href="<?php echo site_url("$controller_name/delete_by_id/$designation_info->designation_id"); ?>" data-confirm="<?php echo lang('designation_confirm_delete_item'); ?>" data-method="post"><?php echo lang('common_delete'); ?></a>
            <?php } ?>
            </div>
        </div>

</div>
<div class="col-xs-12">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>                                 
                </span>
                <?php echo lang("designation_basic_information"); ?>
            </h5>
        </div>

        <div class="widget-body" style="margin-left: 13px;">
            <br/>
            <table class="table  detail-view">
                <tbody>
                    <tr>
                        <th><?php echo lang('designation_name'); ?></th>
                        <td><?php echo $designation_info->designation_name; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('designation_alias'); ?></th>
                        <td><?php echo $designation_info->designation_alias; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('common_created_at'); ?></th>
                        <td><?php echo $created_date = $designation_info->created_at ? date('d-m-Y', strtotime($designation_info->created_at)) : "-"; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('common_created_by'); ?></th>
                        <td><?php echo $creator = $designation_info->creator_name ? $designation_info->creator_name : "-"; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('common_updated_at'); ?></th>
                        <td><?php echo $updated_date = $designation_info->updated_at ? date('d-m-Y', strtotime($designation_info->updated_at)) : "-"; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('common_updated_by'); ?></th>
                        <td><?php echo $updator = $designation_info->updator_name ? $designation_info->updator_name : "-"; ?></td>
                    </tr>
                </tbody>
            </table>
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.col -->

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '.btn-delete', function(event) {
            event.preventDefault();
            var $this = $(this),
            url = $this.attr('href'),
            confrim_message = $this.data('confrim'),
            method = $this.data('method');

            bootbox.confirm(<?php echo json_encode(lang('designation_confirm_delete_item')); ?>, function(result) {
                if (result) {
                    $.ajax({
                        url: url,
                        type: method,
                        dataType: "JSON",
                        success: function(resp) {
                            if (resp.success) {
                                $.notify(resp.message, 'success');
                                window.location.href = '<?php echo site_url('designation'); ?>'
                            } else {
                                $.notify(resp.message, 'error');
                                return false;
                            }
                        }
                    })
                };
            }); 

            /*bootbox.dialog({
                title: "<?php echo lang('proposal_input_email_send_to'); ?>",
                message: 'klk;lk;;',
                buttons: {
                    success: {
                        label: "OK",
                        className: "btn-success",
                        callback: function () {
                            var attention_name = $('#name').val();
                            var email = $('#clientEmail').val();
                            if (email === null) {                                             
                                $.notify("<?php echo lang('proposal_no_email_enter'); ?>", "error")
                                return false                           
                            } else {
                                if (email != "") {
                                    if (confirm("<?php echo lang('proposal_confirm_send_now_proposal'); ?>")) {
                                        data = {email_to : email, attention_name: attention_name}
                                        sendProposal(url, data)
                                    }
                                } else {
                                    $.notify("<?php echo lang('proposal_no_email_enter'); ?>", "error")
                                }
                            }
                        }
                    }
                }
            });*/
        });
    });
</script>

<?php echo $this->load->view('partial/footer'); ?>