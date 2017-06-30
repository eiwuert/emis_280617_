
<div class="body_table">
    <table class="table_schedule" border="1" cellpadding="0" cellspacing="0" width="100%">
        <col width="10%">
        <col width="15%">
        <col width="15%">
        <tr>
            <th>Time</th>
            
            <th>Saturday</th>
            <th>Sunday</th>
        </tr>
        <?php if($get_view_schedule_m->num_rows() > 0):?>
            <?php foreach($get_view_schedule_m->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_sat?><br>( <?php echo $row->e_sat?> )</center></td>
                    <td><center><?php echo $row->s_sun?><br>( <?php echo $row->e_sun?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($get_view_schedule_a->num_rows() > 0):?>
            <?php foreach($get_view_schedule_a->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_sat?><br>( <?php echo $row->e_sat?> )</center></td>
                    <td><center><?php echo $row->s_sun?><br>( <?php echo $row->e_sun?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($get_view_schedule_e->num_rows() > 0):?>
            <?php foreach($get_view_schedule_e->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_sat?><br>( <?php echo $row->e_sat?> )</center></td>
                    <td><center><?php echo $row->s_sun?><br>( <?php echo $row->e_sun?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
</div>
                       