<?php require '../partials/head.php'; ?>
    <title>Template</title>
    </head>
    <body>

<?php include '../partials/header.php';

if($_GET['action'] == 'edit'){
    $result = $product->getProduct($_GET['id']);
}

if(!empty($result[0]['fk_sale_id'])){
    $sale_result = $product->getProductSale($result[0]['fk_sale_id']);


}

$results = $product->getCategories();
//if(key_exists('succes',$_GET)){
//    if($_GET['succes'] == 1){
//        echo"Product edited";
//    }else{
//        echo"Failed";
//    }
//}


?>
    <div class="main-content-add-product">
        <div class="wrapper-add-product flex jc-c">
            <form class="form-add-product" enctype="multipart/form-data" method="post" action="../../app/controllers/cmsControl.php">
                <div class="form-group-cms">
                    <label for="product_name">Product Name*</label>
                    <input type="text" class="form-control" name="product_name" id="product_name" value="<?= $result[0]['product_name'] ?>" required>
                </div>
                <div class="form-group-cms">
                    <label for="product_image">Product Image*</label>
                    <label class="upload-file">
                        <input type="file" class="form-control" name="product-image" id="product-image">
                        <span>Upload File</span>
                    </label>
                    <img id="img-preview" src="<?= $result[0]['product_image_path'] ?>" width="350" height="350" alt="Product Image" />
                </div>
                <div class="form-group-cms">
                    <label for="product_description">Product Description*</label>
                    <textarea name="product_description" class="form-control" id="product_description"><?= $result[0]['product_description'] ?></textarea>
                </div>
                <div class="form-group-cms">
                    <label for="product_price">Product Price*</label>
                    <input type="text" class="form-control" name="product_price" id="product_price" value="<?= $result[0]['product_price'] ?>" required>
                </div>

                <div class="form-group-cms">
                    <label for="product_category">Product Categorie*</label>
                    <select class="form-control" name="product_category" id="product_category">
                        <option value=""></option>
                        <?php foreach($results as $categorie): ?>
                            <option value="<?= $categorie['product_cat_id']?>" <?php if($result[0]['fk_product_cat_id'] == $categorie['product_cat_id']){ echo"selected"; } ?>><?= $categorie['product_cat_desc']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group-cms">

                    <label for="product_is_sale">Is the product in sale?*</label>
                    <div class="radio-group flex fd-r jc-sb">
                        <label for="product_is_sale_true">Yes</label>
                        <input type="radio" name="product_is_sale" <?php if($result[0]['fk_sale_id'] != 0){echo 'checked';} ?> id="product_is_sale_true" value="1">
                        <label for="product_is_sale_false">No</label>
                        <input type="radio" name="product_is_sale" id="product_is_sale_false" <?php if($result[0]['fk_sale_id'] == 0){echo 'checked';} ?> value="0">
                    </div>
                </div>
                <div id="saleoptions">
                    <div class="form-group-cms">
                        <label for="sale_percentage">Sales Percentage*</label>
                        <input type="number" name="sale_percentage" id="sale_percentage" class="form-control" value="<?php if(isset($sale_result)){echo $sale_result['sale_percentage'];} ?>" disabled="disabled" required>
                    </div>
                    <div class="form-group-cms">
                        <label for="sale_image">Sales Image*</label>
                        <label class="upload-file">
                            <input type="file" class="form-control" name="sale_image" id="sale_image" disabled="disabled">
                            <span>Upload File</span>
                        </label>
                        <img id="img-sale-preview" src="<?php if(isset($sale_result)){echo $sale_result['sale_image_path'];} ?>" width="350" height="350" alt="Sale Image" />
                    </div>
                    <div class="form-group-cms">
                        <label for="sale_date_start">Sale Start*</label>
                        <input type="date" name="sale_date_start" id="sale_date_start" class="form-control" value="<?php if(isset($sale_result)){echo $sale_result['sale_date_start'];} ?>" disabled="disabled" required>
                        <label for="sale_date_end">Sale End*</label>
                        <input type="date" name="sale_date_end" id="sale_date_end" class="form-control" value="<?php if(isset($sale_result)){echo $sale_result['sale_date_end'];} ?>" disabled="disabled" required>
                    </div>
                    <input type="hidden" name="sale_id" id="sale_id" value="<?php if(isset($sale_result)){echo $sale_result['sale_id'];} ?>">
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
                            <?php
                            $counter = 1;
                            foreach ($result[1] as $stock):?>
                                <tr>
                                    <input type="hidden" data-stock-id="<?= $stock['stock_id'] ?>" name="stock_id[]" id="stock_id" value="<?= $stock['stock_id'] ?>">
                                    <td>
                                        <input type="text" class="add-size form-control" data-size-id="<?= $counter ?>" data-stock-id="<?= $stock['stock_id'] ?>" name="size[]" value="<?= $stock['stock_size'] ?>" id="add-size">
                                    </td>
                                    <td>
                                        <input type="number" class="add-quantity form-control" data-quantity-id="<?= $counter ?>" data-stock-id="<?= $stock['stock_id'] ?>" name="quantity[]" value="<?= $stock['stock_quantity'] ?>" id="add-quantity">
                                    </td>
                                    <td>
                                        <a href="#" class="remove" data-stock-id="<?= $stock['stock_id'] ?>">- Remove</a>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;?>

                        </table>
                        <a href="#" class="add-new-size">+ Add Size</a>
                    </div>
                </div>
                <input type="hidden" name="product_id" id="product_id" value="<?= $result[0]['product_id'] ?>">
                <input type="hidden" name="category_id" id="category_id" value="<?= $result[0]['fk_product_cat_id'] ?>">
                <input type="hidden" name="sale_id" id="sale_id" value="<?php if(!empty($result[0]['fk_sale_id'])){ echo $result[0]['fk_sale_id'];} ?>">
                <input type="hidden" name="product_image" id="product_image" value="<?= $result[0]['product_image_path'] ?>">
                <input type="hidden" name="sale_image" id="sale_image" value="<?php if(isset($sale_result)){echo $sale_result['sale_image_path'];} ?>">
                <button type="submit" class="btn-primary btn-block btn-md update-product" value="Update Product" name="updateProduct" id="update">Update Product</button>
            </form>
        </div>

    </div>
    <script src="../js/cms.js"></script>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>