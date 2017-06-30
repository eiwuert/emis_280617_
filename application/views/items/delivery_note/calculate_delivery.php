<script type="text/javascript">
    $(function(){
        $('#receiver_type').on('change', function(){
            var receiverType = $(this).val();
            var getUrl = "<?php echo site_url('product_delivery_note/suggest_employee_info')?>";
            if(receiverType == 'student'){
                $('#receiver').val('');
                $('#receiver_div').hide();
            }else{
                $('#receiver_div').show();
            }
        });
    });
    $(document).ready(function(){
        $('.add_pro').click(function(){
            $('input[name="discount"]').val(0);
            $("#ch_total").prop( "checked", false );
            var tr = '<tr class="parent_td">'+ 
                        '<td>'+
                            '<select name="item_name[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">'+
                                '<option value="">-- Select Items --</option>'+
                            '<?php foreach($items as $key=>$row): ?>'+
                                '<option value="<?php echo $row->item_id ?>"><?php echo $row->item_name ?></option>'+
                            '<?php endforeach ?>'+
                            '</select>'+
                        '</td>'+
                        '<td><?php echo form_input(array("name" => "item_unique_id[]","id" => "item_unique_id","class" => "form-control form-inps item_unique_id","placeholder" => "Product Code","value" => ""));?></td>'+
                        '<td>'+
                            '<select name="item_unit[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">'+
                                    '<option value="">-- Select Unit --</option>'+
                                '<?php foreach($unit_items as $key=>$row): ?>'+
                                    '<option value="<?php echo $row->unit_id ?>"><?php echo $row->unit_name ?></option>'+
                                '<?php endforeach ?>'+
                            '</select>'+
                            '<input type="text" name="storage_unit_price[]" value="" class="storage_unit_price" id="storage_unit_price" readonly="" />'+
                            '<input type="hidden" name="storage_unit_discount[]" value="" class="storage_unit_discount" id="storage_unit_discount" readonly="" />'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array("name" => "quantity[]", "type"=>"number", "id" => "quantity", "class" => "form-control form-inps quantity", 'style'=>'font-weight:bold', "placeholder" => "QTY","value" => ""));?>'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array('name' => 'all_qty[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => '', 'readonly' => 'true'));?>'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array("name" => "total_dollar[]", "type"=>"number", "id" => "total_dollar", "class" => "form-control form-inps total_dollar","placeholder" => "Total Dollar","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array("name" => "total_riel[]", "type"=>"number", "id" => "total_riel","class" => "form-control form-inps total_riel","placeholder" => "Total Riel","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array("name" => "total_baht[]", "type"=>"number", "id" => "total_baht","class" => "form-control form-inps total_baht","placeholder" => "Total Baht","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" =>"true"));?>'+
                        '</td>'+
                        '<td>'+
                            '<?php echo form_input(array("name" => "d_each_discount[]", "type"=>"number", "id" => "d_each_discount","class" => "form-control form-inps d_each_discount","placeholder" => "Discount","value" => 0, 'style'=>'font-weight:bold; color:#00bede !important'));?>'+
                        '</td>'+
                        '<td><a class="btn btn-sm btn-danger remove_emp" href="javascript:void(0);">Add More</a></td>'+
                   '</tr>';
            // maxAppend++;
            $('.sortable_table').append(tr);
        });
        $('.sortable_table').on('click', '.remove', function() {
            if ($('.remove').length == 1) {
                $(this).parent().parent().removeClass();
            }else{
                $(this).parent().parent().find('input[name="deleted[]"]').val(1);
                $(this).parent().parent().removeClass();
                $(this).parent().parent().hide();
                $("#ch_total").prop( "checked", false );
            }            
        });

        $('.add_tr').on('click', '.remove_emp', function() {  
                $(this).parent().parent().remove();            
        });

        $('.sortable_table').on('change', '.item_name',function(){
            var id = $(this).parent().parent().find('.item_name').val();
            $this = $(this);
            $.post("<?php echo site_url('product_delivery_note/suggest_items')?>",{ id: id }, function(result, data) {
                if(data == 'success'){
                    $this.parent().parent().find('.item_unique_id').val(result.code); 
                }   
            },"json");

            $.post("<?php echo site_url('product_delivery_note/suggest_unit')?>",{ id: id }, function(result, data) {
                if(data == 'success')
                {   
                    $this.parent().parent().find('#item_unit').html(result.res);
                }
            },"json");
            $(this).parent().parent().find('.d_price').val('');
            $(this).parent().parent().find('.quantity').val('');
            $(this).parent().parent().find('.all_qty').val('');
            $(this).parent().parent().find('.total_dollar').val('');
            $(this).parent().parent().find('.total_riel').val('');
            $(this).parent().parent().find('.total_baht').val('');
            $(this).parent().parent().find('.d_each_discount').val(0);
        });
        $('.sortable_table').delegate('.quantity','keyup change',function(){
            $("#ch_total").prop( "checked", false );
            var get_d_each_discount = $(this).parent().parent().find('.d_each_discount').val();           
            var get_quantity = $(this).val();
            var get_unit_type = $(this).parent().parent().find('.item_unit :selected').data('qty');
            var get_unit_pri = $(this).parent().parent().find('.item_unit :selected').data('pri');
            var get_unit_discount = $(this).parent().parent().find('.item_unit :selected').data('discount');
            var total_all_qty = parseFloat(get_quantity * get_unit_type);

            $(this).parent().parent().find('.storage_unit_price').val(get_unit_pri);
            $(this).parent().parent().find('.storage_unit_discount').val(get_unit_discount);
            $(this).parent().parent().find('.all_qty').val(total_all_qty);
            var get_exchange_r = $('input[name="exchange_riel"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();

            if(get_unit_discount > 0){
                resPriUint = ((get_unit_pri * get_unit_discount) / 100);
            }else{                
                resPriUint = get_unit_pri;
            }

            dollar = (resPriUint * get_quantity);
            riel = (resPriUint * get_quantity) * get_exchange_r;
            baht = (resPriUint * get_quantity) * get_exchange_b;
            $(this).parent().parent().find('.total_dollar').val(parseFloat(dollar).toFixed(2));
            $(this).parent().parent().find('.total_riel').val(parseFloat(riel).toFixed(2));           
            $(this).parent().parent().find('.total_baht').val(parseFloat(baht).toFixed(2));
        });

        $('.sortable_table').delegate(('.item_unit'),'change keyup',function(){
            $("#ch_total").prop( "checked", false );
            var get_d_each_discount = $(this).parent().parent().find('.d_each_discount').val();
            var get_unit_type = $(this).parent().parent().find('.item_unit :selected').data('qty');
            var get_unit_pri = $(this).parent().parent().find('.item_unit :selected').data('pri');
            var get_unit_discount = $(this).parent().parent().find('.item_unit :selected').data('discount');
            var get_quantity = $(this).parent().parent().find('.quantity').val();
            var total_all_qty = parseFloat(get_quantity * get_unit_type);        

            $(this).parent().parent().find('.storage_unit_price').val(get_unit_pri);
            $(this).parent().parent().find('.storage_unit_discount').val(get_unit_discount);
            $(this).parent().parent().find('.all_qty').val(total_all_qty);
            var get_d_price = $(this).parent().parent().find('.d_price').val();
            var get_r_price = $(this).parent().parent().find('.r_price').val();
            var get_b_price = $(this).parent().parent().find('.b_price').val();

            var get_exchange_r = $('input[name="exchange_riel"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();
            if(get_unit_discount > 0){
                resPriUint = ((get_unit_pri * get_unit_discount) / 100);
            }else{                
                resPriUint = get_unit_pri;
            }

            dollar = (resPriUint * get_quantity);
            riel = (resPriUint * get_quantity) * get_exchange_r;
            baht = (resPriUint * get_quantity) * get_exchange_b;

            $(this).parent().parent().find('.total_dollar').val(parseFloat(dollar).toFixed(2));
            $(this).parent().parent().find('.total_riel').val(parseFloat(riel).toFixed(2));           
            $(this).parent().parent().find('.total_baht').val(parseFloat(baht).toFixed(2));

        });

        $('.sortable_table').delegate(('.d_each_discount'),'keyup change',function(){
            $("#ch_total").prop( "checked", false );
            $('input[name="discount"]').val(0);
        });  

        $('input[name="exchange_riel"], input[name="exchange_baht"]').on('keyup change',function(){
            $("#ch_total").prop( "checked", false );
            $('.parent_td').each(function(){
                var get_exchange_r = $('input[name="exchange_riel"]').val();
                var get_exchange_b = $('input[name="exchange_baht"]').val();
                var get_d_each_discount = $(this).find('.d_each_discount').val();                
                var get_unit_type = $(this).find('.item_unit :selected').data('qty');
                var get_unit_pri = $(this).find('.item_unit :selected').data('pri');
                var get_unit_discount = $(this).find('.item_unit :selected').data('discount');    
                var get_quantity = $(this).find('.quantity').val();
                var total_all_qty = parseFloat(get_quantity * get_unit_type);
                $(this).find('.all_qty').val(total_all_qty);
                var get_d_price = $(this).find('.d_price').val();
                var get_r_price = $(this).find('.r_price').val();
                var get_b_price = $(this).find('.b_price').val();

                if(get_unit_discount > 0){
                    resPriUint = ((get_unit_pri * get_unit_discount) / 100);
                }else{                
                    resPriUint = get_unit_pri;
                }

                dollar = (resPriUint * get_quantity);
                riel = (resPriUint * get_quantity) * get_exchange_r;
                baht = (resPriUint * get_quantity) * get_exchange_b;

                $(this).find('.total_dollar').val(parseFloat(dollar).toFixed(2));
                $(this).find('.total_riel').val(parseFloat(riel).toFixed(2));           
                $(this).find('.total_baht').val(parseFloat(baht).toFixed(2));
            });
        });
        $('#discount').on('keyup change',function(){
            $("#ch_total").prop( "checked", false );
            $('.d_each_discount').val(0);
            var numRow = $('.parent_td').length;
            var discount = $(this).val();
             $('.parent_td').each(function() {
                $(this).find('.d_each_discount').val(discount / numRow);
            });
        });

        $('#ch_total').click(function(){
                var discount = $('input[name="discount"]').val();                
                var get_exchange_r = $('input[name="exchange_riel"]').val();
                var get_exchange_b = $('input[name="exchange_baht"]').val();
                if(discount == ''){ discount = 0 }
                // cal each discount
                var result_each_disc = 0;
                $('.parent_td').each(function() {
                    each_disc = parseFloat( $(this).find('.d_each_discount').val());
                    result_each_disc += each_disc;
                });
                $('input[name="all_discount"]').val(result_each_disc);
                
                // Calculate dollar
                var result_dollar = 0;
                $('.parent_td').each(function() {
                    dollar = parseFloat( $(this).find('.total_dollar').val());          
                    result_dollar += dollar;
                });                
                disp_res_dollar = (result_dollar - result_each_disc);                
                $('input[name="total_price_d"]').val(parseFloat(disp_res_dollar).toFixed(2));

                // Calculate riel
                var result_riel = 0;
                $('.parent_td').each(function() {
                    riel = parseFloat( $(this).find('.total_riel').val());
                    result_riel += riel;
                });
                disp_res_riel = (result_riel - (result_each_disc * get_exchange_r));                
                $('input[name="total_price_r"]').val(parseFloat(disp_res_riel).toFixed(2));

                //Calculate baht
                var result_bath = 0;
                $('.parent_td').each(function() {
                    baht = parseFloat( $(this).find('.total_baht').val());
                    result_bath += baht;
                });
                disp_res_baht = (result_bath - (result_each_disc * get_exchange_b));                
                $('input[name="total_price_b"]').val(parseFloat(disp_res_baht).toFixed(2));
        });
    });
</script>
<script type='text/javascript'>
    $(document).ready(function()
    {
        initDatePicker("input[name='on_date']");    
        setTimeout(function(){$(":input:visible:first", "#item_form").focus(); }, 100);
        $('#item_form').validate({
            submitHandler:function(form)
            {
                doDeliverySubmit(form);
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
                // exchange_riel: "required",
                // exchange_baht: "required",
                // receiver: "required",
                on_date: "required",
                send_by: "required",
                ch_total: "required",
            },
            messages:
            {
                // exchange_riel: <?php echo json_encode(lang('delivery_exchange_riel_required')); ?>,
                // exchange_baht: <?php echo json_encode(lang('delivery_exchange_baht_required')); ?>,
                // receiver: <?php // echo json_encode(lang('delivery_receiver_is_required')); ?>,
                on_date: <?php echo json_encode(lang('delivery_on_date_is_required')); ?>,
                send_by: <?php echo json_encode(lang('delivery_send_by_is_required')); ?>,
                ch_total: <?php echo json_encode(lang('delivery_ch_total_is_required')); ?>,
            }
            
        });
    });
    //submit faile
    var submitting = false;
    function doDeliverySubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.product_delivery_note : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$letter_info_by_id->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>