<table class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('students_start_date'); ?></th>
			<th><?php echo lang('students_end_date'); ?></th>
			<th><?php echo lang('students_reason'); ?></th>
			<th><?php echo lang('common_remark'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($postpon_students as $row) { ?>
			<tr>
				<td><?php echo date(get_date_format(), strtotime($row->start_date)); ?></td>
				<td><?php echo date(get_date_format(), strtotime($row->end_date)); ?></td>
				<td><?php echo $row->reason; ?></td>
				<td><?php echo $row->reason_why; ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>