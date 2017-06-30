<?php $this->load->view("partial/header"); ?>

<div id="breadcrumbs" class=" col-md-12 breadcrumbs">
	<?php echo create_breadcrumb(); ?>
</div>
<div class="clear"></div>

<div class="report-listing">
	<div class="col-md-5 ">

	<style type="text/css">
	.panel-green {
		border-color: #5cb85c;
	}
	.panel-green .panel-heading {
	    border-color: #5cb85c;
	    color: #fff;
	    background-color: #5cb85c;
	}
	.panel-red {
	    border-color: #d9534f;
	}
	.panel-red .panel-heading {
	    border-color: #d9534f;
	    color: #fff;
	    background-color: #d9534f;
	}
	.panel-purple {
	    background-color: #9C27B0;
	    color: white;
	}
	.panel-purple {
	    background-color: #9C27B0;
	    color: white;
	}
	.panel-primary {
	    border-color: #337ab7;
	}
	.panel-primary>.panel-heading {
	    color: #fff;
	    background-color: #337ab7;
	    border-color: #337ab7;
	}
		.panel-yellow {
	    border-color: #f0ad4e;
	}
	.panel-yellow .panel-heading {
	    border-color: #f0ad4e;
	    color: #fff;
	    background-color: #f0ad4e;
	}

	.current-div {
		background-color: #256F6C;
		color: white;
	}
	</style>

		<div class="panel">
		<div class="panel-body">
			<?php
			if ($this->Employee->has_module_action_permission('reports', 'view_profit_and_loss', $this->Employee->get_logged_in_employee_info()->person_id))
			{
			?>
			<div class="panel panel-green parents-list">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-th-list fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div><h4><?php echo lang('reports_profit_and_loss'); ?></h4></div>
	                    </div>
	                </div>
	            </div>
	            <a href="#" id="profit-and-loss">
	                <div class="panel-footer">
	                    <span class="pull-left"><b><i class="menu-icon fa fa-table"></i>	<?php echo lang('reports_profit_and_loss'); ?></b></span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	        <?php } ?>
	        <?php
			if ($this->Employee->has_module_action_permission('reports', 'view_proposal', $this->Employee->get_logged_in_employee_info()->person_id))
			{
			?>
			<div class="panel panel-red">
		        <div class="panel-heading">
		            <div class="row">
		                <div class="col-xs-3">
		                    <i class="fa fa-table fa-5x"></i>
		                </div>
		                <div class="col-xs-9 text-right">
		                    <div><h4><?php echo lang('reports_proposal'); ?></h4></div>
		                </div>
		            </div>
		        </div>
		        <a href="<?php echo site_url('reports/summary_proposal'); ?>" id="proposal">
		            <div class="panel-footer">
		                <span class="pull-left"><b><i class="menu-icon fa fa-table"></i>	<?php echo lang('reports_proposal'); ?></b></span>
		                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                <div class="clearfix"></div>
		            </div>
		        </a>
		    </div>
		    <?php } ?>
		    <?php
			if ($this->Employee->has_module_action_permission('reports', 'view_expense', $this->Employee->get_logged_in_employee_info()->person_id))
			{
			?>
		    <div class="panel panel-yellow">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-tasks fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div><h4><?php echo lang('reports_expense'); ?></h4></div>
	                    </div>
	                </div>
	            </div>
	            <a href="<?php echo site_url('reports/summary_expense');?>" id="expanse">
	                <div class="panel-footer">
	                    <span class="pull-left"><b><i class="menu-icon fa fa-table"></i>	<?php echo lang('reports_expense'); ?></b></span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	        <?php } ?>
	        <?php
			if ($this->Employee->has_module_action_permission('reports', 'view_claim', $this->Employee->get_logged_in_employee_info()->person_id))
			{
			?>
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <i class="fa fa-book fa-5x"></i>
	                    </div>
	                    <div class="col-xs-9 text-right">
	                        <div><h4><?php echo lang('reports_claim'); ?></h4></div>
	                    </div>
	                </div>
	            </div>
	            <a href="<?php echo site_url('reports/summary_claim');?>" id="claim">
	                <div class="panel-footer">
	                    <span class="pull-left"><b><i class="menu-icon fa fa-table"></i>	<?php echo lang('reports_claim'); ?></b></span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	        <?php } ?>
        </div>
        </div>
	</div>
	 <div class="col-md-6" id="report_selection">
		<div class="panel">
			<div class="panel-body child-list">
			<h3 class="page-header text-info">&laquo; <?php echo lang('reports_make_a_selection')?></h3>
				<div class="list-group profit-and-loss hidden">
					<a class="list-group-item" href="<?php echo site_url('reports/detailed_profit_and_loss');?>" ><i class="fa fa-building-o"></i> <?php echo lang('reports_detailed_reports'); ?></a>
					<a class="list-group-item" href="<?php echo site_url('reports/graphic_profit_and_loss');?>" ><i class="fa fa-calendar"></i> <?php echo lang('reports_graphical_reports'); ?></a>
				</div>
				<div class="list-group proposal hidden">
					<a class="list-group-item" href="<?php echo site_url('reports/summary_proposal');?>" ><i class="fa fa-building-o"></i> <?php echo lang('reports_summary_reports'); ?></a>
				</div>
				<div class="list-group expanse hidden">
					<a class="list-group-item" href="<?php echo site_url('reports/summary_expense');?>" ><i class="fa fa-building-o"></i> <?php echo lang('reports_summary_reports'); ?></a>
				</div>
				<div class="list-group claim hidden">
					<a class="list-group-item" href="<?php echo site_url('reports/summary_claim');?>" ><i class="fa fa-building-o"></i> <?php echo lang('reports_summary_reports'); ?></a>
				</div>
			</div>
		</div> <!-- /panel -->
	</div> 
</div>
</div>
<script type="text/javascript">
  $('.parents-list a').click(function(e){
 	e.preventDefault();
 	$('.parents-list a').children().removeClass('current-div');
 	$(this).children().first().addClass('current-div');
 	var currentClass='.child-list .'+ $(this).attr("id");
 	$('.child-list .page-header').html($(this).html());
 	$('.child-list .list-group').addClass('hidden');
 	$(currentClass).removeClass('hidden');
	
	$('html, body').animate({
	    scrollTop: $("#report_selection").offset().top
	 }, 500);
 });
 </script>


<?php $this->load->view("partial/footer"); ?>