<div class="col-xs-12">
                                
    <div class="col-xs-12">        
            <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1 col-sm-12">    
                <div class="pull-left"><i class="fa fa-files-o"></i> Full Time</div>
                <a href="<?php echo site_url("$controller_name/print_schedule/$course_id/1")?>" class="pull-right" id='print'><i class="fa fa-print"></i> Print</a>
            </h4>
    </div>

    
            
                
                        <table class="table table-striped table-bordered" style="margin-bottom: 0px">

                                <tr>
                                    <td class="blue"><label>Time - Morning</label></td>
                                    <td class="blue"><center>Monday</center></td>
                                    <td class="blue"><center>Tuesday</center></td>
                                    <td class="blue"><center>Wednesday</center></td>
                                    <td class="blue"><center>Thursday</center></td>
                                    <td class="blue"><center>Friday</center></td>
                                    <td class="blue"><label></label></td>
                                </tr>
                                <?php $view_schedule_m = $get_view_schedule_m->num_rows() ?>
                                <?php if($view_schedule_m > 0): ?>
                                    <?php foreach($get_view_schedule_m->result() as $schdule_row):?>
                                        
                                            <tr>
                                                <td width=""><label><?php echo $schdule_row->time?></label></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_mon?><hr style="margin:0px"/>( <?php echo $schdule_row->e_mon?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_tue?><hr style="margin:0px"/>( <?php echo $schdule_row->e_tue?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_wed?><hr style="margin:0px"/>( <?php echo $schdule_row->e_wed?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_thu?><hr style="margin:0px"/>( <?php echo $schdule_row->e_thu?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_fri?><hr style="margin:0px"/>( <?php echo $schdule_row->e_fri?> )</div></td>
                                                <td width="75">
                                                    <a href="<?php echo site_url("$controller_name/view_schedule/$schdule_row->course_id/$schdule_row->id") ?>"><i class="ace-icon fa fa-pencil bigger-180"></i></a>
                                                    <a  style="color:red" href="<?php echo site_url("$controller_name/delete_schedule/$schdule_row->course_id/1/$schdule_row->id") ?>"><i class="ace-icon fa fa-trash-o bigger-180"></i></a>
                                                </td>
                                            </tr>
                               

                                    <?php endforeach ?>
                                <?php endif ?>                                    
                                
                                <?php $view_schedule_a = $get_view_schedule_a->num_rows() ?>
                                <?php if($view_schedule_a > 0): ?>
                                    <?php foreach($get_view_schedule_a->result() as $schdule_row):?>
                                        
                                            <tr>
                                                <td width=""><label><?php echo $schdule_row->time?></label></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_mon?><hr style="margin:0px"/>( <?php echo $schdule_row->e_mon?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_tue?><hr style="margin:0px"/>( <?php echo $schdule_row->e_tue?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_wed?><hr style="margin:0px"/>( <?php echo $schdule_row->e_wed?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_thu?><hr style="margin:0px"/>( <?php echo $schdule_row->e_thu?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_fri?><hr style="margin:0px"/>( <?php echo $schdule_row->e_fri?> )</div></td>
                                                <td width="75">
                                                    <a href="<?php echo site_url("$controller_name/view_schedule/$schdule_row->course_id/$schdule_row->id") ?>"><i class="ace-icon fa fa-pencil bigger-180"></i></a>
                                                    <a  style="color:red" href="<?php echo site_url("$controller_name/delete_schedule/$schdule_row->course_id/1/$schdule_row->id") ?>"><i class="ace-icon fa fa-trash-o bigger-180"></i></a>
                                                </td>
                                            </tr>
                               

                                    <?php endforeach ?>
                                <?php endif ?>                                    
                                
                                <?php $view_schedule_e = $get_view_schedule_e->num_rows() ?>
                                <?php if($view_schedule_e > 0): ?>
                                    <?php foreach($get_view_schedule_e->result() as $schdule_row):?>
                                        
                                            <tr>
                                                <td width=""><label><?php echo $schdule_row->time?></label></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_mon?><hr style="margin:0px"/>( <?php echo $schdule_row->e_mon?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_tue?><hr style="margin:0px"/>( <?php echo $schdule_row->e_tue?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_wed?><hr style="margin:0px"/>( <?php echo $schdule_row->e_wed?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_thu?><hr style="margin:0px"/>( <?php echo $schdule_row->e_thu?> )</div></td>
                                                <td width="180"><div class="align-center"><?php echo $schdule_row->s_fri?><hr style="margin:0px"/>( <?php echo $schdule_row->e_fri?> )</div></td>
                                                <td width="75">
                                                    <a href="<?php echo site_url("$controller_name/view_schedule/$schdule_row->course_id/$schdule_row->id") ?>"><i class="ace-icon fa fa-pencil bigger-180"></i></a>
                                                    <a  style="color:red" href="<?php echo site_url("$controller_name/delete_schedule/$schdule_row->course_id/1/$schdule_row->id") ?>"><i class="ace-icon fa fa-trash-o bigger-180"></i></a>
                                                </td>
                                            </tr>
                               

                                    <?php endforeach ?>
                                <?php endif ?>                                    
                        </table>
                        

</div>