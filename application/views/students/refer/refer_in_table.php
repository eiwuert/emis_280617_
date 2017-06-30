<table class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('students_refer_from'); ?></th>
			<th><?php echo lang('students_refer_date'); ?></th>
			<th><?php echo lang('students_university'); ?></th>
			<th><?php echo lang('common_major'); ?></th>
			<th><?php echo lang('common_degree'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($refer_in_students as $row) { ?>
			<tr>
				<td><?php echo $row->refer_from; ?></td>
				<td><?php echo date(get_date_format(), strtotime($row->refered_date)); ?></td>
				<td><?php echo $row->university_name; ?></td>
				<td><?php echo $row->skill_name; ?></td>
				<td><?php echo $row->level_name; ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>