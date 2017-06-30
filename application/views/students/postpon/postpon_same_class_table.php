<table class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('students_start_date'); ?></th>
			<th><?php echo lang('students_end_date'); ?></th>
			<th><?php echo lang('common_duration'); ?></th>
			<th><?php echo lang('students_reason'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($postpon_same_class as $row) { ?>
			<tr>
				<td><?php echo date(get_date_format(), strtotime($row->start_date)); ?></td>
				<td><?php echo date(get_date_format(), strtotime($row->end_date)); ?></td>
				<td><?php echo $row->duration; ?></td>
				<td><?php echo $row->reason_why; ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>