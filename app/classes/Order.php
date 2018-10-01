<?php

/**
 * Created by PhpStorm.
 * User: kobus
 * Date: 12/20/2016
 * Time: 4:37 PM
 */
class Order
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getOrderById($orderId) {
        $sql = "SELECT * FROM tbl_order
                INNER JOIN tbl_order_to_product
                    on order_id = fk_order_id
                INNER JOIN tbl_product
                    on product_id = fk_product_id
                where order_id = :orderId
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllOrders($userId = NULL) {

        if($userId == NULL) {
            $sql = "SELECT * FROM `tbl_order` 
                    ORDER BY order_id DESC";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() == 0) {
                return 'none';
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        } else {
            $sql2 = "SELECT * FROM `tbl_order`
                    INNER JOIN tbl_user
                        ON fk_user_id = user_id
                    WHERE fk_user_id = :userId
                    ORDER BY paid";

            $stmt = $this->db->pdo->prepare($sql2);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            if($stmt->rowCount() == 0) {
                return 'none';
            } else {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }


    }

    public function getUsernameFromOrder($orderId = NULL) {

            $sql = "SELECT username FROM tbl_user
                INNER JOIN tbl_order
                    ON fk_user_id = user_id
                WHERE order_id = :orderId 
                AND fk_user_id = user_id
            ";

            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            return $result;
    }

    public function getOrderFromUser($userId) {
        $sql = "SELECT * FROM tbl_order
                WHERE fk_user_id = :userId 
                ORDER BY order_id DESC
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();


        if($stmt->rowCount() == 0) {
            return 'none';
        } else {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getTotalPrice($orderId) {
        $sql = "SELECT product_price, quantity FROM tbl_product
                INNER JOIN tbl_order_to_product
                    on product_id = fk_product_id
                    
                 WHERE fk_order_id = :orderId
                ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();

        if($stmt->rowCount() > 1) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
        }



       

        return $result;
    }

    public function registerBillingAddress($array) {
        $sql = "INSERT INTO tbl_billing_address
        (`billing_streetname`, `billing_housenumber`, `billing_zipcode`, 
        `billing_city`, `billing_country`, `billing_state_or_province`)
        VALUES
        (:streetname, :housenumber, :zipcode, 
        :city, :country, :stateOrProvince)";

        $stmt = $this->db->pdo->prepare($sql);
        foreach ($array as $key => $val) {
            $stmt->bindParam(':' . $key, $val);
        }
        $stmt->execute();
    }

    public function getLastOrderOfUser($userId) {
        $sql = "SELECT order_id FROM `tbl_order` 
        WHERE fk_user_id = :userId 
        ORDER BY order_id DESC LIMIT 1
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        
        return $result;
    }

    public function getNotPaidOrder($userId) {
        $sql = "SELECT * FROM tbl_order
                WHERE paid = 0
                AND fk_user_id = :userId
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    public function createOrder($userId) {
        $user = new User();

        $vatId = 1;
        $sql = "INSERT INTO tbl_order
                (`fk_user_id`,`fk_vat_id`)
                VALUES
                (:userId, :vatId)
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':vatId', $vatId);
        $stmt->execute();
        }

        public function productsToOrder($orderId, $quantity, $size, $productId) {            
            $sql = "INSERT INTO tbl_order_to_product
                    (`quantity`, `fk_stock_size`, 
                    `fk_order_id`, `fk_product_id`)
                    VALUES
                    (:quantity, :size, :orderId, :productId)
            ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':size', $size);
            $stmt->bindParam(':orderId', $orderId);
            $stmt->bindParam(':productId', $productId);
            $stmt->execute();
    }
    
    public function editOrderStatus($orderId, $orderStatus) {
        $sql = "UPDATE tbl_order
                SET order_status = :orderStatus
                WHERE order_id = :orderId
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->bindParam(':orderStatus', $orderStatus);
        $stmt->execute();
        
    }
    
}