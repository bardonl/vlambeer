<?php require '../partials/head.php'; ?>
    <title>Template</title>
    </head>
    <body>

    <?php include '../partials/header.php';?>
<?php $results = $product->getAllProducts();?>
<?php $categories = $product->getCategories();?>
    <div class="main-conten-product-summary">

        <div class="wrapper-product-summary flex fd-r ai-fs ">
            <div class="cms-sidebar">
                <div class="categories-sidebar">
                    <h4 class="sidebar-head-cms category flex fd-c jc-c">Category Listing</h4>
                    <ul class="category-listing">
                        <?php foreach ($categories as $category):?>
                            <li>
                                > <a class="product-category" id="<?= $category['product_cat_id']?>"><?= $category['product_cat_desc']?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="add-product-sidebar">
                    <a href="http://valmbeer.badge-webdevelopment.nl/public/cms/add_product.php"><h4 class="sidebar-head-cms flex fd-c jc-c">Add Product</h4></a>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $("#search").on("click", function(e){
                        e.preventDefault();
                        var searchInput = $("#search-input").val();
                        $.ajax({
                            type: 'post',
                            url: '../../app/controllers/cmsControl.php',
                            data: {
                                'search':searchInput,
                                'action':'searchProduct'
                            },
                            success: function (data) {
                                $('.summary').remove();
                                $(".product-summary").append().html(data);},
                            error: function () {
                                alert("problem");
                            }
                        });
                    });

                    $('.product-category').on("click", function(e){
                        e.preventDefault();
                        var catId = $(this).attr('id');

                        $.ajax({
                            type: 'post',
                            url: '../../app/controllers/cmsControl.php',
                            data: {
                                'catID' : catId,
                                'action' : 'getProductsOnCat'
                            },
                            success: function (data){
                                $('.summary').remove();
                                $(".product-summary").html(data);
                            }
                        });
                    });

                    $(".category").on('click', function(){
                        $('.category-listing').slideToggle("slow", function(){});
                    });

                });
            </script>

            <table class="product-summary table table-striped flex fd-c">
                <tr>
                    <th></th><th></th><th></th>
                    <form class="flex fd-r">
                        <div class="form-group-cms">
                            <th>
                                <input class="form-control" type="text" id="search-input" name="search-input">
                            </th>
                        </div>
                        <th>
                            <input type="submit" class="btn-primary" name="search" id="search">
                        </th>
                    </form>
                    <th></th><th></th><th></th>
                </tr>

                <tr class="head">
                    <th>
                        Product Image
                    </th>
                    <th>
                        Product Name
                    </th>
                    <th>
                        Date Add
                    </th>
                    <th>
                        Product Active
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Sale
                    </th>
                    <th>
                        Category
                    </th>
                    <th></th>
                </tr>
                
                <?php foreach($results as $product):?>
                    <tr class="summary">
                        <td><img style="width: 150px; height: 150px;" src="<?= $product['product_image_path'] ?>" alt=""></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['product_date_add'] ?></td>
                        <td><?= $product['product_is_active'] ?></td>
                        <td><?= $product['product_price']?></td>
                        <td><?= $product['fk_sale_id']?></td>
                        <td><?= $product['product_cat_desc'] ?></td>
                        <td>
                            <form action="../../app/controllers/cmsControl.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <input type="submit" class="edit-product btn-primary" name="action" value="edit">
                            </form>
                        </td>
                    </tr>

                <?php endforeach;?>
                
            </table>
        </div>

    </div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?><?php
/**
 * Created by PhpStorm.
 * User: bart_
 * Date: 02-Jan-17
 * Time: 16:05
 */