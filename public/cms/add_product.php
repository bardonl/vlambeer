<?php require '../partials/head.php'; ?>
    <title>Template</title>
    </head>
    <body>

<?php include '../partials/header.php';


$results = $product->getCategories();

?>


    <script>

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-preview')
                            .attr('src', e.target.result)
                            .width(350)
                            .height(350);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }


    </script>
    <div class="main-content-add-product">
        <div class="wrapper-add-product flex jc-c">
            <form class="form-add-product" enctype="multipart/form-data" action="../../app/controllers/cmsControl.php" method="post">
                <div class="form-group-cms">
                    <label for="product_name">Product Name*</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" required>
                </div>
                <div class="form-group-cms">
                    <label for="product_image">Product Image*</label>
                    <label class="upload-file">
                        <input type="file" class="form-control" name="product-image" id="product-image" onchange="readURL(this);" required>
                        <span>Upload File</span>

                    </label>
                    <img id="img-preview" src="#" alt="your image" />
                </div>
                <div class="form-group-cms">
                    <label for="product_description">Product Description*</label>
                    <textarea name="product_description" class="form-control" id="product_description"></textarea>
                </div>
                <div class="form-group-cms">
                    <label for="product_price">Product Price*</label>
                    <input type="text" class="form-control" name="product_price" id="product_price" required>
                </div>

                <div class="form-group-cms">
                    <label for="product_category">Product Categorie*</label>
                    <select class="form-control" name="product_category" id="product_category">
                        <option value=""></option>
                        <?php foreach($results as $categorie): ?>
                            <option value="<?= $categorie['product_cat_id']?>"><?= $categorie['product_cat_desc']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <script>
                    $(document).ready(function(){
                        var counter = 1;
                        $("a.add-size").on('click',function(){
                            event.preventDefault();
                            counter++;
                            var newSize = $('<tr><td><input type="text" class="form-control" name="size[]" id="add-size"></td><td><input type="number"class="form-control" name="quantity[]" id="add-quantity"></td><td><a href="#" class="remove">- Remove</a></td></tr>');
                            $('table.size-table').append(newSize);
                        });
                        $(".size-table").on('click', '.remove',function(){
                            event.preventDefault();
                            console.log("hallo");
                            $(this).parent().parent().remove();
                        });
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


                </script>
                <div class="form-group-cms">

                    <label for="product_is_sale">Is the product in sale?*</label>
                    <div class="radio-group flex fd-r jc-sb">
                        <label for="product_is_sale_true">Yes</label>
                        <input type="radio" name="product_is_sale" id="product_is_sale_true" value="1">
                        <label for="product_is_sale_false">No</label>
                        <input type="radio" name="product_is_sale" id="product_is_sale_false" value="0">
                    </div>
                </div>
                <div id="saleoptions">
                    <div class="form-group-cms">
                        <label for="sale_percentage">Sales Percentage*</label>
                        <input type="number" name="sale_percentage" id="sale_percentage" class="form-control" disabled="disabled" required>
                    </div>
                    <div class="form-group-cms">
                        <label for="sale_image">Sales Image*</label>
                        <label class="upload-file">
                            <input type="file" class="form-control" name="sale_image" id="sale_image" disabled="disabled" required>
                            <span>Upload File</span>
                        </label>
                    </div>
                    <div class="form-group-cms">
                        <label for="sale_date_start">Sale Start*</label>
                        <input type="date" name="sale_date_start" id="sale_date_start" class="form-control" disabled="disabled" required>
                        <label for="sale_date_end">Sale End*</label>
                        <input type="date" name="sale_date_end" id="sale_date_end" class="form-control" disabled="disabled" required>
                    </div>
                </div>

                <div class="form-group-cms">
                    <label for="">In what sizes are the t-shirts available</label>
                    <div class="add-size-group">
                        <table class="size-table">
                            <tr>
                                <th>
                                    <label for="add-size">Size</label>
                                </th>
                                <th>
                                    <label for="add-quantity">Quantity</label>
                                </th>
                                <th>

                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="size[]" id="add-size">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="quantity[]" id="add-quantity">
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                        <a href="#" class="add-size">+ Add Size</a>
                    </div>
                </div>
                <input type="submit" class="btn-primary btn-block btn-md" value="Add Product" name="addProduct">
            </form>
        </div>

        <?php
        ?>

    </div>
<?php require '../partials/footer.php'?>
    <?php require '../partials/foot.php'?>