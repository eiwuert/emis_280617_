<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
            <?php echo lang('module_' . $controller_name); ?>
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <section class="content" style="min-height: 543px;">
                        <div class="col-xs-12">
                            <div class="col-lg-4 col-sm-4 col-xs-12 no-padding">
                                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('scholarship_view_scholarship'); ?></h3>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12"></div>
                            <div class="col-lg-5 col-sm-5 col-xs-12" style="padding-top: 20px !important">
                                <div class="col-md-12 center" style="text-align: center;">
                                    <div>
                                        <input type="hidden" name="scho_id" value="<?php echo $info->scho_id; ?>" />
                                        <?php
                                            if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/form/-1/",
                                                    '<i title="' . lang('common_new') . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_new') . '</span>',
                                                    array(
                                                        'id' => 'new-person-btn',
                                                        'class' => 'btn btn-success',
                                                        'title' => lang('common_new')
                                                    )
                                                );
                                            }
                                        ?>
                                        <?php 
                                            if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/form/$info->scho_id/2",
                                                    '<i title="' . lang('common_update') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_update') . '</span>',
                                                    array(
                                                        'id' => 'update',
                                                        'class' => 'btn btn-info',
                                                        'title' => $this->lang->line("common_update")
                                                    )
                                                );
                                            }
                                        ?>
                                        <?php 
                                            if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/delete",
                                                    '<i title="' . lang('common_delete') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_delete') . '</span>',
                                                    array(
                                                        'id' => 'delete',
                                                        'class' => 'btn btn-danger',
                                                        'title' => $this->lang->line("common_delete")
                                                    )
                                                );
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="box box-primary view-item">
                                <div class="stu-status-view">
                                    <table class="table  detail-view">
                                        <tbody>
                                        <tr>
                                            <th><?php echo lang('scholarship_scholarship_from'); ?></th>
                                            <td><?php echo $info->scholarship_from; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('scholarship_scholarship_from_kh'); ?></th>
                                            <td><?php echo $info->scholarship_from_kh; ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('scholarship_started_date'); ?></th>
                                            <td><?php echo date(get_date_format(), strtotime($info->started_date)); ?></td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('scholarship_diploma'); ?></th>
                                            <td>
                                            <?php
                                                $selected_degrees = explode(',', $info->degree);
                                                $degrees = $this->Levels->get_degree_by_scholarship($selected_degrees);
                                                $str_degree = '';
                                                if ($degrees->num_rows() > 0) {
                                                    $result = $degrees->result();
                                                    foreach ($result as $key => $value) {
                                                        if ($str_degree == '') {
                                                            $str_degree .= $value->level_name.' ('.$value->level_name_kh.')';
                                                        } else {
                                                           $str_degree .= ', '.$value->level_name.' ('.$value->level_name_kh.')'; 
                                                        }
                                                    }
                                                }
                                                echo $str_degree;
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><?php echo lang('common_major'); ?></th>
                                            <td width="80%">
                                            <?php
                                            $selected_majors = explode(',', $info->major);
                                            $majors = $this->Major_model->get_major_by_scholarship($selected_majors);
                                            $str_major = '';
                                            if ($majors->num_rows() > 0) {
                                                $result = $majors->result();
                                                foreach ($result as $key => $value) {
                                                    if ($str_major == '') {
                                                        $str_major .= $value->skill_name.' ('.$value->skill_name_kh.')';
                                                    } else {
                                                       $str_major .= ', '.$value->skill_name.' ('.$value->skill_name_kh.')'; 
                                                    }
                                                }
                                            }
                                            echo $str_major;
                                            ?>
                                            </td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </section>
                </div> 
            </div> 
        </div>
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')

        $('body').on('click', '#delete', function(e){
            e.preventDefault()
            var ids = [parseInt($('input[name="scho_id"]').val())]
            $.ajax({
                url: SITE_URL + "scholarship/delete",
                type: "POST",
                dataType: "JSON",
                data: {ids : ids},
                success: function(resp) {
                    if (resp.success) {
                        $.notify(resp.message, 'success')
                        window.location.href = SITE_URL + "scholarship"
                    } else {
                        $.notify(resp.message, 'error')
                    }
                }
            })
        });
    })
</script>
<?php $this->load->view("partial/footer"); ?>