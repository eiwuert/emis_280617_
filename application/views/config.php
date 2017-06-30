<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>                                      
</div>
<div class="page-header" id='page-header'>
    <ul class="list-inline pull-right">
		<li> <?php echo anchor('config/backup', lang('config_backup_database'), array('class' => 'btn btn-primary text-white pull-right dbBackup')); ?> </li>
		<li> <?php echo anchor('config/optimize',lang('config_optimize_database'), array('class' => 'btn btn-primary text-white pull-right dbOptimize')); ?> </li>
		<li><i id="spin" class="fa fa-spinner fa fa-spin fa fa-3x  hidden"></i> &nbsp;</li>
	</ul>
	<h1><i class="fa fa-cogs"></i> <?php echo lang('module_'.$controller_name); ?></h1>
</div>
<div class="col-xs-12">
	<?php echo form_open_multipart('config/save/',array('id'=>'config_form','class'=>'form-horizontal', 'autocomplete'=> 'off')); ?>
	<!-- Company Information -->
	<div class="widget-box"> 
		<div class="widget-title">
			<span class="icon col-xs-1">
				<i class="fa fa-align-justify"></i>
			</span>
			<span class="col-xs-11 "> <h5><?php echo lang("config_company_info"); ?></h5></span>
		</div>
		<div class="widget-content nopadding">
			<div class="form-group">
				<?php echo form_label(lang('config_school').':', 'company',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label required')); ?>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<?php echo form_input(array(
						'class'=>'form-control form-inps',
						'name'=>'company',
						'id'=>'company',
						'value'=>$this->config->item('company'))
					);
					?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('config_school_kh').':', 'company_kh',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label required')); ?>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<?php echo form_input(array(
						'class'=>'form-control form-inps',
						'name'=>'company_kh',
						'id'=>'company_kh',
						'value'=>$this->config->item('company_kh'))
					);
					?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('config_school_logo') . ':', 'company_logo', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<?php
					echo form_upload(
						array(
							'name' => 'company_logo',
							'id' => 'company_logo',
							'value' => $this->config->item('company_logo')
						)
					);
					?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('config_delete_logo') . ':', 'delete_logo', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				<div class="col-sm-9 col-md-9 col-lg-10">
					<?php echo form_checkbox('delete_logo', '1'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('config_school_address').':', 'company_address',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				<div class="col-sm-9 col-md-9 col-lg-9">
					<?php echo form_textarea(array(
						'class'=>'form-control form-inps',
						'name'=>'company_address',
						'id'=>'company_address',
						'rows'=>3,
						'value'=>$this->config->item('company_address'))
					);
					?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('common_manager_email').':', 'manager_email',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label ')); ?>
				<div class="col-sm-9 col-md-9 col-lg-9">
				<?php echo form_input(array(
					'class'=>'form-control form-inps',
					'name'=>'manager_email',
					'id'=>'manager_email',
					'value'=>$this->config->item('manager_email')));?>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label(lang('common_notification_email').':', 'notification_email',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label ')); ?>
				<div class="col-sm-9 col-md-9 col-lg-9">
				<?php echo form_input(array(
					'class'=>'form-control form-inps',
					'name'=>'notification_email',
					'id'=>'notification_email',
					'value'=>$this->config->item('notification_email')));?>
				</div>
			</div>
		</div>
	</div>
	<!-- Application Settings -->
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon col-xs-1">
					<i class="fa fa-align-justify"></i>
				</span>
				<span class="col-xs-11"><h5><?php echo lang("config_application_settings_info"); ?></h5> </span>

			</div>
			<div class="widget-content nopadding" >
				
				<div class="form-group">
				<?php echo form_label(lang('config_language').':', 'language',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label  required')); ?>
					<div class="col-sm-9 col-md-9 col-lg-10">
					<?php echo form_dropdown('language', array(
						'khmer'  => 'Khmer',
						'english'  => 'English',
						'indonesia'    => 'Indonesia',
						'spanish'   => 'Spanish', 
						'french'    => 'French',
						'italian'    => 'Italian',
						'dutch'    => 'Dutch',
						'portugues'    => 'Portugues',
						'arabic' => 'Arabic',
						),
						$this->Appconfig->get_raw_language_value());
						?>
					</div>
				</div>

				<div class="form-group">	
				    <?php echo form_label(lang('config_timezone') . ':', 'timezone', array('class' => 'col-sm-2 control-label required')); ?>
				    <div class='col-xs-9'>
				        <?php
				        echo form_dropdown('timezone', array(
				            'Pacific/Midway' => '(GMT-11:00) Midway Island, Samoa',
				            'America/Adak' => '(GMT-10:00) Hawaii-Aleutian',
				            'Etc/GMT+10' => '(GMT-10:00) Hawaii',
				            'Pacific/Marquesas' => '(GMT-09:30) Marquesas Islands',
				            'Pacific/Gambier' => '(GMT-09:00) Gambier Islands',
				            'America/Anchorage' => '(GMT-09:00) Alaska',
				            'America/Ensenada' => '(GMT-08:00) Tijuana, Baja California',
				            'Etc/GMT+8' => '(GMT-08:00) Pitcairn Islands',
				            'America/Los_Angeles' => '(GMT-08:00) Pacific Time (US & Canada)',
				            'America/Denver' => '(GMT-07:00) Mountain Time (US & Canada)',
				            'America/Chihuahua' => '(GMT-07:00) Chihuahua, La Paz, Mazatlan',
				            'America/Dawson_Creek' => '(GMT-07:00) Arizona',
				            'America/Belize' => '(GMT-06:00) Saskatchewan, Central America',
				            'America/Cancun' => '(GMT-06:00) Guadalajara, Mexico City, Monterrey',
				            'Chile/EasterIsland' => '(GMT-06:00) Easter Island',
				            'America/Chicago' => '(GMT-06:00) Central Time (US & Canada)',
				            'America/New_York' => '(GMT-05:00) Eastern Time (US & Canada)',
				            'America/Havana' => '(GMT-05:00) Cuba',
				            'America/Bogota' => '(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
				            'America/Caracas' => '(GMT-04:30) Caracas',
				            'America/Santiago' => '(GMT-04:00) Santiago',
				            'America/La_Paz' => '(GMT-04:00) La Paz',
				            'Atlantic/Stanley' => '(GMT-04:00) Faukland Islands',
				            'America/Campo_Grande' => '(GMT-04:00) Brazil',
				            'America/Goose_Bay' => '(GMT-04:00) Atlantic Time (Goose Bay)',
				            'America/Glace_Bay' => '(GMT-04:00) Atlantic Time (Canada)',
				            'America/St_Johns' => '(GMT-03:30) Newfoundland',
				            'America/Araguaina' => '(GMT-03:00) UTC-3',
				            'America/Montevideo' => '(GMT-03:00) Montevideo',
				            'America/Miquelon' => '(GMT-03:00) Miquelon, St. Pierre',
				            'America/Godthab' => '(GMT-03:00) Greenland',
				            'America/Argentina/Buenos_Aires' => '(GMT-03:00) Buenos Aires',
				            'America/Sao_Paulo' => '(GMT-03:00) Brasilia',
				            'America/Noronha' => '(GMT-02:00) Mid-Atlantic',
				            'Atlantic/Cape_Verde' => '(GMT-01:00) Cape Verde Is.',
				            'Atlantic/Azores' => '(GMT-01:00) Azores',
				            'Europe/Belfast' => '(GMT) Greenwich Mean Time : Belfast',
				            'Europe/Dublin' => '(GMT) Greenwich Mean Time : Dublin',
				            'Europe/Lisbon' => '(GMT) Greenwich Mean Time : Lisbon',
				            'Europe/London' => '(GMT) Greenwich Mean Time : London',
				            'Africa/Abidjan' => '(GMT) Monrovia, Reykjavik',
				            'Europe/Amsterdam' => '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
				            'Europe/Belgrade' => '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague',
				            'Europe/Brussels' => '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris',
				            'Africa/Algiers' => '(GMT+01:00) West Central Africa',
				            'Africa/Windhoek' => '(GMT+01:00) Windhoek',
				            'Asia/Beirut' => '(GMT+02:00) Beirut',
				            'Africa/Cairo' => '(GMT+02:00) Cairo',
				            'Asia/Gaza' => '(GMT+02:00) Gaza',
				            'Africa/Blantyre' => '(GMT+02:00) Harare, Pretoria',
				            'Asia/Jerusalem' => '(GMT+02:00) Jerusalem',
				            'Europe/Minsk' => '(GMT+02:00) Minsk',
				            'Asia/Damascus' => '(GMT+02:00) Syria',
				            'Europe/Moscow' => '(GMT+03:00) Moscow, St. Petersburg, Volgograd',
				            'Africa/Addis_Ababa' => '(GMT+03:00) Nairobi',
				            'Asia/Tehran' => '(GMT+03:30) Tehran',
				            'Asia/Dubai' => '(GMT+04:00) Abu Dhabi, Muscat',
				            'Asia/Yerevan' => '(GMT+04:00) Yerevan',
				            'Asia/Kabul' => '(GMT+04:30) Kabul',
				            'Asia/Yekaterinburg' => '(GMT+05:00) Ekaterinburg',
				            'Asia/Tashkent' => '(GMT+05:00) Tashkent',
				            'Asia/Calcutta' => '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi',
				            'Asia/Katmandu' => '(GMT+05:45) Kathmandu',
				            'Asia/Dhaka' => '(GMT+06:00) Astana, Dhaka',
				            'Asia/Novosibirsk' => '(GMT+06:00) Novosibirsk',
				            'Asia/Rangoon' => '(GMT+06:30) Yangon (Rangoon)',
				            'Asia/Bangkok' => '(GMT+07:00) Bangkok, Hanoi, Jakarta',
				            'Asia/Krasnoyarsk' => '(GMT+07:00) Krasnoyarsk',
				            'Asia/Hong_Kong' => '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi',
				            'Asia/Irkutsk' => '(GMT+08:00) Irkutsk, Ulaan Bataar',
				            'Australia/Perth' => '(GMT+08:00) Perth',
				            'Australia/Eucla' => '(GMT+08:45) Eucla',
				            'Asia/Tokyo' => '(GMT+09:00) Osaka, Sapporo, Tokyo',
				            'Asia/Seoul' => '(GMT+09:00) Seoul',
				            'Asia/Yakutsk' => '(GMT+09:00) Yakutsk',
				            'Australia/Adelaide' => '(GMT+09:30) Adelaide',
				            'Australia/Darwin' => '(GMT+09:30) Darwin',
				            'Australia/Brisbane' => '(GMT+10:00) Brisbane',
				            'Australia/Hobart' => '(GMT+10:00) Hobart',
				            'Asia/Vladivostok' => '(GMT+10:00) Vladivostok',
				            'Australia/Lord_Howe' => '(GMT+10:30) Lord Howe Island',
				            'Etc/GMT-11' => '(GMT+11:00) Solomon Is., New Caledonia',
				            'Asia/Magadan' => '(GMT+11:00) Magadan',
				            'Pacific/Norfolk' => '(GMT+11:30) Norfolk Island',
				            'Asia/Anadyr' => '(GMT+12:00) Anadyr, Kamchatka',
				            'Pacific/Auckland' => '(GMT+12:00) Auckland, Wellington',
				            'Etc/GMT-12' => '(GMT+12:00) Fiji, Kamchatka, Marshall Is.',
				            'Pacific/Chatham' => '(GMT+12:45) Chatham Islands',
				            'Pacific/Tongatapu' => '(GMT+13:00) Nuku\'alofa',
				            'Pacific/Kiritimati' => '(GMT+14:00) Kiritimati'
				                ), $this->config->item('timezone') ? $this->config->item('timezone') : date_default_timezone_get(), 'class="form-control"');
				        ?>
				    </div>
				</div>

				<div class="form-group">	
				<?php echo form_label(lang('config_date_format').':', 'date_format',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label  required')); ?>
					<div class="col-sm-9 col-md-9 col-lg-10">
					<?php echo form_dropdown('date_format', array(
						'middle_endian'    => '12/30/2000',
						'little_endian'  => '30-12-2000',
						'big_endian'   => '2000-12-30'), $this->config->item('date_format'));
						?>
					</div>
				</div>

				<div class="form-group">	
				<?php echo form_label(lang('config_time_format').':', 'time_format',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label  required')); ?>
					<div class="col-sm-9 col-md-9 col-lg-10">
					<?php echo form_dropdown('time_format', array(
						'12_hour'    => '1:00 PM',
						'24_hour'  => '13:00'
						), $this->config->item('time_format'));
						?>
					</div>
				</div>
		
				<div class="form-group">	
					<?php echo form_label(lang('config_number_of_items_per_page').':', 'number_of_items_per_page',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label  required')); ?>
					<div class="col-sm-9 col-md-9 col-lg-10">
					<?php echo form_dropdown('number_of_items_per_page', 
					 array(
						'20'=>'20',
						'50'=>'50',
						'100'=>'100',
						'200'=>'200',
						'500'=>'500'
						), $this->config->item('number_of_items_per_page') ? $this->config->item('number_of_items_per_page') : '20');
						?>
					</div>
				</div>

				<div class="form-group">	
					<?php echo form_label(lang('school_number').':', 'school_number',array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label  required')); ?>
					<div class='col-xs-9'>
						<?php echo form_input(array(
							'class'=>'form-control form-inps',
							'name'=>'school_number',
							'id'=>'school_number',
							'maxlength'=>'2',
							'value'=>$this->config->item('school_number')));?>
					</div>
				</div>	

			</div>

			<div class="form-group"> 
				<div class="form-actions pull-right"> 
				<?php echo form_submit(array(
							'name'=>'submitf',
							'id'=>'submitf',
							'value'=>lang('common_submit'),
							'class'=>'submit_button btn btn-primary float_right')); ?>	
				</div>
			</div>
		</div>

	<?php echo form_close();?>
</div>
<script type='text/javascript'>
//validation and submit handling
$(document).ready(function()
{	
	$(".delete_tier").click(function()
	{
		$("#config_form").append('<input type="hidden" name="tiers_to_delete[]" value="'+$(this).data('tier-id')+'" />');
		$(this).parent().parent().remove();
	});
	
	$("#add_tier").click(function()
	{
		$("#price_tiers tbody").append('<tr><td><input type="text" class="tiers_to_add" name="tiers_to_add[]" value="" /></td><td>&nbsp;</td></tr>');
	});
	
	$(".dbOptimize").click(function(event)
	{
		event.preventDefault();
		$('#spin').removeClass('hidden');
		
		$.getJSON($(this).attr('href'), function(response) 
		{
			$('#spin').addClass('hidden');
			alert(response.message);
		});
		
	});
	var submitting = false;
	$('#config_form').validate({
		submitHandler:function(form)
		{
			if (submitting) return;
			submitting = true;
			$(form).ajaxSubmit({
			success:function(response)
			{
				//Don't let the tiers be double submitted, so we change the name
				$(".tiers_to_add").attr('name', 'tiers_added[]');
				if(response.success)
				{
					$.notify('Successfully Saved ', 'success')
				}
				else
				{
					gritter(<?php echo json_encode(lang('common_error')); ?>,response.message,'gritter-item-error',false,false);
				}
				submitting = false;
			},
			dataType:'json'
		});

		},
		errorClass: "text-danger",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-success').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-error').addClass('has-success');
		},
		rules: 
		{
    		company: "required",
    		sale_prefix: "required",
			return_policy:
			{
				required: true
			}
   	},
		messages: 
		{
     		company: <?php echo json_encode(lang('config_company_required')); ?>,
     		sale_prefix: <?php echo json_encode(lang('config_sale_prefix_required')); ?>,
			return_policy:
			{
				required:<?php echo json_encode(lang('config_return_policy_required')); ?>
			},
	
		}
	});
	
});

$("#calculate_average_cost_price_from_receivings").change(check_calculate_average_cost_price_from_receivings).ready(check_calculate_average_cost_price_from_receivings);

function check_calculate_average_cost_price_from_receivings()
{
	if($("#calculate_average_cost_price_from_receivings").prop('checked'))
	{
		$("#average_cost_price_from_receivings_methods").show();
	}
	else
	{
		$("#average_cost_price_from_receivings_methods").hide();
	}
}

</script>
<?php $this->load->view("partial/footer"); ?>


