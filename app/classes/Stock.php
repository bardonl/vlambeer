<?php
class Stock {
    
    
    
    
    
    
    // check hoeveel stock op product
    // - wanneer product geen size heeft, geef NONE aan size
    public function checkStock($productId, $size = null) {
        if($size == null) {
            $sql = "SELECT stock_quantity FROM tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 WHERE stock_id = :productId";
        } else {
            $sql = "SELECT stock_quantity FROM tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 WHERE stock_size = :size && stock_id = :productId";
        }
        $stmt = $this->db->pdo->prepare($sql);
        if($size != null) {
            $stmt->bindParam(':size', $size);
        }
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function subtractStock($value ,$productId, $size = null) {
        $currentStock = $this->checkStock($productId, $size);
        $updateStock = $currentStock = $currentStock - $value;

        if($size == null) {
            $sql = "UPDATE tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 stock_quantity = :updateStock
                 WHERE stock_size = :size && stock_id = :productId";
        } else {
            $sql = "UPDATE tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 stock_quantity = :updateStock
                 WHERE stock_id = :productId";
        }

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':updateStock', $updateStock);
        if($size != null) {
            $stmt->bindParam(':size', $size);
        }
        $stmt->execute();
    }

    public function addStock($value, $productId, $size = null) {
        $currentStock = $this->checkStock($productId, $size);
        $updateStock = $currentStock = $currentStock + $value;

        if($size == null) {
            $sql = "UPDATE tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 stock_quantity = :updateStock
                 WHERE stock_size = :size && stock_id = :productId";
        } else {
            $sql = "UPDATE tbl_stock
                INNER JOIN tbl_product
                    on tbl_stock.stock_id = fk_stock_id
                 stock_quantity = :updateStock
                 WHERE stock_id = :productId";
        }

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':updateStock', $updateStock);
        if($size != null) {
            $stmt->bindParam(':size', $size);
        }
        $stmt->execute();
    }
}