<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="ace-icon fa fa-search-plus bigger-100"></i>
            <?php echo ucwords($iqa_evaluate_type); ?>
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
                                <col style="width:20%">
                                <col style="width:0%">
                                <col style="width:0%">
                                <col style="width:0%">
                                <col style="width:1%">
                                <col style="width:1%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2">Name</th>
                                    <th rowspan="2">Gender</th>
                                    <th colspan="<?php echo $count_column_evaluation?>"><center>Type Evaluation</center></th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2" colspan="2">Accessor by:</th> 
                                    <th rowspan="2">No.</th> 
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($iqa_detail_byuser->num_rows() > 0) {
                                    $r = 0;
                                    $sum = '';
                                    foreach ($iqa_detail_byuser->result() as $key => $result) {
                                        $no = $r + 1;
                                        $iqa_id = $result->id;
                                        $get_accessor = $this->Iqa_results->get_info_accessor_byid($iqa_id)->result();
                                ?>
                                            <tr style="cursor: pointer;">
                                                <td rowspan="<?php echo (($iqa_detail_row->num_rows()) + 1)?>"><center><?php echo $no; ?></center></td>
                                                <td rowspan="<?php echo (($iqa_detail_row->num_rows()) + 1)?>"><?php echo $result->name_pt; ?></td>
                                                <td rowspan="<?php echo (($iqa_detail_row->num_rows()) + 1)?>"><center><?php echo $iqa_result_info->gender_pt; ?></center></td>
                                            </tr>

                                            <?php $sum_by_evaluate = ''?>   
                                            <?php $get_result_array = array();?>
                                            <?php $n ?>                                     
                                            <?php foreach($iqa_detail_row->result() as $row_evaluate):?>
                                                <?php $n++ ?>
                                                <?php 
                                                    $iqa_result_id = $row_evaluate->id;
                                                    $evaluation_score = $this->Iqa_results->evaluation_score($iqa_result_id)->result();
                                                ?>
                                            <tr>
                                                <?php $sum_ev = '';?>
                                                <?php $result_array = array() ?> 
                                                <?php foreach($evaluation_score as $key => $ev): ?>
                                                    <?php $sum_ev+= $ev->evaluate_score; ?>
                                                    <?php $get_score_ev = $ev->evaluate_score ?>
                                                    <?php $result_array[] = $get_score_ev ?>
                                                <td><?php echo $get_score_ev?></td>
                                                <?php endforeach ?>  

                                                <td><?php echo $sum_ev?></td>

                                                <?php $get_info_accessor = $this->Iqa_results->get_info_accessor_byid($iqa_result_id)?>
                                                <?php if($get_info_accessor->num_rows() > 0):?>
                                                    <td>
                                                    <?php foreach($get_info_accessor->result() as $row_acs): ?>
                                                        - <?php echo $row_acs->first_name?> <?php echo $row_acs->last_name?><br/>
                                                    <?php endforeach ?>
                                                    </td>
                                                    <td>                                                      
                                                    <?php foreach($get_info_accessor->result() as $position_acs): ?>
                                                        - <?php echo $position_acs->designation_name?><br/>
                                                    <?php endforeach ?>
                                                    </td>
                                                <?php endif ?>
                                                <td><?php echo $n?></td>
                                            </tr>
                                            <?php $get_sum_ev+=$sum_ev?>
                                            <?php $get_result_array[] = $result_array?>
                                            <?php endforeach ?> 

                                            <tr>
                                                <td colspan="3"><center><b>Total:</b></center></td>
                                            <?php $result = array();?>
                                            <?php foreach($get_result_array[0] as $k => $v): ?>
                                                <?php $result[$k] = array_sum(array_column($get_result_array, $k)); ?>
                                                <td><?php echo $result[$k] ?></td>
                                            <?php endforeach ?>
                                                <td><?php echo $get_sum_ev?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                <?
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End -->
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
    })
</script>
<?php $this->load->view("partial/footer"); ?>