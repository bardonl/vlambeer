/**
 * Created by bart_ on 24-Jan-17.
 */
$(document).ready(function(){


    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log('hello');
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-preview')
                    .attr('src', e.target.result)
                    .width(350)
                    .height(350);
                $('#img-sale-preview')
                    .attr('src', e.target.result)
                    .width(350)
                    .height(350);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".add-size").on('input',function() {
        var stockId = $(this).data('stock-id');
        var sizeValue = $(this).data('size-id',{value:$('[data-size-id]').val()} );
        console.log("Size Id: "+stockId+" Size Value: "+sizeValue["0"].value);
        $.ajax({
            type: 'POST',
            url: '../../app/controllers/cmsControl.php',
            data: {
                'stockid':stockId,
                'sizeValue':sizeValue["0"].value,
                'action':'updateStockSize'
            },
            success: function (data) {
                console.log(data);}
        });
    });
    $(".add-quantity").on('input',function() {
        var stockId = $(this).data('stock-id');
        var quantityValue = $(this).data('quantity-id',{quantityvalue:$('[data-quantity-id]').val()} );
        console.log("Size Id: "+stockId+" Size Value: "+quantityValue["0"].value);
        $.ajax({
            type: 'post',
            url: '../../app/controllers/cmsControl.php',
            data: {
                'stockid':stockId,
                'stockQuantity':quantityValue["0"].value,
                'action':'updateStockQuantity'
            },
            success: function (data) {
                console.log(data);}
        });
    });
    $('.remove').on("click", function(){
        console.log("Removed");
        var stockId = $(this).data('stock-id');
        $.ajax({
            type: 'post',
            url: '../../app/controllers/cmsControl.php',
            data: {
                'stockid':stockId,
                'action':'removeStock'
            },
            success: function (data) {
                console.log(data);}
        });
    });

//                                    $('#update-product').on('click',function(e) {
//                                        e.preventDefault();
//
//                                        tinyMCE.triggerSave();
//
//
//                                        var is_sale = 0;
//                                        var productId = $("#product_id").val();
//                                        var product_description = $('#product_description').val();
//                                        var product_price = $('#product_price').val();
//                                        var product_name = $('#product_name').val();
//                                        var product_file = $('#product-image')[0];
//                                        var sale_file = $('#sale_image')[0].files[0];
//
//                                        console.log(product_file);
//
//                                        if($('#product_is_sale_true').is(':checked')) {
//                                            is_sale = 1;
//                                            var sale_id = $('#sale_id').val();
//                                            var sale_percentage = $('#sale_percentage').val();
//                                            var sale_date_start = $('#sale_date_start').val();
//                                            var sale_date_end = $('#sale_date_end').val();
//                                            if(document.getElementById("sale_image").files.length == 0){
//                                                sale_image = $('#img-sale-preview').attr('src');
//                                            }else{
//                                                var sale_name = sale_file.name;
//                                                var sale_size = sale_file.size;
//                                                var sale_type = sale_file.type;
//                                                sale_image = document.getElementById("sale_image").files[0];
////                                                sale_image['sale_tmp_name'] = sale_tmp_name;
////                                                sale_image['sale_name'] = sale_name;
////                                                sale_image['sale_size'] = sale_size;
////                                                sale_image['sale_type'] = sale_type;
//                                            }
//                                        }
//                                        if($('#product_is_sale_false').is(':checked')) {
//                                            is_sale = 0;
//                                        }
//
//                                        if(document.getElementById("product-image").files.length == 0){
//                                            product_image = $('#img-preview').attr('src');
//                                        }else{
//                                            var name = product_file.name;
//                                            var size = product_file.size;
//                                            var type = product_file.type;
//                                            product_image = {};
//                                            product_image['name'] = name;
//                                            product_image['size'] = size;
//                                            product_image['type'] = type;
//                                        }
//
//
//
//                                        var size_array = [];
//                                        var counter = 0;
//                                        $('input[name^="new-size"]').each(function(){
//                                            size_array[counter] = $(this).val();
//
//                                            counter++;
//                                        });
//
//                                        var quantity_array = [];
//                                        var counter = 0;
//                                        $('input[name^="new-quantity"]').each(function(){
//                                            quantity_array[counter] = $(this).val();
//
//                                            counter++;
//                                        });
//
//                                        console.log(size_array);
//                                        console.log(quantity_array);
//
//                                        var new_size = $('input[name="new_size"').val();
//                                        var new_quantity = $('input[name="new_quantity"').val();
//
//                                        console.log(product_image);
//                                        console.log(sale_image);
//
//                                        $.ajax({
//                                            type: 'post',
//                                            url: '../../app/controllers/cmsControl.php',
//                                            data: {
//                                                'product_id': productId,
//                                                'product_name':product_name,
//                                                'product_price':product_price,
//                                                'product_description':product_description,
//                                                'is_sale':is_sale,
//                                                'sale_id':sale_id,
//                                                'sale_percentage':sale_percentage,
//                                                'sale_date_start':sale_date_start,
//                                                'sale_date_end':sale_date_end,
//                                                'product_image':{product_image:product_image},
//                                                'sale_image':sale_image,
//                                                'new_size':{size_array},
//                                                'new_quantity':{quantity_array},
//                                                'action':'updateProduct'
//                                            },
//                                            success: function (data) {
//                                                $('.main-content-add-product').append(data);}
//                                        });
//                                    });


    var counter = 1;
    $("a.add-new-size").on('click',function(){
        event.preventDefault();

        var newSize = $('<tr><td><input type="text" class="add-new-size form-control" data-new-size-id="'+counter+'" name="new-size[]" id="add-new-size"></td><td><input type="number" class="add-new-quantity form-control"  data-new-quantity-id="'+counter+'" name="new-quantity[]" id="add-new-quantity"></td><td><a href="#" class="remove">- Remove</a></td></tr>');
        counter++;
        $('table.size-table').append(newSize);
    });
    $(".size-table").on('click', '.remove',function(){
        event.preventDefault();
        $(this).parent().parent().remove();
    });
    if($('#product_is_sale_true').is(':checked')) {
        $("#saleoptions").show();
        $("input").removeAttr('disabled');
    }
    $('.radio-group').click(function() {
        if($('#product_is_sale_true').is(':checked')) {
            $("#saleoptions").show();
            $("input").removeAttr('disabled');
        }
        if($('#product_is_sale_false').is(':checked')) {
            $("#saleoptions").hide();
            $("#sale_percentage").attr('disabled','disabled');
            $("#sale_image").attr('disabled','disabled');
            $("#sale_date_start").attr('disabled','disabled');
            $("#sale_date_end").attr('disabled','disabled');
        }
    });
});