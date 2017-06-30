<?php
if ($export_excel == 1) {
    $rows = array();
    $row  = array();
    foreach ($headers as $header) {
        $row[] = strip_tags($header['data']);
    }

    $rows[] = $row;

    foreach ($data as $datarow) {
        $row = array();
        foreach ($datarow as $cell) {
            $row[] = str_replace('&#8209;', '-', strip_tags($cell['data']));
        }
        $rows[] = $row;
    }

    $content = array_to_csv($rows);

    force_download(strip_tags($title) . '.csv', $content);
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

<div class="col-md-offset-5">					
    <div>
        <?php foreach ($summary_data as $name => $value) {
            ?>
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
            <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                <thead>
                    <tr>
                        <?php foreach ($headers as $header) { ?>
                            <th align="<?php echo $header['align']; ?>"><?php echo $header['data']; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <!--table for summary_s-->
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <?php foreach ($row as $cell) { ?>
                                <td align="<?php echo $cell['align']; ?>"><?php echo $cell['data']; ?></td>
                            <?php } ?>
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
    <?php 
    if($this->uri->segment(2)=='summary_masters'){?>
       $('.sidebar-offcanvas').addClass('collapse-left');
       $('.right-side').addClass('strech');
    <?php }
    ?>
    function init_table_sorting()
    {
        //Only init if there is more than one row
        if ($('.tablesorter tbody tr').length > 1)
        {
            $("#sortable_table").tablesorter();
        }
    }
    $(document).ready(function()
    {
        init_table_sorting();
    });
    $('.innertable').show();
    $(".tablesorter span.expand").css('cursor', 'pointer');
    $(".tablesorter span.expand").click(function() {
        var id = $(this).attr("id");
        $('#table' + id).toggle();
        if ($(this).text() == '+') {
            $(this).text('-');
        } else {
            $(this).text('+');
        }
        return false;
    });
</script>