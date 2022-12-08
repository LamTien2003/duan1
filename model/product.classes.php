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
    public function getFeaturedProducts($limit) {
        $sql = "Select * from product INNER JOIN detailproduct ON product.id_product = detailproduct.id_product 
        GROUP BY product.id_product ORDER BY product.hot_product DESC LIMIT $limit";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getBestSellerProducts($limit) {
        $sql = "Select * from product INNER JOIN detailproduct ON product.id_product = detailproduct.id_product 
        GROUP BY product.id_product ORDER BY sum(detailproduct.sold) DESC LIMIT $limit";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getProductsByCategory($listIDCategory,$limit,$name) {
        $condition = "HAVING ";
        if(count($listIDCategory) > 1 ) {
            for($i = 0; $i < count($listIDCategory) ; $i++) {
                if($i == 0) {
                    $condition .= "id_category = $listIDCategory[$i] ";
                }else {
                    $condition .= "OR id_category = $listIDCategory[$i] ";
                }
            }
        }else if(count($listIDCategory) == 1) {
            $condition .= "id_category = $listIDCategory[0] ";
        }else {
            $condition .= "1";
        }
        $condition .=" AND title_product LIKE '%$name%'";
        $condition .= " LIMIT $limit";
        $sql = "Select * from product INNER JOIN detailproduct ON product.id_product = detailproduct.id_product GROUP BY product.id_product $condition";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCountProductsByCategory($listIDCategory,$name) {
        $condition = "WHERE ";
        if(count($listIDCategory) > 1 ) {
            for($i = 0; $i < count($listIDCategory) ; $i++) {
                if($i == 0) {
                    $condition .= "id_category = $listIDCategory[$i] ";
                }else {
                    $condition .= "OR id_category = $listIDCategory[$i] ";
                }
            }
        }else if(count($listIDCategory) == 1) {
            $condition .= "id_category = $listIDCategory[0] ";
        }else {
            $condition .= "1";
        }
        $condition .=" AND title_product LIKE '%$name%'";
        $sql = "Select * from product $condition";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function getAllSizeAvaible() {
        $sql = "SELECT * FROM `detailproduct` GROUP BY detail_size";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
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
    public function searchProduct($name,$page,$limit) {
        $start = ($page -1) * $limit;
        $sql = "Select * from product WHERE title_product LIKE '%$name%' OR id_product = '$name' ";
        $sqlResult = "Select * from product WHERE title_product LIKE '%$name%' OR id_product = '$name' LIMIT $start,$limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $countTotalProduct = $stmt->rowCount();
        $stmt = $this->connect()->prepare($sqlResult);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return ["countTotalProduct" => $countTotalProduct, "data" => $result];
    }
}

?>