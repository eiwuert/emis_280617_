<script type="text/javascript">
    $(function(){
        $('.add_items_sell').click(function(){
            // if (maxAppend >= 5) return;
            $('.first_row').html('<a class="blue btn btn-active remove_field" href="javascript:void(0);">Remove</a>');
            var tr ='<tr>'+
                        '<td class="parent_td">'+
                            '<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">'+
                                '<select name="sell_cate[]" class="form-control form-inps sell_cate" id="sell_cate" placeholder="Unit Name" style="height:auto">'+
                                        '<option value="">-- Select Unit Items --</option>'+
                                    <?php foreach($unit_items as $key=>$row): ?>
                                        '<option value="<?php echo $row->unit_id ?>"><?php echo $row->unit_name ?></option>'+
                                    <?php endforeach ?>
                                '</select>'+
                            '</div>'+
                            '<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">'+
                                '<?php echo form_input(array("name" => "sell_qty[]", "type"=>"number", "id" => "sell_qty","class" => "form-control form-inps","placeholder" => "Sell QTY","value" =>""));?>'+
                            '</div>'+ 
                            '<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">'+
                                '<?php echo form_input(array("name" => "sell_price[]", "type"=>"number", "id" => "sell_price","class" => "form-control form-inps","placeholder" => "Sell Price","value" =>""));?>'+
                            '</div>'+                             
                            '<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">'+
                                '<?php echo form_input(array("name" => "discount[]", "type"=>"number", "id" => "sell_price_old","class" => "form-control form-inps","placeholder" => "Discount Price $"));?>'+
                            '</div>'+
                        '</td>'+                           
                        '<td class="first_total" colspan="2">'+
                            '<a class="blue btn btn-active remove_field" href="javascript:void(0);">Remove</a>'+
                        '</td>'+
                    '</tr>'; 
            // maxAppend++;
            $('.add_tr').append(tr);
        });

        $('.add_tr').on('click', '.remove_field', function() {
            var id = $(this).parent().parent().find('input[name="autoid[]"]').val();
            $this = $(this);
            $.post("<?php echo site_url("product_items/remove_unit")?>", {id:id}, function(data, status){

                if(status == "success"){
                    if ($('.remove_field').length == 1) {
                        $this.parent().parent().removeClass();
                    }else{
                        $this.parent().parent().remove();
                    }
                }
            });

            
              
            
        });
    });
</script>