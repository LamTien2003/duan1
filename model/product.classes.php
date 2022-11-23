<?php

class Product extends DB {

    public function getProducts() {
        $sql = "Select * from product";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getProductId($id) {
        $sql = "Select * from product WHERE id_product = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getProductsLimit($start,$count) {
        $sql = "Select * from product ORDER BY id_product DESC LIMIT $start, $count ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCountProducts() {
        $sql = "Select * from product";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function insertProduct ($title,$image,$hot,$subTitle,$category,$description) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "INSERT INTO product (title_product, img_product, subTitle_product, des_product, hot_product, id_category) 
            VALUES (?, ?, ?, ?, ?, ?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title,$targetFile,$subTitle,$description,$hot,$category]);
            header("Location:index.php?quanly=admin&action=manageProduct");
        }
    }
    public function updateProduct($id_product,$image,$title,$subTitle,$description,$hot,$category) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "UPDATE product 
            SET title_product = ?, img_product = ?, subTitle_product = ?, des_product = ?, hot_product = ?,id_category = ?
            WHERE id_product = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title,$targetFile,$subTitle,$description,$hot,$category,$id_product]);
            header("Location:index.php?quanly=admin&action=manageProduct");
        }
    }
    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE id_product = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

}

?>