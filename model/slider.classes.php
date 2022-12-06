<?php
class Slider extends DB {
    public function getSliders() {
        $sql = "SELECT * FROM `slider` ORDER BY `slider`.`order` ASC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function getSliderId($id) {
        $sql = "SELECT * FROM `slider` WHERE id_slider = $id";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    public function deleteSlider($id) {
        $sql = "DELETE FROM slider WHERE id_slider = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }
    public function updateSlider($image,$link,$title,$subtitle,$order,$id_slider) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "UPDATE `slider` SET `slider_img` = ?, `slider_link` = ?, `slider_title` = ?, `slider_subtitle` = ?, `order` = ? 
            WHERE `slider`.`id_slider` = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$targetFile,$link,$title,$subtitle,$order,$id_slider]);
            header("Location:index.php?quanly=admin&action=manageSlider");
        }
    }
    public function insertSlider($image,$link,$title,$subtitle,$order) {
        $targetFile = $this->addImageToFolder($image);
        if($targetFile) {
            $sql = "INSERT INTO `slider` (`slider_img`, `slider_link`, `slider_title`, `slider_subtitle`, `order`) 
            VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$targetFile,$link,$title,$subtitle,$order]);
            header("Location:index.php?quanly=admin&action=manageSlider");
        }
    }
}

?>