<script type="text/javascript">
    
//validation and submit handling
    $(function(){        
        $(".item_unique_id").prop("readonly",true);
        // var maxAppend = 0;
        $('.add_pro').click(function(){
            // if (maxAppend >= 5) return;
            var item = "<?php echo $items?>";
            $('.first_total').html('<a class="blue btn btn-active remove_field_emp" href="javascript:void(0);">Remove</a>');
            var tr = '<tr class="parent_td">'+
                        '<td style="border:none;padding: 0px">'+
                            '<table class="table">'+
                                '<tr>'+ 
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Select Items:</label>'+
                                        '<select name="item_name[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">'+
                                                '<option value="">-- Select Items --</option>'+
                                            <?php foreach($items as $key=>$row): ?>
                                                '<option value="<?php echo $row->item_id ?>"><?php echo $row->item_name ?></option>'+
                                            <?php endforeach ?>
                                        '</select>'+
                                    '</td>'+
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Item Code:</label>'+
                                        '<?php echo form_input(array("name" => "item_unique_id[]","id" => "item_unique_id","class" => "form-control form-inps item_unique_id","placeholder" => "Product Code","value" => ""));?>'+
                                    '</td>'+
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Unit:</label>'+
                                        '<select name="item_unit[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">'+
                                                '<option value="">-- Select Unit --</option>'+
                                            <?php foreach($unit_items as $key=>$row): ?>
                                                '<option value="<?php echo $row->unit_id ?>"><?php echo $row->unit_name ?></option>'+
                                            <?php endforeach ?>
                                        '</select>'+
                                    '</td>'+
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">QTY:</label>'+
                                        '<?php echo form_input(array("name" => "quantity[]", "type"=>"number", "id" => "quantity", "class" => "form-control form-inps quantity", 'style'=>'font-weight:bold', "placeholder" => "QTY","value" => ""));?>'+
                                    '</td>'+  
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">All QTY:</label>'+
                                        '<?php echo form_input(array('name' => 'all_qty[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => '', 'readonly' => 'true'));?>'+
                                    '</td>'+                             
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Discount:</label>'+
                                        '<?php echo form_input(array('name' => 'each_discount[]', "type"=>"number", 'id' => 'each_discount','class' => 'form-control form-inps each_discount', 'style'=>'font-weight:bold','placeholder' => 'Discount','value' => 0));?>'+
                                    '</td>'+ 
                                '</tr>'+ 
                                '<tr>'+                    
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Price Dollar:</label>'+
                                        '<?php echo form_input(array("name" => "d_price[]", "type"=>"number", "id" => "d_price","class" => "form-control form-inps d_price", 'style'=>'font-weight:bold', "placeholder" => "Price Dollar","value" => ""));?>'+
                                    '</td>'+ 
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Total Dollar:</label>'+
                                        '<?php echo form_input(array("name" => "total_dollar[]", "type"=>"number", "id" => "total_dollar", "class" => "form-control form-inps total_dollar","placeholder" => "Total Dollar","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>'+
                                    '</td>'+
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Total Reil:</label>'+
                                        '<?php echo form_input(array("name" => "total_riel[]", "type"=>"number", "id" => "total_riel","class" => "form-control form-inps total_riel","placeholder" => "Total Riel","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>'+
                                    '</td>'+
                                    '<td>'+
                                        '<label class="col-sm-12 col-xs-12 no-padding">Total Baht:</label>'+
                                        '<?php echo form_input(array("name" => "total_baht[]", "type"=>"number", "id" => "total_baht","class" => "form-control form-inps total_baht","placeholder" => "Total Baht","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" =>"true"));?>'+
                                    '</td>'+
                                '</tr>'+
                            '</table>'+
                        '<td>'+                                               
                        '<td class="first_total" colspan="2">'+
                            '<a class="blue btn btn-active remove_field_emp" href="javascript:void(0);">Remove</a>'+
                        '</td>'+
                    '<tr>';
            // maxAppend++;
            $('.add_tr').append(tr);
            $('.parent_td').parent().parent().find(".item_unique_id").prop("readonly",true);
        });

        $('.add_tr').on('click', '.remove_field_emp', function() {
                $("#ch_total").prop( "checked", false );
                $(this).parent().find('input[name="deleted[]"]').attr('value',1);
                $(this).parent().parent().find('.parent_td').removeClass();
                $(this).parent().parent().remove();
                $("#ch_total").prop( "checked", false );
        });
        $('.add_tr').on('change', '.item_name',function(){
            var id = $(this).parent().parent().parent().find('.item_name').val();
            $this = $(this);
                $.post("<?php echo site_url('items/suggest_items')?>",{ id: id }, function(result, data) {
                    if(data == 'success'){
                        $this.parent().parent().parent().find('.item_unique_id').val(result.code); 
                    }   
                },"json");

                $.post("<?php echo site_url('items/suggest_unit')?>",{ id: id }, function(result, data) {
                    if(data == 'success')
                    {
                        $this.parent().parent().parent().find('#item_unit').html(result.res);
                    }
                },"json");

            $(this).parent().parent().parent().find('.d_price').val('');
            $(this).parent().parent().parent().find('.all_qty').val('');
            $(this).parent().parent().parent().find('.quantity').val('');
            $(this).parent().parent().parent().find('.total_dollar').val('');
            $(this).parent().parent().parent().find('.total_riel').val('');
            $(this).parent().parent().parent().find('.total_baht').val('');

        });
    });

    $(function(){
        $('.add_tr').delegate(('.d_price'),'keyup',function(){
            $("#ch_total").prop( "checked", false );
            var get_exchange_d = $('input[name="exchange_dollar"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();
            var get_d_price = $(this).val();
            var get_quantity = $(this).parent().parent().parent().find('.quantity').val();

                $(this).parent().parent().parent().find('.total_dollar').val(get_d_price * get_quantity);
                $(this).parent().parent().parent().find('.total_riel').val((get_d_price * get_quantity) * get_exchange_d);           
                $(this).parent().parent().parent().find('.total_baht').val((get_d_price * get_quantity) * get_exchange_b);
                if (!(get_d_price == '' || get_d_price == '0')) {
                    $(this).parent().parent().parent().find('.b_price').prop( "disabled", true );
                    $(this).parent().parent().parent().find('.r_price').prop( "disabled", true );
                }else{
                    $(this).parent().parent().parent().find('.b_price').prop( "disabled", false );
                    $(this).parent().parent().parent().find('.r_price').prop( "disabled", false );
                }   
        });  

        $('.add_tr').delegate(('.item_unit'),'change',function(){
            $("#ch_total").prop( "checked", false );
            var get_unit_type = $(this).parent().parent().parent().find('.item_unit :selected').data('qty');
            var get_quantity = $(this).parent().parent().parent().find('.quantity').val();
            var total_all_qty = parseFloat(get_quantity * get_unit_type);
            $(this).parent().parent().parent().find('.all_qty').val(total_all_qty);
            var get_d_price = $(this).parent().parent().parent().find('.d_price').val();
            var get_r_price = $(this).parent().parent().parent().find('.r_price').val();
            var get_b_price = $(this).parent().parent().parent().find('.b_price').val();

            var get_exchange_d = $('input[name="exchange_dollar"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();

            $(this).parent().parent().parent().find('.total_dollar').val(get_d_price * get_quantity);
            $(this).parent().parent().parent().find('.total_riel').val((get_d_price * get_quantity) * get_exchange_d);           
            $(this).parent().parent().parent().find('.total_baht').val((get_d_price * get_quantity) * get_exchange_b);

        });      
        
        $('.add_tr').delegate(('.quantity'),'keyup change',function(){
            $("#ch_total").prop( "checked", false );
            var get_quantity = $(this).val();
            var get_unit_type = $(this).parent().parent().parent().find('.item_unit :selected').data('qty');
            var total_all_qty = parseFloat(get_quantity * get_unit_type);
            $(this).parent().parent().parent().find('.all_qty').val(total_all_qty);
            var get_d_price = $(this).parent().parent().parent().find('.d_price').val();
            var get_r_price = $(this).parent().parent().parent().find('.r_price').val();
            var get_b_price = $(this).parent().parent().parent().find('.b_price').val();
            var get_exchange_d = $('input[name="exchange_dollar"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();

            $(this).parent().parent().parent().find('.total_dollar').val(get_d_price * get_quantity);
            $(this).parent().parent().parent().find('.total_riel').val((get_d_price * get_quantity) * get_exchange_d);           
            $(this).parent().parent().parent().find('.total_baht').val((get_d_price * get_quantity) * get_exchange_b);
        });

        $('.add_tr').delegate(('.each_discount'),'keyup change',function(){
            $("#discount").val(0);
            $("#ch_total").prop( "checked", false );                           
        });

        $('#discount').on('keyup change',function(){
            $("#ch_total").prop( "checked", false );
             
            var length_field = $(".parent_td").length;
            var discount = $(this).val();  
            $('.parent_td').each(function(){
                $(this).find('.each_discount').val(discount / length_field); 
            });
        });

        $('input[name="exchange_dollar"], input[name="exchange_baht"]').on('keyup',function(){
            $("#ch_total").prop( "checked", false );
            $('.parent_td').each(function(){
                var get_exchange_d = $('input[name="exchange_dollar"]').val(),
                    get_exchange_b = $('input[name="exchange_baht"]').val(),
                    get_d_price = $(this).find('.d_price').val(),
                    get_r_price = $(this).find('.r_price').val(),
                    get_b_price = $(this).find('.b_price').val(),
                    get_quantity = $(this).find('.quantity').val();
                    $(this).find('.total_dollar').val(get_d_price * get_quantity);
                    $(this).find('.total_riel').val((get_d_price * get_quantity) * get_exchange_d);           
                    $(this).find('.total_baht').val((get_d_price * get_quantity) * get_exchange_b);
            });
        });

        // click checked result
        $('#ch_total').click(function(){ 
            if($('.parent_td').length == 0){
                $("#ch_total").prop( "checked", false );
            }
            var get_exchange_d = $('input[name="exchange_dollar"]').val();
            var get_exchange_b = $('input[name="exchange_baht"]').val();
            var discount = $('input[name="discount"]').val();
            if(discount == ''){ discount = 0 }

            // Live each discount
            var resultEeachDiscount = 0;
            $('.parent_td').each(function() {
                eDiscount = parseFloat( $(this).find('.each_discount').val());
                resultEeachDiscount += eDiscount;
            });  
            $('input[name="total_discount"]').val(resultEeachDiscount);  

            // SUM ResultDollar
            var result_dollar = 0;
            $('.parent_td').each(function() {
                dollar = parseFloat( $(this).find('.total_dollar').val());
                result_dollar += dollar;
            });
            disp_res_dollar = (result_dollar - resultEeachDiscount);
            $('input[name="dollar_total"]').val(disp_res_dollar);
            
            //Sum ResultRiel
            var result_riel = 0;
            $('.parent_td').each(function() {
                riel = parseFloat( $(this).find('.total_riel').val());
                result_riel += riel;
            });     
            disp_res_riel = (result_riel - (resultEeachDiscount * get_exchange_d));      
            $('input[name="riel_total"]').val(disp_res_riel);

            // Sum ResuleBaht
            var result_bath = 0;
            $('.parent_td').each(function() {
                baht = parseFloat( $(this).find('.total_baht').val());
                result_bath += baht;
            });
            disp_res_baht = (result_bath - (resultEeachDiscount * get_exchange_b));           
            $('input[name="baht_total"]').val(disp_res_baht);
            
        });
    });

</script>



<!-- parent_td -->