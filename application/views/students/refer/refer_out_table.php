<table class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo lang('students_refer_out_to'); ?></th>
			<th><?php echo lang('students_refer_date'); ?></th>
			<th><?php echo lang('common_remark'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($refer_out_students as $row) { ?>
			<tr>
				<td><?php echo $row->refer_to; ?></td>
				<td><?php echo date(get_date_format(), strtotime($row->refered_date)); ?></td>
				<td><?php echo $row->remark; ?></td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>