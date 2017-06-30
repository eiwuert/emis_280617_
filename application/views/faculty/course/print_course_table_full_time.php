
<div class="body_table">
    <table class="table_schedule" border="1" cellpadding="0" cellspacing="0" width="100%">
        <col width="10%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <col width="15%">
        <tr>
            <th>Time</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
        </tr>
        <?php if($get_view_schedule_m->num_rows() > 0):?>
            <?php foreach($get_view_schedule_m->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_mon?><br>( <?php echo $row->e_mon?> )</center></td>
                    <td><center><?php echo $row->s_tue?><br>( <?php echo $row->e_tue?> )</center></td>
                    <td><center><?php echo $row->s_wed?><br>( <?php echo $row->e_wed?> )</center></td>
                    <td><center><?php echo $row->s_thu?><br>( <?php echo $row->e_thu?> )</center></td>
                    <td><center><?php echo $row->s_fri?><br>( <?php echo $row->e_fri?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($get_view_schedule_a->num_rows() > 0):?>
            <?php foreach($get_view_schedule_a->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_mon?><br>( <?php echo $row->e_mon?> )</center></td>
                    <td><center><?php echo $row->s_tue?><br>( <?php echo $row->e_tue?> )</center></td>
                    <td><center><?php echo $row->s_wed?><br>( <?php echo $row->e_wed?> )</center></td>
                    <td><center><?php echo $row->s_thu?><br>( <?php echo $row->e_thu?> )</center></td>
                    <td><center><?php echo $row->s_fri?><br>( <?php echo $row->e_fri?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        <?php if($get_view_schedule_e->num_rows() > 0):?>
            <?php foreach($get_view_schedule_e->result() as $row): ?>
                <tr>
                    <td><center><?php echo $row->time   ?></center></td>
                    <td><center><?php echo $row->s_mon?><br>( <?php echo $row->e_mon?> )</center></td>
                    <td><center><?php echo $row->s_tue?><br>( <?php echo $row->e_tue?> )</center></td>
                    <td><center><?php echo $row->s_wed?><br>( <?php echo $row->e_wed?> )</center></td>
                    <td><center><?php echo $row->s_thu?><br>( <?php echo $row->e_thu?> )</center></td>
                    <td><center><?php echo $row->s_fri?><br>( <?php echo $row->e_fri?> )</center></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
</div>
                       