<?php
include_once('./model/product.classes.php');
class DetailProduct extends Product {
    public function getDetailProductsByProduct($id) {
        $sql = "Select * from detailproduct WHERE id_product = $id ORDER BY id_detailProduct";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getDetailProductById($id) {
        $sql = "Select * from detailproduct WHERE id_detailProduct = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function updateDetailProduct($inventory,$sold,$size,$price,$id_detailProduct,$id_product) {
        $sql = "UPDATE `detailproduct` SET `inventory` = ?, `sold` = ?, `detail_size` = ?, `detail_price` = ?
        WHERE `detailproduct`.`id_detailProduct` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$inventory,$sold,$size,$price,$id_detailProduct]);
        header("Location:index.php?quanly=admin&action=detailProduct&id_sanpham=$id_product");
    }
    public function updateAmountDetailProduct($id_detailProduct,$amount) {
        $sql = "UPDATE `detailproduct` SET inventory = inventory - $amount, sold = sold + $amount 
        WHERE `id_detailProduct` = $id_detailProduct";
        $stmt = $this->connect()->query($sql);
    }
    public function deleteDetailProduct($id) {
        $sql = "DELETE FROM detailproduct WHERE id_detailProduct = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function insertDetailProduct($price,$size,$inventory,$sold,$id_product) {
        $sql = "INSERT INTO `detailproduct` (`inventory`, `sold`, `detail_size`, `detail_price`, `id_product`) 
        VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$inventory,$sold,$size,$price,$id_product]);
        header("Location:index.php?quanly=admin&action=detailProduct&id_sanpham=$id_product");
    }
}
?>