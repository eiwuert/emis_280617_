<table class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('students_university'); ?></th>
			<th><?php echo lang('students_university').lang('common_kh'); ?></th>
			<th><?php echo lang('students_changed_date'); ?></th>
			<th><?php echo lang('common_remark'); ?></th>
			<th><?php echo lang('common_edit'); ?></th>
		</tr>
	</thead>
	<tbody class="open">
		<?php
		foreach ($transfer_faculties as $row) { ?>
			<tr>
				<td><?php echo H($row->university_name); ?></td>
				<td><?php echo H($row->university_name_kh); ?></td>
				<td><?php echo date(get_date_format(), strtotime($row->changed_date)); ?></td>
				<td><?php echo $row->remark; ?></td>
				<td>
					<?php 
						$stu_info_id = $person_info->stu_info_id;
						$stu_transfer_id = $row->stu_transfer_id;
					?>
					<a  data-transfer-id="<?php echo $row->stu_transfer_id?>" 
						data-transfer-type="<?php echo $row->transfer_type?>" 
						data-transfer-university-id="<?php echo $row->university_id?>"  
						data-transfer-major-id="<?php echo $row->skill_id?>" 
						data-transfer-date="<?php echo $row->changed_date?>" 
						data-transfer-remark="<?php echo $row->remark?>" 												
						data-toggle="modal" data-target="#transferStudent"
						class="btn-sm btn btn-primary text-warning update_row_transfer" 
						href="#" data-href="<?php echo site_url("$controller_name/transfer/$stu_info_id/$stu_transfer_id")?>"><i class="fa fa-pencil-square-o"></i><?php echo lang('common_edit')?></a>
					<a class='btn btn-danger btn-sm del-transfer' href='javascript:void(0)' data-confirm='<?php echo lang("students_confirm_delete_transfer")?>' data-method='post' data-item='<?php echo $row->stu_transfer_id?>'><i class='fa fa-trash-o'></i> <?php echo lang('common_delete')?></a>
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>