<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-user"></i>
        <?php
            if (!$admission_category_info->stu_category_id) {
                echo lang('admission_category_new');
            } else {
                echo lang('admission_category_update');
            }
        ?>  
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>
                    <!-- </div>      -->
                    <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>  
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    Create admission category
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                    echo form_open($controller_name.'/save/' . $admission_category_info->stu_category_id, array('id' => 'admission_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group">  
                                        <?php echo form_label(lang('admission_category_name') . ':', 'admission_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 required')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'admission_name',
                                                'id' => 'admission_name',
                                                'class' => 'form-control',
                                                'value' => $admission_category_info->stu_category_name));
                                            echo form_hidden('original_admission_name', $admission_category_info->stu_category_name);
                                            ?>
                                        </div>
                                    </div>
            
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<?php $this->load->view("partial/footer"); ?>