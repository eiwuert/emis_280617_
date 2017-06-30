
<?php $this->load->view("partial/header"); ?>
<div id="breadcrumbs" class=" col-md-12 breadcrumbs">
	<?php echo create_breadcrumb(); ?>
</div>
<div class="col-md-offset-2">					
    <div>
        <?php 
		$color = array('#0091EA', '#CB2326', '#F57F17', '#24CBE5', '#64E572', '#FF9655', '#CB2326');
		$i=0;
		foreach ($overall_summary_data as $name => $value) { ?>
                <!-- small box -->
				
                <div style="background-color:<?php echo $color[$i];?>" class="infobox-dark col-md-2 text-center">
                    <div class="inner">
                        <h5><?php echo lang('reports_' . $name); ?></h5>
                        <h3>
                            <strong><?php echo to_currency($value); ?></strong>
                        </h3>
                    </div>
                </div>     
        <?php $i++; } ?>
    </div>
</div>	

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table style='display:none;' id="datatable">
	<thead>
		<tr>
			<th></th>
			<th><?php echo lang('reports_inv_amount');?></th>
			<th><?php echo lang('reports_claim_amount');?></th>
			<th><?php echo lang('reports_expense_amount');?></th>
			<th><?php echo lang('reports_profit');?></th>
			
		</tr>
	</thead>
	<tbody>
		<?php foreach ($summary_data as $key=>$row) { ?>
				<tr>
					
					<?php foreach ($row as $cell) { ?>
					<td align="<?php echo $cell['align']; ?>"><?php echo $cell['data']; ?></td>
					<?php } ?>
				</tr>
		<?php } ?>
	</tbody>
</table>
<script src="<?php echo base_url()?>js/chart/highcharts.js"></script>
<script src="<?php echo base_url()?>js/chart/data.js"></script>
<script src="<?php echo base_url()?>js/chart/exporting.js"></script>
<script>
$(function () {
	$('[text-anchor="end"]').html('codingate');
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
		colors: ['#0091EA', '#CB2326', '#F57F17', '#24CBE5', '#64E572', '#FF9655', '#CB2326',      '#6AF9C4'],
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Amount (SDG)'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.point.name+ '</b><br/>' +
                    this.series.name+': <b>'+parseFloat(this.point.y).toFixed(2) +' SGD</b>';
            }
        }
    });;
});
</script>
<?php $this->load->view("partial/footer"); ?>