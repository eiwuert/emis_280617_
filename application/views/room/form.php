<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1><i class="fa fa-pencil"></i> <?php
            if (!$room_info->room_id) {
                echo lang('room_new');
            } else {
                echo lang('room_update');
            }
            ?>
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                   	<?php echo lang("room_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $room_info->room_id, array('id' => 'room_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required">  
                                        <?php echo form_label(lang('room_name') . ':', 'room_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'room_name',
                                                'id' => 'room_name',
                                                'class' => 'form-control',
                                                'value' => $room_info->room_name));
                                            echo form_hidden('original_room_name', $room_info->room_name);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <?php echo form_label(lang('room_note') . ':', 'room_note', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_textarea(array(
                                                'name' => 'room_note',
                                                'id' => 'room_note',
                                                'class' => 'form-control',
                                                'value' => $room_info->room_note));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <?php
                                            echo form_submit(array(
                                                'name' => 'submitf',
                                                'id' => 'submitf',
                                                'value' => lang('common_submit'),
                                                'class' => 'btn btn-primary pull-right')
                                            );
                                            ?>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>
<script type='text/javascript'>
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#room_form").focus(); }, 100);
        $('#room_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("room/check_duplicate"); ?>', {term: $('#room_name').val()}, function(data) {
        <?php if (!$room_info->room_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('room_duplicate_exists')); ?>))
                    {
                        doroomSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doroomSubmit(form);
            }}, "json")
                    .error(function() {
                    });
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
            {
                room_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('room/room_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(room_name) {
                            return ($(room_name).val() != $('input[name="original_room_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                room_name:
                {
                    remote: <?php echo json_encode(lang('room_duplicate_exists')); ?>,
                    required: <?php echo json_encode(lang('room_room_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doroomSubmit(form)
    {
        if (submitting) return;
        submitting = true;

        $.ajax({
            url: $(form).attr("action"),
            type: "post",
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                submitting = false;
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.href = '<?php echo site_url('room'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>

<?php echo $this->load->view("partial/footer"); ?>