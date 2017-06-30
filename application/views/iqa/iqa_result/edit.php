<?php $this->load->view("partial/header"); ?>
<style type="text/css">
    .tbody_clear tr td { padding: 0px !important; vertical-align: middle !important; text-indent: 10px}
    .div_accessor{ float: left; width: 50%; min-height: 35px; line-height: 35px;text-indent: 0px; padding:0px 10px;}
</style>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="ace-icon fa fa-search-plus bigger-100"></i>
            Edit <?php echo ucwords($iqa_evaluate_type); ?>
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <!-- Start -->
                    <h4><?php echo $header_title; ?></h4>
                    <div class="widget-content nopadding table_holder table-responsive">
                        <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                            <colgroup>
                                <col style="width:5%">
                                <col style="width:15%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:10%">
                                <col style="width:25%">
                                <col style="width:25%">
                                <col style="width:5%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Name</th>
                                    <th rowspan="2">Evaluate Date</th>
                                    <th rowspan="2">From Date</th>
                                    <th rowspan="2">To Date</th>
                                    <th colspan="2">គណគ្រប់គ្រង</th> 
                                    <th rowspan="2"></th> 
                                </tr>
                                <tr>
                                    <th>Accessor By:</th> 
                                    <th>Position</th>                                    
                                </tr>

                            </thead>
                            <?php if($iqa_result_info_edit->num_rows() > 0): ?>
                            <tbody class="tbody_clear">
                                <?php $i = '';?>
                                <?php foreach($iqa_result_info_edit->result() as $row): ?>
                                <?php $i++;
                                    $row_id = $row->iqa_id;
                                ?>
                                <?php $get_evaluate_by = $this->Iqa_results->get_info_evaluate_by($row_id); ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$row->get_full_name?></td>
                                    <td><?=$row->evaluate_date?></td>
                                    <td><?=$row->date_from?></td>
                                    <td><?=$row->date_to?></td>
                                    <td colspan="2">

                                        <?php if($get_evaluate_by->num_rows() > 0): ?>
                                            <?php foreach($get_evaluate_by->result() as $row2): ?>
                                                <div style="width:100%; overflow: auto; float:left">
                                                    <div class="div_accessor" style="border-right:1px solid #ddd; border-bottom:1px solid #ddd; ">
                                                        <?=$row2->username?>
                                                    </div>
                                                    <div class="div_accessor" style="border-right:1px solid #ddd; border-bottom:1px solid #ddd; ">
                                                        <?=$row2->designation_name?>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                    </td>
                                    <td>
                                        <div class="col-sm-12" style="display: inline-flex;">
                                            <div class="col-sm-4"><a class="col-sm-4" href="<?=site_url("iqa_tool/view/$row->iqa_id/1")?>"><i class="fa fa-edit bigger-180"></i></a></div>
                                            <div class="col-sm-4"><a class="col-sm-4" href="<?=site_url("iqa_result/delete/$row->iqa_id")?>"><i class="fa fa-trash-o red bigger-180"></i></a></div>
                                        </div>                                  
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                            <?php endif ?>
                        </table>
                    </div>
                    <!-- End -->
                </div> 
            </div> 
        </div>
    </div><!-- /.page-content -->
</div>
<?php $this->load->view("partial/footer"); ?>