<?php

/**
 * Created by PhpStorm.
 * User: bart_
 * Date: 21-Dec-16
 * Time: 11:54
 */
class Product
{

    private $db;

    function __construct() {
//         Database connectie
        $this->db = Database::getInstance();
    }

    // redirect vanaf development folder

    public function redirect($path) {
        header('location:http://valmbeer.badge-webdevelopment.nl/public/'.$path);
    }

    function addSale($data, $file){
        
        $targetSale = '../../public/img/sales_img/';
        $basenameSale = uniqid() . '-' . basename($file['sale_image']['name']);
        $uploadTargetSale = $targetSale . $basenameSale;
        $uploadTargetSaleDb = 'http://valmbeer.badge-webdevelopment.nl/public/img/sales_img/';
        $uploadTargetSaleDb = $uploadTargetSaleDb . $basenameSale;

        //Maakt datum aan voor wanneer het product is toegevoegd
        $dateNow = date('Y-m-d');

        $sql = "INSERT INTO `tbl_sale`
                (`sale_percentage`,
                `sale_image_path`,
                `sale_date_start`,
                `sale_date_end`,
                `sale_date_add`,
                `sale_is_active`)VALUES(
                :sale_percentage,
                :sale_image_path,
                :sale_date_start,
                :sale_date_end,
                :sale_date_add,
                :sale_is_active
                )";

        $pos = 1;
        $neg = 0;


        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':sale_percentage', $data['sale_percentage']);
        $stmt->bindParam(':sale_image_path', $uploadTargetSaleDb);
        $stmt->bindParam(':sale_date_start', $data['sale_date_start']);
        $stmt->bindParam(':sale_date_end', $data['sale_date_end']);
        $stmt->bindParam(':sale_date_add', $dateNow);
        $stmt->bindParam(':sale_is_active', $pos);
        if($stmt->execute()){
            $sql = "SELECT LAST_INSERT_ID()";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
            $data['sale_id'] = $lastId;
            if (move_uploaded_file($file['sale_image']['tmp_name'], $uploadTargetSale)) {
                $this->addProduct($data, $file);
                die;
            } else {
                echo "Hmm iets is er mis";
                die;
            }
        }
    }
    //Toeveogen van producten in de database
    function addProduct($data, $file)
    {
        if($data['product_is_sale'] == 1){
            $saleId = $data['sale_id']['LAST_INSERT_ID()'];
        }else{
            $saleId = NULL;
        }
        //Alles defineren voor de image upload
        $targetProduct = '../../public/img/product_img/';
        $basenameProduct = uniqid() . '-' . basename($file['product-image']['name']);
        $uploadTargetProduct = $targetProduct . $basenameProduct;
        $uploadTargetProductDb = 'http://valmbeer.badge-webdevelopment.nl/public/img/product_img/';
        $uploadTargetProductDb = $uploadTargetProductDb . $basenameProduct;

        //Maakt datum aan voor wanneer het product is toegevoegd
        $dateNow = date('Y-m-d');

        $sql = 'INSERT INTO `tbl_product`(
                `product_name`,
                `product_image_path`,
                `product_description`,
                `product_date_add`,
                `product_is_active`,
                `product_price`,
                `fk_sale_id`,
                `fk_product_cat_id`)
                VALUES(
                :product_name,
                :product_image_path,
                :product_description,
                :product_date_add,
                :product_is_active,
                :product_price,
                :fk_sale_id,
                :fk_product_cat_id
                )';
        
        $pos = 1;
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_name' ,$data['product_name']);
        $stmt->bindParam(':product_image_path' ,$uploadTargetProductDb);
        $stmt->bindParam(':product_description' ,$data['product_description']);
        $stmt->bindParam(':product_date_add' , $dateNow);
        $stmt->bindParam(':product_is_active' ,$pos);
        $stmt->bindParam(':product_price' ,$data['product_price']);
        $stmt->bindParam(':fk_sale_id',$saleId);
        $stmt->bindParam(':fk_product_cat_id' ,$data['product_category']);

        if($stmt->execute()){
            $sql = "SELECT LAST_INSERT_ID()";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();
            $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
            //Upload de image daadwerkelijk naar de juist folder, in de SQL word het pad naar de img geplaats
            if (move_uploaded_file($file['product-image']['tmp_name'], $uploadTargetProduct)) {
                $this->addStock($data, $lastId);
                die;
            } else {
                echo "Hmm iets is er mis";
                die;
            }
        }


    }


    function addStock($data, $id){

        $counter = 0;

        //$data = substr($dat['size'.$counter++], 0, -1);
        foreach($data['size'] as $size){
            $sql = "INSERT INTO `tbl_stock`(`stock_quantity`, `stock_size`, `fk_product_id`)VALUES(:stock_quantity, :stock_size, :fk_product_id)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':stock_quantity', $data['quantity'][$counter++]);
            $stmt->bindParam(':stock_size', $size);
            $stmt->bindParam(':fk_product_id', $id['LAST_INSERT_ID()']);
            if($stmt->execute()){
                echo 'Succes';
            }else{
                echo "whoops";
            }

        }
    }

    //Terug halen van de merchendise op basis van category en hoeveel wil je er terug halen
    function getMerchendises($category, $limit){
        $sql = 'SELECT
              `tbl_product`.*,
              `tbl_product_category`.*
              FROM `tbl_product`
              INNER JOIN
              `tbl_product_category`
              ON `tbl_product`.`fk_product_cat_id` 
              WHERE `tbl_product_category`.`product_cat_desc` = :category
              LIMIT '.$limit;
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':category', $category);
//        $stmt->bindParam(':limit', $limit);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
//INNER JOIN `tbl_sale` ON `tbl_product`.`fk_sale_id` WHERE `tbl_product`.`fk_sale_id` = `tbl_sale`.`sale_id`
    //Verkrijg product op basis van ID
    function getProduct($id){
        $sql = 'SELECT * FROM `tbl_product` WHERE `product_id` = :id ';
        $sqlStock = 'SELECT * FROM `tbl_stock` WHERE `fk_product_id`= :id AND `stock_active`=1';
        $stmt = $this->db->pdo->prepare($sql);
        $stmtStock = $this->db->pdo->prepare($sqlStock);
        $stmt->bindParam(':id', $id);
        $stmtStock->bindParam(':id', $id);
        $stmt->execute();
        $stmtStock->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $resultStock = $stmtStock->fetchAll(PDO::FETCH_ASSOC);
        return $results = [$result,$resultStock];
    }
    
    function getProductSale($id){
        $sql = 'SELECT * FROM `tbl_sale` WHERE `sale_id` = :id';
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAllProducts(){
        $sql = "SELECT `tbl_product`.*, `tbl_product_category`.*
                FROM `tbl_product`
                INNER JOIN `tbl_product_category`
                ON `tbl_product`.`fk_product_cat_id`
                WHERE `tbl_product_category`.`product_cat_id` = `tbl_product`.`fk_product_cat_id`";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function updateProduct($data, $files){

        if ($data['product_is_sale'] == 1){
            if(empty($data['sale_id'])){
                $targetSale = '../../public/img/sales_img/';
                $basenameSale = uniqid() . '-' . basename($files['sale_image']['name']);
                $uploadTargetSale = $targetSale . $basenameSale;
                $uploadTargetSaleDb = 'http://valmbeer.badge-webdevelopment.nl/public/img/sales_img/';
                $uploadTargetSaleDb = $uploadTargetSaleDb . $basenameSale;

                //Maakt datum aan voor wanneer het product is toegevoegd
                $dateNow = date('Y-m-d');

                $sql = "INSERT INTO `tbl_sale`
                (`sale_percentage`,
                `sale_image_path`,
                `sale_date_start`,
                `sale_date_end`,
                `sale_date_add`,
                `sale_is_active`)VALUES(
                :sale_percentage,
                :sale_image_path,
                :sale_date_start,
                :sale_date_end,
                :sale_date_add,
                :sale_is_active
                )";

                $pos = 1;
                $neg = 0;


                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':sale_percentage', $data['sale_percentage']);
                $stmt->bindParam(':sale_image_path', $uploadTargetSaleDb);
                $stmt->bindParam(':sale_date_start', $data['sale_date_start']);
                $stmt->bindParam(':sale_date_end', $data['sale_date_end']);
                $stmt->bindParam(':sale_date_add', $dateNow);
                $stmt->bindParam(':sale_is_active', $pos);
                if($stmt->execute()){

                    $sql = "SELECT LAST_INSERT_ID()";
                    $stmt = $this->db->pdo->prepare($sql);
                    $stmt->execute();
                    $lastId = $stmt->fetch(PDO::FETCH_ASSOC);
                    $data['sale_id'] = $lastId;
                    if (move_uploaded_file($files['sale_image']['tmp_name'], $uploadTargetSale)) {
                        echo "New Sale Added";
                    } else {
                        echo "Sale not added";
                    }
                }
            }else{
                $sql = "UPDATE
                    `tbl_sale`
                    SET
                    `sale_percentage` = :sale_percentage ,
                    `sale_image_path` = :sale_image_path ,
                    `sale_date_start` = :sale_date_start ,
                    `sale_date_end` = :sale_date_end ,
                    `sale_is_active` = :sale_is_active 
                    WHERE
                    `sale_id` = :sale_id";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':sale_percentage', $data['sale_percentage']);
                if (empty($files['sale_image'])) {
                    $targetSale = '../../public/img/sales_img/';
                    $basenameSale = uniqid() . '-' . basename($files['sale_image']['name']);
                    $uploadTargetSale = $targetSale . $basenameSale;
                    $uploadTargetSaleDb = 'http://valmbeer.badge-webdevelopment.nl/public/img/sales_img/';
                    $uploadTargetSaleDb = $uploadTargetSaleDb . $basenameSale;
                    $stmt->bindParam(':sale_image_path', $uploadTargetSaleDb);
                    move_uploaded_file($files['sale_image']['tmp_name'], $uploadTargetSale);
                    $stmt->bindParam(":sale_image_path", $uploadTargetSaleDb);
                } else {
                    $stmt->bindParam(":sale_image_path", $data['sale_image_path']);
                }
                $stmt->bindParam(":sale_date_start", $data['sale_date_start']);
                $stmt->bindParam("sale_date_end", $data['sale_date_end']);
                $pos = 1;
                $neg = 0;
                if (date('Y-m-d') < $data['sale_date_start']) {
                    $stmt->bindParam(":sale_is_active", $neg);
                } else {
                    $stmt->bindParam(":sale_is_active", $pos);
                }
                $stmt->bindParam(":sale_id", $data['sale_id']);
                if ($stmt->execute()) {
                    echo "Sale Edited";
                } else {
                    echo "Nope Sales Failed";
                }
            }
        }

        if(is_array($data['new-size'])) {
            $counter = 0;
            foreach ($data['new-size'] as $size) {
                $sql = "INSERT INTO `tbl_stock`(`stock_quantity`, `stock_size`, `fk_product_id`)VALUES(:stock_quantity, :stock_size, :fk_product_id)";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':stock_quantity', $data['new-quantity'][$counter++]);
                $stmt->bindParam(':stock_size', $size);
                $stmt->bindParam(':fk_product_id', $data['product_id']);
                if ($stmt->execute()) {
                    echo 'Stock Added';
                } else {
                    echo "Stock Failed";
                }

            }
        }

        $pos = 1;
        $sql = "UPDATE `tbl_product`
                SET
                `product_name` = :product_name,
                `product_image_path` = :product_image_path,
                `product_description` = :product_description,
                `product_is_active` = :product_active,
                `product_price` = :product_price,
                `fk_sale_id` = :fk_sale_id,
                `fk_product_cat_id` = :fk_product_cat_id
                WHERE
                `product_id` = :product_id";
        $stmt = $this->db->pdo->prepare($sql);

        $stmt->bindParam(':product_name', $data['product_name']);
        if(!empty($files['product-image']['name'])){

            $targetProduct = '../../public/img/product_img/';
            $basenameProduct = uniqid() . '-' . basename($files['product-image']['name']);
            $uploadTargetProduct = $targetProduct . $basenameProduct;
            $uploadTargetProductDb = 'http://valmbeer.badge-webdevelopment.nl/public/img/product_img/';
            $uploadTargetProductDb = $uploadTargetProductDb . $basenameProduct;
            move_uploaded_file($files['product-image']['tmp_name'], $uploadTargetProduct);
            $stmt->bindParam(':product_image_path', $uploadTargetProductDb);
        }else{
            $stmt->bindParam(':product_image_path', $data['product_image']);
        }
        $stmt->bindParam(':product_description', $data['product_description']);
        $stmt->bindParam(':product_active', $pos);
        $stmt->bindParam(':product_price', $data['product_price']);
        if(is_array($data['sale_id'])){
            $stmt->bindParam(':fk_sale_id', $data['sale_id']['LAST_INSERT_ID()']);
        }elseif(!empty($data['sale_id'])){
            $stmt->bindParam(':fk_sale_id', $data['sale_id']);
        }else{
            $null = NULL;
            $stmt->bindParam(':fk_sale_id', $null);
        }
        $stmt->bindParam(':fk_product_cat_id', $data['product_category']);
        $stmt->bindParam(':product_id', $data['product_id']);

        var_dump($data);
        if($stmt->execute()){
            die;
        }else{
            die;
        }
    }
    function updateStockSize($data){
        $sql = "UPDATE `tbl_stock`
                SET
                `stock_size` = :stock_size
                WHERE
                `stock_id` = :stock_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':stock_size', $data['sizeValue']);
        $stmt->bindParam('stock_id',$data['stockid']);
        if($stmt->execute()){
            echo "succes";
        }else{
            echo "Failure";
        }
    }
    function updateStockQuantity($data){
        $sql = "UPDATE `tbl_stock`
                SET
                `stock_quantity` = :stock_quantity
                WHERE
                `stock_id` = :stock_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':stock_quantity', $data['stockQuantity']);
        $stmt->bindParam('stock_id',$data['stockid']);
        if($stmt->execute()){
            echo "succes";
        }else{
            echo "Failure";
        }
    }

    function makeStockInactive($data){
        $sql = "UPDATE `tbl_stock`
                SET
                `stock_active` = 0
                WHERE
                `stock_id` = :stock_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':stock_id', $data['stockid']);
        if($stmt->execute()){
            echo "succes";
        }else{
            echo "Failure";
        }
    }
    
    function getCategories(){
        $sql = "SELECT * FROM `tbl_product_category`";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function searchProduct($data){
        $bindData = "%$data[search]%";
        $sql = "SELECT `tbl_product`.*, `tbl_product_category`.*
                FROM `tbl_product`
                INNER JOIN `tbl_product_category`
                ON `tbl_product`.`fk_product_cat_id`
                WHERE `tbl_product_category`.`product_cat_id` = `tbl_product`.`fk_product_cat_id`
                AND `tbl_product`.`product_name` LIKE ?
                OR `tbl_product`.`a`
               ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(1, $bindData);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <table class="product-summary table table-striped">
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
        <?php

        foreach($results as $product):?>

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
        <?php
    }

    function getProductsOnCat($data){
        $sql = "SELECT `tbl_product`.*, `tbl_product_category`.*
                FROM `tbl_product`
                INNER JOIN `tbl_product_category`
                ON `tbl_product`.`fk_product_cat_id`
                WHERE `tbl_product_category`.`product_cat_id` = `tbl_product`.`fk_product_cat_id`
                AND `fk_product_cat_id` = :cat_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(":cat_id", $data['catID']);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
        <table class="product-summary table table-striped">
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
        <?php

        foreach($results as $product):?>

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
        <?php
    }
}