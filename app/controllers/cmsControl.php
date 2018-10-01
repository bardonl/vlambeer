<?php
require_once realpath(__DIR__ . '/../init.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(array_key_exists('addProduct', $_POST)){
        if(
            empty($_POST['product_name']) ||
            empty($_POST['product_description']) ||
            empty($_POST['product_price'])
        ){
            $user->redirect('cms/add_product.php');
        }

        $check = getimagesize($_FILES["product-image"]["tmp_name"]);
        $checkSale = getimagesize($_FILES["sale_image"]["tmp_name"]);
        if($check !== false) {
            if($_POST['product_is_sale'] == 1){
                if( $checkSale !== false){
                    $product->addSale($_POST,$_FILES);
                }else{
                    $user->redirect('cms/add_product.php');
                }
            }else{
                $product->addProduct($_POST,$_FILES);
            }
        } else {
            $user->redirect('cms/add_product.php');
        }

    }
    if($_POST['action'] == 'edit'){
        $user->redirect('cms/edit_product.php?action=edit&id='.$_POST['product_id']);
    }
    if(array_key_exists('updateProduct', $_POST)){
        $product->updateProduct($_POST,$_FILES);
        $user->redirect('cms/edit_product.php?action=edit&id='.$_POST['product_id']);
        die;
    }
    if($_POST['action'] == "updateStockSize"){
        if(empty($_POST['stockid'])){
            $product->addStock($_POST);
            die;
        }else{
            $product->updateStockSize($_POST);
            die;
        }
    }
    if($_POST['action'] == "updateStockQuantity"){
        $product->updateStockQuantity($_POST);
        die;
    }
    if($_POST['action'] == "removeStock"){
        $product->makeStockInactive($_POST);
        die;
    }

    if($_POST['action'] == 'addStockSize'){
        var_dump($_POST);
        die;
    }
    
    if($_POST['action'] == 'searchProduct'){
        $product->searchProduct($_POST);
    }
    
    if($_POST['action'] == 'getProductsOnCat'){
        $product->getProductsOnCat($_POST);
    }
}