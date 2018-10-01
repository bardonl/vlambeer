<?php
/**
 * Created by PhpStorm.
 * User: kobus
 * Date: 12/20/2016
 * Time: 9:46 AM
 */
class Shoppingcart
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Get and Set functions

    // get the columns from tbl shopping cart
    public function getCartByUserId($id) {
        $sql = "SELECT shopping_cat_id FROM tbl_shopping_cart
        INNER JOIN tbl_user
            on tbl_user.user_id = tbl_shopping_cart.fk_user_id
        WHERE tbl_user.user_id = :id AND active = 1";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function getCartProducts($userId) {
        $sql = "SELECT * FROM tbl_cart_to_product
                INNER JOIN tbl_shopping_cart
                    on shopping_cat_id = fk_shopping_cart_id
                INNER JOIN tbl_product
                    on fk_product_id = product_id
                INNER JOIN tbl_product_category
                    on fk_product_cat_id = product_cat_id
                WHERE tbl_shopping_cart.fk_user_id = :userId AND active = 1";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function getCartTotalPrice($cartId) {
        $sql = "SELECT product_price, quantity FROM tbl_product
                INNER JOIN tbl_cart_to_product
                    ON fk_product_id = product_id
                
                WHERE fk_product_id = product_id AND fk_shopping_cart_id = :cartId
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $totalPrice = 0;
        
        foreach ($result as $price) {
            $totalPrice += $price['product_price'] * $price['quantity'];
        }
        
        return $totalPrice;
    }
    
    public function getTotalItems($cartId) {
        $sql = "select sum(quantity) from tbl_cart_to_product 
        where fk_shopping_cart_id = :cartId
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);

        return $result;
    }

    // Check functions

    public function checkQuantityStock($productId) {
        $sql = "SELECT stock_quantity, stock_size from tbl_stock
        INNER JOIN tbl_product
            on tbl_product.fk_stock_id = tbl_stock.stock_id
        where :productId = stock_id";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkUserHasActiveShopCart($userId) {
        $sql = "SELECT active FROM `tbl_shopping_cart` WHERE fk_user_id = :userId && active = 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_COLUMN);
        $result = $stmt->rowCount();

        if($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkCartHasItems($cartId) {
        $sql = "SELECT fk_shopping_cart_id FROM tbl_cart_to_product
                WHERE fk_shopping_cart_id = :cartId
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_COLUMN);
        $result = $stmt->rowCount();
        
        if($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function relevantProducts($productId, $category) {
        $sql = "SELECT * FROM tbl_product
                WHERE product_id != :productId 
                AND fk_product_cat_id = :category
                
                limit 4
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // shop cart crud

    public function setAllActiveToNull($userId) {
        $sql = "UPDATE tbl_shopping_cart
                SET active = 0
                WHERE fk_user_id = :userId";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function newShopCart($userId) {
        $date = date('y-m-d');
        $this->setAllActiveToNull($userId);

        $sql = "INSERT INTO tbl_shopping_cart
                    (`fk_user_id`,`active`, `shopping_cart_date_created`)
                    VALUES
                    (:userId, 1, :date)";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    }

    public function addProductToShoppingCart($userId, $productId, $quantity, $size) {
        // check if you have shopping cart active
        if($this->checkUserHasActiveShopCart($userId) == 0) {
            // create new shop cart
            $this->newShopCart($userId);
        }

        $cartId = $this->getCartByUserId($userId);

        if($this->checkDuplicateProducts($cartId, $productId, $size) == 1) {
            $this->editQuantityShopCart($cartId, $productId, $size);
        } else {
            $sql = "INSERT INTO tbl_cart_to_product
                (`fk_shopping_cart_id`,`fk_product_id`,`quantity`, `fk_stock_size`)
                VALUES
                (:cartId, :productId, :quantity, :stockSize)";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':cartId', $cartId);
            $stmt->bindParam(':productId', $productId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':stockSize', $size);
            $stmt->execute();
        }
    }

    // shop cart management

    public function changeShopCartActiveState($shopCatId) {
        $user = new User;
        $cart = $this->getCartByUserId( $user->userId );
        $createDate = strtotime($cart['shopping_cart_date_created']);

        if($createDate >= date($createDate, time() + 1209600)) {
            $sql = "UPDATE tbl_shopping_cart
                    SET active = 0
                    WHERE shopping_cat_id = :shopCatId";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':shopCatId', $shopCatId);
            $stmt->execute();
        } else {
            $sql = "UPDATE tbl_shopping_cart
                    SET active = 1
                    WHERE shopping_cat_id = :shopCatId";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':shopCatId', $shopCatId);
            $stmt->execute();
        }
    }

    public function checkDuplicateProducts($cartId, $productId, $size) {
        $sql = "SELECT fk_product_id FROM tbl_cart_to_product
                WHERE fk_shopping_cart_id = :cartId 
                AND fk_product_id = :productId
                AND fk_stock_size = :size
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':size', $size);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_COLUMN);
        $result = $stmt->rowCount();

        if($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function editQuantityShopCart($cartId, $productId, $size) {
        $sql = "UPDATE tbl_cart_to_product SET
                quantity = quantity + 1
                WHERE fk_shopping_cart_id = :cartId
                AND fk_product_id = :productId 
                AND fk_stock_size = :size
        ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':size', $size);
        $stmt->execute();
    }
    
    public function changeQuantity($cartId, $productId, $size, $quantity) {
        $sql = "UPDATE tbl_cart_to_product SET
                quantity = :quantity
                WHERE fk_shopping_cart_id = :cartId
                AND fk_stock_size = :size
                AND fk_product_id = :productId
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':cartId', $cartId);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
    }
    
    public function removeFromCart($cartId, $productId, $size) {
        $sql = "DELETE FROM tbl_cart_to_product
                WHERE fk_shopping_cart_id = :cartId 
                AND fk_product_id = :productId
                AND fk_stock_size = :size
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam('cartId', $cartId);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':size', $size);
        $stmt->execute();
    }
    
    public function roundPrice($price) {
        return number_format($price, 2);
    }
}

