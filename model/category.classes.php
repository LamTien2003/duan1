<?php
class Category extends DB {
    
    public function getCategorys() {
        $sql = "Select * from category";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCategoryId($id) {
        $sql = "Select * from category WHERE id_category = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCategorysLimit($start,$count) {
        $sql = "Select * from category ORDER BY parent_id ASC LIMIT $start, $count ";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getParentCategory() {
        $sql = "Select * from category WHERE parent_id = 0";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getCountCategory() {
        $sql = "Select * from category";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }
    public function insertCategory($image,$title,$order,$parentId) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "INSERT INTO `category` (`name_category`, `img_category`, `order`, `parent_id`)
            VALUES (?,?,?,?);";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title,$targetFile,$order,$parentId]);
            header("Location:index.php?quanly=admin&action=manageCategory");
        }
    }
    public function updateCategory($id_category,$image,$title,$order,$parentId) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "UPDATE `category` SET `name_category` = ?, `img_category` = ?, `order` = ?, `parent_id` = ? 
            WHERE `category`.`id_category` = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title,$targetFile,$order,$parentId,$id_category]);
            header("Location:index.php?quanly=admin&action=manageCategory");
        }
    }
    public function deleteCategory($id) {
        $sql = "DELETE FROM category WHERE id_category = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function searchCategory($name,$page,$limit) {
        $start = ($page -1) * $limit;
        $sql = "Select * from category WHERE name_category LIKE '%$name%' OR id_category = '$name' ";
        $sqlResult = "Select * from category WHERE name_category LIKE '%$name%' OR id_category = '$name' ORDER BY parent_id ASC LIMIT $start,$limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $countTotalCategory = $stmt->rowCount();
        $stmt = $this->connect()->prepare($sqlResult);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return ["countTotalCategory" => $countTotalCategory, "data" => $result];
    }
}
?>