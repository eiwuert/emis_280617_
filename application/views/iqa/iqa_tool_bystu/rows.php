<?php
$i = 0;
foreach ($iqa_titles as $key => $title) {
    $i++;
?>
    <tr>
        <td><center><?php echo $i; ?></center></td>
        <td><div style='padding: 8px 5px 0px 5px;'>
            <?php echo form_hidden('ids[]', $title->id); ?>
            <input style='width:100%; text-align:left' type='text' name='evaluation_title[]' value='<?php echo $title->title_eng; ?>' /></div>
            <?php echo form_hidden('evaluation_title_kh[]', $title->title_kh); ?>
        </td>
        <td>
            <div style='width:100%; padding: 8px 5px 0px 5px;'>
                <select name="scores[]" style="width:100%;" class="col-sm-6 col-xs-12">
                    <option value="1" <?php echo (($title->evaluate_score == 1)? 'selected' : '' )?>>1</option>
                    <option value="2" <?php echo (($title->evaluate_score == 2)? 'selected' : '' )?>>2</option>
                    <option value="3" <?php echo (($title->evaluate_score == 3)? 'selected' : '' )?>>3</option>
                    <option value="4" <?php echo (($title->evaluate_score == 4)? 'selected' : '' )?>>4</option>
                    <option value="5" <?php echo (($title->evaluate_score == 5)? 'selected' : '' )?>>5</option>
                </select>
            </div>
        </td>
    </tr>
<?php } ?>