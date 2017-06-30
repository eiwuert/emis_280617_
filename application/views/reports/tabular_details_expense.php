<?php
if($export_excel == 1)
{
	if (!$this->config->item('legacy_detailed_report_export'))
	{
		$rows = array();
	
		$row = array();
		foreach ($headers['details'] as $header) 
		{
			$row[] = strip_tags($header['data']);
		}

		foreach ($headers['summary'] as $header) 
		{
			$row[] = strip_tags($header['data']);
		}
		$rows[] = $row;
	
		foreach ($summary_data as $key=>$datarow) 
		{		
			foreach($details_data[$key] as $datarow2)
			{
				$row = array();
				foreach($datarow2 as $cell)
				{
					$row[] = str_replace('&#8209;', '-', strip_tags($cell['data']));				
				}
			
				foreach($datarow as $cell)
				{
					$row[] = str_replace('&#8209;', '-', strip_tags($cell['data']));
				}
				$rows[] = $row;
			}
		
		}
	}
	else
	{
		$rows = array();
		$row = array();
		foreach ($headers['summary'] as $header) 
		{
			$row[] = strip_tags($header['data']);
		}
		$rows[] = $row;
	
		foreach ($summary_data as $key=>$datarow) 
		{
			$row = array();
			foreach($datarow as $cell)
			{
				$row[] = str_replace('&#8209;', '-', strip_tags($cell['data']));
			
			}
		
			$rows[] = $row;

			$row = array();
			foreach ($headers['details'] as $header) 
			{
				$row[] = strip_tags($header['data']);
			}
		
			$rows[] = $row;
		
			foreach($details_data[$key] as $datarow2)
			{
				$row = array();
				foreach($datarow2 as $cell)
				{
					$row[] = str_replace('&#8209;', '-', strip_tags($cell['data']));				
				}
				$rows[] = $row;
			}
		}
	}
	$content = array_to_spreadsheet($rows);
	force_download(strip_tags($title) . '.'.($this->config->item('spreadsheet_format') == 'XLSX' ? 'xlsx' : 'csv'), $content);
	exit;
}
?>
<?php $this->load->view("partial/header"); ?>
<div id="breadcrumbs" class=" col-md-12 breadcrumbs">
	<?php echo create_breadcrumb(); ?>
</div>

<?php if (isset($pagination) && $pagination) { ?>
    <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_top" >
        <?php echo $pagination; ?>
    </div>
<?php } ?>

<div class="col-md-offset-4">					
    <div>
        <?php foreach ($overall_summary_data as $name => $value) { ?>
                <!-- small box -->
                <div class="infobox-blue infobox-dark col-md-3 text-center">
                    <div class="inner">
                        <h5><?php echo lang('reports_' . $name); ?></h5>
                        <h3>
                            <strong><?php echo $value; ?></strong>
                        </h3>
                    </div>
                </div>     
        <?php } ?>
    </div>
</div>	

<div class="col-md-12">
    <div class="dd-handle">
        <b><?php echo $subtitle ?></b>
    </div>
    <div class="widget-content nopadding">
		<div class="table-responsive">
		<table class="table table-bordered table-striped  table-condensed detailed-reports  tablesorter" id="sortable_table">
			<thead>
				<tr align="center" style="font-weight:bold">
					<td class="hidden-print"><a href="#" class="expand_all" >+</a></td>
					<?php foreach ($headers['summary'] as $header) { ?>
					<td align="<?php echo $header['align']; ?>"><?php echo $header['data']; ?></td>
					<?php } ?>
				
				</tr>
			</thead>
			<tbody>
				<?php foreach ($summary_data as $key=>$row) { ?>
				<tr>
					<td class="hidden-print"><a href="#" class="expand" style="font-weight: bold;">+</a></td>
					<?php foreach ($row as $cell) { ?>
					<td align="<?php echo $cell['align']; ?>"><?php echo $cell['data']; ?></td>
					<?php } ?>
				</tr>
				<tr>
					<td colspan="<?php echo count($headers['summary']) + 1; ?>" class="innertable">
						<table class="table ">
							<thead>
								<tr>
									<?php foreach ($headers['details'] as $header) { ?>
									<th align="<?php echo $header['align']; ?>"><?php echo $header['data']; ?></th>
									<?php } ?>
								</tr>
							</thead>

							<tbody>
								<?php foreach ($details_data[$key] as $row2) { ?>

									<tr>
										<?php foreach ($row2 as $cell) { ?>
										<td align="<?php echo $cell['align']; ?>"><?php echo $cell['data']; ?></td>
										<?php } ?>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>

    </div>
</div>
<?php if (isset($pagination) && $pagination) { ?>
    <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_top" >
        <?php echo $pagination; ?>
    </div>
<?php } ?>


<?php $this->load->view("partial/footer"); ?>
<script type="text/javascript" language="javascript">

	$('.innertable').hide();
	$(".tablesorter a.expand").click(function(event)
	{
		$(event.target).parent().parent().next().find('td.innertable').toggle();
		
		if ($(event.target).text() == '+')
		{
			$(event.target).text('-');
		}
		else
		{
			$(event.target).text('+');
		}
		return false;
	});
	
	$(".tablesorter a.expand_all").click(function(event)
	{
		$('td.innertable').toggle();
		
		if ($(event.target).text() == '+')
		{
			$(event.target).text('-');
			$(".tablesorter a.expand").text('-');
		}
		else
		{
			$(event.target).text('+');
			$(".tablesorter a.expand").text('+');
		}
		return false;
	});

</script>